<?php

/**
 * Basic Webservice component class
 *
 * @author wkoller
 */
abstract class WSComponent extends SourceComponent {

    /**
     * Internal reference variable for the service id, needs to be set in the sub-implementation
     * @var int ID of registered service
     */
    protected $m_service_id = null;

    /**
     * Timeout for cached responses in seconds
     * @var int 
     */
    protected $m_timeout = 86400;

    /**
     * URI to identify this webservice
     * @var string 
     */
    private $m_url = null;

    /**
     * If the service uses a different encoding than UTF-8, you can specify it here to do an automatic transcoding to/from UTF-8
     * @var String
     */
    protected $sourceEncoding = NULL;

    /**
     * Setter function for URL, automatically checks the service for validity
     * @param string $value URI to identify the webservice with
     * @throws Exception
     */
    protected function setUrl($value) {
        $this->m_url = $value;

        // find the service definition & check validity
        $model_service = Service::model()->findByAttributes(array(
            'url' => $this->m_url
        ));
        if ($model_service == null) {
            throw new Exception("Invalid service");
        }

        // remember service id
        $this->m_service_id = $model_service->id;
    }

    /**
     * Return the URL of this service
     * @return type
     */
    protected function getUrl() {
        return $this->m_url;
    }

    /**
     * Returns the cached response for a given query
     * @param mixed $query Query to look for
     * @return mixed null if no valid response was found, else the response
     */
    protected function getCachedResponse($query) {
        if ($this->m_service_id == null) {
            throw new Exception('Set service Id before using the cache!');
        }
        $query = sha1(serialize($query));   // using SHA1 to make this quicker
        // find cached entry for this query
        $dbCriteria = new CDbCriteria();
        $dbCriteria->compare('service_id', $this->m_service_id);
        $dbCriteria->compare('query', $query);
        // make sure it's recent enough
        $dbCriteria->compare('timestamp', '>=' . (time() - $this->m_timeout));

        // only the most recent entry
        $dbCriteria->order = 'timestamp DESC';
        $dbCriteria->limit = 1;
        $model_webserviceCache = WebserviceCache::model()->find($dbCriteria);

        // check for valid cache entry
        if ($model_webserviceCache != null) {
            return unserialize($model_webserviceCache->response);
        }

        return null;
    }

    /**
     * Store a response in the cache
     * @param mixed $query Query to cache this response for
     * @param mixed $response Response to cache
     * @throws Exception
     */
    protected function setCachedResponse($query, $response) {
        if ($this->m_service_id == null) {
            throw new Exception('Set service Id before using the cache!');
        }
        $query = sha1(serialize($query));   // using SHA1 to make this quicker
        $response = serialize($response);

        // remember new values and cache them
        $model_webserviceCache = new WebserviceCache();
        $model_webserviceCache->service_id = $this->m_service_id;
        $model_webserviceCache->query = $query;
        $model_webserviceCache->response = $response;
        $model_webserviceCache->timestamp = time();
        $model_webserviceCache->save();
    }

    /**
     * Helper function for cleaning outdated cache entries
     */
    protected function cleanCache() {
        // construct criteria for deleting
        $dbCriteria = new CDbCriteria();
        // only delete outdated entries
        $dbCriteria->compare('timestamp', '<' . (time() - $this->m_timeout));
        $dbCriteria->compare('service_id', '=' . $this->m_service_id);

        // finally delete all matching entries
        WebserviceCache::model()->deleteAll($dbCriteria);
    }

    /**
     * Transcode the result to UTF-8, if necessary NOTE: this needs to be explicitly called from your implementation
     * @param array $result
     * @return array
     */
    protected function transcode_results($result) {
        if ($this->sourceEncoding == NULL) {
            return $result;
        }

        foreach ($result as $key => $value) {
            if (is_array($value)) {
                $array[$key] = $this->transcode_results($value);
            } else {
                $array[$key] = mb_convert_encoding($value, $this->sourceEncoding, 'UTF-8');
            }
        }

        return $result;
    }

}

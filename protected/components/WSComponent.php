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
    protected $m_url = null;
    
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
        if( $model_service == null ) {
            throw new Exception("Invalid service");
        }
        
        // remember service id
        $this->m_service_id = $model_service->id;
    }
    
    /**
     * Returns the cached response for a given query
     * @param mixed $query Query to look for
     * @return mixed null if no valid response was found, else the response
     */
    protected function getCachedResponse($query) {
        if( $this->m_service_id == null ) {
            throw new Exception('Set service Id before using the cache!');
        }
        $query = sha1(serialize($query));   // using SHA1 to make this quicker
        
        // find cached entry for this query
        $model_webserviceCache = WebserviceCache::model()->findByAttributes(array(
            'service_id' => $this->m_service_id,
            'query' => $query
        ));
        
        if( $model_webserviceCache != null && $model_webserviceCache->timestamp >= (time() - $this->m_timeout) ) {
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
    protected function setCachedResponse($query,$response) {
        if( $this->m_service_id == null ) {
            throw new Exception('Set service Id before using the cache!');
        }
        $query = sha1(serialize($query));   // using SHA1 to make this quicker
        $response = serialize($response);
        
        // find old cached entry for this query
        $model_webserviceCache = WebserviceCache::model()->findByAttributes(array(
            'service_id' => $this->m_service_id,
            'query' => $query
        ));
        if( $model_webserviceCache == null ) $model_webserviceCache = new WebserviceCache();
        
        // remember new values and cache them
        $model_webserviceCache->service_id = $this->m_service_id;
        $model_webserviceCache->query = $query;
        $model_webserviceCache->response = $response;
        $model_webserviceCache->timestamp = time();
        $model_webserviceCache->save();
    }
}

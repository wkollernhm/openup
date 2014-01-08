<?php
/**
 * Controller for handling requests to the common names webservice
 * For details on the actual service see http://open-up.eu/content/common-names-service
 */
class CommonNamesController extends Controller {
    /**
     * Main entry function for querying for common names using the Reconciliation API
     * @param array $query
     * @param array $queries
     * @return array
     */
    public function japiGetCommonNames($query = NULL, $queries = NULL) {
        $return = array( 'result' => array() );
        
        // decode input parameters
        $query = json_decode($query, true);
        $queries = json_decode($queries, true);
        
        // check if we received no request
        if( $query == NULL && $queries == NULL ) {
            $return['name'] = 'OpenUp! Common Names Service';
            $return['identifierSpace'] = 'http://openup.nhm-wien.ac.at/commonNames/';
            $return['schemaSpace'] = 'http://openup.nhm-wien.ac.at/commonNames/';
            unset($return['result']);
        }
        // check for single query mode
        else if( $query != NULL && is_array($query) ) {
            $return['result'] = $this->handleQuery($query);
        }
        // multi-query mode?
        else if( $queries != NULL && is_array($queries) ) {
            // handle each sub-query separately
            foreach( $queries as $index => $query ) {
                $return['result'][$index] = $this->handleQuery($query);
            }
        }
        else {
            header('HTTP/1.0 400 Bad Request', true, 400);
            exit();
        }

        return $return;
    }
    
    /**
     * Receive common names for scientific name and output response in SKOS
     * @param type $query
     * @param type $queries
     */
    public function actionCommonNamesEDMSKOS($query = NULL, $queries = NULL) {
        // used result from normal JSON call and encode it in SKOS
        $response = $this->japiGetCommonNames($query, $queries);
        
        // Send correct XML header
        header('Content-Type: application/xml');
        
        // check for service metadata response
        if( !isset($response['result']) ) {
            // output SKOS metadata response
            $this->renderPartial('edmSkos/metadata', array( 'response' => $response ));
        }
        // this is a response to a query
        else {
            // output SKOS response
            $this->renderPartial('edmSkos/response', array( 'entries' => $response['result'] ));
        }
    }
    
    /**
     * Helper action for cleaning the cache
     */
    public function actionCleanCache() {
        SourceComponent::cleanCaches();
        
        echo "Cache clean!";
    }
    
    /**
     * Render an HTML page which displays all common names and their references for a given scientific name id
     * @param int $scientific_name_id
     */
    public function actionShowReferencesForScientificName($scientific_name_id) {
        $scientific_name_id = intval($scientific_name_id);
        if( $scientific_name_id <= 0 ) {
            die('Invalid scientific name id passed - please check your input!');
        }
        
        // fetch the actual scientific name
        $model_scientificNameCache = ScientificNameCache::model()->findByPk($scientific_name_id);
        if( $model_scientificNameCache == NULL ) {
            die('Scientific name not found - make sure you provide a valid id!');
        }
        
        // now query all sources for the name
        $commonName_results = SourceComponent::querySources($model_scientificNameCache->name);
        
        // render the references page
        $this->render('referencesForScientificName', array(
            'model_scientificNameCache' => $model_scientificNameCache,
            'commonName_results' => $commonName_results,
        ));
    }
    
    /**
     * handle a single query and return the result
     * @param string $query Query as JSON-String
     * @return array response according to webservice specification
     */
    protected function handleQuery($query) {
        // check for valid query
        if( $query == NULL || !isset($query['type']) || $query['type'] != '/name/common' || !isset($query['query']) ) {
            header('HTTP/1.0 400 Bad Request', true, 400);
            exit();
        }
        
        // query sources and return them
        return SourceComponent::querySources($query['query']);
    }

    /**
     * Define this controller as JSON controller
     */
    public function actions() {
        return array(
            'japi'=>'JApi',
        );
    }
    
    /**
     * Define file for output caching
     */
    public function filters() {
        return array(
            array(
                'CHttpCache',
                'duration' => 86400,
                'varyByParam' => array('query', 'queries', 'noCache', 'scientific_name_id'),
            ),
        );
    }

    public function accessRules() {
        return array(
            array('allow', // deleting
                'actions' => array('commonNamesEDMSKOS', 'cleanCache', 'showReferencesForScientificName'),
                'users' => array('*'),
            ),
        );
    }
}

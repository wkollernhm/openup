<?php
/**
 * JSON Controller for handling requests to the common names webservice
 * For details on the actual service see http://open-up.eu/content/common-names-service
 */
class JSONCommonNamesController extends Controller {
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
            $return['identifierSpace'] = 'http://open-up.eu/commonNames/';
            $return['schemaSpace'] = 'http://open-up.eu/commonNames/';
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
                'varyByParam' => array('query', 'queries', 'noCache'),
            ),
        );
    }

    public function accessRules() {
        return array(
            array('allow', // deleting
                'actions' => array('commonNamesEDMSKOS', 'cleanCache'),
                'users' => array('*'),
            ),
        );
    }
}

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

        // check if we received no request
        if( $query == NULL && $queries == NULL ) {
            $return['name'] = 'OpenUp! Common Names Service';
            $return['identifierSpace'] = 'http://open-up.eu/commonNames/';
            $return['schemaSpace'] = 'http://open-up.eu/commonNames/';
            unset($return['result']);
        }
        // check for single query mode
        else if( $query != NULL ) {
            $return['result'] = $this->handleQuery(json_decode($query, true));
        }
        // multi-query mode?
        else if( $queries != NULL ) {
            $queries = json_decode($queries, true);
            
            // check if we have a valid queries array
            if( is_array($queries) ) {
                // handle each sub-query separately
                foreach( $queries as $index => $query ) {
                    $return['result'][$index] = $this->handleQuery($query);
                }
            }
            else {
                header('HTTP/1.0 400 Bad Request', true, 400);
                exit();
            }
        }

        return $return;
    }

    /**
     * handle a single query and return the result
     * @param string $query Query as JSON-String
     * @return array response according to webservice specification
     */
    private function handleQuery($query) {
        $response = array();

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
                'COutputCache',
                'duration' => 86400,
                'varyByParam' => array('query', 'queries'),
            ),
        );
    }

}

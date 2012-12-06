<?php
/**
 * JSON Controller for handling requests to the common names webservice
 * For details on the actual service see http://open-up.eu/content/common-names-service
 */
class JSONCommonNamesController extends Controller {
    public function japiGetCommonNames($query = null, $queries = null) {
        $return = array();

        // check if we received no request
        if( $query == null && $queries == null ) {
            $return['name'] = 'OpenUp! Common Names Service';
            $return['identifierSpace'] = 'http://open-up.eu/commonNames/';
            $return['schemaSpace'] = 'http://open-up.eu/commonNames/';
        }
        // check for single query mode
        else if( $query != null ) {
            $return = $this->handleQuery(json_decode($query, true));
        }
        // multi-query mode?
        else if( $queries != null ) {
            $queries = json_decode($queries, true);
            
            // check if we have a valid queries array
            if( is_array($queries) ) {
                // handle each sub-query separately
                foreach( $queries as $index => $query ) {
                    $return[$index] = $this->handleQuery($query);
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
        if( $query == null || $query['type'] != '/name/common' ) {
            header('HTTP/1.0 400 Bad Request', true, 400);
            exit();
        }

        // ask all services
        $webservices = WSComponent::getWebservices();
        foreach ($webservices as $webservice) {
            $response = array_merge($response, $webservice->query($query['query']) );
        }

        return $response;
    }

    /**
     * Define this controller as JSON controller
     */
    public function actions() {
        return array(
            'japi'=>'JApi',
        );
    }
}

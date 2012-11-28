<?php
/**
 * JSON Controller for handling requests to the common names webservice
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
            // decode json query
            $query = json_decode($query, true);
            
            // check for valid query
            if( $query == null ) {
                header('HTTP/1.0 400 Bad Request', true, 400);
                exit();
            }
        }
        
        return $return;
    }
    
    public function actions() {
        return array(
            'japi'=>'JApi',
        );
    }
}

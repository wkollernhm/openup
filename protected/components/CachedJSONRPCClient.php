<?php
/**
 * Copyright 2012 Naturhistorisches Museum Wien
 */

/**
 * CachedJSONRPCClient class
 * Class for wrapping a JSONRPCClient object and provide automatic caching
 * functionality for it.
 * @author Wolfgang Koller
 * @version 1.0
 * @since 2012-12-04
 * @package at.ac.nhmwien
 */
abstract class CachedJSONRPCClient extends WSComponent {
    /**
     * Remote URL
     * @var string
     */
    private $m_url = null;
    /**
     * SoapClient instance for querying the external service
     * @var SoapClient
     */
    private $m_jsonRPCClient = null;
    
    /**
     * Internal helper function which returns a "real" SoapClient object
     * @return SoapClient 
     */
    private function JSONRPCClient() {
        if( $this->m_jsonRPCClient == null ) {
            $this->m_jsonRPCClient = new jsonRPCClient($this->m_url);
        }
        
        return $this->m_jsonRPCClient;
    }

    /**
     * Setter function for WSDL, automatically checks the service for validity
     * @param string $value URI to WSDL file
     * @throws Exception
     */
    public function setUrl($value) {
        $this->m_url = $value;
        
        // find the service definition & check validity
        $model_service = Service::model()->findByAttributes(array(
            'url' => $this->m_url
        ));
        if( $model_service == null ) {
            throw new Exception("Invalid JSON-RPC service");
        }
        
        // remember service id
        $this->m_service_id = $model_service->id;
    }
    
    /**
     * Invoked if the function called does not exist. It checks if this is
     * either a "native" SoapClient method or a function which is defined by the
     * WSDL file. Calls to the remote soap-service are automatically cached and
     * answered with the cached version if available.
     * The actual remote soap-service is only invoked if required (this also
     * means that the SoapClient object is only constructed if required).
     * @param type $name
     * @param type $arguments
     * @return type 
     */
    public function __call( $name , $arguments ) {
        // Check if we have a "standard" SoapClient function
        if( method_exists( "CachedJSONRPCClient", $name ) ) {
            return call_user_func_array( array( $this->JSONRPCClient(), $name ), $arguments );
        }
        // This is a WSDL defined function, which means we can check the cache for it
        else {
            // construct query string
            $query = array($name,$arguments);
            
            // check for cached result
            $response = $this->getCachedResponse($query);
            if( $response != null ) {
                return $response;
            }
            // we need to refresh the request and cache the response
            else {
                $response = call_user_func_array( array( $this->JSONRPCClient(), $name ), $arguments );

                // cache the response
                $this->setCachedResponse($query, $response);
                
                return $response;
            }
        }
    }
}

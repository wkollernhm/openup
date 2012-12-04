<?php
/**
 * Copyright 2012 Naturhistorisches Museum Wien
 */

/**
 * CachedSoapClient class
 * Class for wrapping a SoapClient object and provide automatic caching
 * functionality for it.
 * @author Wolfgang Koller
 * @version 1.0
 * @since 2012-03-8 
 * @package at.ac.nhmwien
 */
class CachedSoapClient extends WSComponent {
    private $m_wsdl = null;
    private $m_soapClient = null;
    /**
     * @var Service 
     */
    private $m_model_service = null;
    
    /**
     * Timeout for cached responses in seconds
     * @var int 
     */
    private $m_timeout = 604800;
    
    /**
     * Internal helper function which returns a "real" SoapClient object
     * @return SoapClient 
     */
    private function SoapClient() {
        if( $this->m_soapClient == null ) {
            $this->m_soapClient = new SoapClient( $this->m_wsdl );
        }
        
        return $this->m_soapClient;
    }

    /**
     * Setter function for WSDL, automatically checks the service for validity
     * @param string $value URI to WSDL file
     * @throws Exception
     */
    public function setWsdl($value) {
        $this->m_wsdl = $value;
        
        // find the service definition
        $this->m_model_service = Service::model()->findByAttributes(array(
            'url' => $this->m_wsdl
        ));
        
        // check for valid service definition
        if( $this->m_model_service == null ) {
            throw new Exception("Invalid Soap service");
        }
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
        if( method_exists( "CachedSoapClient", $name ) ) {
            return call_user_func_array( array( $this->SoapClient(), $name ), $arguments );
        }
        // This is a WSDL defined function, which means we can check the cache for it
        else {
            // construct query string
            $query = serialize(array($name,$arguments));
            
            // find cached entries for this query
            $model_webserviceCache = WebserviceCache::model()->findByAttributes(array(
                'service_id' => $this->m_model_service->id,
                'query' => $query
            ));
            
            // check for cached result
            if( $model_webserviceCache == null ) {
                $model_webserviceCache = new WebserviceCache();
            }
            
            // check if cached result is still valid
            if( $model_webserviceCache->timestamp >= (time() - $this->m_timeout) ) {
                return unserialize($model_webserviceCache->response);
            }
            // we need to refresh the request and cache the response
            else {
                $response = call_user_func_array( array( $this->SoapClient(), $name ), $arguments );
                
                // remember new values and cache them
                $model_webserviceCache->service_id = $this->m_model_service->id;
                $model_webserviceCache->query = $query;
                $model_webserviceCache->response = serialize($response);
                $model_webserviceCache->timestamp = time();
                $model_webserviceCache->save();
                
                return $response;
            }
        }
    }
}

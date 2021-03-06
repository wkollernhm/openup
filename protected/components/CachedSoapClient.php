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
abstract class CachedSoapClient extends WSComponent {
    /**
     * SoapClient instance for querying the external service
     * @var SoapClient
     */
    private $m_soapClient = null;
    
    /**
     * Soap Version to use for the client
     * @var string
     */
    protected $m_soapVersion = SOAP_1_1;
    
    /**
     * A list of function (names) which should not be cached
     * @var array
     */
    protected $m_noCacheFunctions = array();
    
    /**
     * Internal helper function which returns a "real" SoapClient object
     * @return SoapClient 
     */
    private function SoapClient() {
        if( $this->m_soapClient == null ) {
            $this->m_soapClient = new SoapClient(
                    $this->url,
                    array(
                        'trace' => true,
                        'soap_version' => $this->m_soapVersion
                    )
            );
        }
        
        return $this->m_soapClient;
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
        try {
            // Check if we have a "standard" SoapClient function
            if( method_exists( "CachedSoapClient", $name ) ) {
                return call_user_func_array( array( $this->SoapClient(), $name ), $arguments );
            }
            // This is a WSDL defined function, which means we can check the cache for it
            else {
                $response = NULL;
                $bCache = !in_array($name, $this->m_noCacheFunctions);  // check if function should be cached
                
                // check if function should not be cached
                if( $bCache ) {
                    // construct query string
                    $query = array($name,$arguments);
                    // check for cached result
                    $response = $this->getCachedResponse($query);
                }
                
                // check if a cached response was found
                if( $response != null ) {
                    return $response;
                }
                // we need to refresh the request and cache the response
                else {
                    $response = call_user_func_array( array( $this->SoapClient(), $name ), $arguments );

                    // cache the response
                    if( $bCache) $this->setCachedResponse($query, $response);

                    return $response;
                }
            }
        }
        catch(Exception $e) {
            error_log($e->getMessage());
            error_log($e->getTraceAsString());
            if( $this->m_soapClient != NULL ) {
                error_log($this->m_soapClient->__getLastRequestHeaders());
                error_log($this->m_soapClient->__getLastRequest());
                error_log($this->m_soapClient->__getLastResponse());
            }
            
            return null;
        }
    }
}

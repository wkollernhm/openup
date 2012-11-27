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
class CachedSoapClient {
    private $m_soapClient = null;
    private $m_wsdl = null;
    private $m_options = null;
    private $m_dbh = null;
    private $m_table = "soap_cache";
    
    /**
     * Timeout for cached responses in seconds
     * @var int 
     */
    private $m_timeout = 604800;
    
    /**
     * This constructor equals the SoapClient constructor for migration reasons
     * See the SoapClient documentation for details
     * @param string $wsdl
     * @param array $options 
     */
    public function __construct($wsdl, $options = array() ) {
        $this->m_wsdl = $wsdl;
        $this->m_options = $options;
    }
    
    /**
     * Enable caching for the SoapClient
     * @param string $name Name of database
     * @param string $host Host of database
     * @param string $user User for accessing the database
     * @param string $pass Password for user
     * @param string $table Name of table to use for caching
     */
    public function setCaching( $name, $host, $user, $pass, $table = "soap_cache" ) {
        $this->m_dbh = new PDO("mysql:dbname=" . $name . ";host=" . $host, $user, $pass);
        $this->m_table = $table;
    }
    
    /**
     * Internal helper function which returns a "real" SoapClient object
     * @return SoapClient 
     */
    private function SoapClient() {
        if( $this->m_soapClient == null ) {
            $this->m_soapClient = new SoapClient( $this->m_wsdl, $this->m_options );
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
        // Check if we have a "standard" SoapClient function
        if( method_exists( "SoapClient", $name ) ) {
            return call_user_func_array( array( $this->SoapClient(), $name ), $arguments );
        }
        // This is a WSDL defined function, which means we can check the cache for it
        else {
            // Check if caching is enabled
            if( $this->m_dbh != null ) {
                $sth = $this->m_dbh->prepare( "SELECT `response` FROM `" . $this->m_table . "` WHERE `wsdl` = ? AND `function` = ? AND `query` = ? AND `` < DATE_SUB(NOW(), INTERVAL SECOND ?)" );
                $sth->bindValue( 1, sha1($this->m_wsdl), PDO::PARAM_STR );
                $sth->bindValue( 2, $name, PDO::PARAM_STR );
                $sth->bindValue( 3, serialize($arguments), PDO::PARAM_STR );
                $sth->bindValue( 4, $this->m_timeout, PDO::PARAM_INT );
                $sth->execute();
                $response = $sth->fetch(PDO::FETCH_ASSOC);
                
                // Check if there is a cached response available
                if( $response ) {
                    error_log( "Cached response" );
                    return unserialize($response);
                }
                // If not query Soap-Service and cache the response
                else {
                    $response = call_user_func_array( array( $this->SoapClient(), $name ), $arguments );
                    
                    // Write response & query information to database
                    $sth = $this->m_dbh->prepare( "INSERT INTO `" . $this->m_table . "` ( `wsdl`, `function`, `query`, `response` ) values ( ?, ?, ?, ? )" );
                    $sth->bindValue( 1, sha1($this->m_wsdl), PDO::PARAM_STR );
                    $sth->bindValue( 2, $name, PDO::PARAM_STR );
                    $sth->bindValue( 3, serialize($arguments), PDO::PARAM_STR );
                    $sth->bindValue( 4, serialize($response), PDO::PARAM_STR );
                    $sth->execute();

                    return $response;
                }
            }
            else {
                // If caching didn't work, call the function directly
                return call_user_func_array( array( $this->SoapClient(), $name ), $arguments );
            }
        }
    }
}

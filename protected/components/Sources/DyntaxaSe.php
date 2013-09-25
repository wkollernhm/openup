<?php
/**
 * DyntaxaSe Webservice implementation
 *
 * @author wkoller
 */
class DyntaxaSe extends CachedSoapClient {
    /**
     * username to use for login
     * @var string
     */
    public $userName;
    
    /**
     * password to use for login
     * @var string
     */
    public $password;
    
    /**
     * application identifier to use for login
     * @var string
     */
    public $applicationIdentifier;
    
    /**
     * activiationrequired flag to use for login
     * @var bool
     */
    public $isActivationRequired;
    
    public function init() {
        parent::init();
        $this->url = 'https://taxon.artdatabankensoa.se/TaxonService.svc?wsdl';
        
        $this->m_timeout = 2592000; // 30 days
    }
    
    /**
     * Query the Dyntaxa.se webservice and return the results
     * @param string $term Term to query for
     * @return array response information
     */
    public function query($term) {
        $response = array();
        
        // login to the service
        $WebLoginResponse = $this->Login(
                array(
                    'userName' => $this->userName, 
                    'password' => $this->password, 
                    'applicationIdentifier' => $this->applicationIdentifier,
                    'isActivationRequired' => $this->isActivationRequired
                )
        );
        $WebLoginResponse = $WebLoginResponse->LoginResult;
        
        // construct internal webclient information object
        $WebClientInformation = array(
            'Locale' => $WebLoginResponse->Locale,
            'Role' => NULL,
            'Token' => $WebLoginResponse->Token
        );
        
        // Logout after calling the service
        $this->Logout(
                array(
                    'clientInformation' => $WebClientInformation
                )
        );
        
        return $response;
    }
}

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
        
        // do not cache authentication functions
        $this->m_noCacheFunctions = array(
            'Login',
            'Logout'
        );
    }
    
    /**
     * Query the Dyntaxa.se webservice and return the results
     * @param string $term Term to query for
     * @return array response information
     */
    public function query($term) {
        $response = array();
        
        // login to the service
        $WebLoginResponse = $this->Login(array(
            'userName' => $this->userName, 
            'password' => $this->password, 
            'applicationIdentifier' => $this->applicationIdentifier,
            'isActivationRequired' => $this->isActivationRequired,
        ));
        $WebLoginResponse = $WebLoginResponse->LoginResult;
        
        // construct internal webclient information object
        $WebClientInformation = array(
            'Locale' => $WebLoginResponse->Locale,
            'Role' => NULL,
            'Token' => $WebLoginResponse->Token,
        );
        
        // construct WebStringSearchCriteria object
        $WebStringSearchCriteria = array(
            'SearchString' => $term,
            'CompareOperators' => array(
                'Like',
            ),
        );
        
        // construct WebTaxonSearchCriteria object
        $WebTaxonSearchCriteria = array(
            'TaxonNameSearchString' => $WebStringSearchCriteria,
        );
        
        // query service for taxa by this name
        $WebTaxons = $this->GetTaxaBySearchCriteria(array(
            'clientInformation' => $WebClientInformation,
            'searchCriteria' => $WebTaxonSearchCriteria,
        ));
        $WebTaxons = $WebTaxons->GetTaxaBySearchCriteriaResult;
        
        // check if we have some results
        if( isset($WebTaxons->WebTaxon) ) {
            $WebTaxons = $WebTaxons->WebTaxon;
            
            // make sure result is in array form (it's no array if only a single match is found)
            if( !is_array($WebTaxons) ) {
                $WebTaxons = array($WebTaxons);
            }
            
            // iterate over results and add them to response
            foreach($WebTaxons as $WebTaxon) {
                $response[] = array(
                    "name" => $WebTaxon->CommonName,
                    "language" => 'swe',
                    'geography' => NULL,
                    'period' => NULL,
                    "score" => 100,
                    "match" => true,
                    "references" => array('Dyntaxa (' . date('Y') . ') Swedish Taxonomic Database. Accessed at https://www.dyntaxa.se/Taxon/Info/' . $WebTaxon->Id . ' at [' . date('Y-m-d') . ']'),
                    "taxon" => $WebTaxon->ScientificName,
                );
            }
        }
        
        // Logout after calling the service
        $this->Logout(array(
            'clientInformation' => $WebClientInformation,
        ));
        
        // finally return the response
        return $response;
    }
}

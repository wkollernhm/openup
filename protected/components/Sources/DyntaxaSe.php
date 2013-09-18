<?php
/**
 * DyntaxaSe Webservice implementation
 *
 * @author wkoller
 */
class DyntaxaSe extends CachedSoapClient {
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
        
        return $response;
    }
}

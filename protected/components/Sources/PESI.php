<?php
/**
 * PESI Webservice implementation
 *
 * @author wkoller
 */
class PESI extends CachedSoapClient {
    public function init() {
        parent::init();
        $this->url = 'http://www.eu-nomen.eu/portal/soap.php?wsdl=1';
        
        $this->m_timeout = 2592000; // 30 days
    }
    
    /**
     * Query the PESI webservice and return the results
     * @param string $term Term to query for
     * @return array response information
     */
    public function query($term) {
        $response = array();
        
        // Fetch records matching our query
        $records = $this->getPESIRecords( $term, false );
        if( is_array($records) ) {
            // Check all records and analyze the data
            foreach( $records as $record ) {
                $guid = $record->GUID;

                $vernaculars = $this->getPESIVernacularsByGUID( $guid );

                foreach( $vernaculars as $vernacular ) {
                    if( !isset( $vernacular->vernacular ) ) continue;

                    $response[] = array(
                        "name" => $vernacular->vernacular,
                        "language" => $vernacular->language_code,
                        'geography' => NULL,
                        'period' => NULL,
                        "score" => 100,
                        "match" => true,
                        "references" => array('pesi'),
                        "taxon" => $record->scientificname,
                    );
                }
            }
        }
        
        return $response;
    }
}

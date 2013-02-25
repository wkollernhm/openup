<?php
/**
 * PESI Webservice implementation
 *
 * @author wkoller
 */
class ArtsdatabankenNo extends CachedSoapClient {
    public function init() {
        parent::init();
        $this->url = 'http://webtjenester.artsdatabanken.no/Artsnavnebase.asmx?WSDL';
        
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
        $records = $this->Artssok( array('Search' => $term) );
        $ArtssokResult = $records->ArtssokResult;
        
        // check for found response
        if( isset($ArtssokResult->LatinskNavn) ) {
            $LatinskNavn = $ArtssokResult->LatinskNavn;
            $Takson = $LatinskNavn->Takson;
            
            // create fake array for single result entries
            $Popularnavns = $Takson->Popularnavn;
            if( !is_array($Popularnavns) ) $Popularnavns = array( $Popularnavns );

            // add all popularnavn
            foreach( $Popularnavns as $Popularnavn ) {
                // create fake array for single result entries
                $Navns = $Popularnavn->Navn;
                if( !is_array($Navns) ) $Navns = array($Navns);
                
                // cycle through actual names and add them
                foreach( $Navns as $Navn ) {
                    $response[] = array(
                        "name" => $Navn->_,
                        "language" => $Popularnavn->Spraak,
                        'geography' => NULL,
                        'period' => NULL,
                        "score" => 100,
                        "match" => true,
                        "references" => array('artsdatabanken.no'),
                        "taxon" => $LatinskNavn->VitenskapligNavn,
                    );
                    //var_dump($Navn);
                }
            }
        }
        
//        if( isset($records->ArtssokResult->LatinskNavn) ) {
//            foreach($records->ArtssokResult->LatinskNavn as $latinskNavn) {
//                var_export($latinskNavn);
//                foreach( $latinskNavn->Popularnavn as $popularnavn) {
//                    foreach($popularnavn->Navn as $navn) {
//                        $response[] = array(
//                            "name" => $navn->_,
//                            "language" => $popularnavn->Spraak,
//                            'geography' => NULL,
//                            'period' => NULL,
//                            "score" => 100,
//                            "match" => true,
//                            "references" => array('artsdatabanken.no'),
//                            "taxon" => $latinskNavn->VitenskapligNavn,
//                        );
//                    }
//                }
//            }
//        }
        
//        if( is_array($records) ) {
//            // Check all records and analyze the data
//            foreach( $records as $record ) {
//                $guid = $record->GUID;
//
//                $vernaculars = $this->getPESIVernacularsByGUID( $guid );
//
//                foreach( $vernaculars as $vernacular ) {
//                    if( !isset( $vernacular->vernacular ) ) continue;
//
//                    $response[] = array(
//                        "name" => $vernacular->vernacular,
//                        "language" => $vernacular->language_code,
//                        'geography' => NULL,
//                        'period' => NULL,
//                        "score" => 100,
//                        "match" => true,
//                        "references" => array('pesi'),
//                        "taxon" => $record->scientificname,
//                    );
//                }
//            }
//        }
        
        return $response;
    }
}

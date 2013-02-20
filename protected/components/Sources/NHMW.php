<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NHMW
 *
 * @author wkoller
 */
class NHMW extends CachedJSONRPCClient {
    public function init() {
        parent::init();
        
        $this->url = 'http://131.130.131.9/taxamatch/jsonRPC/json_rpc_taxamatchMdld.php';
    }
    
    /**
     * Query NHMW for common names for a given scientific name
     * @param string $term Scientific name to search for
     * @return array Results in the correct form
     */
    public function query($term) {
        $response = array();
        
        $matches = $this->getMatchesService('vienna',$term,array('showSyn'=>false,'NearMatch'=>false,'includeCommonNames'=>true));
        
        foreach( $matches['result'] as $result ) {
            foreach( $result['searchresult'] as $searchresult ) {
                if( isset($searchresult['species']) && is_array($searchresult['species']) ) {
                    foreach( $searchresult['species'] as $species ) {
                        if( isset($species['commonNames']) && is_array($species['commonNames']) ) {
                            foreach($species['commonNames'] as $commonName) {
                                $response[] = array(
                                    "name" => $commonName['name'],
                                    "language" => $commonName['language'],
                                    "geography" => $commonName['geography'],
                                    'period' => NULL,   // TODO: fetch period from service
                                    "score" => $species['ratio'] * 100.0,
                                    "match" => ($species['ratio'] == 1) ? true : false,
                                    "references" => array('nhmw'),
                                    "taxon" => $species['taxon'],
                                );
                            }
                        }
                    }
                }
            }
        }
        
        return $response;
    }
}

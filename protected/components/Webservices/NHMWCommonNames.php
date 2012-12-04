<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of JACQCommonNames
 *
 * @author wkoller
 */
class NHMWCommonNames extends CachedJSONRPCClient {
    public function init() {
        parent::init();
        
        $this->url = 'http://192.168.56.101/NetBeans/NHM/jacq/taxamatch/jsonRPC/json_rpc_taxamatchMdld.php';
    }
    
    public function query($term) {
        $response = array();
        
        $matches = $this->getMatchesService('vienna',$term,array('showSyn'=>false,'NearMatch'=>false,'includeCommonNames'=>true));
        
        foreach( $matches['result'] as $result ) {
            foreach( $result['searchresult'] as $searchresult ) {
                if( isset($searchresult['species']) && is_array($searchresult['species']) ) {
                    foreach( $searchresult['species'] as $species ) {
                        foreach($species['commonNames'] as $commonName) {
                            $response[] = array(
                                "id" => $commonName['id'],
                                "name" => $commonName['name'],
                                "type" => "/name/common",
                                "score" => $species['ratio'] * 100.0,
                                "match" => ($species['ratio'] == 1) ? true : false,
                                "language" => $commonName['language'],
                                "geography" => $commonName['geography'],
                                "reference" => "nhmw",
                                "taxon" => $species['taxon'],
                                "taxon_id" => $species['taxonID'],
                            );
                        }
                    }
                }
            }
        }
        
        return $response;
    }
}

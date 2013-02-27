<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NHMWService
 *
 * @author wkoller
 */
class NHMWService extends CachedJSONRPCClient {
    public function init() {
        $this->m_noRegister = true; // this source shouldn't be used directly
        $this->url = 'http://131.130.131.9/taxamatch/jsonRPC/json_rpc_taxamatchMdld.php';
        
        parent::init();
    }
    
    /**
     * Query NHMW for common names for a given scientific name
     * @param string $term Scientific name to search for
     * @return array Results in the correct form
     */
    public function query($term) {
        $matches = $this->getMatchesService('vienna',$term,array('showSyn'=>false,'NearMatch'=>false,'includeCommonNames'=>true));
        return $matches;
    }
}

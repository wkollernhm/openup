<?php
/**
 * Description of wboeOeaw
 *
 * @author wkoller
 */
class wboeOeaw extends CachedRESTClient {
    public function init() {
        parent::init();
        
        $this->m_url = 'http://wboe.oeaw.ac.at/api/taxonid/';
        $this->m_timeout = 2592000;     // 30 days caching time
    }
    
    public function query($term) {
        $response = array();
        
        // use the generic NHMW service for querying
        $matches = Yii::app()->NHMWService->query($term);
        var_dump($matches);
        
        return $response;
    }
}

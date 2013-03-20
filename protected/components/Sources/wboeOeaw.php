<?php
/**
 * Names from the Austrian academy of sciences, wboe
 *
 * @author wkoller
 */
class wboeOeaw extends CachedRESTClient {
    public function init() {
        parent::init();
        
        $this->url = 'http://wboe.oeaw.ac.at/api/taxonid/';
        $this->m_timeout = 2592000;     // 30 days caching time
    }
    
    /**
     * Query the WBÖ service based on taxonIDs provided by the NHMW system
     * @param string $term Term to search for
     * @return boolean
     */
    public function query($term) {
        $response = array();
        
        // use the generic NHMW service for querying
        $matches = Yii::app()->NHMWService->query($term);
        // go through all matches and add them as result
        foreach( $matches['result'] as $result ) {
            foreach( $result['searchresult'] as $searchresult ) {
                if( isset($searchresult['species']) && is_array($searchresult['species']) ) {
                    foreach( $searchresult['species'] as $species ) {
                        // ask wboe for each taxonID we've found
                        $results = json_decode($this->getResponse($species['taxonID']), true);
                        // check for a avalid response
                        if( $results == NULL ) continue;
                        
                        // check all results and add them to response
                        foreach($results as $result) {
                            $response[] = array(
                                "name" => $result['name'],
                                "language" => $result['language'],
                                'geography' => NULL,
                                'period' => NULL,
                                "taxon" => $species['taxon'],
                                "references" => array($result['reference']),
                                "score" => $species['ratio'] * 100.0,
                                "match" => ($species['ratio'] == 1) ? true : false,
                            );
                        }
                    }
                }
            }
        }
        
        return $response;
    }
}

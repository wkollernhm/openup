<?php
/**
 * Add names from the JACQ database as source
 *
 * @author wkoller
 */
class NHMW extends SourceComponent {
    /**
     * Query NHMW for common names for a given scientific name
     * @param string $term Scientific name to search for
     * @return array Results in the correct form
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
                        if( isset($species['commonNames']) && is_array($species['commonNames']) ) {
                            foreach($species['commonNames'] as $commonName) {
                                $response[] = array(
                                    "name" => $commonName['name'],
                                    "language" => $commonName['language'],
                                    "geography" => $commonName['geography'],
                                    "period" => $commonName['period'],
                                    "score" => $species['ratio'] * 100.0,
                                    "match" => ($species['ratio'] == 1) ? true : false,
                                    "references" => array(),    // TODO: Fetching of references
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

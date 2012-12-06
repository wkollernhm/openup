<?php
/**
 * Description of COL
 *
 * @author wkoller
 */
class COL extends CachedRESTClient {
    public function init() {
        parent::init();
        $this->url = "http://www.catalogueoflife.org/col/webservice?response=full&format=php&name=";
    }
    
    /**
     * Query the Catalogue of Life webservice for a given scientific name
     * @param string $term Scientific name to search for
     * @return array response information
     */
    public function query($term) {
        $response = array();
        
        $term = urlencode($term);
        $results = unserialize($this->getResponse($term));
        
        // check for valid response
        if( $results != null && is_array($results) ) {
            // check if we found something
            if( intval($results['number_of_results_returned']) > 0 ) {
                // cycle through results and handle them
                foreach( $results['results'] as $result ) {
                    // check if entry has common names
                    if( isset($result['common_names']) ) {
                        // cycle through common names and return as result
                        foreach( $result['common_names'] as $common_name ) {
                            $response[] = array(
                                "id" => $common_name['name'],
                                "name" => $common_name['name'],
                                "type" => "/name/common",
                                "score" => 100,
                                "match" => true,
                                "language" => $common_name['language'],
                                "reference" => "col",
                                "taxon" => $result['name'],
                                "taxon_id" => $result['id'],
                            );
                        }
                    }
                }
            }
        }

        return $response;
    }
}

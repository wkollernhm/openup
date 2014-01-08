<?php
/**
 * COL webservice wrapper class
 *
 * @author wkoller
 */
class COL extends CachedRESTClient {
    public function init() {
        parent::init();

        $this->url = "http://www.catalogueoflife.org/col/webservice?response=full&format=php&name=";
        $this->m_timeout = 2592000; // 30 days
    }
    
    /**
     * Query the Catalogue of Life webservice for a given scientific name
     * @param string $term Scientific name to search for
     * @return array response information
     */
    public function query($term) {
        $response = array();
        
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
                            // check for invalid characters in CoL result, if found ignore result
                            if( strpos($common_name['name'], "?") !== FALSE ) continue;
                            
                            // extract references & add them as string array
                            $references = array('Bisby F., Roskov Y., Culham A., Orrell T., Nicolson D., Paglinawan L., Bailly N., Kirk P., Bourgoin T., Baillargeon G., Hernandez F., De Wever A., Kunze T., eds (2013). Species 2000 & ITIS Catalogue of Life, 8th February 2013. Digital resource at www.catalogueoflife.org/col/. Species 2000: Reading, UK.');
                            // add source database
                            if( isset($result['source_database']) ) $references[] = $result['source_database'];
                            // add the individual common names references
                            foreach($common_name['references'] as $reference) {
                                $references[] = join(' ', $reference);
                            }
                            
                            // construct final response
                            $response[] = array(
                                "name" => $common_name['name'],
                                "language" => $common_name['language'],
                                'geography' => NULL,
                                'period' => NULL,
                                "taxon" => $result['name'],
                                "references" => $references,
                                "score" => 100,
                                "match" => true,
                            );
                        }
                    }
                }
            }
        }

        return $response;
    }
}

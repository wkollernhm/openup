<?php
/**
 * Include finish common names from luomus.fi
 *
 * @author wkoller
 */
class LuomusFi extends CachedRESTClient {
    public function init() {
        parent::init();
        
        $this->url = 'http://ws.luomus.fi/triplestore/search?predicate=dwc:scientificName&object=';
        $this->m_timeout = 2592000;     // 30 days caching time
    }
    
    public function query($term) {
        $response = array();
        
        // Fetch response from service
        $result = $this->getResponse($term);
        if( $result ) {
            // parse XML response
            $xmlResultObj = new SimpleXMLElement($result);
            // register darwin core namespace prefix
            $xmlResultObj->registerXPathNamespace('dwc', 'http://rs.tdwg.org/dwc/terms/');
            
            // find all taxon entries
            $tResults = $xmlResultObj->xpath('dwc:Taxon');
            foreach( $tResults as $tResult ) {
                // fetch all vernacular names & scientific name
                $vernacularNames = array();
                $scientificName = NULL;
                foreach( $tResult->children('http://rs.tdwg.org/dwc/terms/') as $tResultChild ) {
                    switch($tResultChild->getName()) {
                        case 'vernacularName':
                            $vernacularName = array(
                                'name' => (string) $tResultChild,
                                'lang' => NULL
                            );
                            
                            // try to find the language as attribute
                            foreach( $tResultChild->attributes('xml', true) as $vnAttribute ) {
                                if($vnAttribute->getName() == 'lang') {
                                    $vernacularName['lang'] = (string) $vnAttribute;
                                }
                            }
                            
                            // add vernacular info as a result
                            $vernacularNames[] = $vernacularName;
                            break;
                        case 'scientificName':
                            $scientificName = (string) $tResultChild;
                            break;
                    }
                }
                
                // add all found vernacular name entries
                foreach( $vernacularNames as $vernacularName ) {
                    $response[] = array(
                        'name' => $vernacularName['name'],
                        "language" => $vernacularName['lang'],
                        'geography' => NULL,
                        'period' => NULL,
                        "taxon" => $scientificName,
                        "references" => array('luomus.fi - Finnish Museum of Natural History'),
                        "score" => 100.0,
                        "match" => true,
                    );
                }
            }
            
        }
        
        return $response;
    }
}

<?php
/**
 * JSON Controller for handling requests to the common names webservice
 * For details on the actual service see http://open-up.eu/content/common-names-service
 */
class JSONCommonNamesController extends Controller {
    public function japiGetCommonNames($query = NULL, $queries = NULL) {
        $return = array( 'result' => array() );

        // check if we received no request
        if( $query == NULL && $queries == NULL ) {
            $return['name'] = 'OpenUp! Common Names Service';
            $return['identifierSpace'] = 'http://open-up.eu/commonNames/';
            $return['schemaSpace'] = 'http://open-up.eu/commonNames/';
            unset($return['result']);
        }
        // check for single query mode
        else if( $query != NULL ) {
            $return['result'] = $this->handleQuery(json_decode($query, true));
        }
        // multi-query mode?
        else if( $queries != NULL ) {
            $queries = json_decode($queries, true);
            
            // check if we have a valid queries array
            if( is_array($queries) ) {
                // handle each sub-query separately
                foreach( $queries as $index => $query ) {
                    $return['result'][$index] = $this->handleQuery($query);
                }
            }
            else {
                header('HTTP/1.0 400 Bad Request', true, 400);
                exit();
            }
        }

        return $return;
    }

    /**
     * handle a single query and return the result
     * @param string $query Query as JSON-String
     * @return array response according to webservice specification
     */
    private function handleQuery($query) {
        $response = array();

        // check for valid query
        if( $query == NULL || !isset($query['type']) || $query['type'] != '/name/common' || !isset($query['query']) ) {
            header('HTTP/1.0 400 Bad Request', true, 400);
            exit();
        }
        
        // parse the name before sending it to the services
        $query['query'] = Yii::app()->NameParser->parse($query['query']);

        // ask all sources
        $sources = SourceComponent::getSources();
        foreach ($sources as $source) {
            $sourceResponse = $source->query($query['query']);

            // check for valid response
            if( is_array($sourceResponse) ) {
                $response = array_merge($response, $sourceResponse);
            }
        }

        // deduplicate response before returning it
        return $this->deduplicateResponse($response);
    }
    
    /**
     * deduplicates a set of results returned from the individual sources
     * @param type $response
     * @return type
     */
    private function deduplicateResponse($response) {
        $dedupResponse = array();
        
        // handle each result and deduplicate it
        foreach($response as $result) {
            // try to find cached version of common name
            $model_commonNamesCache = CommonNamesCache::model()->findByAttributes(array(
                'name' => $result['name'],
                'language' => $result['language'],
                'geography' => $result['geography'],
                'period' => $result['period'],
            ));
            // if this name wasn't cached yet, create it
            if( $model_commonNamesCache == NULL ) {
                $model_commonNamesCache = new CommonNamesCache();
                $model_commonNamesCache->name = $result['name'];
                $model_commonNamesCache->language = $result['language'];
                $model_commonNamesCache->geography = $result['geography'];
                $model_commonNamesCache->period = $result['period'];
                $model_commonNamesCache->save();
            }
            
            // clean the scientific name
            $result['taxon'] = Yii::app()->NameParser->parse($result['taxon']);
            
            // find the scientific name
            $model_scientificName = ScientificNameCache::model()->findByAttributes(array(
                'name' => $result['taxon']
            ));
            // create cached scientific name if it doesn't exist yet
            if( $model_scientificName == NULL ) {
                $model_scientificName = new ScientificNameCache();
                $model_scientificName->name = $result['taxon'];
                $model_scientificName->save();
            }
            
            // check if this common name already exists in results
            if( isset($dedupResponse[$model_commonNamesCache->id])
                && $dedupResponse[$model_commonNamesCache->id]['taxon_id'] == $model_scientificName->id ) {
                // just update references
                if( is_array($result['references']) ) {
                    $dedupResponse[$model_commonNamesCache->id]['references'] = array_merge(
                        $dedupResponse[$model_commonNamesCache->id]['references'],
                        $result['references']
                    );
                }
            }
            // if not add a new entry
            else {
                $dedupResponse[$model_commonNamesCache->id] = array(
                    // common name info
                    'id' => $model_commonNamesCache->id,
                    'name' => $model_commonNamesCache->name,
                    'type' => array('/name/common'),
                    'language' => $model_commonNamesCache->language,
                    'geography' => $model_commonNamesCache->geography,
                    'period' => $model_commonNamesCache->period,
                    // scientific name info
                    'taxon' => $model_scientificName->name,
                    'score' => $result['score'],
                    'match' => $result['match'],
                    'taxon_id' => $model_scientificName->id,
                    'reference' => NULL,
                    'references' => $result['references']
                );
            }
        }
        
        // for compatibility reasons, add reference as concatenated string
        foreach($dedupResponse as &$dedupResult) {
            $dedupResult['reference'] = join(';', $dedupResult['references']);
        }
        
        return array_values($dedupResponse);
    }

    /**
     * Define this controller as JSON controller
     */
    public function actions() {
        return array(
            'japi'=>'JApi',
        );
    }
}

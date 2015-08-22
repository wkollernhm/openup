<?php

/**
 * Generic parent class for handling sources of common names
 *
 * @author wkoller
 */
abstract class SourceComponent extends CComponent {

    /**
     * can be set to prevent this component from registering automatically
     * @var boolean 
     */
    protected $m_noRegister = false;

    /**
     * @var array array of registered source components
     */
    private static $m_sourceComponents = array();

    /**
     * Return all registered webservice components
     * @return array
     */
    public static function getSources() {
        return SourceComponent::$m_sourceComponents;
    }

    /**
     * keep reference when initializing
     */
    public function init() {
        if (!$this->m_noRegister)
            SourceComponent::$m_sourceComponents[] = $this;
    }

    /**
     * Query the webservice for a given term
     * @param string $term Term to search for
     * @return array Structured response information
     */
    protected abstract function query($term);

    /**
     * Query all registered sources, deduplicate them and return the result
     * @param string $term scientific name to search for
     * @return array Response
     */
    public static function querySources($term) {
        $response = array();

        Yii::trace("[" . microtime(true) . "]" . "SourceComponent.querySources");

        // parse the name before sending it to the services
        Yii::trace("[" . microtime(true) . "]" . "SourceComponent.clean");
        $term = Yii::app()->NameParser->clean($term);
        Yii::trace("[" . microtime(true) . "]" . "SourceComponent.clean done.");

        // ask all sources
        $sources = SourceComponent::getSources();
        foreach ($sources as $source) {
            try {
                $query_start = microtime(true);
                Yii::trace("[" . $query_start . "]" . "SourceComponent.query." . get_class($source));
                $sourceResponse = $source->query($term);

                // check for valid response
                if (is_array($sourceResponse)) {
                    $response = array_merge($response, $sourceResponse);
                }
                $query_end = microtime(true);
                Yii::trace("[" . $query_end . "]" . "SourceComponent.query." . get_class($source) . " done. (" . ($query_end - $query_start) . ")");
            } catch (Exception $e) {
                error_log($e->getMessage());
            }
        }

        Yii::trace("[" . microtime(true) . "]" . "SourceComponent.querySources done.");

        // deduplicate response before returning it
        return SourceComponent::deduplicateResponse($response);
    }

    /**
     * Clean the cache for all service entries
     */
    public static function cleanCaches() {
        // clean cache for all sources
        $sources = SourceComponent::getSources();
        foreach ($sources as $source) {
            // only webservice components use the cache
            if (is_subclass_of($source, 'WSComponent')) {
                $source->cleanCache();
            }
        }
    }

    /**
     * deduplicates a set of results returned from the individual sources
     * @param type $response
     * @return type
     */
    private static function deduplicateResponse($response) {
        $dedupResponse = array();

        // handle each result and deduplicate it
        foreach ($response as $result) {
            // try to find cached version of common name
            $model_commonNamesCache = CommonNamesCache::model()->findByAttributes(array(
                'name' => $result['name'],
                'language' => $result['language'],
                'geography' => $result['geography'],
                'period' => $result['period'],
            ));
            // if this name wasn't cached yet, create it
            if ($model_commonNamesCache == NULL) {
                $model_commonNamesCache = new CommonNamesCache();
                $model_commonNamesCache->name = $result['name'];
                $model_commonNamesCache->language = $result['language'];
                $model_commonNamesCache->geography = $result['geography'];
                $model_commonNamesCache->period = $result['period'];
                // check if saving the cached entry worked
                if (!$model_commonNamesCache->save()) {
                    continue;
                }
            }

            // clean the scientific name
            $result['taxon'] = Yii::app()->NameParser->clean($result['taxon']);

            // find the scientific name
            $model_scientificName = ScientificNameCache::model()->findByAttributes(array(
                'name' => $result['taxon']
            ));
            // create cached scientific name if it doesn't exist yet
            if ($model_scientificName == NULL) {
                $model_scientificName = new ScientificNameCache();
                $model_scientificName->name = $result['taxon'];
                // check if saving the cached entry worked
                if (!$model_scientificName->save()) {
                    continue;
                }
            }

            // check if this common name already exists in results
            if (isset($dedupResponse[$model_commonNamesCache->id]) && $dedupResponse[$model_commonNamesCache->id]['taxon_id'] == $model_scientificName->id) {
                // just update references
                if (is_array($result['references'])) {
                    $dedupResponse[$model_commonNamesCache->id]['references'] = array_merge(
                            $dedupResponse[$model_commonNamesCache->id]['references'], $result['references']
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
                    'references' => $result['references']
                );
            }
        }

        // for compatibility reasons, add reference as concatenated string
        foreach ($dedupResponse as &$dedupResult) {
            $dedupResult['reference'] = join(';', $dedupResult['references']);
        }

        return array_values($dedupResponse);
    }

}

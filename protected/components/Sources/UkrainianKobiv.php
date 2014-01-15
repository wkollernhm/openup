<?php
/**
 * Ukrainian Names provided by Kobiv
 *
 * @author wkoller
 */
class UkrainianKobiv extends SourceComponent {
    /**
     * Helper function for checking a specified field of the Ukrainian Names source for a match
     * @param string $targetField Name of field to match
     * @param string $term Scientific Name to match against
     * @return array Found matches in response format
     */
    private function findMatch($targetField, $term) {
        $response = array();
        
        // find an entry with the scientific name in $targetField
        $dbCriteria = new CDbCriteria();
        $dbCriteria->addSearchCondition($targetField, $term);
        $models_sourceUkrainianKobiv = SourceUkrainianKobiv::model()->findAll($dbCriteria);
        foreach( $models_sourceUkrainianKobiv as $model_sourceUkrainianKobiv ) {
            // return a clean scientific name
            $scientificName = Yii::app()->NameParser->clean($model_sourceUkrainianKobiv->$targetField);
            
            // only handle direct matches
            if( $scientificName != $term ) continue;
            
            // load the geography information
            $models_sourceUkrainianKobivRegions = SourceUkrainianKobivRegions::model()->findAllByAttributes(array(
                'short' => explode(' ', $model_sourceUkrainianKobiv->GEOSK),
            ));
            $geographies = array();
            foreach( $models_sourceUkrainianKobivRegions as $model_sourceUkrainianKobivRegions ) {
                $geographies[] = $model_sourceUkrainianKobivRegions->region;
            }
            
            // load the references
            $models_sourceUkrainianKobivReferences = SourceUkrainianKobivReferences::model()->findAllByAttributes(array(
                'short' => explode(' ', $model_sourceUkrainianKobiv->LIT),
            ));
            $references = array();
            foreach( $models_sourceUkrainianKobivReferences as $model_sourceUkrainianKobivReferences ) {
                $references[] = $model_sourceUkrainianKobivReferences->reference;
            }

            $response[] = array(
                "name" => (!empty($model_sourceUkrainianKobiv->UTYPESET) ) ? $model_sourceUkrainianKobiv->UTYPESET : $model_sourceUkrainianKobiv->UNAR,
                "language" => 'ukr',
                "geography" => implode('; ', $geographies),
                'period' => NULL,
                "taxon" => $model_sourceUkrainianKobiv->$targetField,
                "references" => $references,
                "score" => 100.0,
                "match" => true,
            );
        }
        
        return $response;
    }
    
    /**
     * Find the Ukrainian names
     * @param string $term Scientific Name to search for
     * @return array Found matches in response format
     */
    public function query($term) {
        $response = array();
        
        // find matches in different fields
        $response = array_merge($response, $this->findMatch('LSECOND', $term));
        $response = array_merge($response, $this->findMatch('LNOM', $term));
        
        return $response;
    }
}

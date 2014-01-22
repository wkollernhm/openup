<?php
/**
 * Czech Names provided by Jiri Kvacek
 *
 * @author wkoller
 */
class CzechJiri extends SourceComponent {
    /**
     * Helper function for checking a specified field of the Ukrainian Names source for a match
     * @param string $targetField Name of field to match
     * @param string $term Scientific Name to match against
     * @return array Found matches in response format
     */
    private function findMatch($target_model, $term) {
        $response = array();
        
        // find an entry with the scientific name in $targetField
        $dbCriteria = new CDbCriteria();
        $dbCriteria->addSearchCondition('latin_name', $term);
        $models_czechJiri = $target_model->findAll($dbCriteria);
        foreach( $models_czechJiri as $model_czechJiri ) {
            // return a clean scientific name
            $scientificName = Yii::app()->NameParser->clean($model_czechJiri->latin_name);
            
            // only handle direct matches
            if( $scientificName != $term ) continue;

            $response[] = array(
                "name" => $model_czechJiri->czech_name,
                "language" => 'ces',
                "geography" => NULL,
                'period' => NULL,
                "taxon" => $model_czechJiri->latin_name,
                "references" => array('Czech names provided by Jiri Kvacek'),
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
        $response = array_merge($response, $this->findMatch(SourceCzechJiriBezo1::model(), $term));
        $response = array_merge($response, $this->findMatch(SourceCzechJiriRoztoci::model(), $term));
        $response = array_merge($response, $this->findMatch(SourceCzechJiriVacnatci::model(), $term));
        
        return $response;
    }
}

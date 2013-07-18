<?php
/**
 * Hebrew names
 *
 * @author wkoller
 */
class RussianPlantarium extends SourceComponent {
    public function query($term) {
        $response = array();
        
        // find all fitting entries
        $models_sourceRussianPlantarium = SourceRussianPlantarium::model()->findAllByAttributes(array(
            'scientific_name' => $term
        ));
        
        // cycle through result and handle each entry
        foreach( $models_sourceRussianPlantarium as $model_sourceRussianPlantarium ) {
            // check if we have a common name
            if( empty($model_sourceRussianPlantarium->russian_name) ) continue;
            
            // add response
            $response[] = array(
                "name" => $model_sourceRussianPlantarium->russian_name,
                "language" => 'rus',
                "geography" => NULL,
                'period' => NULL,
                "taxon" => $model_sourceRussianPlantarium->scientific_name,
                "references" => array("Plantarium - Russia"),
                "score" => 100.0,
                "match" => true,
            );
        }
        
        return $response;
    }
}

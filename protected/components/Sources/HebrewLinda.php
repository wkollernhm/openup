<?php
/**
 * Hebrew names
 *
 * @author wkoller
 */
class HebrewLinda extends SourceComponent {
    public function query($term) {
        $response = array();
        
        // find all fitting entries
        $models_sourceHebrewLinda = SourceHebrewLinda::model()->findAllByAttributes(array(
            'CleanScientific_Name' => $term
        ));
        
        // cycle through result and handle each entry
        foreach( $models_sourceHebrewLinda as $model_sourceHebrewLinda ) {
            // check if we have a common name
            if( empty($model_sourceHebrewLinda->HebrewSpecies) ) continue;
            
            // add response
            $response[] = array(
                "name" => $model_sourceHebrewLinda->HebrewSpecies,
                "language" => 'heb',
                "geography" => NULL,
                'period' => NULL,
                "taxon" => $model_sourceHebrewLinda->CleanScientific_Name,
                "references" => array("Hebrew Names"),
                "score" => 100.0,
                "match" => true,
            );
        }
        
        return $response;
    }
}

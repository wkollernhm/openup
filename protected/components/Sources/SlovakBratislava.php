<?php
/**
 * Slovak names from Bratislava
 *
 * @author wkoller
 */
class SlovakBratislava extends SourceComponent {
    public function query($term) {
        $response = array();
        
        // find all fitting entries
        $models_sourceSlovakBratislava = SourceSlovakBratislava::model()->findAllByAttributes(array(
            'fldName' => $term
        ));
        
        // cycle through result and handle each entry
        foreach( $models_sourceSlovakBratislava as $model_sourceSlovakBratislava ) {
            // check if we have a common name
            if( empty($model_sourceSlovakBratislava->fldNameSK) ) continue;
            
            // add response
            $response[] = array(
                "name" => $model_sourceSlovakBratislava->fldNameSK_prefix . ' ' . $model_sourceSlovakBratislava->fldNameSK,
                "language" => 'slk',
                "geography" => NULL,
                'period' => NULL,
                "taxon" => $model_sourceSlovakBratislava->fldName,
                "references" => array("Slovak Academy of Sciences"),
                "score" => 100.0,
                "match" => true,
            );
        }
        
        return $response;
    }
}

<?php
/**
 * Wrapper component for Allearter.dk
 *
 * @author wkoller
 */
class AllearterDk extends SourceComponent {
    public function query($term) {
        $response = array();
        
        // load all hits for this name
        $models_sourceAllearterDk = SourceAllearterDk::model()->findAllByAttributes(array(
            'Videnskabeligt_navn' => $term
        ));
        
        foreach($models_sourceAllearterDk as $model_sourceAllearterDk) {
            // skip entries without danish names
            if(empty($model_sourceAllearterDk->Dansk_navn)) continue;
            
            // construct final response
            $response[] = array(
                "name" => $model_sourceAllearterDk->Dansk_navn,
                "language" => 'dan',
                "geography" => NULL,
                "period" => NULL,
                "taxon" => $model_sourceAllearterDk->Videnskabeligt_navn,
                "references" => array($model_sourceAllearterDk->Referencetekst),
                "score" => 100,
                "match" => true,
            );
        }
        
        return $response;
    }
}

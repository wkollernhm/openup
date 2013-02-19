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
                "id" => sha1($model_sourceAllearterDk->Dansk_navn),
                "name" => $model_sourceAllearterDk->Dansk_navn,
                "type" => "/name/common",
                "score" => 100,
                "match" => true,
                "language" => 'dan',
                "reference" => $model_sourceAllearterDk->Referencetekst,
                "references" => array($model_sourceAllearterDk->Referencetekst),
                "taxon" => $model_sourceAllearterDk->Videnskabeligt_navn,
                "taxon_id" => sha1($model_sourceAllearterDk->Videnskabeligt_navn),
            );
        }
        
        return $response;
    }
}

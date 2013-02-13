<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SourceCzech
 *
 * @author wkoller
 */
class SourceCzech extends SourceComponent {
    public function query($term) {
        $response = array();
        
        $models_sourceCzechPrague = SourceCzechPrague::model()->findAllByAttributes(array(
            'Cele_jmeno' => $term
        ));
        
        foreach( $models_sourceCzechPrague as $model_sourceCzechPrague ) {
            $response[] = array(
                "id" => $model_sourceCzechPrague->ID,
                "name" => $model_sourceCzechPrague->Ceske_jmeno,
                "type" => "/name/common",
                "score" => 100.0,
                "match" => true,
                "language" => 'ces',
                "geography" => NULL,
                "reference" => "prague czech",
                "taxon" => $model_sourceCzechPrague->Cele_jmeno,
                "taxon_id" => $model_sourceCzechPrague->ID,
            );
        }
        
        return $response;
    }
}

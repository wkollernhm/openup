<?php
/**
 * Common names from ETI Databases export
 *
 * @author wkoller
 */
class ETIDatabases extends SourceComponent {
    public function query($term) {
        $response = array();
        
        $models_sourceCzechPrague = SourceCzechPrague::model()->findAllByAttributes(array(
            'Cele_jmeno' => $term
        ));
        
        foreach( $models_sourceCzechPrague as $model_sourceCzechPrague ) {
            $response[] = array(
                "name" => $model_sourceCzechPrague->Ceske_jmeno,
                "language" => 'ces',
                "geography" => NULL,
                'period' => NULL,
                "taxon" => $model_sourceCzechPrague->Cele_jmeno,
                "references" => array("Institute of Botany, Academy of Sciences of Czech Republic - Květena"),
                "score" => 100.0,
                "match" => true,
            );
        }
        
        return $response;
    }
}

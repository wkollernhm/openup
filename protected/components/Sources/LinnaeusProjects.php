<?php
/**
 * Common names from Linnaeus Projects (Naturalis / ETI)
 *
 * @author wkoller
 */
class LinnaeusProjects extends SourceComponent {
    public function query($term) {
        $response = array();
        
        $models_sourceLinnaeusProjects = SourceLinnaeusProjects::model()->findAllByAttributes(array(
            'taxon' => $term
        ));
        
        foreach( $models_sourceLinnaeusProjects as $model_sourceLinnaeusProjects ) {
            $response[] = array(
                "name" => $model_sourceLinnaeusProjects->name,
                "language" => $model_sourceLinnaeusProjects->language,
                "geography" => NULL,
                'period' => NULL,
                "taxon" => $model_sourceLinnaeusProjects->taxon,
                "references" => array($model_sourceLinnaeusProjects->source),
                "score" => 100.0,
                "match" => true,
            );
        }
        
        return $response;
    }
}

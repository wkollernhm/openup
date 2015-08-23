<?php

/**
 * TogoDb source for japanese names
 *
 * @author wkoller
 */
class TogoDb extends SourceComponent {

    public function query($term) {
        $response = array();

        $models_sourceTogodb = SourceTogodbJapanese::model()->findAllByAttributes(array(
            'scientific_name' => $term
        ));

        foreach ($models_sourceTogodb as $model_sourceTogodb) {
            $response[] = array(
                "name" => $model_sourceTogodb->japanese_name,
                "language" => 'jpn',
                "geography" => NULL,
                'period' => NULL,
                "taxon" => $model_sourceTogodb->scientific_name,
                "references" => array($model_sourceTogodb->information_source_name . " (" . $model_sourceTogodb->information_source_distributor . ", " . $model_sourceTogodb->information_source_edition . ") <" . $model_sourceTogodb->ID . ">"),
                "score" => 100.0,
                "match" => true,
            );
        }

        return $response;
    }

}

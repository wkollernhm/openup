<?php
/**
 * Common names from ETI Databases export
 *
 * @author wkoller
 */
class ETIDatabases extends SourceComponent {
    public function query($term) {
        $response = array();
        
        $dbCriteria = new CDbCriteria();
        $dbCriteria->compare('Taxon', $term, true);
        $models_sourceEtiDatabases = SourceEtiDatabases::model()->findAll($dbCriteria);
        
        foreach( $models_sourceEtiDatabases as $model_sourceEtiDatabases ) {
            $response[] = array(
                "name" => $model_sourceEtiDatabases->Name,
                "language" => $model_sourceEtiDatabases->iso_639_6,
                "geography" => NULL,
                'period' => NULL,
                "taxon" => Yii::app()->NameParser->parse($model_sourceEtiDatabases->Taxon),    // return a clean taxon name
                "references" => array($model_sourceEtiDatabases->Source),
                "score" => 100.0,
                "match" => true,
            );
        }
        
        return $response;
    }
}

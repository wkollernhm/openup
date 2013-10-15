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
            // return a clean taxon name
            $taxon = Yii::app()->NameParser->clean($model_sourceEtiDatabases->Taxon);
            // prevent sub-matches (e.g. species instead of genus)
            if( $taxon != $term ) continue;
            
            $response[] = array(
                "name" => $model_sourceEtiDatabases->Name,
                "language" => $model_sourceEtiDatabases->iso_639_6,
                "geography" => NULL,
                'period' => NULL,
                "taxon" => $taxon,
                "references" => array($model_sourceEtiDatabases->Source),
                "score" => 100.0,
                "match" => true,
            );
        }
        
        return $response;
    }
}

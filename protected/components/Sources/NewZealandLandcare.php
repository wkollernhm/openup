<?php
/**
 * Description of NewZealandLandcare
 *
 * @author wkoller
 */
class NewZealandLandcare extends SourceComponent {
    public function query($term) {
        $response = array();
        
        // filter list using a like search
        $dbCriteria = new CDbCriteria();
        $dbCriteria->addSearchCondition('NameFull', $term);
        
        // find all matching entries
        $models_newZealandLandcare = SourceNewZealandLandcare::model()->findAll($dbCriteria);
        // cycle through models and add them to result
        foreach($models_newZealandLandcare as $model_newZealandLandcare) {
            // we add the new zealand landcare as a reference, since sometimes the field is empty
            $references = array('New Zealand Landcare');
            if( $model_newZealandLandcare->ReferenceGenCitation != NULL ) $references[] = $model_newZealandLandcare->ReferenceGenCitation;

            // parse the returned name and compare it to the actual query term, in order to only return 100% matches
            $nameFull = Yii::app()->NameParser->parse($model_newZealandLandcare->NameFull);
            if( $nameFull != $term ) continue;

            // construct response data
            $response[] = array(
                "name" => $model_newZealandLandcare->VernacularName,
                "language" => $model_newZealandLandcare->LanguageISOCode,
                "geography" => $model_newZealandLandcare->GeoRegionName,
                "period" => NULL,
                "taxon" => $nameFull,
                "references" => $references,
                "score" => 100,
                "match" => true,
            );
        }
        
        return $response;
    }
}

<?php
/**
 * Description of NewZealandLandcare
 *
 * @author wkoller
 */
class NewZealandLandcare extends SourceComponent {
    public function query($term) {
        $response = array();
        
        $dbCriteria = new CDbCriteria();
        $dbCriteria->addSearchCondition('NameFull', $term);
        
        $models_newZealandLandcare = SourceNewZealandLandcare::model()->findAll($dbCriteria);
        if( $models_newZealandLandcare != NULL ) {
            foreach($models_newZealandLandcare as $model_newZealandLandcare) {
                $references = array('New Zealand Landcare');
                if( $model_newZealandLandcare->ReferenceGenCitation != NULL ) $references[] = $model_newZealandLandcare->ReferenceGenCitation;
                
                // construct response data
                $response[] = array(
                    "name" => $model_newZealandLandcare->VernacularName,
                    "language" => $model_newZealandLandcare->LanguageISOCode,
                    "geography" => $model_newZealandLandcare->GeoRegionName,
                    "period" => NULL,
                    "taxon" => $model_newZealandLandcare->NameFull,
                    "references" => $references,
                    "score" => 100,
                    "match" => true,
                );
            }
            
        }
        
        return $response;
    }
}

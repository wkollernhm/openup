<?php
/**
 * Hungarian names
 *
 * @author wkoller
 */
class HungarianPeregovits extends SourceComponent {
    public function query($term) {
        $response = array();

        // get components of parsed name
        $termParsed = Yii::app()->NameParser->parse($term);
        if( $termParsed != NULL ) {
            $termDetails = $termParsed['details'][0];
            
            $models_sourceHungarianPeregovits = array();
            
            // search for all species entries with the given binomial
            if( isset($termDetails['genus']) && isset($termDetails['species']) ) {
                // find all fitting scientific name entries
                $models_sourceHungarianPeregovits = SourceHungarianPeregovits::model()->findAllByAttributes(array(
                    'Genus' => $termDetails['genus']['string'],
                    'species' => $termDetails['species']['string'],
                ));
            }
            // search for an uninomial entry
            else if( isset($termDetails['uninomial']) ) {
                // search for all families or genus entries
                $dbCriteria = new CDbCriteria();
                $dbCriteria->addColumnCondition(array(
                    'Family' => $termDetails['uninomial']['string'],
                    'Genus' => '',
                    'species' => '',
                ), 'AND', 'OR');
                $dbCriteria->addColumnCondition(array(
                    'Genus' => $termDetails['uninomial']['string'],
                    'species' => '',
                ), 'AND', 'OR');
                
                // finally execute the search
                $models_sourceHungarianPeregovits = SourceHungarianPeregovits::model()->findAll($dbCriteria);
            }

            // cycle through results and add them to the response
            foreach($models_sourceHungarianPeregovits as $model_sourceHungarianPeregovits) {
                // only return entries with a valid literature reference
                if( $model_sourceHungarianPeregovits->pUB == NULL ) continue;

                // construct response data
                $response[] = array(
                    "name" => $model_sourceHungarianPeregovits->HU_Common_name,
                    "language" => "hun",
                    "geography" => NULL,
                    "period" => $model_sourceHungarianPeregovits->Period,
                    "taxon" => $termParsed['canonical'],
                    "references" => array($model_sourceHungarianPeregovits->pUB->citation),
                    "score" => 100,
                    "match" => true,
                );
            }
        }
        
        return $response;
    }
}

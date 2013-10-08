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
            
            // find all fitting scientific name entries
            $models_sourceHungarianPeregovits = SourceHungarianPeregovits::model()->findAllByAttributes(array(
                'Genus' => $termDetails['genus'],
                'species' => $termDetails['species'],
            ));

            // cycle through results and add them to the response
            foreach($models_sourceHungarianPeregovits as $model_sourceHungarianPeregovits) {
                // construct response data
                $response[] = array(
                    "name" => $model_sourceHungarianPeregovits->HU_Common_name,
                    "language" => "hun",
                    "geography" => NULL,
                    "period" => $model_sourceHungarianPeregovits->Period,
                    "taxon" => $termParsed['canonical'],
                    "references" => array(),
                    "score" => 100,
                    "match" => true,
                );
            }
        }
        
        return $response;
    }
}

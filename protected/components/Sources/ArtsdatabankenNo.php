<?php

/**
 * Artsdatabanken Webservice implementation
 *
 * @author wkoller
 */
class ArtsdatabankenNo extends CachedSoapClient {

    public function init() {
        parent::init();
        $this->url = 'http://webtjenester.artsdatabanken.no/Artsnavnebase.asmx?WSDL';

        $this->m_timeout = 2592000; // 30 days
    }

    /**
     * Query the PESI webservice and return the results
     * @param string $term Term to query for
     * @return array response information
     */
    public function query($term) {
        $response = array();

        // Fetch records matching our query
        $records = $this->Artssok(array('Search' => $term));
        if( !isset($records->ArtssokResult) ) {
            return $response;
        }
        $ArtssokResult = $records->ArtssokResult;

        // check for found response
        if (isset($ArtssokResult->LatinskNavn)) {
            // create fake array for latin name results
            $LatinskNavns = $ArtssokResult->LatinskNavn;
            if (!is_array($LatinskNavns))
                $LatinskNavns = array($LatinskNavns);

            foreach ($LatinskNavns as $LatinskNavn) {
                $Takson = $LatinskNavn->Takson;

                // check if latin name starts with search string in order to avoid wrong results
                if (stripos($LatinskNavn->VitenskapligNavn, $term) !== 0) {
                    continue;
                }

                // calculate exact matches
                $VitenskapligNavn = Yii::app()->NameParser->clean($LatinskNavn->VitenskapligNavn);
                $score = (strcasecmp($VitenskapligNavn, $term) == 0) ? 100 : 0;
                $match = ($score == 100) ? true : false;

                // check if we do not have a common name
                if (!isset($Takson->Popularnavn)) {
                    continue;
                }

                // create fake array for single result entries
                $Popularnavns = $Takson->Popularnavn;
                if (!is_array($Popularnavns)) {
                    $Popularnavns = array($Popularnavns);
                }

                // add all popularnavn
                foreach ($Popularnavns as $Popularnavn) {
                    // create fake array for single result entries
                    $Navns = $Popularnavn->Navn;
                    if (!is_array($Navns)) {
                        $Navns = array($Navns);
                    }

                    // cycle through actual names and add them
                    foreach ($Navns as $Navn) {
                        $response[] = array(
                            "name" => $Navn->_,
                            "language" => $Popularnavn->Spraak,
                            'geography' => NULL,
                            'period' => NULL,
                            "score" => $score,
                            "match" => $match,
                            "references" => array('artsdatabanken.no'),
                            "taxon" => $LatinskNavn->VitenskapligNavn,
                        );
                    }
                }
            }
        }

        return $response;
    }

}

<?php

/**
 * Pland webservice wrapper class
 *
 * @author wkoller
 */
class Pland extends CachedRESTClient {

    public function init() {
        parent::init();

        $this->url = "http://www.meertens.knaw.nl/pland/rest/?format=php&plantnaam=";
        $this->m_timeout = 2592000; // 30 days
    }

    /**
     * Query the Catalogue of Life webservice for a given scientific name
     * @param string $term Scientific name to search for
     * @return array response information
     */
    public function query($term) {
        $response = array();

        $results = unserialize($this->getResponse($term));

        // check for valid response
        if ($results != null && is_array($results) && isset($results[$term]) && is_array($results[$term])) {
            foreach ($results[$term] as $result) {
                // check for an exact match
                $score = (strcasecmp($result['botanische_naam'], $term) == 0) ? 100 : 0;
                $match = ($score == 100) ? true : false;

                // add main entry (nl_naam) first
                $response[] = array(
                    "name" => $result['nl_naam'],
                    "language" => 'dut',
                    'geography' => $result['kaart'],
                    'period' => NULL,
                    "taxon" => $result['botanische_naam'],
                    "references" => array($result['woordenboekartikel']),
                    "score" => $score,
                    "match" => $match,
                );

                // now add all dialect variants
                if (isset($result['dialectnamen']) && is_array($result['dialectnamen'])) {
                    foreach ($result['dialectnamen'] as $dialectname) {
                        $response[] = array(
                            "name" => $dialectname,
                            "language" => 'dut',
                            'geography' => $result['kaart'],
                            'period' => NULL,
                            "taxon" => $result['botanische_naam'],
                            "references" => array($result['woordenboekartikel']),
                            "score" => $score,
                            "match" => $match,
                        );
                    }
                }
            }
        }

        return $response;
    }

    /**
     * Get the resposne from a REST based service
     * @param string $query Query to send to the REST service (appended to URL)
     * @return mixed Response of service
     */
    protected function getResponse($query) {
        // urlencode query by default
        $query = urlencode($query);

        // check for cached response of this query
        $response = mb_convert_encoding($this->getCachedResponse($query), "UTF-8", "Windows-1252");
        if ($response == null) {
            // fetch the response from the rest service
            $response = file_get_contents($this->url . $query);
            $this->setCachedResponse($query, mb_convert_encoding($response, "Windows-1252", "UTF-8"));
        }

        return $response;
    }

}

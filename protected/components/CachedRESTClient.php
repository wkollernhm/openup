<?php

/**
 * Base class for a cached REST webservice
 *
 * @author wkoller
 */
abstract class CachedRESTClient extends WSComponent {
    /**
     * Get the resposne from a REST based service
     * @param string $query Query to send to the REST service (appended to URL)
     * @return mixed Response of service
     */
    protected function getResponse($query) {
        // urlencode query by default
        $query = urlencode($query);

        // check for cached response of this query
        $response = $this->getCachedResponse($query);
        // check if we need to transcode the content from UTF-8
        if ($this->sourceEncoding != NULL) {
            $response = mb_convert_encoding($this->getCachedResponse($query), "UTF-8", $this->sourceEncoding);
        }

        if ($response == null) {
            // fetch the response from the rest service
            $response = file_get_contents($this->url . $query);
            // check if we need to transcode the content (since database requires UTF-8 content only)
            if ($this->sourceEncoding != NULL) {
                $this->setCachedResponse($query, mb_convert_encoding($response, $this->sourceEncoding, "UTF-8"));
            } else {
                $this->setCachedResponse($query, $response);
            }
        }

        return $response;
    }

}

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
        // check for cached response of this query
        $response = $this->getCachedResponse($query);
        if( $response == null ) {
            // fetch the response from the rest service
            $response = file_get_contents($this->url . $query);
            $this->setCachedResponse($query, $response);
        }
        
        return $response;
    }
}

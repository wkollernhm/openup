<?php

class CHttpCache extends COutputCache {

    protected $_headers = array();

    public function run() {
        $contentCached = $this->getIsContentCached();
        
        // check for header displaying
        if( $contentCached ) {
            // re-display all headers
            foreach ($this->_headers as $header) {
                header($header);
            }
        }
        
        // now run parent code
        parent::run();
        
        // finally also add the header to the cached entry (if necessary)
        if( !$contentCached ) {
            $this->_headers = headers_list();
            $data = $this->getCache()->get($this->getCacheKey());
            $data = array($data[0], $data[1], $this->_headers);
            $this->getCache()->set($this->getCacheKey(),$data,$this->duration,$this->dependency);
        }
    }

    /**
     * Looks for content in cache.
     * @return boolean whether the content is found in cache.
     */
    protected function checkContentCache() {
        if( parent::checkContentCache() ) {
            $data = $this->getCache()->get($this->getCacheKey());
            $this->_headers = $data[2];
            
            return true;
        }
        
        return false;
    }
}

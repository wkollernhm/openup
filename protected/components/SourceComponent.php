<?php
/**
 * Generic parent class for handling sources of common names
 *
 * @author wkoller
 */
abstract class SourceComponent extends CComponent {
    /**
     * can be set to prevent this component from registering automatically
     * @var boolean 
     */
    protected $m_noRegister = false;
    
    /**
     * @var array array of registered source components
     */
    private static $m_sourceComponents = array();
    
    /**
     * Return all registered webservice components
     * @return array
     */
    public static function getSources() {
        return SourceComponent::$m_sourceComponents;
    }
    
    /**
     * keep reference when initializing
     */
    public function init() {
        if( !$this->m_noRegister ) SourceComponent::$m_sourceComponents[] = $this;
    }

    /**
     * Query the webservice for a given term
     * @param string $term Term to search for
     * @return array Structured response information
     */
    public abstract function query($term);
}

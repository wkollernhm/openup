<?php
/**
 * Generic parent class for handling sources of common names
 *
 * @author wkoller
 */
abstract class SourceComponent extends CComponent {
    /**
     * @var array array of registered source components
     */
    private static $m_sourceComponents = array();
    
    /**
     * Return all registered webservice components
     * @return type
     */
    public static function getSources() {
        return SourceComponent::$m_sourceComponents;
    }
    
    /**
     * keep reference when initializing
     */
    public function init() {
        SourceComponent::$m_sourceComponents[] = $this;
    }

    /**
     * Query the webservice for a given term
     * @param string $term Term to search for
     * @return array Structured response information
     */
    public abstract function query($term);
}

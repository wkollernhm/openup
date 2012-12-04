<?php
/**
 * Basic Webservice component class
 *
 * @author wkoller
 */
class WSComponent extends CComponent {
    private static $m_wsComponents = array();
    
    /**
     * Automatically add self to components in constructor
     * NOTE: Don't forget to call the parent constructor in your sub-classes
     */
    public function __construct() {
        WSComponent::$m_wsComponents[] = $this;
    }
    
    /**
     * Return all registered webservices
     * @return array Array of WSComponent instances
     */
    public static function getWebServices() {
        return WSComponent::$m_wsComponents;
    }
    
    /**
     * init stub
     */
    public function init() {
    }
}

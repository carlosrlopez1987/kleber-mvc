<?php
namespace core;

class KContainer
{
    private static $_instance;
    private $items      = array();
    private $_templates = array();
    
    // paramet is a two dimensional array
    private function __construct() {}
    
    public static function get_instance() {
        if ( self::$_instance == null || !isset( self::$_instance ) ) {
            self::$_instance = new KContainer();
        }
        
        return self::$_instance;
    }
    
    // add an array full of service dependencies to the container
    public function config( array $dependencies ) {
        $this->items = $dependencies;
    }
    
    // retrieves a service, if service was saved as a template it will create a new service
    public function service( String $name, $params = null ) {
        $service = "not found";
        
        if ( !isset( $this->items[ $name ] ) && $this->items[ $name ] != null ) 
           echo "Service is not available!<br />";
           
        if ( gettype( $this->items[ $name ] ) == "string" ) {
            if ( $params != null )
                $service = new $this->items[ $name ]( $params[0], $params[1], $params[2], $params[3] );
            else 
                $service = new $this->items[ $name ]();
        }
        
        return $service;
    }
    
    public function addService( $name, $service ) {
        // adding if is not set or is null
        if ( !isset( $this->items[ $name ] ) || $this->items[ $name ] == null ) {
            if ( gettype( $service ) == "string" )
                $this->items[ $name ] = new $service();
            else 
                $this->items[ $name ] = $service;
        }
    }
    
    public function addTemplate( $name, $template ) {
        if ( !isset( $this->_templates[ $name ] ) || $this->_templates[ $name ] == null ) {
            if ( gettype( $template ) == "string" )
                $this->_templates[ $name ] = $template;
        }
    }
    
    public function template( $name ) {
        $template = null;
        
        if ( isset( $this->_templates[ $name ] ) && $this->_templates[ $name ] != null )
            $template = $this->_templates[ $name ];
        
        return $template;
    }
    
    
    
}


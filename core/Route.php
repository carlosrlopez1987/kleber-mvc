<?php

namespace core;



class Route
{
    
    //private $appInstance;    // <= The main applications instance
    
    private const GET = "GET";
    private const POST = "POST";
    
    private $_name;
    private $_method;
    private $_page;
    private $_action;
    private $_params;   
    
    private function __construct( $method, $page, $action, $name = '' ) {
        if ( $name == null ) $name = $page;
       
        $this->_name    = $name;
        $this->_action  = $action;
        $this->_method  = $method;
        $this->_page    = $page;
    }
    
    public function get_page()   { return $this->_page;      }
    public function get_action() { return $this->_action;    }
    public function get_name()   { return $this->_name; }
    public function get_method() { return $this->_method;    }
    
    
    
    private static function make( $method, $page, $action, $name = null ):Route {
        return new Route( $method, $page, $action, $name );
    }
    
    // Route creation methods
    // to make routes, each method create and return and instance of a route
    public static function get( $page, $action, $name = null ){ 
        return self::make( "GET", $page, $action, $name ); 
    }
    public static function post( $page, $action, $name = null ){
        return self::make( "POST", $page, $action, $name );
    }
    public static function put( $page, $action, $name = null ){
        return self::make( "PUT", $page, $action, $name );
    }
    public static function delete( $page, $action, $name = null ){
        return self::make( "DELETE", $page, $action, $name );
    }
    public static function update( $page, $action, $name = null ){
        return self::make( "UPDATE", $page, $action, $name );
    }
}


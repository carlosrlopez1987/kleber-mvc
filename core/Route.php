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
    
    
    
    public static function make( $method, $page, $action, $name = null ) {
        $route = new Route( $method, $page, $action, $name );
        if ( $route != null )
            App::get_instance()->register_route( $route );
    }
    
    // Route creation methods
    // to make routes, each method create and return and instance of a route
    public static function get( $page, $action, $name = null ){ 
        self::make( "GET", $page, $action, $name ); 
    }
    public static function post( $page, $action, $name = null ){
        self::make( "POST", $page, $action, $name );
    }
    public static function put( $page, $action, $name = null ){
        self::make( "PUT", $page, $action, $name );
    }
    public static function delete( $page, $action, $name = null ){
        self::make( "DELETE", $page, $action, $name );
    }
    public static function update( $page, $action, $name = null ){
        self::make( "UPDATE", $page, $action, $name );
    }
}


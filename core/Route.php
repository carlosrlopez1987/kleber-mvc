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
    
    protected $_className;
    protected $_classMethod;
    
    private function __construct( $method, $page, $action ) {
        $this->_action  = $action;
        $this->_method  = $method;
        $this->_page    = $page;
        
        $this->extract_actionClass();
    }
    
    public function get_page()   { return $this->_page;      }
    public function get_action() { return $this->_action;    }
    public function get_name()   { return $this->_name; }
    public function get_method() { return $this->_method;    }
    public function get_class()  { return $this->_className; }
    public function get_clasMethod() { return $this->_classMethod; }
    
    public function extract_actionClass() {
        
        if ( gettype( $this->_action ) == "string" ) {
            $arr = explode( "@", $this->_action );
        
            if ( $arr[0] != null && isset( $arr[ 0 ] ) )
                $this->_className = $arr[0];
             
            if( $arr[1] != null && isset( $arr[1] ) )
                $this->_classMethod = $arr[1];
        }
    }
    
    public function className()   { return $this->_className;   }
    public function classMethod() { return $this->_classMethod; }
    
    public static function make( $method, $page, $action ) {
        $route = new Route( $method, $page, $action );
        return $route;
    }
    
    // Route creation methods
    // to make routes, each method create and return and instance of a route
    public static function get( $page, $action ){ 
        self::make( "GET", $page, $action ); 
    }
    public static function post( $page, $action ){
        self::make( "POST", $page, $action );
    }
    public static function put( $page, $action ){
        self::make( "PUT", $page, $action );
    }
    public static function delete( $page, $action ){
        self::make( "DELETE", $page, $action );
    }
    public static function update( $page, $action ){
        self::make( "UPDATE", $page, $action );
    }
}


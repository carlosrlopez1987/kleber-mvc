<?php
namespace core;

class Router {
    
    protected $_handler;
    protected $_request = array();
    
    public const ROUTE   = 'route';
    protected $_name;
    
    
    public function __construct() {}
    
    public function name( $name = null ) {
        if ( $name != null && !isset($name) ) $this->_name = $name;
        return $this->_name;
    }
    
    public function listen() {
        $req = $this->get_request();
        // sends request for processing
        $this->submit( $req );    
    }
    
    /*
     * Returns an associative array containing request information
     * 
     * 
     */
    public function get_request() {
        $req = array (
          "scheme" => $_SERVER[ "REQUEST_SCHEME" ],
          "method" => $_SERVER[ "REQUEST_METHOD" ],
          "url"    => self::get_page_from_uri( $_SERVER[ "REQUEST_URI" ] ),
          "params" => self::get_params_from_uri( $_SERVER[ "REQUEST_URI" ] )
        );
        
       return $req;
    }
    
    public function find_route( $route ) {
        $routes = $this->get_routes();
        $found = false;
       
        if ( $route != null && isset( $route ) )
            return $found;
        
        if ( $routes != null )
            $found = $routes[ $route->get_method() ][ $route->get_name() ];
        
        return $found;
    }
    
    public function get_routes() {
        $routes = $this->_routes;
        
        if ( $routes == null | $routes == '' ) {
            if ( isset( $this->_handler ) ) {
                $handler = $this->handler();
                $routes = $handler->get_routes();
                $this->_routes = $routes;
            }
        }
        
        return $routes;
    }
    
    public function handler( $set = null ) {
        // if a handler has been passed it will save it
        if ( $set != null && !isset( $this->_handler ) )
            $this->_handler = $set;
        
        return $this->_handler;
    }
    
    public static function remove_slashes( $str ):string {
        return rtrim( ltrim( $str, '/' ), '/' );
    }
    
    // returns a string 
    public static function get_page_from_uri( $uri ):string {
        $token = '/';
        if ( $uri == $token ) return "index";
        $url = explode( $token, self::remove_slashes( $uri ) );
        
        return $url[ 0 ];
    }
    
    public static function get_params_from_uri( $uri ) {
        $params = self::remove_slashes( $uri );
        $token = '/';
        $hasSlash = strpos( $params, $token );
        
        
        if ( $hasSlash ) {
            $params = substr( $params, $hasSlash );
            if ( $params[0] == $token || $params[ strlen( $params ) - 1 ] == $token )
                $params = self::remove_slashes( $params );
        }
        
        $params = explode( $token, $params );
        
        return $params;
    }
   
}


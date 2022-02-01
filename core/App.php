<?php


namespace core;

require_once 'Request.php';
require_once 'Router.php';
require_once 'Route.php';





class App {
    // singleton
    protected static $_instance = '';
    
    
    /////////////////////////////
    //        CONTAINERS       //
    /////////////////////////////
    
    protected $_routes    = array(); // route collection
    
    protected $_container;              // services container
    
    protected $_request;
    protected $_response;
    
    // END OF CONTAINERS SECTIONS //
    
    
    ///////////////////////////////
    //      SETTING ARRAYS       //
    ///////////////////////////////
    
    protected $_settings = array();
    
    // END OF SETTING ARRAYS SECTION //
    
    
    
    
    ///////////////////////////////
    //      USEFUL CONSTANTS     //
    ///////////////////////////////
    
    // ROUTE METHOD TYPE CONSTANTS
    public const GET    = "GET";
    public const POST   = "POST";
    public const PUT    = "PUT";
    public const UPDATE = "UPDATE";
    public const DELETE = "DELETE";
    
    // CLASS TEMPLATE NAMES, CAN BE USED AS ARAY KEYS AND VALUES
    
    public const ROUTING = 'routing';
    public const ROUTE   = 'route';
    
    // END OF USEFUL CONSTANTS SECTION //
    
    
    private function __construct(){}
    
    public static function get_instance() {
        if ( self::$_instance == null ) {
            self::$_instance = new App();
        }
        return self::$_instance;
    }
    
    public function add_dependencies( $container ) {
        $this->_container = $container;
    }
    
    public function run() {
        
    }
    
    public function get_notFound() {
        return $this->_routes[ "GET" ][ "404" ];
    }
    
    public function config( $settings ){} // dnt know what to do here yet
    
    public function register_route( &$route ) {
        // if found true else false
        $saved = false;
        if ( $route == null ) return false;
        $found = isset( $this->_routes[ $route->get_method() ][ $route->get_name() ] );
        
        if ( !$found ) {
            $this->_routes[ $route->get_method() ][ $route->get_name() ] = $route;
            $saved = true;
        }
        
        return $saved;
    }
    
    public function &get_routes(){ return $this->_routes; }
    
    // todo: if route not found return a not found route
    public function find_route( $name ) { return $this->_routes[ $name ]; }
    
    public function service( $name ) {
        $service = $this->_services[ $name ];
        
        if ( $service == null | $service == '' )
            $this->create_service( $name );
        
        return $service;
    }
    
    
    public function save_service( $service ) {
        if ( !isset( $this->_services[ $service->name() ] ) )
            $this->_services[ $service->name() ] = $service;
    }
    
    
    // route registers
    public function get(    $page, $action ) { Route::get(    $page, $action ); }
    public function post(   $page, $action ) { Route::post(   $page, $action ); }
    public function put(    $page, $action ) { Route::put(    $page, $action ); }
    public function delete( $page, $action ) { Route::delete( $page, $action ); }
    public function update( $page, $action ) { Route::update( $page, $action ); }

}


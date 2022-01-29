<?php


namespace core;

require_once 'Request.php';
require_once 'Router.php';
require_once 'Route.php';
require_once 'http.php';
require_once 'RouteFactory.php';





class App
{
    
    protected static $app_instance = '';
    
    
    
    
    
    /////////////////////////////
    //        CONTAINERS       //
    /////////////////////////////
    
    protected $_routes      = array(); // route collection
    protected $_services    = array(); // services
    protected $_templates   = array(); 
    
    
    protected $_request;
    protected $_response;
    
    // END OF CONTAINERS SECTIONS //
    
    
    
    
    ///////////////////////////////
    //      SETTING ARRAYS       //
    ///////////////////////////////
    
    protected $factory_settings = array();
    
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
    
    
    public function __construct( $templates )
    {
        $this->_templates = $templates;
        $this->service( self::ROUTING );
    }
    
    public function run()
    {
        $this->config();
        $router = $this->service( self::ROUTING );
        $router->listen();
        $router->dispatch();
    }
    
    public function config(){} // dnt know what to do here yet

    public function create_route( $method, $page, $action )
    {
        $router = $this->service( self::ROUTING );
        $route  = $router->create_route( $method, $page, $action );
        $this->save_route( $route );
    }
    
    public function save_route( $route )
    {
        // if found true else false
        $found = isset( $this->_routes[ $route->name() ] );
        $saved = false;
        
        if ( !$found ) // if not found
        {
            $this->_routes[ $route->name() ] = $route;
            $saved = true;
        }
        
        return $saved;
    }
    
    public function &get_routes()
    {
        return $this->_routes;
    }
    
    public function template( $name )
    {
        $template = $this->_templates[ $name ];
        
        if ( $template = null )
        {
            $template = false;
        }
        
        return $template;
    }
    
    public function service( $name )
    {
        $service = $this->_services[ $name ];
        
        if ( $service == null | $service == '' )
        {
            $this->create_service( $name );
        }
        
        return $service;
    }
    
    public function create_service( $name )
    {
        $serviceTemplate = $this->_templates[ $name ];
        if ( $serviceTemplate != null | $serviceTemplate != '' )
        {
            $service = new $serviceTemplate( $this, $name );
            $this->save_service( $service );
            echo $service->name();
        }
        else {
            echo $this->_templates[ $name ];
        }
        
        return $service;
    }
    
    public function save_service( $service )
    {
        if ( !isset( $this->_services[ $service->name() ] ) )
        {
            $this->_services[ $service->name() ] = $service;
        }
    }
    
    public function get( $page, $action )
    {
        $this->create_route( self::GET, $page, $action );
    }
    public function post( $page, $action )
    {
        $this->create_route(self::POST, $page, $action );
    }
    public function put( $page, $action )
    {
        $this->create_route( self::PUT, $page, $action );
    }
    public function delete( $page, $action )
    {
        $this->create_route(self::DELETE, $page, $action );
    }
    public function update( $page, $action )
    {
        $this->create_route(self::UPDATE, $page, $action );
    }

}


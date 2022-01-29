<?php
namespace core;

class Router
{
    protected $_handler;
    protected $_routes = array();
    protected $_request = array();
    
    protected $route_template;
    
    public const ROUTE   = 'route';
    protected $_name;
    
    public function __construct( &$handler, $name )
    {
        
        $this->_handler       = $handler;
        $this->_name          = $name;
        $this->_routes        = $this->_handler->get_routes();
        $this->route_template = $handler->template( self::ROUTE );
    }
    
    public function name( $name = null )
    {
        if ( $name != null )
            $this->_name = $name;
        return $this->_name;
    }
    
    public function listen()
    {
        //we need to parse request, which we will put in a route object
        // 
        $req = $this->get_request();
        
        $this->_request[ 'scheme' ] = $req->scheme();
        $this->_request[ 'method' ] = $req->method();
        // $this->_request[ 'action' ] we will need to find this from routes available
        $this->_request[ 'page'   ] = $req->page();
        $this->_request[ 'params' ] = $req->params();
    }
    
    public function create_route( $method, $page, $action )
    {
        $templ = $this->route_template;
        $route = new $templ( $method, $page, $action );
        return $route;
    }
    public function find_route( $route )
    {
        $routes = $this->get_routes();
        $found = false;
       
        foreach( $routes as $found_route )
        {
            if ( $found_route->name() == $route->name() )
            {
                break;
            }
            $found = $found_route;
        }
        
        return $found;
    }
    public function get_routes()
    {
        $routes = $this->_routes;
        
        if ( $routes == null | $routes == '' )
        {
            if ( isset( $this->_handler ) )
            {
                $handler = $this->handler();
                $routes = $handler->get_routes();
                $this->_routes = $routes;
            }
        }
        
        return $routes;
    }
    public function handler( $set = null )
    {
        // if a handler has been passed it will save it
        if( $set != null && !isset( $this->_handler ) )
        {
            $this->_handler = $set;
        }
        
        return $this->_handler;
    }
   
}


<?php

namespace core;



class Route
{
    
    //private $appInstance;    // <= The main applications instance
    
    private const GET = "GET";
    private const POST = "POST";
    
    private $route_name;
    private $_method;
    private $_page;
    private $_action;
    private $_params;   
    
    public function __construct( $method, $page, $callback, $name = '' )
    {
        $named_route = $name;
        
        if ( $named_route == null )
        {
            $named_route = $page;
        }
       
        $this->route_name   = $named_route;
        $this->_action       = $callback;
        $this->_method       = $method;
        $this->_page         = $page;
        
        return $this;
    }
    
   public function get_page()
   {
       return $this->_page;
   }
    
    public function get_action()
    {
        return $this->_action;
    }
    
    public function get_name()
    {
        return $this->route_name;
    }
    
    public function get_method()
    {
        return $this->_method;
    }
 
}


<?php

namespace core;

class RouteFactory
{
    private $route_template = Route::class;
    
    private $route;
    
    private const TEMPLATE = "template";
    
    public function __contruct()
    {
        echo "hello";
    }
    
    public function make( $method, $url, $action, $name = '' )
    {
       $route = $this->route_template;
       $this->route = new $route( $method, $url, $name );
       return $this->route;
    }
    
    
    public function load_settings( $class = null ) 
    {
        switch ( gettype( $class ) )
        {
            case "string":
                $this->route_template = $class;
                break;
            case "array":
                if ( array_key_exists( self::TEMPLATE ) )
                {
                    $this->route_template = $class[ self::TEMPLATE ];
                    
                }
                break;
            default:
                echo "null setting<br />";
                
                
                
                
                
                break;
        }
    }
    
}


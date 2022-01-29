<?php
namespace core;

use App;

class http
{
    public const GET    = "GET";
    public const POST   = "POST";
    public const DELETE = "DELETE";
    public const UPDATE = "UPDATE";
    
    
}


class test
{
    
    private static $appInstance;    // <= The main applications instance
    private static $routes = [];    // <= The Route class' storage container
    
    private const GET = "GET";
    private const POST = "POST";
    
    private static $instance = null;
    
    // this function adds a route to the Route::$routes container
    public static function addRoute( $method, $path, $callback )
    {
        self::$routes[ $method ][ $path ] = $callback;
    }
    
    
    
    // this function adds the Route::$routes container to the resource
    // starage of the app so that they can be accessible to any class
    // specially the router or which ever class will handle routing
    public static function register(){
        // get the apps instance
        self::$appInstance = App::getInstance();
        
        // adding rotes to the ROUTES section of the app's storage
        self::$appInstance->addResource( App::ROUTES, self::$routes );
    }
    
    public function testing()
    {
        echo "inside route class";
    }
    
    public static function getInstance()
    {
        self::$instance = null;
        
        // in case we need an instance of the route class
        // im thinking of creating a router instance that will call this function
        if ( self::$instance == null )
        {
            self::$instance = new test();
            
        }
        
        return self::$instance;
    }
    
    private function Route(){
        
    }
}





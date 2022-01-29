<?php

require_once 'core/App.php';
require_once 'core/Route.php';
require_once 'core/Router.php';
require_once 'core/Request.php';
require_once 'core/Response.php';
require_once 'core/RouteFactory.php';


use core\App;
use core\Route;
use core\Router;
use core\Request;
use core\RouteFactory;




    // Creates and application instance and
    // Creates or generates a router instance
    



$templates = array(
    'route'       => Route::class,
    'routing'      => Router::class
);


$app = new App( $templates );


$app->get(       "home", function(){ return "home page"; }                );
$app->put(  "register", function(){ return "you have been registered"; } );
$app->post(     "login", function(){ return "you have logged in"; }       );
$app->get(      "login", function(){ return "home page"; }                );
$app->get(   "register", function(){ return "you have been registered"; } );
$app->get(      "about", function(){ return "you have logged in"; }       );
$app->get(    "profile", function(){ return "you are in profile page"; }  );

$app->run();








    

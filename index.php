<?php

require_once 'core/App.php';
require_once 'core/Route.php';
require_once 'core/Router.php';
require_once 'core/Request.php';
require_once 'core/Response.php';
require_once 'core/KContainer.php';


use core\App;
use core\Route;
use core\Router;
use core\KContainer;

    // Creates and application instance and
    // Creates or generates a router instance


$app = App::get_instance();
$cont = KContainer::get_instance();

$cont->addService( "router", Router::class );
$app->add_dependencies( $cont );


// register routes here
Route::get( "index", function() {
    echo "inside index page!<br />";
});

// not found route
$app->get( "404", function(){
   echo "Page was not found!"; 
});

$app->get( "/", function() {
    echo "inside index page!<br />";
});

Route::get( "profile",function() {
    echo "inside profile page!<br />";
});

$app->run();

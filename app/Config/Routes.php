<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Addons Routing
// Include the custom routes for addons
include APPPATH . 'Config/addons_routes.php';

$routes->match(['get', 'post'], 'login', 'UserController::login', ["filter" => "noauth"]);
// Admin routes
$routes->group("admin", ["filter" => "auth"], function ($routes) {
    $routes->get("/", "AdminController::index");
    $routes->get('addons','PluginsController::addons');
    $routes->get("testing", "AdminController::testing");
    //Admin Routes
    
        $routes->get("Test", "TestController::index");
        $routes->post("Test", "TestController::Store");
        //
        
        $routes->get("Links", "LinksController::index");
        $routes->post("Links", "LinksController::Store");
        //
        
        $routes->get("Post", "PostController::index");
        $routes->post("Post", "PostController::Store");
        //
        
        $routes->get("Post", "PostController::index");
        $routes->post("Post", "PostController::Store");
        //
        
        $routes->get("Swapnil", "SwapnilController::index");
        $routes->post("Swapnil", "SwapnilController::Store");
        //
        // {New Admin Routes}

    // Settings Routes 
    // {New Admin Settings Routes}
});
// Editor routes
$routes->group("editor", ["filter" => "auth"], function ($routes) {
    $routes->get("/", "EditorController::index");
});
$routes->get('logout', 'UserController::logout');

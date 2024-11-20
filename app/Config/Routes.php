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
    //Admin Routes
    
    $routes->get("profile", "AdminController::profile");
    $routes->post("profile", "AdminController::UpdateProfile");
    $routes->post("updatepassword", "AdminController::UpdatePassword");

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

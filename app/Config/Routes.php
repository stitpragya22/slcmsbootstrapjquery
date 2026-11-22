<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Shield Authentication Routes
service('auth')->routes($routes);

// Addons Routing
// Include the custom routes for addons
include APPPATH . 'Config/addons_routes.php';

// $routes->match(['get', 'post'], 'login', 'UserController::login', ["filter" => "noauth"]);
// Admin routes
$routes->group("admin", ["filter" => "group:admin,superadmin"], function ($routes) {
    $routes->get("/", "AdminController::index");
    $routes->get("userlist", "AdminController::userlist");
    $routes->get("profile", "AdminController::profile");
    $routes->post("updateprofile", "AdminController::UpdateProfile");
    $routes->post("updatepassword", "AdminController::UpdatePassword");
    $routes->get('addons', 'PluginsController::addons');
    $routes->get('plugins', 'PluginsController::addons');
    $routes->get('plugins/activate/(:segment)', 'PluginsController::activate/$1');
    $routes->get('plugins/deactivate/(:segment)', 'PluginsController::deactivate/$1');

    // CRUD Generator Routes
    $routes->get("generator", "Generator::index");
    $routes->get("generator/modules", "Generator::modules");
    $routes->post("generator/generate", "Generator::controllergenerate");
    $routes->get("generator/delete/(:num)", "Generator::deleteModule/$1");

    // Dynamic CMS Module Routes (Zero File Mutation)
    try {
        $db = \Config\Database::connect();
        if ($db->tableExists('cms_modules')) {
            $modules = $db->table('cms_modules')->where('is_active', 1)->get()->getResultArray();
            foreach ($modules as $mod) {
                $slug = $mod['slug'];
                $ctrl = $mod['controller'];
                $routes->get($slug, "{$ctrl}::index");
                $routes->get("{$slug}/(:num)", "{$ctrl}::index/$1");
                $routes->post("{$slug}/store", "{$ctrl}::Store");
                $routes->post("{$slug}", "{$ctrl}::Store");
                $routes->get("{$slug}/delete/(:num)", "{$ctrl}::delete/$1");
            }
        }
    } catch (\Throwable $e) {
        // Safe fallback if database table not yet created
    }
});
// Editor routes
$routes->group("editor", ["filter" => "group:editor,admin,superadmin"], function ($routes) {
    $routes->get("/", "EditorController::index");
});
// $routes->get('logout', 'UserController::logout');

<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('marketplace', 'Home::marketplace');
$routes->get('marketplace/plugin/(:segment)', 'Home::marketplaceDetail/$1');
$routes->get('marketplace/developer/(:any)', 'Home::marketplaceDeveloper/$1');
$routes->get('marketplace/download/(:segment)', 'Home::marketplaceDownload/$1');
$routes->get('docs', 'Home::docs');
$routes->get('starter', 'Home::starter');
$routes->get('page/(:segment)', 'Home::page/$1');

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

    // Plugin Marketplace Routes
    $routes->get('marketplace', 'MarketplaceController::index');
    $routes->post('marketplace/upload', 'MarketplaceController::uploadZip');
    $routes->get('marketplace/install/(:segment)', 'MarketplaceController::install/$1');
    $routes->get('marketplace/activate/(:segment)', 'MarketplaceController::activate/$1');
    $routes->get('marketplace/deactivate/(:segment)', 'MarketplaceController::deactivate/$1');
    $routes->get('marketplace/uninstall/(:segment)', 'MarketplaceController::uninstall/$1');

    // CRUD Generator Routes
    $routes->get("generator", "Generator::index");
    $routes->get("generator/modules", "Generator::modules");
    $routes->post("generator/generate", "Generator::controllergenerate");
    $routes->get("generator/delete/(:num)", "Generator::deleteModule/$1");

    // Custom Pages Management
    $routes->get('pages', 'PagesController::index');
    $routes->get('pages/create', 'PagesController::create');
    $routes->post('pages/store', 'PagesController::store');
    $routes->get('pages/edit/(:num)', 'PagesController::edit/$1');
    $routes->post('pages/update/(:num)', 'PagesController::update/$1');
    $routes->get('pages/delete/(:num)', 'PagesController::delete/$1');
    $routes->get('pages/toggle/(:num)', 'PagesController::toggle/$1');

    // Global CMS Settings & Custom Code
    $routes->get('settings', 'SettingsController::index');
    $routes->post('settings/update', 'SettingsController::update');

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

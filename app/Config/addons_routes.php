<?php
// app/Config/addons_routes.php
$routes->group('addons', function ($routes) {
    // Route for plugin name only, redirects to index method
    $routes->add('(:segment)', function ($pluginName, $method = 'index') {
        // Check if the plugin controller file exists
        $controllerFile = FCPATH . 'Plugins' . DIRECTORY_SEPARATOR . $pluginName . DIRECTORY_SEPARATOR . $pluginName . 'Controller.php';
        $activeFile = FCPATH . 'Plugins' . DIRECTORY_SEPARATOR . $pluginName . DIRECTORY_SEPARATOR . '.active';

        // Create the .active file with default value if it doesn't exist
        if (!file_exists($activeFile)) {
            file_put_contents($activeFile, '0');
        }
        // Check if the plugin controller file exists and if the plugin is active
        if (file_exists($controllerFile) && file_exists($activeFile) && file_get_contents($activeFile) == '1') {
            // Redirect to the specified method
            return redirect()->to("addons/{$pluginName}/{$method}");
        } else {
            if (!file_exists($controllerFile)) {
                // Plugin controller file not found
                throw new \RuntimeException('Plugin controller file not found.');
            } else {
                // Plugin is inactive
                throw new \RuntimeException('Plugin is inactive.');
            }
        }
    });

    // Route for plugin name and method
    $routes->add('(:segment)/(:segment)', function ($pluginName, $method = 'index') {
        // Construct the fully qualified namespace of the plugin controller
        $controllerNamespace = 'App\Plugins\\' . $pluginName . '\\' . $pluginName . 'Controller';

        // Manually instantiate the Request object
        $request = service('request');
        
        // Check if the plugin controller class exists and if the plugin is active
        $activeFile = FCPATH . 'Plugins' . DIRECTORY_SEPARATOR . $pluginName . DIRECTORY_SEPARATOR . '.active';
        if (class_exists($controllerNamespace) && file_exists($activeFile) && file_get_contents($activeFile) == '1') {
            // Instantiate the plugin controller and call the specified method
            $controller = new $controllerNamespace($request);
            return $controller->$method();
        } else {
            if (!class_exists($controllerNamespace)) {
                // Plugin controller not found
                throw new \RuntimeException('Plugin controller not found.');
            } else {
                // Plugin is inactive
                throw new \RuntimeException('Plugin is inactive.');
            }
        }
    });

    // Additional routes for specific methods as needed
});

<?php

// app/Config/addons_routes.php
// Secure Addons Dispatcher
$routes->group('addons', function ($routes) {
    $routes->match(['get', 'post'], '(:segment)', function ($pluginName) {
        return redirect()->to("addons/{$pluginName}/index");
    });

    $routes->match(['get', 'post'], '(:segment)/(:segment)', function ($pluginName, $method = 'index') {
        // 1. Sanitize plugin name and method to prevent directory traversal and injection
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $pluginName) || !preg_match('/^[a-zA-Z0-9_]+$/', $method)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Invalid plugin or method identifier.');
        }

        // 2. Prevent access to internal/magic methods
        if (str_starts_with($method, '__')) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Access to internal method is prohibited.');
        }

        // 3. Check controller location in safe plugins directory (or legacy FCPATH if exists)
        $pluginBasePath = is_dir(ROOTPATH . 'plugins/' . $pluginName) 
            ? ROOTPATH . 'plugins/' . $pluginName 
            : FCPATH . 'Plugins/' . $pluginName;

        $controllerFile = $pluginBasePath . DIRECTORY_SEPARATOR . $pluginName . 'Controller.php';
        $activeFile     = $pluginBasePath . DIRECTORY_SEPARATOR . '.active';

        if (!file_exists($controllerFile)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Plugin '{$pluginName}' controller not found.");
        }

        if (!file_exists($activeFile) || trim((string) file_get_contents($activeFile)) !== '1') {
            throw new \RuntimeException("Plugin '{$pluginName}' is currently inactive.");
        }

        $controllerNamespace = 'Plugins\\' . $pluginName . '\\' . $pluginName . 'Controller';

        if (!class_exists($controllerNamespace)) {
            if (file_exists($controllerFile)) {
                require_once $controllerFile;
            }
        }

        if (!class_exists($controllerNamespace)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Plugin class '{$controllerNamespace}' not found.");
        }

        $request = service('request');
        $controller = new $controllerNamespace($request);

        if (!is_callable([$controller, $method])) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Method '{$method}' not found in plugin.");
        }

        return $controller->$method();
    });
});

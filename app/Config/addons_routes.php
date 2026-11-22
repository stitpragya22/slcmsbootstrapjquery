<?php

// app/Config/addons_routes.php
// Secure Addons Dispatcher
$routes->group('addons', function ($routes) {
    $routes->match(['get', 'post'], '(:segment)', function ($pluginName) {
        return redirect()->to("addons/{$pluginName}/index");
    });

    $routes->match(['get', 'post'], '(:segment)/(:segment)', function ($pluginName, $method = 'index') {
        // 1. Sanitize plugin name and method (allow letters, numbers, underscores, and hyphens)
        if (!preg_match('/^[a-zA-Z0-9_-]+$/', $pluginName) || !preg_match('/^[a-zA-Z0-9_]+$/', $method)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Invalid plugin or method identifier.');
        }

        // 2. Prevent access to internal/magic methods
        if (str_starts_with($method, '__')) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Access to internal method is prohibited.');
        }

        // 3. Resolve plugin path case-insensitively across plugins and Plugins
        $pluginBasePath = is_dir(ROOTPATH . 'plugins/' . $pluginName)
            ? ROOTPATH . 'plugins/' . $pluginName
            : (is_dir(ROOTPATH . 'Plugins/' . $pluginName) ? ROOTPATH . 'Plugins/' . $pluginName : FCPATH . 'Plugins/' . $pluginName);

        if (!is_dir($pluginBasePath)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Plugin directory '{$pluginName}' not found.");
        }

        $studly = str_replace(['-', '_'], '', ucwords($pluginName, '-_'));

        // Check controller file candidates
        $candidates = [
            $pluginBasePath . DIRECTORY_SEPARATOR . $studly . 'Controller.php',
            $pluginBasePath . DIRECTORY_SEPARATOR . $pluginName . 'Controller.php',
        ];

        $controllerFile = null;
        foreach ($candidates as $c) {
            if (file_exists($c)) {
                $controllerFile = $c;
                break;
            }
        }

        if (!$controllerFile) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Plugin controller not found for '{$pluginName}'.");
        }

        // Check active status in database or .active file
        if (!\App\Libraries\PluginManager::isActive($pluginName)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Plugin '{$pluginName}' is currently inactive.");
        }

        // Namespace candidates
        $nsCandidates = [
            'Plugins\\' . $studly . '\\' . $studly . 'Controller',
            'Plugins\\' . $pluginName . '\\' . $pluginName . 'Controller',
        ];

        $controllerClass = null;
        require_once $controllerFile;

        foreach ($nsCandidates as $ns) {
            if (class_exists($ns)) {
                $controllerClass = $ns;
                break;
            }
        }

        if (!$controllerClass) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Plugin controller class could not be resolved for '{$pluginName}'.");
        }

        $controller = new $controllerClass();
        if (method_exists($controller, 'initController')) {
            $controller->initController(
                \Config\Services::request(),
                \Config\Services::response(),
                \Config\Services::logger()
            );
        }

        if (!is_callable([$controller, $method])) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Method '{$method}' not found in plugin.");
        }

        return $controller->$method();
    });
});

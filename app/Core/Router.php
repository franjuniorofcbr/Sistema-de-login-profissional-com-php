<?php

namespace App\Core;

class Router
{
    private $routes = [];

    public function get($uri, $action)    { $this->add('GET', $uri, $action); }
    public function post($uri, $action)   { $this->add('POST', $uri, $action); }
    public function put($uri, $action)    { $this->add('PUT', $uri, $action); }
    public function delete($uri, $action) { $this->add('DELETE', $uri, $action); }

    private function add($method, $uri, $action, $middleware = null) {
        $pattern = preg_replace('#\{([\w]+)\}#', '(?P<$1>[^/]+)', $uri);
        $pattern = "#^" . $pattern . "$#";
        $this->routes[] = compact('method', 'uri', 'pattern', 'action', 'middleware');
    }

    public function dispatch() {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $route) {
            if ($route['method'] === $method && preg_match($route['pattern'], $uri, $params)) {
                // Remove numeric keys from $params
                $params = array_filter($params, 'is_string', ARRAY_FILTER_USE_KEY);

                // Middleware (exemplo de estrutura)
                if (!empty($route['middleware'])) {
                    foreach ((array)$route['middleware'] as $middleware) {
                        if (class_exists($middleware)) {
                            (new $middleware())->handle();
                        }
                    }
                }

                return $this->callAction($route['action'], $params);
            }
        }

        $this->sendError(404, "404 Not Found");
    }

    private function callAction($action, $params = []) {
        [$controller, $method] = explode('@', $action);
        $controller = "App\\Controllers\\$controller";

        if (class_exists($controller)) {
            $obj = new $controller();
            if (method_exists($obj, $method)) {
                return call_user_func_array([$obj, $method], $params);
            }
        }

        $this->sendError(500, "Controller ou método não encontrado.");
    }

    private function sendError($code, $message) {
        http_response_code($code);
        echo $message;
        exit;
    }
}

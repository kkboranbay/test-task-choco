<?php

class Router
{
    public $routes = [
        'GET' => [],
        'POST' => []
    ];

    public static function load($file)
    {
        $router = new static;

        require $file;

        return $router;
    }

    public function get($uri, $controller)
    {
        $this->routes['GET'][$uri] = $controller;
    }

    public function post($uri, $controller)
    {
        $this->routes['POST'][$uri] = $controller;
    }

    public function direct($uri, $requestType)
    {
        if (array_key_exists($uri, $this->routes[$requestType])) {
            return $this->callMethod(
                ...explode( '@', $this->routes[$requestType][$uri])
            );
        }

        foreach (array_keys($this->routes[$requestType]) as $route) {
            preg_match_all('/\{([^}]+)\}/', $route, $matches);

            if (in_array('{id}', $matches[0]) && in_array('{title}', $matches[0])) {
                $id  = explode('/', $uri)[0];
                $uri = '{id}/{title}';

                $params   = explode( '@', $this->routes[$requestType][$uri]);
                $params[] = $id;

                return $this->callMethod(...$params);

            } elseif (in_array('{id}', $matches[0])) {
                $id  = explode('/', $uri)[1];

                $uri = 'update/{id}';

                $params   = explode( '@', $this->routes[$requestType][$uri]);
                $params[] = $id;


                return $this->callMethod(...$params);
            }
        }

        throw new Exception('No route defined for this URI.');
    }

    protected function callMethod($controller, $method, $id = null)
    {
        $controller = new $controller();

        if (! method_exists($controller, $method)) {
            throw new Exception(
                "{$controller} does not respond to the {$method} action."
            );
        }

        return $controller->$method($id);
    }
}
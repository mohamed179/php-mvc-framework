<?php

namespace App\Core;

use App\Core\Exceptions\NotFoundException;

class Router
{
    private Request $request;
    private Response $response;

    private array $routes = [
        'get' => [],
        'post' => []
    ];

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $method = $this->request->getRequestMethod();
        $route = $this->request->getRequestRoute();
        $callback = $this->routes[$method][$route] ?? null;

        if (is_null($callback)) {
            throw new NotFoundException();
        }

        return call_user_func_array($callback, [
            'request' => $this->request,
            'response' => $this->response
        ]);
    }
}

<?php

namespace App\Core;

use App\Core\Middlewares\Middleware;

abstract class Controller
{
    private array $middlewares = [];

    public function registerMiddleware(Middleware $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }
}

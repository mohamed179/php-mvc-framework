<?php

namespace App\Controllers;

use App\Core\Request;
use App\Core\Controllers\Controller;
use App\Core\Middlewares\AuthMiddleware;
use App\Core\Response;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware());
    }

    public function login(Request $request, Response $response)
    {
        //
    }

    public function register(Request $request, Response $response)
    {
        //
    }
}

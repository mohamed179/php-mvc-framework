<?php

namespace App\Core\Controllers;

use App\Core\Request;
use App\Core\Controllers\Controller;
use App\Core\Middlewares\GuestMiddleware;
use App\Core\Response;

abstract class AuthController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new GuestMiddleware(['login', 'register']));
    }

    abstract public function login(Request $request, Response $response);

    abstract public function register(Request $request, Response $response);
}

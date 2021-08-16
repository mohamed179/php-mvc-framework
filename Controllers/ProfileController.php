<?php

namespace App\Controllers;

use Mohamed179\Core\Application;
use Mohamed179\Core\Controllers\Controller;
use Mohamed179\Core\Middlewares\AuthMiddleware;
use Mohamed179\Core\View;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware());
    }

    public function profile()
    {
        $user = Application::$app->auth->user;
        return new View('profile', [
            'model' => $user
        ]);
    }
}
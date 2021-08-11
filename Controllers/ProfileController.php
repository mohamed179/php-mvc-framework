<?php

namespace App\Controllers;

use App\Core\Application;
use App\Core\Controllers\Controller;
use App\Core\Middlewares\AuthMiddleware;
use App\Core\View;

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
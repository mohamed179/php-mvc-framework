<?php

namespace App\Controllers;

use App\Core\Application;
use App\Core\View;
use App\Models\User;
use App\Core\Request;
use App\Core\Response;
use App\Core\Controllers\AuthController as BaseAuthController;

class AuthController extends BaseAuthController
{
    public function login(Request $request, Response $response)
    {
        return (new View('auth/login'))
            ->setLayout('auth')
            ->setTitle(Application::$app->config['app_name'] . ' - Login');
    }

    public function register(Request $request, Response $response)
    {
        $user = new User();
        if ($request->isPost()) {
            $user->loadData($request->getRequestBody());
            if ($user->validate() /*&& $user->save()*/) {
                return $response->redirect('/');
            }
        }

        return (new View('auth/register', [
            'model' => $user
        ]))
            ->setLayout('auth')
            ->setTitle(Application::$app->config['app_name'] . ' - Register');
    }
}

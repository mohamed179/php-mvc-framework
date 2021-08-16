<?php

namespace App\Controllers;

use Mohamed179\Core\Application;
use Mohamed179\Core\View;
use App\Models\User;
use App\Models\LoginModel;
use Mohamed179\Core\Request;
use Mohamed179\Core\Response;
use Mohamed179\Core\Controllers\AuthController as BaseAuthController;
use Mohamed179\Core\Middlewares\AuthMiddleware;
use Mohamed179\Core\Middlewares\GuestMiddleware;

class AuthController extends BaseAuthController
{
    public function __construct()
    {
        $this->registerMiddleware(new GuestMiddleware(['login', 'register']));
        $this->registerMiddleware(new AuthMiddleware(['logout']));
    }

    public function login(Request $request, Response $response)
    {
        $loginModel = new LoginModel();

        if ($request->isPost()) {
            $data = $request->getRequestBody();
            $loginModel->loadData($data);

            if ($loginModel->validate()) {
                $user = User::where(['email' => $data['email']]);
                if (!is_null($user) && $user->verifyPassword($data['password'])) {
                    Application::$app->auth->login($user);
                    return $response->redirect('/profile');
                }

                $loginModel->setError('email', 'Email or password is incorrect');
            }
        }

        return (new View('auth/login', [
            'model' => $loginModel
        ]))
            ->setLayout('auth')
            ->setTitle(Application::$app->config['app_name'] . ' - Login');
    }

    public function register(Request $request, Response $response)
    {
        $user = new User();
        if ($request->isPost()) {
            $user->loadData($request->getRequestBody());
            if ($user->validate() && $user->save()) {
                Application::$app->session->setFlash('success', 'You have registerd successfuly');
                return $response->redirect('/login');
            }
        }

        return (new View('auth/register', [
            'model' => $user
        ]))
            ->setLayout('auth')
            ->setTitle(Application::$app->config['app_name'] . ' - Register');
    }

    public function logout(Request $request, Response $response)
    {
        Application::$app->auth->logout();
        return $response->redirect('/');
    }
}

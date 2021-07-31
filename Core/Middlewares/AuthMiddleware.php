<?php

namespace App\Core\Middlewares;

use App\Core\Application;
use App\Core\Exceptions\ForbiddenException;

class AuthMiddleware extends RouteMiddleware
{
    public function execute(): bool
    {
        if (empty($this->actions) || in_array(Application::$app->controller->getAction(), $this->actions)) {
            if (Application::$app->auth->isGuest()) {
                throw new ForbiddenException();
                return false;
            }
        }
        return true;
    }
}
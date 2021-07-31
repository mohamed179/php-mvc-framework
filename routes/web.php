<?php

use App\Controllers\SiteController;
use App\Core\View;

$app->router->get('/', [SiteController::class, 'home']);

$app->router->get('/contact', [SiteController::class, 'contact']);

$app->router->get('/about', [SiteController::class, 'about']);

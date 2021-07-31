<?php

use App\Controllers\SiteController;

$app->router->get('/', [SiteController::class, 'home']);

$app->router->get('/contact', [SiteController::class, 'contact']);

$app->router->get('/about', [SiteController::class, 'about']);

include_once __DIR__.'/auth.php';

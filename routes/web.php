<?php

use App\Core\View;

$app->router->get('/', function () {
    return new View('home');
});

$app->router->get('/contact', function () {
    return new View('contact');
});

$app->router->get('/about', function () {
    return new View('about');
});

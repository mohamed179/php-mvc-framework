<?php

// Applying composer autoload
include_once dirname(__DIR__).'/vendor/autoload.php';

use Dotenv\Dotenv;
use App\Core\Application;

// Getting env variables from .env file
$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
$config = [
    'app_name' => $_ENV['APP_NAME'],
    'main_layout' => $_ENV['MAIN_LAYOUT']
];

// Creating new application
$app = new Application(dirname(__DIR__), $config);

include_once dirname(__DIR__).'/routes/web.php';

$app->run();
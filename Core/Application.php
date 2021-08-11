<?php

namespace App\Core;

use App\Core\Controllers\Controller;
use App\Core\Database\Database;
use App\Core\Logger\ConsoleChannel;
use App\Core\Logger\ErrorLogChannel;
use App\Core\Logger\Logger;
use App\Core\Logger\RotatingFileChannel;
use App\Core\Logger\StreamChannel;

class Application
{
    public static $ROOT_DIR;
    public static $app;

    public array $config;
    public Logger $logger;
    public Session $session;
    public Request $request;
    public Response $response;
    public Router $router;
    public Controller $controller;
    public Authentication $auth;
    public Database $db;

    public function __construct(string $rootDir, array $config)
    {
        Application::$ROOT_DIR = $rootDir;
        Application::$app = $this;

        // Setting config and session
        $this->config = $config;
        $this->session = new Session();

        // Setting logger
        $this->logger = new Logger(self::$ROOT_DIR.'/runtime/logs');
        $this->logger->addChannel(new StreamChannel('default', 'default.log'));
        $this->logger->addChannel(new ConsoleChannel('console'));
        $this->logger->addChannel(new RotatingFileChannel('daily', 'daily.log'));
        $this->logger->addChannel(new ErrorLogChannel('errors'));

        // Setting request, response, router, database connnection and authentication
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->db = new Database($config['db']);
        $this->auth = new Authentication();
    }

    public function run()
    {
        try {
            echo $this->router->resolve();
        } catch(\Exception $ex) {
            $this->response->setResponseCode($ex->getCode());
            echo new View('errors/_error', [
                'message' => $ex->getMessage(),
                'trace' => $ex->getTraceAsString()
            ]);
            $this->logger->log('errors', Logger::LEVEL_ERROR, $ex);
        }
    }
}

<?php

namespace App\Core;

use App\Core\Controllers\Controller;
use App\Core\Database\Database;

class Application
{
    public static $ROOT_DIR;
    public static $app;

    public array $config;
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

        $this->config = $config;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->auth = new Authentication();
        $this->db = new Database($config['db']);
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
        }
    }
}

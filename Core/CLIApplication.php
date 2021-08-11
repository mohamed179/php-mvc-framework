<?php

namespace App\Core;

use App\Core\Logger\Logger;
use App\Core\Database\Database;
use App\Core\Logger\StreamChannel;
use App\Core\Logger\ConsoleChannel;
use App\Core\Logger\ErrorLogChannel;
use App\Core\Logger\RotatingFileChannel;

class CLIApplication extends Application
{
    public function __construct(string $rootDir, array $config)
    {
        Application::$ROOT_DIR = $rootDir;
        Application::$app = $this;

        // Setting config
        $this->config = $config;

        // Setting logger
        $this->logger = new Logger(self::$ROOT_DIR.'/runtime/logs');
        $this->logger->addChannel(new StreamChannel('default', 'default.log'));
        $this->logger->addChannel(new ConsoleChannel('console'));
        $this->logger->addChannel(new RotatingFileChannel('daily', 'daily.log'));
        $this->logger->addChannel(new ErrorLogChannel('errors'));

        // Setting database connnection
        $this->db = new Database($config['db']);
    }
}
<?php

namespace App\Core\CLI;

use App\Core\Application;
use App\Core\Logger\Logger;
use Ahc\Cli\Application as CLIContainer;
use App\Core\CLI\Commands\MigrateCommand;
use App\Core\CLI\Commands\MakeCommandCommand;
use App\Core\CLI\Commands\MakeControllerCommand;
use App\Core\CLI\Commands\MakeMigrationCommand;
use App\Core\CLI\Commands\MakeModelCommand;

class CLI
{
    public const CLI_LOGO = 'PHP CLI';

    private CLIContainer $cli;

    public function __construct()
    {
        $this->cli = new CLIContainer('php-cli', 'v0.0.1');
        $this->cli->logo(self::CLI_LOGO);
        $this->addBuiltInCommands();
        $this->addUserDefiendCommands();
    }

    private function addBuiltInCommands()
    {
        $this->cli->add(new MakeCommandCommand());
        $this->cli->add(new MakeControllerCommand());
        $this->cli->add(new MakeMigrationCommand());
        $this->cli->add(new MakeModelCommand());
        $this->cli->add(new MigrateCommand());
    }

    private function addUserDefiendCommands()
    {
        if (!is_dir(Application::$ROOT_DIR.'/Commands')) {
            return;
        }

        $files = scandir(Application::$ROOT_DIR.'/Commands');
        $files = array_diff($files, ['.', '..']);
        foreach ($files as $file) {
            $pathParts = pathinfo($file);
            if ($pathParts['extension'] === 'php') {
                try {
                    $className = 'App\Commands\\'.$pathParts['filename'];
                    $this->cli->add(new $className());
                } catch (\Exception $ex) {
                    // Log the exception
                    Application::$app->logger->log('console', Logger::LEVEL_ERROR, $ex);
                    Application::$app->logger->log('errors', Logger::LEVEL_ERROR, $ex);
                }
            }
        }
    }

    public function run(array $data)
    {
        try {
            $this->cli->handle($data);
        } catch (\Exception $ex) {
            Application::$app->logger->log('console', Logger::LEVEL_ERROR, $ex);
            Application::$app->logger->log('errors', Logger::LEVEL_ERROR, $ex);
        }
    }
}
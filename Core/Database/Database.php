<?php

namespace App\Core\Database;

use App\Core\Application;

class Database
{
    private \PDO $pdo;
    private \PDOStatement $stmt;

    public function __construct(array $config)
    {
        $host = $config['host'];
        $port = $config['port'];
        $user = $config['user'];
        $password = $config['password'];
        $database = $config['database'];
        $options = $config['options'] ?? null;

        $dsn = "mysql:host=$host;port=$port;dbname=$database";
        $this->pdo = new \PDO($dsn, $user, $password, $options);
    }

    public function exec(string $query)
    {
        return $this->pdo->exec($query);
    }

    public function prepare($query, array $options = [])
    {
        $this->stmt = $this->pdo->prepare($query, $options);
    }

    public function execute($params = null)
    {
        $this->stmt->execute($params);
    }

    public function fetch(
        $mode = \PDO::FETCH_BOTH,
        $cursorOrientation = \PDO::FETCH_ORI_NEXT,
        $cursorOffset = 0
    )
    {
        return $this->stmt->fetch($mode, $cursorOrientation, $cursorOffset);
    }

    public function fetchAll($mode = \PDO::FETCH_BOTH, ...$args)
    {
        return $this->stmt->fetchAll($mode, ...$args);
    }

    public function fetchColumn($column = 0)
    {
        return $this->stmt->fetchColumn($column);
    }

    public function fetchObject($class = "stdClass", array $ctorArgs = [])
    {
        return $this->stmt->fetchObject($class, $ctorArgs);
    }

    protected function createMigrationsTable()
    {
        $this->exec("CREATE TABLE IF NOT EXISTS migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255) NOT NULL,
            migrated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );");
    }

    protected function getMigratedFiles()
    {
        $this->prepare("SELECT migration FROM migrations;");
        $this->execute();
        return $this->fetchAll(\PDO::FETCH_COLUMN);
    }

    protected function saveMigrations(array $migrations)
    {
        $migrations = implode(', ', array_map(function ($migration) {
            return "('$migration')";
        }, $migrations));
        $this->exec("INSERT INTO migrations (migration) VALUES $migrations;");
    }

    public function runMigrations()
    {
        // Create migrations table if not exists
        $this->createMigrationsTable();

        // Get migrated files
        $migrated = $this->getMigratedFiles();

        // Get migrations files
        $files = scandir(Application::$ROOT_DIR.'/migrations');
        $files = array_diff($files, ['.', '..']);

        // Remove migrated files from all files
        $files = array_diff($files, $migrated);

        // Run not migrated migrations
        $newMigrations = [];
        foreach ($files as $file) {
            // Check if the file is a .php file
            $pathParts = pathinfo($file);
            if ($pathParts['extension'] === 'php') {
                try {
                    include_once Application::$ROOT_DIR.'/migrations/'.$file;
                    $className = $pathParts['filename'];
                    echo 'Applying migration: ' . $file . PHP_EOL;
                    (new $className())->up();
                    echo 'Applied migration: ' . $file . PHP_EOL;
                    $newMigrations[] = $file;
                } catch (\Exception $ex) {
                    echo $ex;
                }
            }
        }

        // Add the new migrated files to database
        if (!empty($newMigrations)) {
            $this->saveMigrations($newMigrations);
        } else {
            // Log the all migrations have been migrated
            echo 'All migrations have been applied' . PHP_EOL;
        }
    }
}

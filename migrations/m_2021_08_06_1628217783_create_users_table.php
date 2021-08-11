<?php

use App\Core\Application;

class m_2021_08_06_1628217783_create_users_table
{
    public function up()
    {
        Application::$app->db->exec("CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            firstname VARCHAR(255) NOT NULL,
            lastname VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL UNIQUE,
            password VARCHAR(512) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );");
    }

    public function down()
    {
        Application::$app->db->exec("DROP TABLE IF EXISTS users;");
    }
}
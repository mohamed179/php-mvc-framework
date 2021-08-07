<?php

use App\Core\Application;

class m_2021_08_06_1628221301_add_status_column_to_users_table
{
    public function up()
    {
        Application::$app->db->exec(
            "ALTER TABLE users ADD COLUMN status TINYINT NOT NULL AFTER password;"
        );
    }

    public function down()
    {
        Application::$app->db->exec(
            "ALTER TABLE users DROP COLUMN IF EXISTS status;"
        );
    }
}
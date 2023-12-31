<?php

namespace classes\traits;

use PDOException;

trait TDb
{
    private \PDO $db;
    private string $url;

    public function __construct()
    {
        $dsn = $_ENV['DB_CONNECTION'] . ':host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_DATABASE'];
        $username = $_ENV['DB_USERNAME'];
        $password = $_ENV['DB_PASSWORD'];
        $this->db = new \PDO($dsn, $username, $password);
    }
}
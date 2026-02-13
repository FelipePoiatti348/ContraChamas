<?php

class Database
{
    private static ?mysqli $connection = null;

    public static function connect(): mysqli
    {
        if (self::$connection === null) {

            $host = $_ENV['DB_HOST'] ?? 'localhost';
            $user = $_ENV['DB_USER'] ?? 'root';
            $pass = $_ENV['DB_PASS'] ?? '';
            $dbname = $_ENV['DB_NAME'] ?? '';

            self::$connection = new mysqli($host, $user, $pass, $dbname);

            if (self::$connection->connect_error) {
                throw new Exception(
                    "Erro na conexão com o banco: " .
                    self::$connection->connect_error
                );
            }
        }

        return self::$connection;
    }
}

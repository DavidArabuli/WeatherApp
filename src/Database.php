<?php

class Database
{
    private static ?PDO $pdo = null;

    public static function getConnection(): PDO
    {
        if (self::$pdo === null) {
            $host = getenv('DB_HOST');
            $port = getenv('DB_PORT');
            $db   = getenv('DB_NAME');
            $user = getenv('DB_USER');
            $pass = getenv('DB_PASS');

            if (!$host || !$db || !$user) {
                throw new RuntimeException('Database environment variables are not set');
            }

            $dsn = "pgsql:host={$host};port={$port};dbname={$db}";

            self::$pdo = new PDO(
                $dsn,
                $user,
                $pass,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                ]
            );
        }

        return self::$pdo;
    }
}

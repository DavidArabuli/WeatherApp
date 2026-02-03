<?php

class Database
{
    private static ?PDO $pdo = null;

    public static function getConnection(): PDO
    {
        if (self::$pdo === null) {
            $DBconfig = require __DIR__ . '/../env.php';

            $dsn = "pgsql:host={$DBconfig['host']};port={$DBconfig['port']};dbname={$DBconfig['db']}";
            self::$pdo = new PDO($dsn, $DBconfig['user'], $DBconfig['password'], [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        }
        return self::$pdo;
    }
}

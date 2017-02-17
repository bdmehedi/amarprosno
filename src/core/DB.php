<?php namespace app\core;

class DB
{
    private static $pdo;

    private function __construct()
    {
        try {
            $this->pdo = new \PDO('mysql:host=127.0.0.1;dbname=codex-1', 'root', 'root');
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    //create object for this class by using this function.
    public static function getPDO()
    {
        try {
            self::$pdo = new \PDO('mysql:host=127.0.0.1;dbname=codex-1', 'root', 'root');
            return self::$pdo;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}

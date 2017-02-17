<?php

namespace app\user;
require_once "../../vendor/autoload.php";
use app\core\DB;
use PDO;

class Unique
{
    private static $pdo = null;
    private static $allData = null;

    public static function check($email)
    {
        self::$pdo = DB::getPDO();

        $sql = "SELECT * FROM `users` WHERE `email` = :email";
        $query = self::$pdo->prepare($sql);
        $taskReplay = $query->execute(
            array(
                ':email' => $email
            )
        );

        if($taskReplay){
            self::$allData = $query->fetchAll(PDO::FETCH_OBJ);
            $count = $query->rowCount();
            if ($count){
                return false;
            }else{
                return true;
            }
        }else{
            return false;
        }
    }

    public static function getAlldata()
    {
        if (self::$allData){
            return self::$allData[0];
        }
    }
}
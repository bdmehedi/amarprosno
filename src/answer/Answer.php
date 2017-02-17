<?php

namespace app\answer;
require_once "../../vendor/autoload.php";
use app\core\DB;
use PDO;


class Answer
{
    private $db = null;
    private $qid;
    private $answer;
    private $ansById;
    private $ansId;

    private static $_db;
    private static $AllData;

    public function __construct()
    {
        $this->db = DB::getPDO();
    }

    public function setData($data = "")
    {

        if (array_key_exists('qid', $data)) {
            $this->qid = $data['qid'];
        }
        if (array_key_exists('answer', $data)) {
            $this->answer = $data['answer'];
        }

        if (array_key_exists('ansById', $data)) {
            $this->ansById = $data['ansById'];
        }

        if (array_key_exists('ansId', $data)) {
            $this->ansId = $data['ansId'];
        }


        return $this;

    }

    public function store()
    {
        $sql = "INSERT INTO `answers` (`question_id`, `answered_by`, `answer`, `time`) VALUES (:qid, :ansById, :answer, :atime)";
        $query = $this->db->prepare($sql);
        $taskreplay = $query->execute(
            array(
                ':qid' => $this->qid,
                ':ansById' => $this->ansById,
                ':answer' => $this->answer,
                ':atime' => date('Y-m-d h:m:s')
            )
        );

        if($taskreplay){
            //Session::put('success', 'Your registration is succeed');
            // Redirect::to('../../view/user_profile/edit_user_profile.php');
            return true;
        }else{
            return false;
        }
    } //functin store end here...


    public function update()
    {
        //echo $this->ansId, $this->answer; exit();
        $sql = "UPDATE `answers` SET `answer` = :answer, `time` = :atime WHERE `answers`.`ansid` = :ansId";
        $query = $this->db->prepare($sql);
        $taskreplay = $query->execute(
            array(
                ':answer' => $this->answer,
                ':atime' => date('Y-m-d h:m:s'),
                ':ansId' => $this->ansId
            )
        );

        if($taskreplay){
            return true;
        }else{
            return false;
        }
    }

    public function delete()
    {
        //echo $this->ansId, $this->answer; exit();
        $sql = "DELETE FROM `answers` WHERE `answers`.`ansid` = :ansId";
        $query = $this->db->prepare($sql);
        $taskreplay = $query->execute(
            array(
                ':ansId' => $this->ansId
            )
        );

        if($taskreplay){
            return true;
        }else{
            return false;
        }
    }

    public static function findAllAns($qid = null, $ansId = null){
        self::$_db = DB::getPDO();

        if ($qid){
            $sql = "SELECT * FROM answers JOIN users ON answers.answered_by = users.id JOIN questions ON questions.qid = answers.question_id WHERE answers.question_id = :qid ORDER BY ansid DESC ";
            $query = self::$_db->prepare($sql);
            $query_test = $query->execute(
                array(
                    ':qid' => $qid
                )
            );
        }elseif ($ansId){
            $sql = "SELECT * FROM answers JOIN users ON answers.answered_by = users.id JOIN questions ON questions.qid = answers.question_id WHERE answers.ansid = :ansId";
            $query = self::$_db->prepare($sql);
            $query_test = $query->execute(
                array(
                    ':ansId' => $ansId
                )
            );
        }else{
            $sql = null;
        }


        if (isset($query_test)){
            self::$AllData = $query->fetchAll(PDO::FETCH_OBJ);
            return true;
        }else{
            return false;
        }

    }

    public static function findAllAnsForUser($uid = null, $limit = null){
        self::$_db = DB::getPDO();
        if($limit){
            $sql = "SELECT * FROM answers JOIN users ON answers.answered_by = users.id WHERE answers.answered_by = :uid ORDER BY answers.ansid DESC LIMIT 0,$limit";
        }else{
            $sql = "SELECT * FROM answers JOIN users ON answers.answered_by = users.id WHERE answers.answered_by = :uid";
        }


        $query = self::$_db->prepare($sql);
        $query_test = $query->execute(
            array(
                'uid' => $uid
            )
        );

        if ($query_test){
            self::$AllData = $query->fetchAll(PDO::FETCH_OBJ);
            return true;
        }else{
            return false;
        }

    }

    public static function getAllAns()
    {
        return self::$AllData;
    }

    public static function getFirstAns()
    {
        return self::$AllData[0];
    }
}
<?php
namespace app\question;
require_once "../../vendor/autoload.php";
use app\core\DB;
use PDO;

class Questions
{
    private static $_db;
    private static $AllData;

    private $db = null;
    private $id;
    private $question;
    private $email;
    private $title;
    private $qid = null;

    public function __construct()
    {
        $this->db = DB::getPDO();
    }

    public function setData($data = "")
    {
        if (array_key_exists('id', $data)) {
            $this->id = $data['id'];
        }

        if (array_key_exists('qid', $data)) {
            $this->qid = $data['qid'];
        }

        if (array_key_exists('email', $data)) {
            $this->email = $data['email'];
        }

        if (array_key_exists('question', $data)) {
            $this->question = $data['question'];
        }

        if (array_key_exists('title', $data)) {
            $this->title = $data['title'];
        }

        return $this;

    }

    public function store()
    {
        $sql = "INSERT INTO `questions` (`user_id`, `question`, `title`, `question_time`) VALUES (:id, :question, :title, :qtime);";
        $query = $this->db->prepare($sql);
        $taskreplay = $query->execute(
            array(
                ':id' => $this->id,
                ':question' => $this->question,
                ':title' => $this->title,
                ':qtime' => date('Y-m-d h:m:s')
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
        $sql = "UPDATE `questions` SET `question` = :question, `title` = :title, `question_time` = :qtime WHERE `questions`.`qid` = :qid";
        $query = $this->db->prepare($sql);
        $taskreplay = $query->execute(
            array(
                ':qid' => $this->qid,
                ':question' => $this->question,
                ':title' => $this->title,
                ':qtime' => date('Y-m-d h:m:s')
            )
        );

        if($taskreplay){
            //Session::put('success', 'Your registration is succeed');
            // Redirect::to('../../view/user_profile/edit_user_profile.php');
            return true;
        }else{
            return false;
        }
    }

    public static function delete($qid)
    {
        self::$_db = DB::getPDO();
        $sql = "DELETE FROM questions WHERE questions.qid = :qid";
        $query = self::$_db->prepare($sql);
        $deleteResult = $query->execute(
            array(
                ':qid' => $qid
            )
        );

        if ($deleteResult){
            return true;
        }else{
            return false;
        }
    }


    public static function findAllquestion($id = null, $limit = null, $qid = null){
        self::$_db = DB::getPDO();

        if ($id){
            $sql = "SELECT * FROM users JOIN questions ON users.id = questions.user_id WHERE users.id = $id ORDER BY questions.qid DESC";
        }elseif($limit){
            $sql = "SELECT * FROM users JOIN questions ON users.id = questions.user_id ORDER BY questions.qid DESC LIMIT 0,$limit";
        }elseif($qid){
            $sql = "SELECT * FROM users JOIN questions ON users.id = questions.user_id WHERE questions.qid = $qid";
        }else{
            $sql = "SELECT * FROM users JOIN questions ON users.id = questions.user_id ORDER BY questions.qid DESC";
        }

        $query = self::$_db->prepare($sql);
        $query_test = $query->execute();

        if ($query_test){
            self::$AllData = $query->fetchAll(PDO::FETCH_OBJ);
            return true;
        }else{
            return false;
        }

    }

    public static function findSearchQuestion($search = null){
        self::$_db = DB::getPDO();

        $sql = "SELECT * FROM users JOIN questions on users.id = questions.user_id WHERE questions.question LIKE :search1 OR questions.title LIKE :search2";
        $search = '%'.$search.'%';
        $query = self::$_db->prepare($sql);
        $query_test = $query->execute(
            array(
                ':search1' => $search,
                ':search2' => $search
            )
        );

        if ($query_test){
            self::$AllData = $query->fetchAll(PDO::FETCH_OBJ);
            return true;
        }else{
            return false;
        }

    }


    public static function findAllQuestionForAns($ansId = null){
        self::$_db = DB::getPDO();

        $sql = "SELECT * FROM questions JOIN users on questions.user_id = users.id WHERE questions.qid = :ansId";
        $query = self::$_db->prepare($sql);
        $query_test = $query->execute(
            array(
                ':ansId' => $ansId
            )
        );

        if ($query_test){
            self::$AllData = $query->fetchAll(PDO::FETCH_OBJ);
            return true;
        }else{
            return false;
        }

    }


    public static function getAllData()
    {
        return self::$AllData;
    }

    public static function getFirstData()
    {
        return self::$AllData[0];
    }
}
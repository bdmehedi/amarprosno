<?php
namespace app\user;
require_once "../../vendor/autoload.php";

use app\core\DB;
use app\core\Redirect;
use app\core\Session;
//use app\user\UploadImg;
use \PDO;

class Users
{
    private $db = null;
    private $id = null;
    private $email = '';
    private $password;
    private $re_password ;
    private $alldata = null;
    private $count = null;
    private $first_name = '';
    private $middle_name = '';
    private $last_name = '';
    private $gender = '';
    private $date_of_birth = null;
    private $hobby = '';
    private $interest = '';
    private $photo = '';
    private $cover_photo = '';
    private $phone = null;


    public function __construct()
    {
        $this->db = DB::getPDO();
    }

    public function setData($data = "")
    {
        if (array_key_exists('id', $data)) {
            $this->id = $data['id'];
        }

        if (array_key_exists('email', $data)) {
            $this->email = $data['email'];
        }

        if (Session::exists('user')) {
            $this->email = Session::get('user');
        }

        if (array_key_exists('password', $data)) {
            $this->password = md5($data['password']);
        }

        if (array_key_exists('re_password', $data)) {
            $this->re_password = md5($data['re_password']);
        }

        if (array_key_exists('firstName', $data)) {
            $this->first_name = $data['firstName'];
        }

        if (array_key_exists('middleName', $data)) {
            $this->middle_name = $data['middleName'];
        }

        if (array_key_exists('lastName', $data)) {
            $this->last_name = $data['lastName'];
        }

        if (array_key_exists('gender', $data)) {
            $this->gender = $data['gender'];
        }

        if (array_key_exists('birthday', $data)) {
            $this->date_of_birth = $data['birthday'];
        }

        if (array_key_exists('hobby', $data)) {
            $this->hobby = $data['hobby'];
        }

        if (array_key_exists('interest', $data)) {
            $this->interest = $data['interest'];
        }

        if (array_key_exists('photo', $data)) {
            $this->photo = $data['photo'];
        }

        if (array_key_exists('phone', $data)) {
            $this->phone = $data['phone'];
        }

        if (array_key_exists('cover_photo', $data)) {
            $this->cover_photo = $data['cover_photo'];
        }


        return $this;

    }

    public function store()
    {
        $sql = "INSERT INTO `users` (`id`, `email`, `password`) VALUES (:id, :email, :password)";
        $query = $this->db->prepare($sql);
        $taskreplay = $query->execute(
            array(
                ':id' => null,
                ':email' => $this->email,
                ':password' => $this->password
            )
        );

        if($taskreplay){
            //Session::put('success', 'Your registration is succeed');
            Session::put('user', $this->email);
            Redirect::to('../../view/user_profile/edit_user_profile.php');

            return true;
        }else{
            return false;
        }
    } //functin store end here...

    public function checkLoginData()
    {
        $sql = "SELECT * FROM `users` WHERE `email` = :email";
        $query = $this->db->prepare($sql);
        $taskReplay = $query->execute(
            array(
                ':email' => $this->email
            )
        );

        if($taskReplay){
            $this->alldata = $query->fetchAll(PDO::FETCH_OBJ);
            $this->count = $query->rowCount();
            if ($this->count){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    
    
    public function getUserAllData($email)
    {
        $sql = "SELECT * FROM `users` WHERE `email` = :email";
        $query = $this->db->prepare($sql);
        $taskReplay = $query->execute(
            array(
                ':email' => $email
            )
        );

        if($taskReplay){
            $this->alldata = $query->fetchAll(PDO::FETCH_OBJ);
            $this->count = $query->rowCount();
            if ($this->count){
                return $this->alldata[0];
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    

    public function getAllData()
    {
        if ($this->count){
            return $this->alldata[0];
        }
    }
    
      public function updateProfile()
    {
        $sql = "UPDATE `users` SET `first_name` = :firstName, `middle_name` = :middleName, `last_name` = :lastName, `gender` = :gender, `date_of_birth` = :birthday, `hobby` = :hobby, `interest` = :interest, `phone` = :phone WHERE `email` = :email";
        $query = $this->db->prepare($sql);
        $taskreplay = $query->execute(
            array(
                ':email' => $this->email,
                ':firstName' => $this->first_name,
                ':middleName' => $this->middle_name,
                ':lastName' => $this->last_name,
                ':gender' => $this->gender,
                ':birthday' => $this->date_of_birth,
                ':hobby' => $this->hobby,
                ':interest' => $this->interest,
                ':phone' => $this->phone
            )
        );

        if($taskreplay){
            Session::put('success', 'Profile updated');
            Redirect::to('../../view/user_profile/edit_user_profile.php');

            return true;
        }else{
            return false;
        }
    }
    
     public function uploadUserImg($userPhoto)
    {
        $sql = "UPDATE `users` SET `photo` = :userPhoto WHERE `email` = :email";
        $query = $this->db->prepare($sql);
        $taskreplay = $query->execute(
            array(
                ':email' => $this->email,
                ':userPhoto' => $userPhoto
            )
        );

        if($taskreplay){
            Session::put('success', 'Your image uploading is succeed');
            Redirect::to('../../view/user_profile/edit_user_profile.php');

            return true;
        }else{
            return false;
        }
    }
    
     public function uploadCoverImg($coverPhoto)
    {
        $sql = "UPDATE `users` SET `cover_photo` = :coverPhoto WHERE `email` = :email";
        $query = $this->db->prepare($sql);
        $taskreplay = $query->execute(
            array(
                ':email' => $this->email,
                ':coverPhoto' => $coverPhoto
            )
        );

        if($taskreplay){
            Session::put('success', 'Your image uploading is succeed');
            Redirect::to('../../view/user_profile/edit_user_profile.php');

            return true;
        }else{
            return false;
        }
    }
    
}
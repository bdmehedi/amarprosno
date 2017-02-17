<?php
require_once "../../vendor/autoload.php";
use app\core\Redirect;
use app\user\Unique;
use app\core\Session;
use app\core\Validation;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (Validation::valid($_POST['question']) && Validation::valid($_POST['title'])){
        $allData = Unique::check(Session::get('user'));
        if (!$allData){
            $allData = Unique::getAlldata();
            $_POST['id'] = $allData->id;
            $storeQuestion = new \app\question\Questions();

            if ($storeQuestion->setData($_POST)->store()){
                Redirect::to('user_home_page.php');
            }else{
                Session::put('qerror', 'Something going wrong. please try again');
                Redirect::to('ask_question.php');
            }
        }else{
            Redirect::to('ask_question.php');
        }
    }else{
        Session::put('qerror', 'Opps! Invalid input.');
        Redirect::to('ask_question.php');
    }
}else{
    Redirect::to('user_home_page.php');
}
 
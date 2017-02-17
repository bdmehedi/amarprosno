<?php
require_once "../../vendor/autoload.php";
use app\core\Redirect;
use app\core\Session;
use app\core\Validation;
use app\answer\Answer;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (Validation::valid($_POST['answer'])){
        $ansStore = new Answer();
        if ($ansStore->setData($_POST)->store()){
            $qid = serialize(time()).$_POST['qid'];
            $ansById = serialize(time()).$_POST['ansById'];
            header('Location: view_single_question.php?qid='.$qid.'&ansById='.$ansById);
        }else{
            Session::put('anserror', 'Opps! Something going wrong. for database');
            Redirect::to('view_single_question.php');
        }
    }else{
        Session::put('anserror', 'Opps! Invalid input.');
        Redirect::to('view_single_question.php');
    }
}else{
    Redirect::to('user_home_page.php');
}

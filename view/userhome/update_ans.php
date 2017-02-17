<?php
require_once "../../vendor/autoload.php";
use app\core\Redirect;
use app\core\Session;
use app\core\Validation;
use app\answer\Answer;


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (Validation::valid($_POST['answer'])){
        $ansUpdate = new Answer();
        if ($ansUpdate->setData($_POST)->update()){
            $qid = serialize(time()).$_POST['qid'];
            $ansById = serialize(time()).$_POST['ansById'];
            header('Location: view_single_question.php?qid='.$qid.'&ansById='.$ansById);
        }else{
            $qid = serialize(time()).$_POST['qid'];
            $ansById = serialize(time()).$_POST['ansById'];
            Session::put('anserror', 'Opps! Something going wrong.');
            header('Location: view_single_question.php?qid='.$qid.'&ansById='.$ansById);
        }
    }else{
        Session::put('anserror', 'Opps! Invalid input.');
        Redirect::to('view_single_question.php');
    }
}else{
    Redirect::to('user_home_page.php');
}

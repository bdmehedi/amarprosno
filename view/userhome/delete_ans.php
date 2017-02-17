<?php
require_once "../../vendor/autoload.php";
use app\core\Redirect;
use app\core\Session;
use app\core\Validation;
use app\answer\Answer;

if (isset($_GET['qid'])){
    $qid = explode(';', $_GET['qid']);
    $qid = end($qid);
    $_POST['qid'] = $qid;
}
if (isset($_GET['ansid'])){
    $ansId = explode(';', $_GET['ansid']);
    $ansId = end($ansId);
    $_POST['ansId'] = $ansId;
}
//print_r($_POST);exit();
if(Session::exists('user')){
    $ansUpdate = new Answer();
    if ($ansUpdate->setData($_POST)->delete()){
        $qid = serialize(time()).$qid;
        $ansById = serialize(time()).$ansId;
        header('Location: view_single_question.php?qid='.$qid.'&ansById='.$ansById);
    }else{
        $qid = serialize(time()).$_POST['qid'];
        $ansById = serialize(time()).$_POST['ansById'];
        Session::put('anserror', 'Opps! Something going wrong.');
        header('Location: view_single_question.php?qid='.$qid.'&ansById='.$ansById);
    }
}else{
    Redirect::to('user_home_page.php');
}

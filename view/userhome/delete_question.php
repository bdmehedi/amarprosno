<?php
require_once "../../vendor/autoload.php";
use app\core\Redirect;
use app\core\Session;
use app\question\Questions;


if (Session::exists('user')){
    $qid = explode(';', $_GET['qid']);
    $qid = end($qid);
    if (Questions::delete($qid)){
        Session::put('delete', 'Question delete successfully.');
        Redirect::to('user_home_page.php');
    }

}else{
    Redirect::to('user_home_page.php');
}

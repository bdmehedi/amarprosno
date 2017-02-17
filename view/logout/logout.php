<?php
require_once "../../vendor/autoload.php";
use app\core\Session;
use app\core\Redirect;

if (Session::exists('user')){
    Session::delete('user');
    Redirect::to('../../index.php');
}else{
    Redirect::to('../../index.php');
}
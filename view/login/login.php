<?php
require_once "../../vendor/autoload.php";
use app\core\Redirect;
use app\core\Session;
use app\core\Validation;
use app\user\Users;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset($_POST['login'])){
        if (Validation::valid($_POST['email']) && Validation::valid($_POST['password'])){
            $login = new Users();
            $allData = $login->setData($_POST)->checkLoginData();
            if ($allData){
                $allData = $login->getAllData();
                if ($allData->email === Validation::valid($_POST['email']) && $allData->password === md5(Validation::valid($_POST['password']))){
                    Session::put('user', $allData->email);
                    Redirect::to('../userhome/user_home_page.php');
                }else{
                    Session::put('error', 'Opps! email or password is not valid. please try again.');
                    Redirect::to('../../index.php');
                }
            }else{
                Session::put('error', 'Opps! email or password is not valid. please try again.');
                Redirect::to('../../index.php');
            }

        }else{
            Session::put('error', 'Sorry! Invalid input.');
            Redirect::to('../../index.php');
        }
    }else{
        Redirect::to('../../index.php');
    }
}else{
    Redirect::to('../../index.php');
}
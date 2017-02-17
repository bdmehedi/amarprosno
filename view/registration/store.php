<?php
require_once "../../vendor/autoload.php";
use app\core\Redirect;
use app\user\Users;
use app\core\Session;
use app\core\Validation;
use app\user\Unique;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset($_POST['registration'])){
        if(!empty($_POST['email'])){
            if ($_POST['password'] === $_POST['re_password']){
                if (strlen($_POST['password']) >= 6){
                    if (Validation::valid($_POST['email']) && Validation::valid($_POST['password'])){
                        if (Unique::check($_POST['email'])){
                            $registration = new Users();
                            $registration->setData($_POST)->store();
                        }else{;
                            Session::put('error', 'Sorry! This email is used for another id. Please try to login');
                            Redirect::to('../../index.php');
                        }
                    }else{
                        Session::put('error', 'Sorry! Invalid input.');
                        Redirect::to('../../index.php');
                    }
                }else{
                    Session::put('error', 'Sorry! Password length must be at least 6.');
                    Redirect::to('../../index.php');
                }
            }else{
                Session::put('error', 'Sorry! Password & Retype Password must be match.');
                Redirect::to('../../index.php');
            }
        }else{
            Session::put('error', 'Sorry! Email should not be empty !');
            Redirect::to('../../index.php');
        }
    }else{
        Redirect::to('../../index.php');
    }
}else{
    Redirect::to('../../index.php');
}
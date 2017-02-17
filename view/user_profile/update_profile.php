<?php
require_once "../../vendor/autoload.php";
use app\core\Redirect;
use app\core\Session;
use app\core\Validation;
use app\user\UploadImg;
use app\user\Users;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (!empty($_POST)){
        if (isset($_POST['update'])){
            if (Validation::validWithoutEmpty($_POST['firstName']) || Validation::validWithoutEmpty($_POST['middleName'])  || Validation::validWithoutEmpty($_POST['lastName']) || Validation::validWithoutEmpty($_POST['phone'])  || Validation::validWithoutEmpty($_POST['birthday']) || Validation::validWithoutEmpty($_POST['hobby'])  || Validation::validWithoutEmpty($_POST['interest'])){
                $updateProfile = new Users();
                $updateProfile->setData($_POST)->updateProfile();
            }else{
                Session::put('error', 'Sorry! Invalid input.');
                Redirect::to('edit_user_profile.php');
            }
        }elseif (isset($_POST['userPhotoUpload'])){
//            echo "<pre>";
//            print_r($_FILES); exit();die();
            $img_size = 2;
            $img_type = 'jpeg,jpg,png';
            $img_path = 'uploadsImg';
            $photoUpload = new UploadImg($img_path, $img_type, $img_size);
            $photoUpload->update_img('userPhoto');
            $path = $photoUpload->getpath();
            $fileName = $photoUpload->getFileName();
            if (move_uploaded_file($fileName, '../../'.$path)){
                $updateProfile = new Users();
                if ($updateProfile->setData()->uploadUserImg($path)){
                    Session::put('success', 'Your Image is updated');
                }else{
                    Session::put('imgerror', 'Someting going wrong ! please try again');
                    Redirect::to('edit_user_profile.php');
                }
            }else{
                Session::put('imgerror', 'Someting going wrong ! please try again');
                Redirect::to('edit_user_profile.php');
            }
        }elseif (isset($_POST['coverPhotoUpload'])){
            $img_size = 2;
            $img_type = 'jpeg,jpg,png';
            $img_path = 'uploadsImg';
            $photoUpload = new UploadImg($img_path, $img_type, $img_size);
            $photoUpload->update_img('coverPhoto');
            $path = $photoUpload->getpath();
            $fileName = $photoUpload->getFileName();
            if (move_uploaded_file($fileName, '../../'.$path)){
                $updateProfile = new Users();
                if ($updateProfile->setData()->uploadCoverImg($path)){
                    Session::put('success', 'Your Image is updated');
                }else{
                    Session::put('imgerror', 'Someting going wrong ! please try again');
                    Redirect::to('edit_user_profile.php');
                }
            }else{
                Session::put('imgerror', 'Someting going wrong ! please try again');
                Redirect::to('edit_user_profile.php');
            }
        }else{
            Redirect::to('edit_user_profile.php');
        }
    }else{
        Session::put('error', 'Sorry! Invalid input for empty.');
        Redirect::to('edit_user_profile.php');
    }
}else{
    Redirect::to('edit_user_profile.php');
}
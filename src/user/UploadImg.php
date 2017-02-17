<?php
namespace app\user;
require_once "../../vendor/autoload.php";
use app\core\Session;
use app\core\Redirect;

class UploadImg
{
    protected $filex = '';
    protected $filetype = '';
    protected $filesize = '';
    protected $given_size = '';
    protected $fl_temp_name = '';
    protected $path_name = '';
    protected $expact_type = '';
    protected $path = '';

    public function __construct($path, $img_info, $img_size)
    {
        $this->path_name = $path;
        $this->expact_type = explode(',', $img_info);
        $this->given_size = $img_size;
    }

    public function update_img($name)
    {
        $explodeName = explode('.',$_FILES[$name]['name']);
        $this->filex = strtolower(end($explodeName));
        $explodeType = explode('/',$_FILES[$name]['type']);
        $this->filetype = end($explodeType);
        $this->fl_temp_name = $_FILES[$name]['tmp_name'];
        $this->filesize = $_FILES[$name]['size'];


        if (empty($this->filex)) {
            Session::put('imgerror', 'Image must not be empty');
            Redirect::to('../../view/user_profile/edit_user_profile.php');
        }elseif (!in_array($this->filex, $this->expact_type)) {
            $expted_type = 'Image must be';
            for ($i = 0; $i < count($this->expact_type); $i++) {
                $expted_type = $expted_type .' '. $this->expact_type[$i] . ',';
            }
            Session::put('imgerror', $expted_type);
            Redirect::to('../../view/user_profile/edit_user_profile.php');
        }elseif ($this->filesize > ($this->given_size*1024*1024)) {
            Session::put('imgerror', 'Image must be within 2MB.');
            Redirect::to('../../view/user_profile/edit_user_profile.php');
        }elseif ($_FILES[$name]['error']) {
            Session::put('imgerror', 'Sorry! This image not valid for upload . Image must have within 2MB & must be jpeg,jpg,png.');
            Redirect::to('../../view/user_profile/edit_user_profile.php');
        }else {
            $file_to_name = md5(time());
            $this->path = $this->path_name. '/' .$file_to_name. '.' .$this->filex;
            //move_uploaded_file($this->fl_temp_name, $this->path);
            //echo $path;
        }
        // echo $this->filex,'<br>', $this->filetype, '<br>', $this->filesize, '<br>', $this->fl_temp_name ;

        // echo '<pre>', print_r($_FILES[$name]), '</pre><br>';
    }

    public function getpath(){
        if ($this->path != ''){
            return $this->path;
        }else{
            return false;
        }
    }

    public function getFileName(){
        if ($this->fl_temp_name != ''){
            return $this->fl_temp_name;
        }else{
            return false;
        }
    }

}
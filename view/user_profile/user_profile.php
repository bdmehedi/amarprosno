<?php
require_once "../../vendor/autoload.php";
use app\core\Session;
use app\core\Redirect;
use app\user\Users;

if (Session::exists('user')){
    $alldata = new Users();
    $alldata = $alldata->getUserAllData(Session::get('user'));
    if ($alldata){
        //print_r($alldata);
    }
}else{
    Redirect::to('../../index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Amar Prosno.com</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../view/images/icon.png" />

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<section class="manue">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-default navbar-fixed-top">
                    <ul class="nav nav-pills">
                        <li><a href="../userhome/user_home_page.php">User Home</a></li>
                        <li><a href="../user_profile/edit_user_profile.php">Edit Profile</a></li>
                        <li><a href="../logout/logout.php">Logout</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</section>
<header>
    <div class="col-md-12">
        <div class="container">
            <div class="cover_photo">
                <img class="img-thumbnail img-responsive" src="<?php echo '../../' . $alldata->cover_photo;?>" alt="Cover Photo">

                <div class="profile_photo">
                    <img class="img-rounded img-responsive" src="<?php echo '../../' . $alldata->photo;?>" alt="Your Photo">
                </div>
            </div>

        </div>
    </div>
</header>
<section class="profile_body">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="text-align: center"><h1>Your Profile</h1></div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Email</h3>
                    </div>
                    <div class="panel-body">
                        <?php echo $alldata->email;?>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Full Name</h3>
                    </div>
                    <div class="panel-body">
                        <?php echo $alldata->first_name . '  ' . $alldata->middle_name . '  ' . $alldata->last_name;?>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Phone No</h3>
                    </div>
                    <div class="panel-body">
                        <?php echo $alldata->phone;?>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Date of Birth</h3>
                    </div>
                    <div class="panel-body">
                        <?php echo $alldata->date_of_birth;?>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Gender</h3>
                    </div>
                    <div class="panel-body">
                        <?php echo $alldata->gender;?>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Your Hobby</h3>
                    </div>
                    <div class="panel-body">
                        <?php echo $alldata->hobby;?>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">You are interested in</h3>
                    </div>
                    <div class="panel-body">
                        <?php echo $alldata->interest;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<footer class="footer">
    <p>&copy; 2017 All Rights Reserved</p>
</footer>
</body>
</html>
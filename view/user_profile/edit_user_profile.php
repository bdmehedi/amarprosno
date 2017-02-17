<?php
require_once "../../vendor/autoload.php";
use app\core\Session;
use app\core\Redirect;
use app\user\Users;

if (Session::exists('user')){
    $alldata = new Users();
    $alldata = $alldata->getUserAllData(Session::get('user'));
    if ($alldata){
       // print_r($alldata);exit();
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
    <link rel="shortcut icon" type="image/x-icon" href="../images/icon.png" />
    
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
                        <li><a href="../user_profile/user_profile.php"><img src="../../<?php echo $alldata->photo ?>" alt="Your Profile"></a></li>
                            <li><a href="../userhome/user_home_page.php">User Home</a></li>
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

                    <form class="cover_photo" action="update_profile.php" method="post" enctype="multipart/form-data">
                        <label for="coverPhoto">Update your cover photo</label>
                        <input type="file" id="coverPhoto" name="coverPhoto">
                        <input type="submit" name="coverPhotoUpload" value="upload">
                    </form>

                    <div class="profile_photo">
                        <img class="img-rounded img-responsive" src="<?php echo '../../' . $alldata->photo;?>" alt="Your Photo">
                    </div>
                </div>

                <form action="update_profile.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="userPhoto">
                    <input type="submit" name="userPhotoUpload" value="upload">
                </form>

            </div>
        </div>
    </header>


<?php
    if (Session::exists('error')){ ?>
    <section class="error">
        <div class="container">
            <div class="row">
                <div class="com-md-4 col-md-offset-4">
                    <?php echo '<h3 style="color: red">' . Session::get('error') . '</h3>';
                    Session::delete('error');
                    ?>
                </div>
            </div>
        </div>
    </section>
    <?php } ?>
    <?php
    if (Session::exists('imgerror')){ ?>
    <section class="error">
        <div class="container">
            <div class="row">
                <div class="com-md-4 col-md-offset-4">
                    <?php echo '<h3 style="color: red">' . Session::get('imgerror') . '</h3>';
                    Session::delete('imgerror');
                    ?>
                </div>
            </div>
        </div>
    </section>
    <?php } ?>

    <?php if (Session::exists('success')){ ?>
    <section class="error">
        <div class="container">
            <div class="row">
                <div class="com-md-4 col-md-offset-4">
                    <?php echo '<h3 style="color: green">' . Session::get('success') . '</h3>';
                    Session::delete('success');
                    ?>
                </div>
            </div>
        </div>
    </section>

<?php } ?>



    <section class="profile_body">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="form">
                        <form class="form-horizontal" action="update_profile.php" method="post">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" value="<?php if ($alldata){echo $alldata->email;} ?>" id="inputEmail3" disabled="" name="email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="firstName" class="col-sm-2 control-label">First Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?php if ($alldata){echo $alldata->first_name;} ?>" name="firstName">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="middleName" class="col-sm-2 control-label">Middle Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?php if ($alldata){echo $alldata->middle_name;} ?>" id="middleName" name="middleName">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="lastName" class="col-sm-2 control-label">Last Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?php if ($alldata){echo $alldata->last_name;} ?>" id="lastName" name="lastName">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="phone" class="col-sm-2 control-label">Phone</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?php if ($alldata){echo $alldata->phone;} ?>" id="phone" name="phone">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="phone" class="col-sm-2 control-label">Date of birth</label>
                                <div class="col-sm-10">
                                    <input type="datetime" class="form-control" value="<?php if ($alldata){echo $alldata->date_of_birth;} ?>" id="phone" name="birthday" placeholder="EX: yyyy-mm-dd">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="hobby" class="col-sm-2 control-label">Hobby</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?php if ($alldata){echo $alldata->hobby;} ?>" id="hobby" name="hobby">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="interest" class="col-sm-2 control-label">Interest</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?php if ($alldata){echo $alldata->interest;} ?>" id="interest" name="interest">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="gender" class="col-sm-2 control-label">Select your gender</label>
                                <div class="col-sm-10">
                                    <select name="gender" id="gender">
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-default" name="update">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!--    <footer class="footer">-->
<!--        <p>&copy; 2017 All Rights Reserved</p>-->
<!--    </footer>-->
</body>
</html>
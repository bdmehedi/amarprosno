<?php
require_once "../../vendor/autoload.php";
use app\core\Session;
use app\core\Redirect;
use app\user\Unique;
use app\question\Questions;

if (Session::exists('user')){
    if (!(Unique::check(Session::get('user')))){
        $allData = Unique::getAlldata();

        $qid = explode(';', $_GET['qid']);
        $qid = end($qid);
        if (Questions::findAllquestion(null, null, $qid)){
            $allQuestion = Questions::getFirstData();
        }else{
            $allQuestion = null;
        }

//        if (Answer::findAllAns($qid)){
//            $allAns = Answer::getAllAns();
//        }

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
                        <li><a href="../user_profile/user_profile.php"><img src="../../<?php echo $allData->photo ?>" alt="your pic"></a></li>
                        <li><a href="../user_profile/edit_user_profile.php">Edit Profile</a></li>
                        <li><a href="user_home_page.php">User Home</a></li>
                        <li><a href="view_all_question.php">View All Questions</a></li>
                        <li><a href="ask_question.php">Add a question</a></li>
                        <li><a href="../logout/logout.php">Logout</a></li>
                        <!--<form class="navbar-form navbar-right">
                            <div class="form-group">
                                <label for="search">Find a question</label>
                                <input type="text" id="search" class="form-control" placeholder="Search">
                            </div>
                            <button type="submit" class="btn btn-default">Submit</button>
                        </form>-->
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</section>
<header>
    <div class="col-md-12">
        <div class="container">

        </div>
    </div>
</header>

<section class="profile_body">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="askQuestions">

                    <?php
                    if (Session::exists('qerror')){
                        echo '<p style="color: red">'. Session::get('qerror').'</p>';
                        Session::delete('qerror');
                    }
                    ?>

                    <div class="ask_question_header">
                        <h2 style="text-align: center">Update your question here</h2>
                    </div>
                    <div class="ask_question_body">
                        <form action="update_question.php" method="post">
                            <div class="field">
                                <label for="question_head">Title</label>
                                <input type="text" name="title" id="question_head" value="<?php echo $allQuestion->title?>"> <br><br>
                                <textarea id="question" rows="7" cols="50" name="question"><?php echo $allQuestion->question?></textarea><br>
                                <input type="submit" value="Submit">
                                <input type="hidden" name="qid" value="<?php echo $qid?>">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--<footer class="footer">
          <p>&copy; 2017 All Rights Reserved</p>
</footer>-->
</body>
</html>

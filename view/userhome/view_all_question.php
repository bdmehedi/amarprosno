<?php
require_once "../../vendor/autoload.php";
use app\core\Session;
use app\core\Redirect;
use app\user\Unique;
use app\question\Questions;

if (Session::exists('user')){
    if (!(Unique::check(Session::get('user')))){
        $allData = Unique::getAlldata();
        if (Questions::findAllQuestion()){
            $allQuestion = Questions::getAllData();
        }
        $checkSearch = null;
        if (isset($_GET['search'])){
            if (Questions::findSearchQuestion($_GET['search'])){
                $allQuestion = Questions::getAllData();
                $checkSearch = 1;
            }
        }
        if (Questions::findAllQuestion($allData->id)){
            $myQuestion = Questions::getAllData();
        }

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
                        <form class="navbar-form navbar-right" action="" method="get">
                            <div class="form-group">
                                <label for="search">Find a question</label>
                                <input type="text" id="search" class="form-control" name="search" placeholder="Search">
                            </div>
                            <button type="submit" class="btn btn-default">Search</button>
                        </form>
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

<section class="user_home_body">
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <div class="questions">
                <div class="questin_header">
                    <?php if ($checkSearch){ ?>
                        <h2>Searched Questions</h2>
                    <?php }else{ ?>
                        <h2>All Questions</h2>
                    <?php } ?>
                </div>

                <?php foreach ($allQuestion as $question){ ?>
                    <div class="question_body">
                        <div class="single_question">
                            <a href="view_single_question.php?qid=<?php echo serialize(time()),$question->qid;?>&b=<?php echo time();?>"><h3><i class="fa fa-question-circle"></i> <?php echo $question->title?></h3>
                                <p> <?php echo $question->question?></p></a>
                            <p><?php if (Session::get('user') == $question->email){?>
                                    <a href="edit_question.php?qid=<?php echo serialize(time()),$question->qid;?>&b=<?php echo time();?>"><i class="fa fa-pencil-square"></i></a>
                                    <a href="delete_question.php?qid=<?php echo serialize(time()),$question->qid;?>&b=<?php echo time();?>"><i class="fa fa-trash"></i></a> &nbsp; Me
                                <?php }else{ echo $question->first_name; }?> &nbsp; <?php echo $question->question_time; ?></p>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<!--<footer class="footer">-->
<!--    <p>&copy; 2017 All Rights Reserved</p>-->
<!--</footer>-->
</body>
</html>


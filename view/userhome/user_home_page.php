<?php
require_once "../../vendor/autoload.php";
use app\core\Session;
use app\core\Redirect;
use app\user\Unique;
use app\question\Questions;
use app\answer\Answer;

if (Session::exists('user')){
    if (!(Unique::check(Session::get('user')))){
        $allData = Unique::getAlldata();
        if (Questions::findAllQuestion(null, 7)){
            $allQuestion = Questions::getAllData();
        }

        $checkSearch = null;
        if (isset($_GET['search'])){
            if (Questions::findSearchQuestion($_GET['search'])){
                $allQuestion = Questions::getAllData();
                $checkSearch = 1;
            }
        }
        $myQuestion = null;
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

    <div>
        <?php
        if (Session::exists('delete')){
            echo Session::get('delete');
            Session::delete('delete');
        }
        ?>
    </div>

    <section class="user_home_body">
        <div class="container">
            <div class="col-md-4">
                <div class="questions">
                    <div class="questin_header">
                        <?php if ($checkSearch){ ?>
                            <h2>Searched Questions</h2>
                        <?php }else{ ?>
                            <h2>Recent Questions</h2>
                        <?php } ?>
                    </div>

                    <?php foreach ($allQuestion as $question){ ?>
                    <?php 
                        $readQuestion = $question->question;
                        if (strlen($readQuestion) > 50) {
                            $readQuestion = substr($readQuestion, 0, 50) . ' .... <b id = "read_more">Read more</b>';
                        }
                        ?>
                    <div class="question_body">
                        <div class="single_question">
                            <a href="view_single_question.php?qid=<?php echo serialize(time()),$question->qid;?>&b=<?php echo time();?>"><h3><i class="fa fa-question-circle"></i> <?php echo $question->title?></h3>
                            <p><?php echo $readQuestion?></p></a>
                            <p><?php
                                if (Session::get('user') == $question->email){ ?>
                                    <a href="edit_question.php?qid=<?php echo serialize(time()),$question->qid;?>&b=<?php echo time();?>"><i class="fa fa-pencil-square"></i></a>
                                    <a href="delete_question.php?qid=<?php echo serialize(time()),$question->qid;?>&b=<?php echo time();?>"><i class="fa fa-trash"></i></a>
                                    <?php echo "Me"; }else{echo $question->first_name;}?> &nbsp; <?php echo $question->question_time; ?></p>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>

            <div class="col-md-4">
                <div class="questions">
                    <div class="questin_header">
                        <h2>Your Questions</h2>
                    </div>
                    <?php
                    if ($myQuestion){
                    foreach ($myQuestion as $mquestion){ ?>
                        <?php 
                        $question = $mquestion->question;
                        if (strlen($question) > 50) {
                            $question = substr($question, 0, 50) . ' .... <b id = "read_more">Read more</b>';
                        }
                         ?>
                        <div class="question_body">
                            <div class="single_question">
                                <a href="view_single_question.php?qid=<?php echo serialize(time()),$mquestion->qid;?>&b=<?php echo time();?>"><h3><i class="fa fa-question-circle"></i> <?php echo $mquestion->title;?></h3>
                                    <p><?php echo $question;?></p></a>
                                <p><?php if (Session::get('user') == $mquestion->email){ ?>
                                        <a href="edit_question.php?qid=<?php echo serialize(time()),$mquestion->qid;?>&b=<?php echo time();?>"><i class="fa fa-pencil-square"></i></a>
                                        <a href="delete_question.php?qid=<?php echo serialize(time()),$mquestion->qid;?>&b=<?php echo time();?>"><i class="fa fa-trash"></i></a>
                                    <?php } ?> Me &nbsp; <?php echo $mquestion->question_time; ?></p>
                            </div>
                        </div>
                        <?php }}else{ ?>
                            <p>There is no question.</p>
                    <?php } ?>
                </div>
            </div>

            <div class="col-md-4">
                <div class="questions">
                    <div class="questin_header">
                        <h2>Recent questions you have answered</h2>
                    </div>
                    <?php if(!empty($allData->id)){
                        Answer::findAllAnsForUser($allData->id, 4);
                    if($myAnswers = Answer::getAllAns()){
                        foreach($myAnswers as $myAns){
                        if(Questions::findAllQuestionForAns($myAns->question_id)){
                    ?>
                    <?php 
                    $question = Questions::getFirstData()->question;
                    if (strlen($question) > 50) {
                        $question = substr($question, 0, 50) . ' .... <b id = "read_more">Read more</b>';
                    }
                    ?>
                        <div class="question_body">
                            <div class="single_question">
                                <a href="view_single_question.php?qid=<?php echo serialize(time()),Questions::getFirstData()->qid;?>&b=<?php echo time();?>"><h3><i class="fa fa-question-circle"></i> <?php echo Questions::getFirstData()->title?></h3>
                                    <p><?php echo $question?></p></a>
                                <p> <?php if (Session::get('user') == Questions::getFirstData()->email){?>
                                        <a href="edit_question.php?qid=<?php echo serialize(time()),Questions::getFirstData()->qid;?>&b=<?php echo time();?>"><i class="fa fa-pencil-square"></i></a>
                                        <a href="delete_question.php?qid=<?php echo serialize(time()),Questions::getFirstData()->qid;?>&b=<?php echo time();?>"><i class="fa fa-trash"></i></a> &nbsp; Me
                                    <?php }else{ echo Questions::getFirstData()->first_name; }?> &nbsp; <?php echo Questions::getFirstData()->question_time; ?></p>
                            </div>

                    <?php 
                    $answer = $myAns->answer;
                    if (strlen($answer) > 90) {
                        //$string = substr($stringCut, 0, strrpos($stringCut, ' ')).'... <a href="/this/story">Read More</a>';
                        $answer = substr($answer, 0, 90);
                        $answer = substr($answer, 0, strrpos($answer, ' ')). '... <a href="view_single_question.php?qid='.serialize(time()).Questions::getFirstData()->qid .'&b='.time() .'">Read More</a>';
                        
                    }?>
                            <div class="single_ans">
                                    <p><i class="fa fa-comment"></i> <?php echo $answer?></p>
                                <p><?php if (Session::get('user') == $myAns->email){ ?>
                                        <a href="edit_ans.php?ansid=<?php echo serialize(time()),$myAns->ansid;?>&b=<?php echo time();?>"><i class="fa fa-pencil-square"></i></a>
                                        <a href="delete_ans.php?ansid=<?php echo serialize(time()),$myAns->ansid;?>&qid=<?php echo serialize(time()),$myAns->question_id;?>&b=<?php echo time();?>"><i class="fa fa-trash"></i></a>
                                    <?php } ?> Me &nbsp; <?php echo $myAns->time; ?></p>
                            </div>
                        </div>
                    <?php }}}else{?>
                        <p>There is no answer. please give your answer.</p>
                    <?php }}?>
                </div>
            </div>

            <div class="col-md-6">

            </div>
        </div>
    </section>
<!--    <footer class="footer">-->
<!--        <p>&copy; 2017 All Rights Reserved</p>-->
<!--    </footer>-->
</body>
</html>


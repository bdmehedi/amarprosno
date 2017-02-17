<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>AmarProsno</title>
    <link rel="shortcut icon" type="image/x-icon" href="view/images/icon.png" />
  <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  
      <link rel="stylesheet" href="view/tample/style.css">

  
</head>

<body>
  <div class="form">

      <?php
          require_once "vendor/autoload.php";
          use app\core\Session;
          if (Session::exists('error')){
              echo '<p style="color: #fff">' . Session::get('error') . '</p>';
              Session::delete('error');
          }
      ?>
<!--      <h1>Amarprosno.com</h1>-->
      <ul class="tab-group">
        <li class="tab active"><a href="#signup">Sign Up</a></li>
        <li class="tab"><a href="#login">Log In</a></li>
      </ul>
      
      <div class="tab-content">
        <div id="signup">   
          <h1>Sign Up for first use</h1>
          
          <form action="view/registration/store.php" method="post">


          <div class="field-wrap">
            <label>
              Email Address<span class="req">*</span>
            </label>
            <input name="email" type="email"required autocomplete="off"/>
          </div>
          
          <div class="field-wrap">
            <label>
              Set A Password<span class="req">*</span>
            </label>
            <input name="password" type="password"required autocomplete="off"/>
          </div>

          <div class="field-wrap">
              <label>
                  Retype Password<span class="req">*</span>
              </label>
              <input name="re_password" type="password"required autocomplete="off"/>
          </div>
          
          <button type="submit" name="registration" class="button button-block"/>Register</button>
          
          </form>

        </div>
        
        <div id="login">   
          <h1>Welcome Back!</h1>
          
          <form action="view/login/login.php" method="post">
          
            <div class="field-wrap">
            <label>
              Email Address<span class="req">*</span>
            </label>
            <input name="email" type="email"required autocomplete="off"/>
          </div>
          
          <div class="field-wrap">
            <label>
              Password<span class="req">*</span>
            </label>
            <input name="password" type="password"required autocomplete="off"/>
          </div>

<!--          <p class="forgot"><a href="#">Forgot Password?</a></p>-->
          
          <button name="login" type="submit" class="button button-block"/>Log In</button>
          
          </form>

        </div>
        
      </div><!-- tab-content -->
      
</div> <!-- /form -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="view/tample/main.js"></script>

</body>
</html>

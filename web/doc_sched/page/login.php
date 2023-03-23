<?php
require('page/webservice_login.php');
$loginABS  = new WsloginToken;
/////////////////////////////////////////////////////////////////////////////////////////////////////
$showWrongLogin = false;
if (isset($_POST['g-recaptcha-response'], $_POST['txt_user'], $_POST['txt_pass'])) {
  $captcha = $_POST['g-recaptcha-response'];
  $rescall = $loginABS->Captcha_cal($captcha);
  $userid = filter_input(INPUT_POST, 'txt_user', FILTER_DEFAULT);
  $password = filter_input(INPUT_POST, 'txt_pass', FILTER_DEFAULT);

  if ($rescall->success == true && $rescall->score >= 0.5) {

    $result_login = $loginABS->ChkloginENT($userid, $password);

    if ($result_login->json_result == true) {
      $LastStaff = $loginABS->StaffENT($result_login->access_token, 'staff');
      $LastStaffnm = $loginABS->StaffENT($result_login->access_token, 'staff_name');
      $lctstaff = $loginABS->StaffENT($result_login->access_token, 'staff_div');
      $exptoken = $loginABS->StaffENT($result_login->access_token, 'exp');
      $_SESSION['login_ENTApp'] = true;
      $_SESSION['STAFF'] = $LastStaff;
      $_SESSION['TOKEN_ENT'] = $result_login->access_token;
      $_SESSION['STAFF_NM'] = $LastStaffnm;
      $_SESSION['STAFF_LCT'] = $lctstaff;
      $_SESSION['EXP_TOKEN'] = $exptoken;
      echo '<script>window.location = "?p=tem_upbody";</script>';
    } else {
      $_SESSION['login_ENTApp'] = false;
      $showWrongLogin = true;
    }
  } else {
    //!bot not passed recaptcha 
  }
} else {
  $captcha = false;
  $showWrongLogin = false;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Login | Appointment ENT</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
  <link rel="stylesheet" href="./dist/loginstyle.css">
  <!--calendar call jquery -->
  <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="assets/demo.css">
  <link rel="stylesheet" href="assets/css/font-awesome.css">
  <!--calendar call jquery -->
  <style type="text/css">
    body {
      background-image: url("./assets/bg/rajabg2.jpg");
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
    }
  </style>
</head>

<body>

  <!-- partial:index.partial.html -->
  <div class="cont">
    <div class="demo">
      <div class="login">
        <div class="login">
          <img src="./assets/images/logoh.png" height="30%" width="50%" style="margin-top: 20%;margin-left: 25%;margin-right: 25%;">
        </div>
        <div class="login__form">
          <?php
          if ($showWrongLogin) {
            echo '<div class="row">
                  <h1><strong style="color:red; text-align:center; font-size: 0.7em; ">Username หรือ Password ไม่ถูกต้อง</strong></h1>
                </div>';
          }
          ?>
          <form action="" method="post">
            <div class="login__row">
              <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
                <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
              </svg>
              <input type="text" class="login__input name" name="txt_user" placeholder="Username" />
            </div>

            <div class="login__row">
              <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
                <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />
              </svg>
              <input type="password" class="login__input pass" name="txt_pass" placeholder="Password" />
            </div>

            <!-- ReCaptcha -->
            <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
            <input type="hidden" name="action" value="validate_captcha">
            <!-- ReCaptcha -->
            <button type="submit" id="btn_submit" class="login__submit">Sign in</button>

          </form>
        </div>

      </div>

      <div class="app">

        <div class="app__logout">
          <svg class="app__logout-icon svg-icon" viewBox="0 0 20 20">
            <path d="M6,3 a8,8 0 1,0 8,0 M10,0 10,12" />
          </svg>
        </div>
      </div>
    </div>
  </div>
  <!--template call jquery -->
  <!-- jQuery -->
  <!-- <script src="assets/js/jquery-2.1.0.min.js"></script> -->
  <script src="./dist/jquery.min.js"></script>
  <script src="assets/js/popper.js"></script>
  <!-- <script src="assets/js/bootstrap.bundle.min.js"></script> -->
  <script src="./assets/js/3.4.1/bootstrap.min.js"></script>
  <!-- recaptcha -->
  <script src="https://www.google.com/recaptcha/api.js?render=6LfoS5seAAAAAFQmxpzrC3OfgAAVcLIKvWdh3J6M"></script>
  <script>
    grecaptcha.ready(function() {
      // do request for recaptcha token
      // response is promise with passed token
      grecaptcha.execute('6LfoS5seAAAAAFQmxpzrC3OfgAAVcLIKvWdh3J6M', {
          action: 'validate_captcha'
        })
        .then(function(token) {
          // add token value to form
          document.getElementById('g-recaptcha-response').value = token;
        });
    });
  </script>
  <!-- recaptcha -->
  <!-- Plugins -->
  <script src="assets/js/scrollreveal.min.js"></script>
  <script src="assets/js/waypoints.min.js"></script>
  <script src="assets/js/jquery.counterup.min.js"></script>
  <script src="assets/js/imgfix.min.js"></script>
  <!-- Global Init -->
  <script src="assets/js/custom.js"></script>
  <!--template call jquery -->
  <!-- partial -->
  <script src="./dist/loginscript.min.js"></script>
  <!-- <script src="./dist/loginscript.js"></script> -->

</body>

</html>
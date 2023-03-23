<!DOCTYPE html>
<html lang="en">
  <?php $p='login'; ?>

<head>
  <meta charset="UTF-8">
  <title>Login | Appointment ENT</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
  <link rel="stylesheet" href="./dist/loginstyle.css">

</head>
<style type="text/css">
  body {
    background-image: url("./assets/bg/rajabg2.jpg");
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
  }
</style>

<body>

  <!-- partial:index.partial.html -->
  <div class="cont">
    <div class="demo">
      <div class="login">
        <div class="login">
          <img src="./assets/images/logoh.png" height="30%" width="50%" style="margin-top: 20%;margin-left: 25%;margin-right: 25%;">
        </div>

        <div class="login__form">

                <script langquage='javascript'>
                  //window.location = "?p=tem_upbody";
                  //window.location = "?p=login";
                </script>

                <div class="row">
                  <h1><strong style="color:red;">Username หรือ Password ไม่ถูกต้อง</strong></h1>
                </div>

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
  <!-- partial -->
  <script src="./dist/loginscript.min.js"></script>
  <script src="./dist/loginscript.js"></script>

</body>

</html>
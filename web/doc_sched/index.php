  <?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  session_start();
  //session_destroy();
  date_default_timezone_set("Asia/Bangkok");
  require('template/inc_page.php');

  if ($p == "login") {
    require($pages);
  } else {
    if ($_SESSION['login_ENTApp'] == false) {
      echo '<script>alert("กรุณา login ใหม่");window.location = "?p=login";</script>';
    } else {
      if (strtotime("+ 2 seconds") > $_SESSION['EXP_TOKEN']) {
        echo '<script>alert("Session หมดอายุกรุณา login ใหม่");window.location = "?p=login";</script>';
      }
    }
    require_once 'lib/jwt.class.php';
    $jwtClass = new Jjwt();
    $tmpPayload = $jwtClass->getPayload(array('remote_ip', 'exp'));
    $tmpInEYE = $jwtClass->getPayload(array('staff_eye'));
    $dNow = new DateTime('now');
    $dAllow = new DateTime('2023-03-08 12:00:00');
  ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <link href="https://fonts.googleapis.com/css?family=Raleway:100,300,400,500,700,900" rel="stylesheet">
      <!-- <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'> -->
      <title> Appointment ENT. </title>
      <!--
      SOFTY PINKO
      https://templatemo.com/tm-535-softy-pinko
      -->
      <!-- Additional CSS Files -->
      <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
      <link rel="stylesheet" type="text/css" href="assets/css/templatemo-softy-pinko.css">


      <link rel="stylesheet" type="text/css" href="assets/demo.css">
      <link rel="stylesheet" type="text/css" href="dist/simple-calendar.css">
      <link rel="stylesheet" type="text/css" href="dist/templatemo-style.css">

      <link rel="stylesheet" type="text/css" href="assets/css/custom.css">

      <!--calendar call jquery -->

      <!-- select2 css -->
      <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
      <link rel="stylesheet" type="text/css" href="vendor/ttskch/select2-bootstrap4-theme/dist/select2-bootstrap4.css">
    </head>

    <body>
      <!-- ***** Preloader Start ***** -->
      <div id="preloader">
        <div class="jumper">
          <div></div>
          <div></div>
          <div></div>
        </div>
      </div>
      <!-- ***** Preloader End ***** -->
      <!-- ***** Header Area Start ***** -->
      <header class="header-area header-sticky">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <nav class="main-nav">
                <!-- ***** Logo Start ***** -->
                <a href="index.php?p=tem_upbody" class="logo">
                  <img src="assets/images/logo1.png" alt="rajavithi" width="200" height="50" />
                </a>
                <!-- ***** Logo End ***** -->
                <!-- ***** Menu Start ***** -->
                <ul class="nav">
                  <li><a href="index.php?p=tem_upbody" class="active">Home</a></li>
                  <li><a href="index.php?p=sch_calendar">mySchedule</a></li>
                  <li><a href="index.php?p=consult_list">IPD Consult</a></li>
                  <?php
                  if ($tmpInEYE->staff_eye && ($dNow > $dAllow)) {
                  ?>
                    <li><a href="index.php?p=or_calendar">OR Queue</a></li>
                    <li><a href="index.php?p=surgeon_search">Surgeon Queue</a></li>
                  <?php
                  }
                  ?>
                  <li><a href="?p=exit">Logout</a></li>
                </ul>
                <a class='menu-trigger'>
                  <span>Menu</span>
                </a>
                <!-- ***** Menu End ***** -->
              </nav>
            </div>
          </div>
        </div>
      </header>
      <!-- ***** Header Area End ***** -->
      <?php
      require($pages);
      ?>
      <!-- jQuery -->
      <!-- <script src="./dist/jquery.min.js"></script> -->
      <!-- <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script> -->
      <script src="assets/js/jquery-2.1.0.min.js"></script>
      <!-- Bootstrap -->
      <script src="assets/js/popper.js"></script>
      <script src="assets/js/bootstrap.min.js"></script>

      <!-- Plugins -->
      <script src="assets/js/scrollreveal.min.js"></script>
      <script src="assets/js/waypoints.min.js"></script>
      <script src="assets/js/jquery.counterup.min.js"></script>
      <script src="assets/js/imgfix.min.js"></script>

      <!-- Global Init -->
      <script src="assets/js/custom.js"></script>

      <!--select2 jquery -->
      <script src="vendor/select2-4.1.0/dist/js/select2.js"></script>
      <!--calendar call jquery -->
      <?php
      if ($p == 'sch_calendar') {
      ?>
        <script src="dist/jquery.simple-calendar.js"></script>
      <?php
      }
      if ($p == 'or_calendar') {
      ?>
        <script src="dist/jquery.simple-calendar_or.js"></script>
      <?php
      }
      if ($p == 'surgeon_calendar') {
      ?>
        <script src="dist/jquery.simple-calendar_p.js"></script>
      <?php
      }
      ?>


      <?php
      if ($p == 'consult_list') {
      ?>
        <!--for consult_list page-->
        <script src="js/datepicker.js"></script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
      <?php
      }
      if (isset($inc_script) && $inc_script === true) {
        // $parts = explode('/', $_SERVER["SCRIPT_NAME"]);
        // $file = $parts[count($parts) - 1];
        // $arrFile = explode('.', $file);
        // $jsName = $arrFile[0].'.js';
        $jsName = $p . '.js';
      ?>
        <script src="js/page/<?php echo $jsName; ?>"></script>
      <?php
      }
      ?>
      <div class="j_xs">xs</div>
      <div class="j_sm">sm</div>
      <div class="j_md">md</div>
      <div class="j_lg">lg</div>
    </body>

    </html>
  <?php

  }

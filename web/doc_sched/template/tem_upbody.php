<?php
$gener = date('s');
if ($gener % 2 == 0) {
    $gen = 1;
} else {
    $gen = 2;
}
?>
<!-- ***** Welcome Area Start ***** -->
<div class="welcome-area" id="welcome" style="">
    <!-- ***** Header Text Start ***** -->
    <div class="header-text">
        <div class="container">
            <div class="row">
                <!-- <div class="offset-xl-3 col-xl-6 offset-lg-2 col-lg-8 col-md-12 col-sm-12">
                  <h1>We provide the best <strong>strategy</strong><br>to grow up your <strong>business</strong></h1>
                  <p>Softy Pinko is a professional Bootstrap 4.0 theme designed by Template Mo
                    for your company at absolutely free of charge</p>
                  <a href="#features" class="main-button-slider">Discover More</a>
                </div> -->
            </div>
        </div>
    </div>
    <!-- ***** Header Text End ***** -->
</div>
<!-- ***** Welcome Area End ***** -->

<!-- ***** Features Small Start ***** -->
<section class="section home-feature">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">

                    <!-- ***** Features Small Item Start ***** -->
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s">
                        <a href="?p=sch_calendar">
                            <div class="features-small-item">
                                <div class="icon">
                                    <i><img src="assets/images/calendar.png" alt="" width="80" height="80"></i>
                                </div>
                                <h5 class="features-title">My Schedule</h5>
                                <p>ตารางงานของฉัน <br> [ <?= $_SESSION['STAFF_NM']; ?> ] </p>
                            </div>
                        </a>
                    </div>
                    <!-- ***** Features Small Item End ***** -->
                    <!-- ***** Features Small Item Start ***** -->
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s">
                        <a href="?p=consult_list">
                            <div class="features-small-item">
                                <div class="icon">
                                    <i><img src="assets/images/doctor<?= $gen; ?>.png" alt="" width="80" height="80"></i>
                                </div>
                                <h5 class="features-title">IPD Consult</h5>
                                <p>ตารางส่งปรึกษา <br> [ <?= $_SESSION['STAFF_NM']; ?> ] </p>
                            </div>
                        </a>
                    </div>
                    <!-- ***** Features Small Item End ***** -->
                    <?php
                    
                    if ($tmpInEYE->staff_eye && ($dNow > $dAllow)) {
                    ?>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s">
                            <a href="?p=or_calendar">
                                <div class="features-small-item">
                                    <div class="icon">
                                        <i><img src="assets/images/calendar_red.png" alt="" style="width: 80px; border-radius: 50%;"></i>
                                    </div>
                                    <h5 class="features-title">OR Queue</h5>
                                    <p>ตารางคิวห้องผ่าตัด</p>
                                </div>
                            </a>
                        </div>
                        <!-- <div class="col-lg-4 col-md-6 col-sm-6 col-12" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s">
                            <a href="#">
                                <div class="features-small-item">
                                    <div class="icon">
                                        <i><img src="assets/images/bed-patient.png" alt="" style="width: 80px;"></i>
                                    </div>
                                    <h5 class="features-title">Patient</h5>
                                    <p>ค้นหาผู้ป่วยนัดผ่าตัด</p>
                                </div>
                            </a>
                        </div> -->
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s">
                            <a href="?p=surgeon_search">
                                <div class="features-small-item">
                                    <div class="icon">
                                        <i><img src="assets/images/surgeon.png" alt="" style="width: 80px;"></i>
                                    </div>
                                    <h5 class="features-title">Surgeon Queue</h5>
                                    <p>ค้นหานัดแบบระบุแพทย์</p>
                                </div>
                            </a>
                        </div>
                        <!-- <div class="col-lg-4 col-md-6 col-sm-6 col-12" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s">
                            <a href="#">
                                <div class="features-small-item">
                                    <div class="icon">
                                        <i><img src="assets/images/surgery.png" alt="" style="width: 90px;"></i>
                                    </div>
                                    <h5 class="features-title">Staff's OR Queue</h5>
                                    <p>วันนัดสุดท้ายของ Staff</p>
                                </div>
                            </a>
                        </div> -->
                        <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-12" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s">
                            <div class="features-small-item">
                                <pre style="text-align: left;"><?php var_dump($jwtClass->getPayload(array('staff_eye'))); ?></pre>
                            </div>
                        </div> -->

                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ***** Features Small End ***** -->
<?php
include ("sqlcom/FunctionWebservice.php");

$oci = new Webservice43 ();

$user='jodiazed';
$pwd='te1234st';
$ip=$_SERVER['SERVER_ADDR'];

$toke=$oci->XisamToken($user, $pwd, $ip);

//print_r($toke);

$token=$toke->access_token;

$hn=$_SESSION['hn'];
//$hn='59080202';
//$idcard='1103701083271';
//$hn='55014418';//pn

$personal=$oci->PersonFile($token, $hn, $idcard);
//print_r($personal);

//$personal->json_data['0']->NAME;
//echo '<br><br>';

//echo $drug->json_data['0']->PID.'<<<<<here';
//echo '<br><br>';
//print_r($drug);

/*
$hn='55014418';
$ncd=$oci->NCDscreen($hn, $token);
$chron=$oci->chronicfu($hn, $token);
$diagopd=$oci->diagnosis_opd($hn, $token);
$diagipd=$oci->diagnosis_ipd($hn, $token);
$chronic=$oci->chronic($hn, $token);
$drugopd=$oci->drug_opd($hn, $token);
$drugipd=$oci->drug_ipd($hn, $token);
$procedureopd=$oci->procedure_opd($hn, $token);
$procedureipd=$oci->procedure_ipd($hn, $token);
$procedurerefer=$oci->procedure_refer($hn, $token);
$labfu=$oci->labfu($hn, $token); // field not found
$investigationrefer=$oci->investigation_refer($hn, $token);  // field not found
$appointment=$oci->appointment($hn, $token);
*/

//////////////////////css include//////////////////////
include ("incu/css_detail.php");
//////////////////////css include//////////////////////

$sex=$personal->json_data['0']->SEX;
  if($sex==1){$sex='ชาย';
}else if($sex==2){$sex='หญิง';
}else{$sex='ไม่ระบุ';}
$mstatus=$personal->json_data['0']->MSTATUS;
  if($mstatus==1){$mstatus='โสด';
}else if($mstatus==2){$mstatus='แต่งงานแล้ว';
}else{$mstatus='ไม่ระบุ';}
?>
    <!-- Contact Us Starts Here -->
    <div class="contact-us">
      <div class="container"> 

              <form id="contact" action="" method="post">


        <div class="row">
          <div class="col-md-12">
            <div class="contact-form">


                  <div class="row">
                  <div class="col-md-3 col-sm-3">
                    <span style="text-align:center">เลขบัตรประชาชน</span>
                      <input name="casedate" type="text" placeholder="รหัสบัตรประชาชน" value="<?php echo $personal->json_data['0']->CID;?>">
                  </div>
                
                  <div class="col-md-3 col-sm-3">
                    <span style="text-align:center">ชื่อ</span>
                      <input name="casewhos" type="text" placeholder="ชื่อ" value="<?php echo $personal->json_data['0']->NAME;?>">
                  </div>

                  <div class="col-md-3 col-sm-3">
                    <span style="text-align:center">นามสกุล</span>
                      <input name="caseposi" type="text" placeholder="นามสกุล" value="<?php echo $personal->json_data['0']->LNAME;?>">
                  </div>

                  <div class="col-md-3 col-sm-3">
                    <span style="text-align:center">เพศ</span>
                      <input name="caseposi" type="text" placeholder="เพศ" value="<?php echo $sex;?>">
                  </div>
                  </div>

                  <div class="row">
                  <div class="col-md-3 col-sm-3">
                    <span style="text-align:center">สถานภาพ</span>
                      <!-- <input name="casedate" type="text" placeholder="สถานภาพ" value="<?php echo $mstatus;?>"> -->
                      <input name="casedate" type="text" placeholder="สถานภาพ" value="<?php echo $personal->json_data['0']->MNAME;?>">
                  </div>
                
                  <div class="col-md-3 col-sm-3">
                    <span style="text-align:center">อาชีพ</span>
                      <input name="casewhos" type="text" placeholder="อาชีพ" value="<?php echo $personal->json_data['0']->OCCUPATION_NEW;?>">
                  </div>

                  <div class="col-md-3 col-sm-3">
                    <span style="text-align:center">สัญชาติ</span>
                      <input name="caseposi" type="text" placeholder="สัญชาติ" value="<?php echo $personal->json_data['0']->RACENAME;?>">
                  </div>

                  <div class="col-md-3 col-sm-3">
                    <span style="text-align:center">ศาสนา</span>
                      <input name="caseposi" type="text" placeholder="ศาสนา" value="<?php echo $personal->json_data['0']->RLGNNAME;?>">
                  </div>
                  </div>


                   <div class="row">
                  <div class="col-md-3 col-sm-3">
                    <span style="text-align:center">การศึกษา</span>
                      <input name="casedate" type="text" placeholder="การศึกษา" value="<?php echo $personal->json_data['0']->EDUNAME;?>">
                  </div>
                
                <?php 
                $byear = substr($personal->json_data['0']->BIRTH, 0, 4);
                $bmonth = substr($personal->json_data['0']->BIRTH, 4, -2);
                $bday = substr($personal->json_data['0']->BIRTH, 6, 8);

                function getAge($birthday) {
                $then = strtotime($birthday);
                return(floor((time()-$then)/31556926));
                }
                // การใช้งาน
                $dateB="$byear-$bmonth-$bday"; // ตัวแปรเก็บวันเกิด

                ?>
                  <div class="col-md-3 col-sm-3">
                    <span style="text-align:center">วันเดือนปีเกิด</span>
                      <input name="casewhos" type="text" placeholder="วันเดือนปีเกิด" value="<?php echo $bday.'/'.$bmonth.'/'.$byear;?>">
                  </div>

                  <div class="col-md-3 col-sm-3">
                    <span style="text-align:center">อายุ</span>
                      <input name="caseposi" type="text" placeholder="อายุ" value="<?php echo getAge($dateB).' ปี';?>">
                  </div>

                  <div class="col-md-3 col-sm-3">
                  </div>
                  </div>

                   <div class="row">
                  <div class="col-md-3 col-sm-3">
                    <span style="text-align:center">บ้านเลขที่</span>
                      <input name="casedate" type="text" placeholder="บ้านเลขที่" value="<?php echo $personal->json_data['0']->HOUSENO;?>">
                  </div>
                
                  <div class="col-md-3 col-sm-3">
                    <span style="text-align:center">ถนน</span>
                      <input name="casewhos" type="text" placeholder="ถนน" value="<?php echo $personal->json_data['0']->ROAD;?>">
                  </div>

                  <div class="col-md-3 col-sm-3">
                    <span style="text-align:center">หมู่</span>
                      <input name="caseposi" type="text" placeholder="หมู่" value="<?php echo $personal->json_data['0']->MOO;?>">
                  </div>

                  <div class="col-md-3 col-sm-3">
                    <span style="text-align:center">ตำบล/แขวง</span>
                      <input name="caseposi" type="text" placeholder="ตำบล/แขวง" value="<?php echo $personal->json_data['0']->TBNM;?>">
                  </div>
                  </div>

                   <div class="row">
                  <div class="col-md-3 col-sm-3">
                    <span style="text-align:center">อำเภอ/เขต</span>
                      <input name="casedate" type="text" placeholder="อำเภอ/เขต" value="<?php echo $personal->json_data['0']->AUMPNM;?>">
                  </div>
                
                  <div class="col-md-3 col-sm-3">
                    <span style="text-align:center">จังหวัด</span>
                      <input name="casewhos" type="text" placeholder="จังหวัด" value="<?php echo $personal->json_data['0']->CGWTNM;?>">
                  </div>

                  <div class="col-md-3 col-sm-3">
                    <span style="text-align:center">รหัสไปรษณีย์</span>
                      <input name="caseposi" type="text" placeholder="รหัสไปรษณีย์" value="<?php echo $personal->json_data['0']->POSTAL_CODE;?>">
                  </div>

                  <div class="col-md-3 col-sm-3">
                  </div>
                  </div>


                   <div class="row">
                  <div class="col-md-3 col-sm-3">
                    <span style="text-align:center">สิทธิการรักษา</span>
                      <input name="casedate" type="text" placeholder="สิทธิการรักษา" value="">
                  </div>
                
                  <div class="col-md-3 col-sm-3">
                    <span style="text-align:center">สถานบริการหลัก</span>
                      <input name="casewhos" type="text" placeholder="สถานบริการหลัก" value="<?php echo $row["HPTNAME"];?>">
                  </div>

                  <div class="col-md-3 col-sm-3">
                    <span style="text-align:center">สถานบริการรอง</span>
                      <input name="caseposi" type="text" placeholder="สถานบริการรอง" value="">
                  </div>

                  <div class="col-md-3 col-sm-3">
                  </div>
                  </div>

                  <center>
                  <div class="row" >       
                  <div class="col-md-12 col-sm-12">             
                        <button type="button" class="btn btn-warning">แก้ไข</button>
                        <button type="button" class="btn btn-danger">ย้อนกลับ</button>
                  </div><br><br>
                  </center>

<button type="button" class="button button1" onclick="topic1()" >Health Data</button>
<button type="button" class="button button2" onclick="topic2()">Women health</button>
<button type="button" class="button button3" onclick="topic3()">Functional data</button>
<button type="button" class="button button4" onclick="topic4()">Child health</button>
<button type="button" class="button button5" onclick="topic5()">Dental health</button>

                <div id="topic1" style="display:block;"><!-- topic1 -->
                  <?php include 'page/p1health.php';?>
                <div class="section-heading"></div>
                </div><!-- topic1 -->

                <div id="topic2" style="display:none;"><!-- topic2 -->
                <div class="section-heading"></div>
                </div><!-- topic2 --><br>

                <div id="topic3" style="display:none;"><!-- topic3 -->
                <div class="section-heading"></div>
                </div><!-- topic3 --><br>

                <div id="topic4" style="display:none;"><!-- topic4 -->
                <div class="section-heading"></div>
                </div><!-- topic4 --><br>

                <div id="topic5" style="display:none;"><!-- topic5 -->
                  hi there ! im topic 5
                  <?php include 'page/p5child.php';?>
                <div class="section-heading"></div>
                </div><!-- topic5 --><br>

          <div class="col-md-12">
            <div class="right-content">             
              <div class="section-heading"></div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </form>


    <!-- Contact Us Ends Here -->

  </form>

<!-- <script src="assets/js/jquery.min.js"></script> -->

<script>

/*Dropdown Menu*/
$('.dropdown').click(function () {
        $(this).attr('tabindex', 1).focus();
        $(this).toggleClass('active');
        $(this).find('.dropdown-menu').slideToggle(300);
    });
    $('.dropdown').focusout(function () {
        $(this).removeClass('active');
        $(this).find('.dropdown-menu').slideUp(300);
    });
    $('.dropdown .dropdown-menu li').click(function () {
        $(this).parents('.dropdown').find('span').text($(this).text());
        $(this).parents('.dropdown').find('input').attr('value', $(this).attr('id'));
    });
/*End Dropdown Menu*/

$('.dropdown-menu li').click(function () {
  var input = '<strong>' + $(this).parents('.dropdown').find('input').val() + '</strong>',
      msg = '<span class="msg">Hidden input value: ';
  $('.msg').html(msg + input + '</span>');
}); 

function topic1() {
  var x = document.getElementById("topic1");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}

function topic2() {
  var x = document.getElementById("topic2");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}

function topic3() {
  var x = document.getElementById("topic3");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}

function topic4() {
  var x = document.getElementById("topic4");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}

function topic5() {
  var x = document.getElementById("topic5");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}

$(".answer").hide();
$(".coupon_question").click(function() {
    if($(this).is(":checked")) {
        $(".answer").show();
    } else {
        $(".answer").hide();
    }
});

</script>
<?php
session_start();
include ("sqlcom/FunctionWebservice.php");

$oci = new Webservice43 ();

$user='jodiazed';
$pwd='te1234st';
$ip=$_SERVER['SERVER_ADDR'];

$toke=$oci->XisamToken($user, $pwd, $ip);

//print_r($toke);

$token=$toke->access_token;

//$hn='59080202';
//$idcard='1103701083271';
$hn=$_SESSION['hn'];
$idcard=$_SESSION['cid'];

//////////////////////// for intro data //////////////////////////
$personal=$oci->PersonFile($token, $hn, $idcard);
//print_r($personal);
//////////////////////// for intro data //////////////////////////

$geno=$oci->genogram($idcard, $token);


//$hn='55014418';

//insert genogram

//print_r($_POST['tst']);

if($geno->json_total>0){
  header("Location: https://rjfamily.rajavithi.go.th/mirac1e/index.php?p=genogram");
}

for($i=0;$i<6;$i++){

  if($i==0){ $key=1; $fat=3; $mot=4; $rea=2; }
  if($i==1){ $key=2; $fat=-99; $mot=-99; $rea=1; }
  if($i==2){ $key=3; $fat=-99; $mot=-99; $rea=4; }
  if($i==3){ $key=4; $fat=-99; $mot=-99; $rea=3; }
  if($personal->json_data['0']->SEX==1){
      if($i==4){ $key=5; $fat=1; $mot=2; $rea=-99; }
      if($i==4){ $key=6; $fat=1; $mot=2; $rea=-99; }
  }
  if($personal->json_data['0']->SEX==2){
      if($i==4){ $key=5; $fat=2; $mot=1; $rea=-99; }
      if($i==4){ $key=6; $fat=2; $mot=1; $rea=-99; }
  }

$arrayName = array(
  'ge_key'=>$key,
  'ge_nam'=>$_POST['tname'][$i],
  'ge_pid'=>$_POST['tid'][$i],
  'ge_sex'=>$_POST['tsex'][$i],
  'ge_dea'=>$_POST['tst'][$i],
  'ge_mot'=>$mot,
  'ge_fat'=>$fat,
  'ge_rea'=>$rea,
  'ge_who'=>'',
  'ge_self'=>$idcard
);

/*
echo'<pre>';
print_r($arrayName);
echo'</pre>';
*/

if(isset($_POST['tname'][$i])&&$_POST['tname'][$i]!=''){
  $addgeno=$oci->addgenogram($arrayName,$token);
  header("Location: https://rjfamily.rajavithi.go.th/mirac1e/index.php?p=genogram");
  //print_r($addgeno);
  }
}


//echo $_POST['tname'][0];
//insert genogram

//$geno=$oci->genogram($idcard, $token);
//print_r($geno);
?>
<link rel="stylesheet" href="assets/css/summer.css">
    <!-- Contact Us Starts Here -->
    <div class="contact-us">
      <div class="container"> 

              <form id="contact" action="" method="post">


        <div class="row">
          <div class="col-md-12">
            <div class="contact-form">
<?php 
//echo $_POST['t1st1'].'<<<<<<here';
?>
<br>
<form  method="post" action="#">
<button type="button" class="button button1" onclick="topic1()">Part ตัวเอง</button>
              <div class="section-heading"></div>

                <div id="topic1"><!-- topic1 -->
                  <div class="row">
                  <div class="col-md-3 col-sm-3">
                      <input name="tname[0]" type="text" placeholder="ชื่อ" value="<?php echo $personal->json_data['0']->NAME.' '.$personal->json_data['0']->LNAME;?>" readonly>
                  </div>
                
                  <div class="col-md-3 col-sm-3">
                      <input name="tid[0]" type="text" placeholder="เลขบัตรประชาชน" value="<?php echo $personal->json_data['0']->CID;?>">
                  </div>

                  <div class="col-md-2 col-sm-2">
                      <select name="tsex[0]">
                       <?php if($personal->json_data['0']->SEX==1){$sex='M';$sextx='ชาย'; };?>
                       <?php if($personal->json_data['0']->SEX==2){$sex='F';$sextx='หญิง'; };?>
                        <option value="<?php echo $sex;?>"><?php echo $sextx;?></option>
                      </select>
                  </div>

                  <div class="col-md-2 col-sm-2" align="left">
                      <h5>สถานะมีชีวิต</h5>
                  </div>
                
                  <div class="col-md-2 col-sm-2">
                    <label class="switch">
                      <input type="checkbox" name="tst[0]" value="1" checked>
                      <span class="slider"></span>
                    </label>
                  </div>

                  </div>

                  <div class="row">
                  <div class="col-md-3 col-sm-3">
                      <input name="tname[1]" type="text" placeholder="ชื่อคู่สมรส(ถ้ามี)">
                  </div>
                
                  <div class="col-md-3 col-sm-3">
                      <input name="tid[1]" type="text" placeholder="เลขบัตรประชาชน">
                  </div>

                  <div class="col-md-2 col-sm-2">
                      <select name="tsex[1]" >
                       <?php if($personal->json_data['0']->SEX==2){$sex='M'; $sex2='F';$sextx='ชาย';$sextx2='หญิง'; }?>
                       <?php if($personal->json_data['0']->SEX==1){$sex='F'; $sex2='M';$sextx='หญิง';$sextx2='ชาย'; }?>
                        <option value="<?php echo $sex;?>"><?php echo $sextx;?></option>
                        <option value="<?php echo $sex2;?>"><?php echo $sextx2;?></option>
                      </select>
                  </div>

                  <div class="col-md-2 col-sm-2" align="left">
                      <h5>สถานะมีชีวิต</h5>
                  </div>
                
                  <div class="col-md-2 col-sm-2">
                    <label class="switch">
                      <input type="checkbox" name="tst[1]" value="1" checked>
                      <span class="slider"></span>
                    </label>
                  </div>
                  </div>

                </div><!-- topic1 --><br>

<button type="button" class="button button2" onclick="topic2()">Part พ่อ-แม่</button>
              <div class="section-heading"></div>

                <div id="topic2"><!-- topic2 -->
                  <div class="row">
                  <div class="col-md-3 col-sm-3">
                      <input name="tname[2]" type="text" placeholder="ชื่อพ่อ" value="<?php echo $personal->json_data['0']->DADNAME;?>">
                  </div>

                  <div class="col-md-3 col-sm-3">
                      <input name="tid[2]" type="text" placeholder="เลขบัตรประชาชน">
                  </div>

                  <input name="tsex[2]" type="hidden" value="M">

                  <div class="col-md-2 col-sm-2" align="left">
                      <h5>สถานะมีชีวิต</h5>
                  </div>
                
                  <div class="col-md-3 col-sm-3">
                    <label class="switch">
                      <input type="checkbox" name="tst[2]" value="1" checked>
                      <span class="slider"></span>
                    </label>
                  </div></div>

                  <div class="row">
                  <div class="col-md-3 col-sm-3">
                      <input name="tname[3]" type="text" placeholder="ชื่อแม่" value="<?php echo $personal->json_data['0']->MOMNAME;?>">
                  </div>

                  <div class="col-md-3 col-sm-3">
                      <input name="tid[3]" type="text" placeholder="เลขบัตรประชาชน">
                  </div>

                  <input name="tsex[3]" type="hidden" value="F">

                  <div class="col-md-2 col-sm-2" align="left">
                      <h5>สถานะมีชีวิต</h5>
                  </div>
                
                  <div class="col-md-3 col-sm-3">
                    <label class="switch">
                      <input type="checkbox" name="tst[3]" value="1" checked>
                      <span class="slider"></span>
                    </label>
                  </div>
                  </div>

                </div><!-- topic2 --><br>


<button type="button" class="button button3" onclick="topic3()" >part บุตร(ถ้ามี)</button>
             <div class="section-heading"></div>

                <div id="topic3" style="display:none;"><!-- topic1 -->
                  <div class="row">
                  <div class="col-md-3 col-sm-3">
                      <input name="tname[4]" type="text" placeholder="ชื่อบุตรคนที่ 1">
                  </div>
                
                  <div class="col-md-3 col-sm-3">
                      <input name="tid[4]" type="text" placeholder="เลขบัตรประชาชน">
                  </div>

                  <div class="col-md-2 col-sm-2">
                      <select name="tsex[4]">
                        <option value="">ระบุเพศ</option>
                        <option value="F">หญิง</option>
                        <option value="M">ชาย</option>
                      </select>
                  </div>

                  <div class="col-md-2 col-sm-2" align="left">
                      <h5>สถานะมีชีวิต</h5>
                  </div>
                
                  <div class="col-md-2 col-sm-2">
                    <label class="switch">
                      <input type="checkbox" name="tst[4]" value="1" checked>
                      <span class="slider"></span>
                    </label>
                  </div>

                  </div>

                  <div class="row">
                  <div class="col-md-3 col-sm-3">
                      <input name="tname[5]" type="text" placeholder="ชื่อบุตรคนที่ 2">
                  </div>
                
                  <div class="col-md-3 col-sm-3">
                      <input name="tid[5]" type="text" placeholder="เลขบัตรประชาชน">
                  </div>

                  <div class="col-md-2 col-sm-2">
                      <select name="tsex[5]">
                        <option value="">ระบุเพศ</option>
                        <option value="F">หญิง</option>
                        <option value="M">ชาย</option>
                      </select>
                  </div>

                  <div class="col-md-2 col-sm-2" align="left">
                      <h5>สถานะมีชีวิต</h5>
                  </div>
                
                  <div class="col-md-2 col-sm-2">
                    <label class="switch">
                      <input type="checkbox" name="tst[5]" value="1" checked>
                      <span class="slider"></span>
                    </label>
                  </div>
                  </div>

                </div><!-- topic3 --><br>
                <center>
                  <div class="col-md-1 col-sm-1">
                      <button type="submit" class="btn btn-success">บันทึก</button>
                  </div>
                </center>

        </div>
      </div>
    </div>
  </form>


  </form>

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

 <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script> 
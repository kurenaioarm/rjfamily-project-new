<?php
session_start();
include("sqlcom/FunctionWebservice.php");

$oci = new Webservice43();

$user = 'jodiazed';
$pwd = 'te1234st';
$ip = $_SERVER['SERVER_ADDR'];

$toke = $oci->XisamToken($user, $pwd, $ip);

//print_r($toke);

$token = $toke->access_token;

//$hn='59080202';
//$idcard='1103701083271';
$hn = $_SESSION['hn'];
$idcard = $_SESSION['cid'];

//////////////////////// for intro data //////////////////////////
$personal = $oci->PersonFile($token, $hn, $idcard);
//print_r($personal);
//////////////////////// for intro data //////////////////////////

//$hn='55014418';

//insert genogram
if (isset($_POST['ge_pid']) && isset($_POST['ge_nam']) && $_POST['ge_nam'] != '') {
  $addgeno = $oci->addgenogram($_POST, $token);
  //print_r($addgeno);
}
//insert genogram

$geno = $oci->genogram($idcard, $token);

if ($geno->json_total == 0) {
  header("Location: https://rjfamily.rajavithi.go.th/mirac1e/index.php?p=pre_geno");
}
//print_r($geno);
?>

<style>
  select::-ms-expand {
    display: none;
  }

  select {
    display: inline-block;
    box-sizing: border-box;
    padding: 0.5em 2em 0.5em 0.5em;
    border: 1px solid #eee;
    font: inherit;
    line-height: inherit;
    -webkit-appearance: none;
    -moz-appearance: none;
    -ms-appearance: none;
    appearance: none;
    background-repeat: no-repeat;
    background-image: linear-gradient(45deg, transparent 50%, currentColor 50%), linear-gradient(135deg, currentColor 50%, transparent 50%);
    background-position: right 15px top 1em, right 10px top 1em;
    background-size: 5px 5px, 5px 5px;
  }

  /*password*/
  .password-group {
    position: relative;
    width: 300px;
  }

  .password-group>input {
    width: 100%;
  }

  .password-visibility {
    position: absolute;
    right: 25px;
    top: 10px;
  }

  /*password*/
</style>


<body>
  <!-- This top nav is not part of the sample code -->
  <nav id="navTop" class="w-full z-30 top-0 text-white bg-nwoods-primary">
    <div class="w-full container max-w-screen-lg mx-auto flex flex-wrap sm:flex-nowrap items-center justify-between mt-0 py-2">

    </div>
    <hr class="border-b border-gray-600 opacity-50 my-0 py-0" />
  </nav>
  <!-- * * * * * * * * * * * * * -->
  <!-- Start of GoJS sample code -->

  <?php include("./geno/inc_script.php"); ?>

  <div id="sample">
    <div id="myDiagramDiv" style="background-color: #F8F8F8; margin: auto;  border: solid 1px black; width:70%; height:500px;"></div>
  </div>
  <!-- * * * * * * * * * * * * * -->
  <!--  End of GoJS sample code  -->
  <br><br>
  <div class="col-md-1 col-sm-1">
    <button class="btn btn-info" onclick="shgeno()">ซ่อน/แสดงข้อมูลทั้งหมด</button>
  </div>
  <br>
  <div id="shge" style="display:none;">
    <?php
    foreach ($geno->json_data as $value) { ?>

      <input value="<?php echo $value->GENO_ID; ?>" type="hidden" id="caseid">
      <div class="section-body">
        <div class="col-md-12">
          <div class="contact-form">


            <div class="row">
              <div class="col-md-1 col-sm-1">
                <input name="casedate" type="text" placeholder="รหัส" value="<?php echo $value->GENO_KPER; ?>" readonly="readonly">
              </div>

              <div class="col-md-2 col-sm-2">
                <input name="casewhos" type="text" placeholder="ชื่อ" value="<?php echo $value->GENO_NAME; ?>">
              </div>

              <div class="col-md-2 col-sm-2 password-group">
                <input name="casewhos" type="password" class="form-control password-box" name="password " aria-label="password" value="<?php echo $value->GENO_PERSONAL; ?>">
                <a href="#!" class="password-visibility"><i class="fa fa-eye"></i></a>
              </div>

              <div class="col-md-1 col-sm-1">
                <select name="">
                  <?php if ($value->GENO_SEX == 'M') {
                    $value->GENO_SEX = 'ชาย'; ?>
                    <option><?php echo $value->GENO_SEX; ?></option>
                    <option value="F">หญิง</option>
                  <?php } else {
                    $value->GENO_SEX = 'หญิง'; ?>
                    <option><?php echo $value->GENO_SEX; ?></option>
                    <option value="M">ชาย</option>
                  <?php } ?>

                </select>
              </div>

              <div class="col-md-1 col-sm-1">
                <select name="">
                  <?php if ($value->GENO_MOTH == '-99' || $value->GENO_MOTH == '0') {
                    $value->GENO_MOTH = 'ไม่ระบุ';
                  } else {
                  } ?>
                  <option value="<?php echo $value->GENO_MOTH; ?>"><?php echo $value->GENO_MOTH; ?></option>
                  <option value="-99">ไม่ระบุ</option>
                  <?php foreach ($geno->json_data as $value2) { ?>
                    <option value="<?php echo $value2->GENO_KPER; ?>"><?php echo $value2->GENO_KPER; ?>. <?php echo $value2->GENO_NAME; ?></option>
                  <?php } ?>
                </select>
              </div>

              <div class="col-md-1 col-sm-1">
                <select name="">
                  <?php if ($value->GENO_FATH == '-99' || $value->GENO_FATH == '0') {
                    $value->GENO_FATH = 'ไม่ระบุ';
                  } else {
                  } ?>
                  <option value="<?php echo $value->GENO_FATH; ?>"><?php echo $value->GENO_FATH; ?></option>
                  <option value="-99">ไม่ระบุ</option>
                  <?php foreach ($geno->json_data as $value2) { ?>
                    <option value="<?php echo $value2->GENO_KPER; ?>"><?php echo $value2->GENO_KPER; ?>. <?php echo $value2->GENO_NAME; ?></option>
                  <?php } ?>
                </select>
              </div>

              <div class="col-md-1 col-sm-1">
                <select name="">
                  <?php if ($value->GENO_REAC == '-99' || $value->GENO_REAC == '0') {
                    $value->GENO_REAC = 'ไม่ระบุ';
                  } else {
                  } ?>
                  <option value="<?php echo $value->GENO_REAC; ?>"><?php echo $value->GENO_REAC; ?></option>
                  <option value="-99">ไม่ระบุ</option>
                  <?php foreach ($geno->json_data as $value2) { ?>
                    <option value="<?php echo $value2->GENO_KPER; ?>"><?php echo $value2->GENO_KPER; ?>. <?php echo $value2->GENO_NAME; ?></option>
                  <?php } ?>
                </select>
              </div>

              <div class="col-md-1 col-sm-1">
                <select name="">
                  <?php if ($value->GENO_DEAD == 'S') {
                    $value->GENO_DEAD = 'เสียชีวิต'; ?>
                    <option><?php echo $value->GENO_DEAD; ?></option>
                    <option value=" ">มีชีวิตอยู่</option>
                  <?php } else {
                    $value->GENO_DEAD = 'มีชีวิตอยู่'; ?>
                    <option><?php echo $value->GENO_DEAD; ?></option>
                    <option value="S">เสียชีวิต</option>
                  <?php } ?>

                </select>
              </div>

              <div class="col-md-2 col-sm-2">
                <button type="button" class="btn btn-warning" value="<?php echo $token; ?>" onclick="ckupdate(this.value);">แก้ไข</button>
                <button id="<?php echo $value->GENO_KPER; ?>" type="delete" class="btn btn-danger" onClick="reply_click(this.id)">ลบรายการ</button>
              </div>

            </div>
          </div>
        </div>
      </div>
      <?php if ($value->GENO_PERSONAL == $idcard) {
        $_SESSION['hlkey'] = $value->GENO_KPER;
      } ?>

    <?php } ?>
    <?php $runkper = $value->GENO_KPER + 1; ?>
  </div><!-- from show/hide data -->
  <form method="post" action="#">
    <br>
    <div class="section-body">
      <div class="col-md-12">
        <div class="contact-form">
          <h3>ระบุรายชื่อเพิ่มเติม</h3>
          <div class="row">
            <div class="col-md-1 col-sm-1">
              <input name="ge_key" type="text" placeholder="รหัส" value="<?php echo $runkper; ?>" readonly="readonly">
            </div>

            <div class="col-md-2 col-sm-2">
              <?php if ($runkper == 1) {
                $introname = $fn . ' ' . $ln;
              } ?>
              <input name="ge_nam" type="text" placeholder="ชื่อ" value="<?php echo $introname; ?>">
            </div>

            <div class="col-md-2 col-sm-2">
              <?php if ($runkper == 1) {
                $introidc = $idcard;
              } ?>
              <input name="ge_pid" type="text" placeholder="เลขบัตรประชาชน" value="<?php echo $introidc; ?>">
            </div>

            <input name="ge_self" type="hidden" value="<?php echo $idcard; ?>">

            <div class="col-md-1 col-sm-1">
              <?php if ($runkper == 1) {
                $introsex = $sex;
              } ?>
              <select name="ge_sex" required="required">
                <option value="">เลือกเพศ</option>
                <option value="F">หญิง</option>
                <option value="M">ชาย</option>
              </select>
            </div>

            <div class="col-md-1 col-sm-1">
              <select name="ge_mot" required="required">
                <option value="">ระบุผู้เป็นแม่</option>
                <option value="-99">ไม่ระบุ</option>
                <?php foreach ($geno->json_data as $value) { ?>
                  <option value="<?php echo $value->GENO_KPER; ?>"><?php echo $value->GENO_KPER; ?>. <?php echo $value->GENO_NAME; ?></option>
                <?php } ?>
              </select>
            </div>

            <div class="col-md-1 col-sm-1">
              <select name="ge_fat" required="required">
                <option value="">ระบุผู้เป็นพ่อ</option>
                <option value="-99">ไม่ระบุ</option>
                <?php foreach ($geno->json_data as $value) { ?>
                  <option value="<?php echo $value->GENO_KPER; ?>"><?php echo $value->GENO_KPER; ?>. <?php echo $value->GENO_NAME; ?></option>
                <?php } ?>
              </select>
            </div>

            <div class="col-md-1 col-sm-1">
              <select name="ge_rea" required="required">
                <option value="">ระบุผู้เป็นคู่สมรส</option>
                <option value="-99">ไม่ระบุ</option>
                <?php foreach ($geno->json_data as $value) { ?>
                  <option value="<?php echo $value->GENO_KPER; ?>"><?php echo $value->GENO_KPER; ?>. <?php echo $value->GENO_NAME; ?></option>
                <?php } ?>
              </select>
            </div>

            <div class="col-md-1 col-sm-1">
              <select name="ge_dea">
                <option value="">มีชีวิตอยู่</option>
                <option value="S">เสียชีวิต</option>
              </select>
            </div>

            <div class="col-md-1 col-sm-1">
              <button type="submit" class="btn btn-success">บันทึก</button>
            </div>

          </div>
        </div>
      </div>
    </div>
  </form>


</body>
<br><br><br>
<!--  This script is part of the gojs.net website, and is not needed to run the sample -->

</html>

<script type="text/javascript">
  function reply_click(clicked_id) {
    let text = 'ต้องการลบข้อมูลรายการที่ ' + clicked_id + ' หรือไม่?';
    if (confirm(text) == true) {
        alert ('ทำรายการสำเร็จ');
    };
  }
</script>

<script>
  $(function() {
    $('.password-group').find('.password-box').each(function(index, input) {
      var $input = $(input);
      $input.parent().find('.password-visibility').click(function() {
        var change = "";
        if ($(this).find('i').hasClass('fa-eye')) {
          $(this).find('i').removeClass('fa-eye')
          $(this).find('i').addClass('fa-eye-slash')
          change = "text";
        } else {
          $(this).find('i').removeClass('fa-eye-slash')
          $(this).find('i').addClass('fa-eye')
          change = "password";
        }
        var rep = $("<input type='" + change + "' />")
          .attr('id', $input.attr('id'))
          .attr('name', $input.attr('name'))
          .attr('class', $input.attr('class'))
          .val($input.val())
          .insertBefore($input);
        $input.remove();
        $input = rep;
      }).insertAfter($input);
    });
  });
</script>

<script>
  function ckupdate(val) {
    var action = "update";
    var caseid = $("#caseid").val();
    var dataString = 'caseid=' + caseid + '&token=' + val + '&action=' + action;
    $.ajax({
      type: 'POST',
      data: dataString,
      url: 'page/apicall.php',
      success: function(data) {
        // alert(clinic);
        $('#update').html(data);
        //$("#drug").toggle();
      }
    });

  }
</script>
<<script>
  function shgeno() {
  var x = document.getElementById("shge");
  if (x.style.display === "none") {
  x.style.display = "block";
  } else {
  x.style.display = "none";
  }
  }
  </script>

  <script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  </script>
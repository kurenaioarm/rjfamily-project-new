<?php 
        if($_POST['finder']!=''){
           $_SESSION['person']=$_POST['finder'];
        }else{
            $_SESSION['showperson']=$_POST['finder'];
        }
            $sethn=explode("-",$_POST['finder']);
            $_SESSION['person']=$sethn[1].$sethn[0];
            $_SESSION['person']=trim($_SESSION['person']);

include ("sqlcom/FunctionWebservice.php");

$oci = new Webservice43 ();

$user='jodiazed';
$pwd='te1234st';
$ip=$_SERVER['SERVER_ADDR'];

$toke=$oci->XisamToken($user, $pwd, $ip);

//print_r($toke);

$token=$toke->access_token;
$hn=$_SESSION['person'];//hn person
if(strlen($_POST['finder'])>=9){$idcard=$_SESSION['person'];}//send personalID
//$hn='55014418';//pn

$personal=$oci->PersonFile($token, $hn, $idcard);
//print_r($personal);
$_SESSION['hn']=$personal->json_data['0']->HN;//get personalID person
$_SESSION['cid']=$personal->json_data['0']->CID;//get personalID person
?>
    <!-- Services Starts Here -->
    <div class="services-section">
      <div class="container">
        <div class="row">
<?php foreach ($personal->json_data as $row) { ?>

                <?php 
                $byear = substr($row->BIRTH, 0, 4);
                $bmonth = substr($row->BIRTH, 4, -2);
                $bday = substr($row->BIRTH, 6, 8);

                function getAge($birthday) {
                $then = strtotime($birthday);
                return(floor((time()-$then)/31556926));
                }
                // การใช้งาน
                $dateB="$byear-$bmonth-$bday"; // ตัวแปรเก็บวันเกิด

                ?>


       <h4> "<?=$_POST['finder'];?>" พบ <?php echo count($row->NAME); ?> รายการ</h4>
        <?php 
        if($row->TBNM==''){$row->TBNM='-';} 
        if($row->AUMPNM==''){$row->AUMPNM='-';} 
        if($row->CGWTNM==''){$row->CGWTNM='-';} 
        ?>

          <div class="col-md-12 col-sm-12 col-xs-12">
            <a rel="nofollow" href="?p=sub_detail">
            <div class="service-item">
              <p style="font-size:18px;"><?php echo $row->NAME.'&nbsp;&nbsp;'.$row->LNAME;?> <?php echo 'อายุ : '.getAge($dateB).' ปี ';?> <?php echo 'ตำบล : '.$row->TBNM.'  ';?>
              <?php echo 'อำเภอ : '.$row->AUMPNM.'  ';?><?php echo 'จังหวัด : '.$row->CGWTNM.'  ';?>
              </p>
            </div>
            </a>
          </div>


<!--           
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="service-item">
              <h5>Mr.Witsanu Thongcharook</h5>
              <p><a rel="nofollow" href="?p=sub_detail">let's go!</a></p>
            </div>
          </div>

          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="service-item">
              <h4>Mr.Wissarut Supon</h4>
              <p>You are not allowed to re-distribute this template as a downloadable ZIP file on any template collection website. Please <a rel="nofollow" href="https://templatemo.com/contact" target="_parent">contact us</a> if you want to.</p>
            </div>
          </div>

          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="service-item">
              <h4>Miss.Kamonwan bancha</h4>
              <p>Aenean sit amet leo vitae tellus vehicula tincidunt vel sed lorem. Nullam tincidunt commodo magna, id aliquam sapien sollicitudin id.</p>
            </div>
          </div> 
-->

        </div>
      </div>
    </div>
    <!-- Services Ends Here -->
<?php }?>
<?php if(count($row->NAME)==0){?>
<h2>คำค้นหา "<?=$_POST['finder'];?>" ไม่พบข้อมูล</h2>
<?php }?>

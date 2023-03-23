<?php
session_start();
include ("sqlcom/FunctionWebservice.php");

$oci = new Webservice43 ();

//echo $_SESSION['person'].'<<<<>>>>'.$_SESSION['cid'];
$token=$toke->access_token;
$hn=$_SESSION['hn'];
$idcard=$_SESSION['cid'];
$personal=$oci->PersonFile($token, $hn, $idcard);
//$personal->json_data['0']->NAME;

$entoke=$oci->TokenENT();
$tokenphoto=$entoke->access_token;
$este=$oci->HNPhotos($hn,$tokenphoto);
//print_r($este);

//print_r($personal);
?>

<!-- <img src="data:image/png;base64,<?= $este->json_data; ?>" alt="" height="350" width="350"> -->

    <!-- Features Starts Here -->
    <div class="features-section">
      <div class="container">
        <div class="row">
    <!-- About Us Starts Here -->
    <center>
    <div class="feature-item">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="left-image" align="center">
              <img src="data:image/png;base64,<?= $este->json_data; ?>" alt="" height="350" width="350">
              <!-- <img src="assets/images/cat.jpg" alt="" height="350" width="350"> -->
            </div>
          </div>
          <div class="col-md-6">
            <div class="left-content">
              <div class="section-heading">
<!-- <?php include 'sqlcom/que_person.php';?> -->
<?php foreach ($data_s as $row) {?>
                <?php 
                $byear = substr($row["BIRTH"], 0, 4);
                $bmonth = substr($row["BIRTH"], 4, -2);
                $bday = substr($row["BIRTH"], 6, 8);

                function getAge($birthday) {
                $then = strtotime($birthday);
                return(floor((time()-$then)/31556926));
                }
                // การใช้งาน
                $dateB="$byear-$bmonth-$bday"; // ตัวแปรเก็บวันเกิด

                ?>
                <span>Profile</span>
                <h2> <?php echo $row["NAME"].'&nbsp;&nbsp;'.$row["LNAME"];?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo '<br>อายุ : '.getAge($dateB).' ปี ';?> </h2>
                <h4><?='HN :'.$_SESSION['hn'];?></h4>
              </div>
              <a rel="nofollow" href="?p=detail_personal"><button type="button" class="button button2">ดูรายละเอียด</button></a>
              <a rel="nofollow" href="?p=genogram"><button type="button" class="button button3">GenoGram(beta)</button></a>
              <a rel="nofollow" href="?p=minemap"><button type="button" class="button button4">แผนที่(Test)</button></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </center>
  <br>
    <!-- About Us Ends Here -->
        <div class="row">

          <div class="col-md-6">
            <div class="feature-item">
              <a href="?p=survey_profile">
              <div class="icon">
                <img src="assets/images/feature-01.png" alt="">
              </div>
              <h4>แบบฟอร์มการสำรวจข้อมูลที่พักอาศัย</h4>
              <font color='red'><p>progress 0%</p></font>
              </a>
            </div>
          </div>
       
          <div class="col-md-6">
            <div class="feature-item">
              <a href="?p=survey_sanitary">
              <div class="icon">
                <img src="assets/images/feature-01.png" alt="">
              </div>
              <h4>แบบฟอร์มการสำรวจข้อมูลสุขาภิบาลที่พักอาศัยของครอบครัว<br>(Health Survey)</h4>
              <font color='red'><p>progress 0%</p></font>
              </a>
            </div>
          </div>
<?php }?>
<!--    
          <div class="col-md-6">
            <div class="feature-item">
              <div class="icon">
                <img src="assets/images/feature-01.png" alt="">
              </div>
              <h4>Top Reliability</h4>
              <p>Lorem ipsum dolor ame taxidermy sriracha cardigan salvia actually vice migas en pin sustainable carry scenester.</p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="feature-item">
              <div class="icon">
                <img src="assets/images/feature-01.png" alt="">
              </div>
              <h4>High Security</h4>
              <p>Lorem ipsum dolor ame taxidermy sriracha cardigan salvia actually vice migas en pin sustainable carry scenester.</p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="feature-item">
              <div class="icon">
                <img src="assets/images/feature-01.png" alt="">
              </div>
              <h4>Quality Hardwares</h4>
              <p>Lorem ipsum dolor ame taxidermy sriracha cardigan salvia actually vice migas en pin sustainable carry scenester.</p>
            </div>
          </div>

          <div class="col-md-6">
            <div class="feature-item">
              <div class="icon">
                <img src="assets/images/feature-01.png" alt="">
              </div>
              <h4>Network Solutions</h4>
              <p>Lorem ipsum dolor ame taxidermy sriracha cardigan salvia actually vice migas en pin sustainable carry scenester.</p>
            </div>
          </div> -->

        </div>
      </div>
    </div>
    <!-- Features Ends Here -->
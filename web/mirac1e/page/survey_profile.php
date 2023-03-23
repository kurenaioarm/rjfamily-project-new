    <!-- Contact Us Starts Here -->
    <div class="contact-us">
      <div class="container"> 

              <form id="contact" action="" method="post">


        <div class="row">
          <div class="col-md-12">
            <div class="contact-form">


<button type="button" class="button button1" onclick="topic1()">หน่วยบริการที่สำรวจ</button>
              <div class="section-heading"></div>

                <div id="topic1"><!-- topic1 -->
                  <div class="row">
                  <div class="col-md-4 col-sm-4">
                      <input name="casedate" type="date" placeholder="วันที่สำรวจ">
                  </div>
                
                  <div class="col-md-4 col-sm-4">
                      <input name="casewhos" type="text" placeholder="ชื่อผู้สำรวจ">
                  </div>

                  <div class="col-md-4 col-sm-4">
                      <input name="caseposi" type="text" placeholder="ตำแหน่ง">
                  </div>
                  </div>
                </div><!-- topic1 --><br>

<button type="button" class="button button2" onclick="topic2()">ที่พักอาศัย</button>
              <div class="section-heading"></div>

                <div id="topic2"><!-- topic2 -->
                  <div class="row">
                  <div class="col-md-4 col-sm-4">
                      <input name="casedate" type="text" placeholder="บ้านเลขที่">
                  </div>
                
                  <div class="col-md-4 col-sm-4">
                      <input name="casewhos" type="text" placeholder="ชื่อที่อยู่">
                  </div>

                  <div class="col-md-2 col-sm-2">
                      <input name="caseposi" type="text" placeholder="หมู่">
                  </div>

                  <div class="col-md-2 col-sm-2">
                      <input name="soi" type="text" placeholder="ซอย">
                  </div>
                  </div>

                  <div class="row">
                  <div class="col-md-3 col-sm-3">
                      <input name="casedate" type="text" placeholder="แยก">
                  </div>
                
                  <div class="col-md-3 col-sm-3">
                      <input name="casewhos" type="text" placeholder="ถนน">
                  </div>

                  <div class="col-md-3 col-sm-3">
                      <input name="caseposi" type="text" placeholder="แขวง">
                  </div>

                  <div class="col-md-3 col-sm-3">
                      <input name="soi" type="text" placeholder="เขต">
                  </div>
                  </div>

                  <div class="row">
                  <div class="col-md-6 col-sm-6">
                      <input name="casedate" type="text" placeholder="รหัสไปรษณีย์">
                  </div>
                
                  <div class="col-md-6 col-sm-6">
                      <input name="casewhos" type="text" placeholder="หมายเลขโทรศัพท์">
                  </div>
                  </div>
                </div><!-- topic2 --><br>


<button type="button" class="button button3" onclick="topic3()">รายละเอียดที่พักอาศัย</button>
              <div class="section-heading"></div>

                <div id="topic3"><!-- topic3 -->
                  <div class="row">
                  <div class="col-md-3 col-sm-3" align="left">
                      <h4>ลักษณะบ้าน</h4>
                  </div>
                
                  <div class="col-md-4 col-sm-4">

                  <div class="dropdown">
                    <div class="select">
                      <span>กรุณาเลือก</span>
                      <i class="fa fa-chevron-left"></i>
                    </div>
                    <input type="hidden" name="gender">
                    <ul class="dropdown-menu">
                      <li id="">1.บ้านเดี่ยว</li>
                      <li id="">2.ทาวน์เฮาส์/ทาวน์โฮม</li>
                      <li id="">3.ห้องชุด คอนโดมิเนี่ยม</li>
                      <li id="">4.อพาทเม้นท์/แฟลต/หอพัก</li>
                      <li id="">5.บ้านพักคนงาน</li>
                      <li id="">6.ศาสนสถาน</li>
                      <li id="">7.อาคารพิณิชย์/ตึกแถว</li>
                      <li id="">8.อื่นๆ</li>
                      <li id="">9.ไม่ทราบ</li>
                    </ul>
                  </div></div>

                  <div class="col-md-5 col-sm-5">
                      <input name="caseposi" type="text" placeholder="อื่นๆ ระบุ">
                  </div></div>

 
                  <div class="row">
                  <div class="col-md-3 col-sm-3" align="left">
                      <h4>ประเภทที่อยู่อาศัย</h4>
                  </div>
                
                  <div class="col-md-4 col-sm-4">

                  <div class="dropdown">
                    <div class="select">
                      <span>กรุณาเลือก</span>
                      <i class="fa fa-chevron-left"></i>
                    </div>
                    <input type="hidden" name="gender">
                    <ul class="dropdown-menu">
                      <li id="">1.ของตนเอง</li>
                      <li id="">2.เช่า(ที่ดิน/บ้าน)</li>
                      <li id="">3.ห้องแบ่งเช่า</li>
                      <li id="">4.อาศัยผู้อื่น</li>
                      <li id="">5.หน่วยงานจัดให้</li>
                      <li id="">6.บ้านบุกรุก</li>
                      <li id="">7.ที่ทรัพย์สินส่วนพระมหากษัตริย์</li>
                      <li id="">8.ไม่ทราบ</li>
                    </ul>
                  </div></div>

                  <div class="col-md-5 col-sm-5">
                      <input name="caseposi" type="text" placeholder="อื่นๆ ระบุ">
                  </div></div>

                  <div class="row">
                  <div class="col-md-3 col-sm-3" align="left">
                      <h4>การใช้ประโยชน์</h4>
                  </div>
                
                  <div class="col-md-4 col-sm-4">

                  <div class="dropdown">
                    <div class="select">
                      <span>กรุณาเลือก</span>
                      <i class="fa fa-chevron-left"></i>
                    </div>
                    <input type="hidden" name="gender">
                    <ul class="dropdown-menu">
                      <li id="">1.ที่พักอาศัย</li>
                      <li id="">2.สถานประกอบการ</li>
                      <li id="">3.ที่พักอาศัยและสถานประกอบการ</li>
                    </ul>
                  </div></div>

                </div>
                </div><!-- topic3 -->
                <br>

<button type="button" class="button button5" onclick="topic4()">สถานประกอบการ</button>
                <div class="row">
                  <span><font color="red">( ระบุเพิ่มเติมกรณีเลือกการใช้ประโยชน์เป็นสถานประกอบการหรือที่พักอาศัยและสถานประกอบการ )</font></span>
                </div>
              <div class="section-heading"></div>

                <div id="topic4"><!-- topic4 -->
                <br>

                  <div class="row">
                  <div class="col-md-3 col-sm-3" align="left">
                      <h4>ประเภทสถานประกอบการ</h4>
                  </div>
                
                  <div class="col-md-4 col-sm-4">
                  <div class="dropdown">
                    <div class="select">
                      <span>กรุณาเลือก</span>
                      <i class="fa fa-chevron-left"></i>
                    </div>
                    <input type="hidden" name="gender">
                    <ul class="dropdown-menu">
                      <li id="male">1.แหล่งประโยชน์ทางสุขภาพ</li>
                      <li id="female">2.แหล่งเฝ้าระวังด้าวสุขาภิบาล สังคมและสิ่งแวดล้อม</li>
                    </ul>
                  </div></div>

                  <div class="col-md-5 col-sm-5">
                      <input name="caseposi" type="text" placeholder="ระบุ หมายเหตุ">
                  </div></div>

                  <div class="row">
                  <div class="col-md-12 col-sm-12">
                      <input name="casedate" type="text" placeholder="ชื่อสถานประกอบการ">
                  </div>
                  </div>


                  <div class="row">
                  <div class="col-md-4 col-sm-4">
                      <input name="casedate" type="text" placeholder="จำนวนประชากรในสถานประกอบการ">
                  </div>
                
                  <div class="col-md-4 col-sm-4">
                      <input name="casewhos" type="text" placeholder="ชื่อผู้ติดต่อ">
                  </div>

                  <div class="col-md-4 col-sm-4">
                      <input name="caseposi" type="text" placeholder="เบอร์โทร">
                  </div>
                  </div>

                  <div class="row">
                  <div class="col-md-3 col-sm-3" align="left">
                      <h5>เคยเกิดอุบัติเหตุจากการทำงาน</h5>
                  </div>
                
                  <div class="col-md-4 col-sm-4">
                  <div class="dropdown">
                    <div class="select">
                      <span>กรุณาเลือก</span>
                      <i class="fa fa-chevron-left"></i>
                    </div>
                    <input type="hidden" name="gender">
                    <ul class="dropdown-menu">
                      <li id="male">ไม่เกิด</li>
                      <li id="female">เกิด</li>
                    </ul>
                  </div></div>

                  <div class="col-md-5 col-sm-5">
                      <input name="caseposi" type="text" placeholder="ระบุ หมายเหตุ">
                  </div></div>

                  <div class="row">
                  <div class="col-md-3 col-sm-3" align="left">
                      <h5>โรคจากการทำงาน</h5>
                  </div>
                
                  <div class="col-md-4 col-sm-4">
                  <div class="dropdown">
                    <div class="select">
                      <span>กรุณาเลือก</span>
                      <i class="fa fa-chevron-left"></i>
                    </div>
                    <input type="hidden" name="gender">
                    <ul class="dropdown-menu">
                      <li id="male">ไม่เกิด</li>
                      <li id="female">เกิด</li>
                    </ul>
                  </div></div>

                  <div class="col-md-5 col-sm-5">
                      <input name="caseposi" type="text" placeholder="ระบุ หมายเหตุ">
                  </div></div>

                </div><br>
                </div><!-- topic4 -->


<button type="button" class="button button3" onclick="topic5()">กรณีสำรวจไม่ได้</button>
              <div class="section-heading"></div>

                <div id="topic5"><!-- topic5 -->
                <br>

                  <div class="row">
                  <div class="col-md-4 col-sm-4" align="left">
                      <h4>สำรวจข้อมูลไม่ได้ สาเหตุ :</h4>
                  </div>

                  <div class="col-md-4 col-sm-4">
                  <div class="dropdown">
                    <div class="select">
                      <span>สาเหตุ</span>
                      <i class="fa fa-chevron-left"></i>
                    </div>
                    <input type="hidden" name="gender">
                    <ul class="dropdown-menu">
                      <li id="male">1.ไม่มีผู้อยู่อาศัย</li>
                      <li id="female">2.บ้านปิด</li>
                      <li id="female">3.ไม่ให้ความร่วมมือ</li>
                    </ul>
                  </div></div>
                  </div><br>

                  <div class="row">
                  <div class="col-md-4 col-sm-4" align="left">
                      <h4>ไม่ให้ความร่วมมือเนื่องจาก</h4>
                  </div>

                  <div class="col-md-4 col-sm-4">
                  <div class="dropdown">
                    <div class="select">
                      <span>เนื่องจาก</span>
                      <i class="fa fa-chevron-left"></i>
                    </div>
                    <input type="hidden" name="gender">
                    <ul class="dropdown-menu">
                      <li id="male">ไม่เกิด</li>
                      <li id="female">เกิด</li>
                    </ul>
                  </div></div>

                </div><br>
                </div><!-- topic5 -->

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

<?/*?>
    <!-- Map Starts Here -->
    <div id="map">
    
<!-- How to change your own map point
	1. Go to Google Maps
	2. Click on your location point
	3. Click "Share" and choose "Embed map" tab
	4. Copy only URL and paste it within the src="" field below
-->

      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d11196.961132529668!2d-43.38581128725845!3d-23.011063013218724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9bdb695cd967b7%3A0x171cdd035a6a9d84!2sAv.%20L%C3%BAcio%20Costa%20-%20Barra%20da%20Tijuca%2C%20Rio%20de%20Janeiro%20-%20RJ%2C%20Brazil!5e0!3m2!1sen!2sth!4v1568649412152!5m2!1sen!2sth" width="100%" height="520px" frameborder="0" style="border:0" allowfullscreen>
        
      </iframe>
    </div>
    <!-- Map Ends Here -->

<?*/?>
  </form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

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
</script>
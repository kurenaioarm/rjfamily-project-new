<style type="text/css">
  /*switch bar*/
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
/*switch bar*/
/*checkbox css*/
article {
  position: relative;
  width: 140px;
  height: 100px;
  margin: 5px;
  float: left;
  border: 2px solid #50bcf2;
  box-sizing: border-box;
}

article div {
  width: 100%;
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  line-height: 25px;
}

article input {
  position: absolute;
  top: 0;
  left: 0;
  width: 140px;
  height: 100px;
  opacity: 0;
  cursor: pointer;
}

input[type=checkbox]:checked ~ div {
  background-color: #50bcf2;
}

.upgrade-btn {
  display: block;
  margin: 30px auto;
  width: 200px;
  padding: 10px 20px;
  border: 2px solid #50bcf2;
  border-radius: 50px;
  color: #f5f5f5;
  font-size: 18px;
  font-weight: 600;
  text-decoration: none;
  transition: .3s ease;
}

.upgrade-btn:hover {
  background-color: #50bcf2;
}

.blue-color {
  color: #50bcf2;
}

.gray-color {
  color: #555;
}

.social i:before {
  width: 14px;
  height: 14px;
  position: fixed;
  color: #fff;
  background: #0077B5;
  padding: 10px;
  border-radius: 50%;
  top:5px;
  right:5px;
}

@keyframes slidein {
  from {
    margin-top: 100%;
    width: 300%;
  }

  to {
    margin: 0%;
    width: 100%;
  }
}
/*checkbox css*/
</style>

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

<button type="button" class="button button2" onclick="topic2()">ประเมินที่พักอาศัย</button>
              <div class="section-heading"></div>

                <div id="topic2"><!-- topic2 -->
                  <div class="row">
                  <div class="col-md-3 col-sm-3" align="left">
                      <h5>อากาศถ่ายเท</h5>
                  </div>
                
                  <div class="col-md-3 col-sm-3">
                    <label class="switch">
                      <input type="checkbox">
                      <span class="slider"></span>
                    </label>
                  </div>

                  <div class="col-md-3 col-sm-3" align="left">
                      <h5>แสงสว่างภายในบ้าน</h5>
                  </div>
                
                  <div class="col-md-3 col-sm-3">
                    <label class="switch">
                      <input type="checkbox">
                      <span class="slider"></span>
                    </label>
                  </div></div>

                  <div class="row">
                  <div class="col-md-3 col-sm-3" align="left">
                      <h5>ความสะอาดเป็นระเบียบ</h5>
                  </div>
                
                  <div class="col-md-3 col-sm-3">
                    <label class="switch">
                      <input type="checkbox">
                      <span class="slider"></span>
                    </label>
                  </div>

                  <div class="col-md-3 col-sm-3" align="left">
                      <h5>น้ำดื่ม</h5>
                  </div>
                
                  <div class="col-md-3 col-sm-3">
                    <label class="switch">
                      <input type="checkbox">
                      <span class="slider"></span>
                    </label>
                  </div></div>

                  <div class="row">
                  <div class="col-md-3 col-sm-3" align="left">
                      <h5>น้ำใช้</h5>
                  </div>
                
                  <div class="col-md-3 col-sm-3">
                    <label class="switch">
                      <input type="checkbox">
                      <span class="slider"></span>
                    </label>
                  </div>

                  <div class="col-md-3 col-sm-3" align="left">
                      <h5>ขยะมูลฝอย</h5>
                  </div>
                
                  <div class="col-md-3 col-sm-3">
                    <label class="switch">
                      <input type="checkbox">
                      <span class="slider"></span>
                    </label>
                  </div></div>

                  <div class="row">
                  <div class="col-md-3 col-sm-3" align="left">
                      <h5>การสุขาภิบาลอาหาร</h5>
                  </div>
                
                  <div class="col-md-3 col-sm-3">
                    <label class="switch">
                      <input type="checkbox">
                      <span class="slider"></span>
                    </label>
                  </div>

                  <div class="col-md-3 col-sm-3" align="left">
                      <h5>สุขา</h5>
                  </div>
                
                  <div class="col-md-3 col-sm-3">
                    <label class="switch">
                      <input type="checkbox">
                      <span class="slider"></span>
                    </label>
                  </div></div>

                  <div class="row">
                  <div class="col-md-3 col-sm-3" align="left">
                      <h5>น้ำท่วมขังบริเวณบ้าน</h5>
                  </div>
                
                  <div class="col-md-3 col-sm-3">
                    <label class="switch">
                      <input type="checkbox">
                      <span class="slider"></span>
                    </label>
                  </div>

                  <div class="col-md-6 col-sm-6">
                      <input name="" type="text" placeholder="หากมี โปรดระบุลักษณะ">
                  </div></div>

                  <div class="row">
                  <div class="col-md-6 col-sm-6" align="left">
                      <h5>สภาพแวดล้อมภายในบ้านที่เป็นอันตรายต่อผู้อยู่อาศัย :</h5>
                  </div>
                
                  <div class="col-md-6 col-sm-6">
                    <label class="switch">
                      <input type="checkbox">
                      <span class="slider"></span>
                    </label>
                  </div></div>

                </div><!-- topic2 --><br>


<button type="button" class="button button3" onclick="topic3()">สัตว์นำโรคและสัตว์เลี้ยง</button>
              <div class="section-heading"></div>

                <div id="topic3"><!-- topic3 -->

                  <div class="row">
                  <div class="col-md-6 col-sm-6" align="left">
                      <h5>สัตว์นำโรคและสัตว์ที่เป็นปัญหา</h5>
                  </div>
                
                  <div class="col-md-6 col-sm-6">
                    <label class="switch">
                      <input type="checkbox">
                      <span class="slider"></span>
                    </label>
                  </div></div>

 
                  <div class="row">
                    <section class="app">
                        <article class="feature1">
                          <input type="checkbox" id="feature1"/>
                          <div>
                            <span>หนู<br/></span>
                          </div>
                        </article>

                        <article class="feature2">
                          <input type="checkbox" id="feature2"/>
                          <div>
                            <span>ยุง<br/></span>
                          </div>
                        </article>
                      
                        <article class="feature3">
                          <input type="checkbox" id="feature3"/>
                          <div>
                            <span>แมลงสาบ<br/></span>
                          </div>
                        </article>
                      
                        <article class="feature4">
                          <input type="checkbox" id="feature4"/>
                          <div>
                            <span>แมลงวัน<br/></span>
                          </div>
                        </article>

                        <article class="feature5">
                          <input type="checkbox" id="feature5"/>
                          <div>
                            <span>งู<br/></span>
                          </div>
                        </article>
                      </section>

                  <div class="col-md-12 col-sm-12">
                      <input name="" type="text" placeholder="อื่นๆ โปรดระบุ">
                  </div>
                </div>

                  <div class="row">
                  <div class="col-md-3 col-sm-3" align="left">
                      <h5>สัตว์เลี้ยงในครอบครัว</h5>
                  </div>
                
                  <div class="col-md-9 col-sm-9">
                    <label class="switch">
                      <input type="checkbox" class="coupon_question" name="coupon_question" value="1" >
                      <span class="slider"></span>
                    </label>
                  </div></div>

   <fieldset class="answer">
      <div class="col-md-2 col-sm-2" align="left">
        <label for="coupon_field">สุนัข</label>
      </div>
                  <div class="col-md-2 col-sm-2">
                    <label class="switch">
                      <input type="checkbox" >
                      <span class="slider"></span>
                    </label>
                  </div>
       
   </fieldset>

                </div>
                </div><!-- topic3 -->
                <br>


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

$(".answer").hide();
$(".coupon_question").click(function() {
    if($(this).is(":checked")) {
        $(".answer").show();
    } else {
        $(".answer").hide();
    }
});

</script>
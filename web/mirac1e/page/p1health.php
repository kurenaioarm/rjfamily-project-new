 <style>
  fieldset{
    font-size:18px;
  }
.warning {
    border: 1px ridge #9AE74E;
    background-color: #EBECBD;
    padding: .5rem;
    display: flex;
    flex-direction: column;
}

.warning img {
    width: 100%;
}

.warning p {
    font: small-caps bold 1.2rem sans-serif;
    text-align: center;
}
/*heading tag near button */
h2 {
  margin: 30;
    display: inline-block;
}
</style>


<?php $round+=0; ?>

<?php
//$hn='64024108';
//$hn='55014418';
//$hn='59080202';
$hn=$_SESSION['hn'];


?>
<!-- <input value="59080202" type="hidden" id="hn"> -->
<input value="<?php echo $hn; ?>" type="hidden" id="hn">
    <!-- Contact Us Starts Here -->
    <!-- แพ้ยา -->
      <div class="container">
        <h2>ประวัติการแพ้ยา</h2> 
        <button type="button" class="btn btn-warning" value="<?php echo $token; ?>" onclick="ckdrug(this.value);">ดูรายละเอียด</button>
        <div class="row" id="drug"></div>
      </div>
      
      <!-- ข้อมูลโรคไม่ติดต่อเรื้อรัง -->
      <div class="container">
        <h2>ข้อมูลโรคไม่ติดต่อเรื้อรัง</h2> 
        <button type="button" class="btn btn-warning"  value="<?php echo $token; ?>" onclick="ckncd(this.value);">ดูรายละเอียด</button>
        <div class="row" id="ncd"></div>
      </div>

      <!-- ข้อมูลการตรวจติดตามผู้ป่วยโรคเรื้อรัง -->
      <div class="container">
        <h2>ข้อมูลการตรวจติดตามผู้ป่วยโรคเรื้อรัง</h2> 
        <button type="button" class="btn btn-warning"  value="<?php echo $token; ?>" onclick="ckchr(this.value);">ดูรายละเอียด</button>
        <div class="row" id="chr"></div>
      </div>      

      <!-- Diag_OPD -->
      <div class="container">
        <h2>Diag_OPD</h2> 
        <button type="button" class="btn btn-warning"  value="<?php echo $token; ?>" onclick="ckdopd(this.value);">ดูรายละเอียด</button>
        <div class="row" id="dopd"></div>
      </div>     

      <!-- Diag_IPD -->
      <div class="container">
        <h2>Diag_IPD</h2> 
        <button type="button" class="btn btn-warning"  value="<?php echo $token; ?>" onclick="ckdipd(this.value);">ดูรายละเอียด</button>
        <div class="row" id="dipd"></div>
      </div>  

      <!-- Diag_IPD -->
      <div class="container">
        <h2>CHRONIC</h2> 
        <button type="button" class="btn btn-warning"  value="<?php echo $token; ?>" onclick="ckcron(this.value);">ดูรายละเอียด</button>
        <div class="row" id="cron"></div>
      </div>  
      
       <!-- procedure_opd -->
      <div class="container">
        <h2>procedure_opd</h2> 
        <button type="button" class="btn btn-warning"  value="<?php echo $token; ?>" onclick="ckproo(this.value);">ดูรายละเอียด</button>
        <div class="row" id="proo"></div>
      </div> 

       <!-- procedure_ipd -->
      <div class="container">
        <h2>procedure_ipd</h2> 
        <button type="button" class="btn btn-warning"  value="<?php echo $token; ?>" onclick="ckproi(this.value);">ดูรายละเอียด</button>
        <div class="row" id="proi"></div>
      </div> 
 
        <!-- procedurerefer -->
      <div class="container">
        <h2>procedure_refer</h2> 
        <button type="button" class="btn btn-warning"  value="<?php echo $token; ?>" onclick="ckpror(this.value);">ดูรายละเอียด</button>
        <div class="row" id="pror"></div>
      </div> 

         <!-- labfu -->
      <div class="container">
        <h2>labfu</h2> 
        <button type="button" class="btn btn-warning"  value="<?php echo $token; ?>" onclick="cklabf(this.value);">ดูรายละเอียด</button>
        <div class="row" id="labf"></div>
      </div> 

         <!-- investigationrefer -->
      <div class="container">
        <h2>investigationrefer</h2> 
        <button type="button" class="btn btn-warning"  value="<?php echo $token; ?>" onclick="ckinvr(this.value);">ดูรายละเอียด</button>
        <div class="row" id="invr"></div>
      </div> 

      <!-- appointment -->
      <div class="container">
        <h2>appointment</h2> 
        <button type="button" class="btn btn-warning"  value="<?php echo $token; ?>" onclick="ckappo(this.value);">ดูรายละเอียด</button>
        <div class="row" id="appo"></div>
      </div> 

    <!-- Contact Us Ends Here -->

<script>
    function ckdrug(val) {
      var action = "drug";
       var hn = $("#hn").val();
              var dataString = 'hn=' + hn + '&token=' + val+'&action='+action;
              $.ajax({
                  type: 'POST',
                  data: dataString,
                  url: 'page/apicall.php',
                  success: function(data) {
                      // alert(clinic);
                      $('#drug').html(data);
                      //$("#drug").toggle();
                  }
              });

    }

    function ckncd(val) {
      var action = "ncd";
       var hn = $("#hn").val();
              var dataString = 'hn=' + hn + '&token=' + val+'&action='+action;
              $.ajax({

                  type: 'POST',
                  data: dataString,
                  url: 'page/apicall.php',
                  success: function(data) {
                      // alert(clinic);
                      $('#ncd').html(data);
                      //$("#ncd").toggle();
                  }
              });

    }

    function ckchr(val) {
      var action = "chr";
       var hn = $("#hn").val();
              var dataString = 'hn=' + hn + '&token=' + val+'&action='+action;
              $.ajax({

                  type: 'POST',
                  data: dataString,
                  url: 'page/apicall.php',
                  success: function(data) {
                      // alert(clinic);
                      $('#chr').html(data);
                      //$("#ncd").toggle();
                  }
              });

    }

    function ckdopd(val) {
      var action = "dopd";
       var hn = $("#hn").val();
              var dataString = 'hn=' + hn + '&token=' + val+'&action='+action;
              $.ajax({

                  type: 'POST',
                  data: dataString,
                  url: 'page/apicall.php',
                  success: function(data) {
                      // alert(clinic);
                      $('#dopd').html(data);
                      //$("#ncd").toggle();
                  }
              });

    }

    function ckdipd(val) {
      var action = "dipd";
       var hn = $("#hn").val();
              var dataString = 'hn=' + hn + '&token=' + val+'&action='+action;
              $.ajax({

                  type: 'POST',
                  data: dataString,
                  url: 'page/apicall.php',
                  success: function(data) {
                      // alert(clinic);
                      $('#dipd').html(data);
                      //$("#ncd").toggle();
                  }
              });

    }

    function ckdipd(val) {
      var action = "dipd";
       var hn = $("#hn").val();
              var dataString = 'hn=' + hn + '&token=' + val+'&action='+action;
              $.ajax({

                  type: 'POST',
                  data: dataString,
                  url: 'page/apicall.php',
                  success: function(data) {
                      // alert(clinic);
                      $('#dipd').html(data);
                      //$("#ncd").toggle();
                  }
              });

    }

    function ckcron(val) {
      var action = "cron";
       var hn = $("#hn").val();
              var dataString = 'hn=' + hn + '&token=' + val+'&action='+action;
              $.ajax({

                  type: 'POST',
                  data: dataString,
                  url: 'page/apicall.php',
                  success: function(data) {
                      // alert(clinic);
                      $('#cron').html(data);
                      //$("#ncd").toggle();
                  }
              });

    }

    function ckdugo(val) {
      var action = "dugo";
       var hn = $("#hn").val();
              var dataString = 'hn=' + hn + '&token=' + val+'&action='+action;
              $.ajax({

                  type: 'POST',
                  data: dataString,
                  url: 'page/apicall.php',
                  success: function(data) {
                      // alert(clinic);
                      $('#dugo').html(data);
                      //$("#ncd").toggle();
                  }
              });

    } 

    function ckdugi(val) {
      var action = "dugi";
       var hn = $("#hn").val();
              var dataString = 'hn=' + hn + '&token=' + val+'&action='+action;
              $.ajax({

                  type: 'POST',
                  data: dataString,
                  url: 'page/apicall.php',
                  success: function(data) {
                      // alert(clinic);
                      $('#dugi').html(data);
                      //$("#ncd").toggle();
                  }
              });

    } 

    function ckproo(val) {
      var action = "proo";
       var hn = $("#hn").val();
              var dataString = 'hn=' + hn + '&token=' + val+'&action='+action;
              $.ajax({

                  type: 'POST',
                  data: dataString,
                  url: 'page/apicall.php',
                  success: function(data) {
                      // alert(clinic);
                      $('#proo').html(data);
                      //$("#ncd").toggle();
                  }
              });

    } 

    function ckproi(val) {
      var action = "proi";
       var hn = $("#hn").val();
              var dataString = 'hn=' + hn + '&token=' + val+'&action='+action;
              $.ajax({

                  type: 'POST',
                  data: dataString,
                  url: 'page/apicall.php',
                  success: function(data) {
                      // alert(clinic);
                      $('#proi').html(data);
                      //$("#ncd").toggle();
                  }
              });

    } 

    function ckpror(val) {
      var action = "pror";
       var hn = $("#hn").val();
              var dataString = 'hn=' + hn + '&token=' + val+'&action='+action;
              $.ajax({

                  type: 'POST',
                  data: dataString,
                  url: 'page/apicall.php',
                  success: function(data) {
                      // alert(clinic);
                      $('#pror').html(data);
                      //$("#ncd").toggle();
                  }
              });

    } 


    function cklabf(val) {
      var action = "labf";
       var hn = $("#hn").val();
              var dataString = 'hn=' + hn + '&token=' + val+'&action='+action;
              $.ajax({

                  type: 'POST',
                  data: dataString,
                  url: 'page/apicall.php',
                  success: function(data) {
                      // alert(clinic);
                      $('#labf').html(data);
                      //$("#ncd").toggle();
                  }
              });

    } 


    function ckinvr(val) {
      var action = "invr";
       var hn = $("#hn").val();
              var dataString = 'hn=' + hn + '&token=' + val+'&action='+action;
              $.ajax({

                  type: 'POST',
                  data: dataString,
                  url: 'page/apicall.php',
                  success: function(data) {
                      // alert(clinic);
                      $('#invr').html(data);
                      //$("#ncd").toggle();
                  }
              });

    } 


    function ckappo(val) {
      var action = "appo";
       var hn = $("#hn").val();
              var dataString = 'hn=' + hn + '&token=' + val+'&action='+action;
              $.ajax({

                  type: 'POST',
                  data: dataString,
                  url: 'page/apicall.php',
                  success: function(data) {
                      // alert(clinic);
                      $('#appo').html(data);
                      //$("#ncd").toggle();
                  }
              });

    } 


</script>
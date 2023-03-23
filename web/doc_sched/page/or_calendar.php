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
    <div class="d-flex justify-content-center">
      <h5 class="title"><span class="badge badge-pill badge-dark">คิวห้องผ่าตัด</span></h5>
    </div>
    <div class="d-flex justify-content-center">
      <div id="container" class="calendar-container">
        <div id="loading" style="text-align: center;">
        </div>
      </div>
    </div>
  </div>
</section>
<!-- ***** Features Small End ***** -->

<script type="text/javascript" src="./dist/jquery.min.js"></script>
<script>
  var $calendar;
  $(document).ready(function() {
    $.fn.changeMonth = function(varMonth, varYear) {
      let datatoken = {
        "model": "que",
        "varcode": "EYE",
        "orroom": "46",
        "month": varMonth + 1,
        "year": varYear
      };
      $.ajax({
        url: "call/orroom.php",
        type: 'GET',
        data: datatoken,
        dataType: 'json',
        cache: false,
        beforeSend: function() {
          $(".calendar").hide();
          $('#loading').html("<i class='fa fa-refresh fa-spin fa-3x fa-fw'></i>  Loading...");
        },
        success: function(result) {
          // console.log(result);
          var hisInfo = [];
          $.each(result, function(key, value) {
            var StartDate = value.startDate;
            var arrStartDate = StartDate.split("/");
            var obj = {
              startDate: new Date(arrStartDate[2], arrStartDate[1] - 1, arrStartDate[0]).toISOString(),
              endDate: new Date(arrStartDate[2], arrStartDate[1] - 1, arrStartDate[0]).getTime(),
              summary: "QUE",
              nextTime: value.nextTime,
              // nextURL: value.nextURL,
              nextHN: value.nextHN,
              nextNM: value.nextNM,
              orNM: value.orNM,
              orNO: value.orNO
            };
            hisInfo.push(obj);
          });
          console.log('hisInfo');
          console.log(hisInfo);
          $calendar.setEvents(hisInfo);
          $('#loading').html("");
          $(".calendar").show();
        }
      });
    };

    const jdate = new Date();
    var strYear = jdate.getFullYear();
    var strMonth = jdate.getMonth();
    // alert(strYear);
    var datatoken = {
      "model": "que",
      "varcode": "EYE",
      "orroom": "46",
      "month": (strMonth + 1),
      "year": strYear
    };
    $.ajax({
      url: "call/orroom.php",
      type: 'GET',
      data: datatoken,
      dataType: 'json',
      cache: false,
      beforeSend: function() {
        $('#loading').html("<i class='fa fa-refresh fa-spin fa-3x fa-fw'></i>  Loading...")
      },
      success: function(result) {
        // console.log(result);
        var hisInfo = [];
        $.each(result, function(key, value) {
          var StartDate = value.startDate;
          var arrStartDate = StartDate.split("/");
          var obj = {
            startDate: new Date(arrStartDate[2], arrStartDate[1] - 1, arrStartDate[0]).toISOString(),
            endDate: new Date(arrStartDate[2], arrStartDate[1] - 1, arrStartDate[0]).getTime(),
            summary: "QUE",
            nextTime: value.nextTime,
            // nextURL: value.nextURL,
            nextHN: value.nextHN,
            nextNM: value.nextNM,
            orNM: value.orNM,
            orNO: value.orNO
          };
          hisInfo.push(obj);
        });
        // console.log('hisInfo');
        // console.log(hisInfo);
        let container = $("#container").simpleCalendar({
          fixedStartDay: 0, // begin weeks by sunday
          disableEmptyDetails: true,
          onMonthChange: function(month, year) {
            // console.log(month + '/' + year);
            $(this).changeMonth(month, year);
          },
          events: []
        });

        $calendar = container.data('plugin_simpleCalendar');
        $calendar.setEvents(hisInfo);
        $('#loading').html("");
      }
    });

  });
</script>
<div class="content_j">
  <h5 class="title"><span class="badge badge-pill badge-dark"><?= $_SESSION['STAFF_NM']; ?></span></h5>

  <div id="container" class="calendar-container">
    <div id="loading" style="text-align: center;">
    </div>
  </div>
</div>

<script type="text/javascript" src="./dist/jquery.min.js"></script>
<script type="text/javascript" src="./dist/jquery.simple-calendar.js"></script>
<script>
  var $calendar;
  $(document).ready(function() {

    var datatoken = 'datatoken=<?php echo $_SESSION['TOKEN_ENT']; ?>';
    $.ajax({
      url: "page/json_docAppointment.php",
      type: 'GET',
      data: datatoken,
      dataType: 'json',
      cache: false,
      beforeSend: function() {
        $('#loading').html("<i class='fa fa-refresh fa-spin fa-3x fa-fw'></i>  Loading...")
      },
      success: function(result) {
        var hisInfo = [];
        $.each(result, function(key, value) {
          var StartDate = value.startDate;
          var arrStartDate = StartDate.split(",");
          var endDate = value.endDate;
          var arrEndDate = endDate.split(",");
          var obj = {
            startDate: new Date(arrStartDate[0], arrStartDate[1], arrStartDate[2]).toISOString(),
            endDate: new Date(arrEndDate[0], arrEndDate[1], arrEndDate[2]).getTime(),
            nextTime: value.nextTime,
            nextURL: value.nextURL,
            nextHN: value.nextHN,
            nextNM: value.nextNM,
            lctNM: value.lctNM
          };
          hisInfo.push(obj);
        });
        // console.log('hisInfo');
        // console.log(hisInfo);
        let container = $("#container").simpleCalendar({
          fixedStartDay: 0, // begin weeks by sunday
          disableEmptyDetails: true,
          events: []
        });

        $calendar = container.data('plugin_simpleCalendar');
        $calendar.setEvents(hisInfo);
        $('#loading').html("");
      }
    });

  });
</script>
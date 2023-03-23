<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('lib/orroom_api.class.php');
$orClass = new Orroom();
$objListResult = $orClass->dct();
if ($objListResult->json_result) {
    $arrDoctLst = array();
    foreach ($objListResult->json_data as $key => $queueRow) {
        $arrDoctLst[$queueRow->DCT] = $queueRow->DSPNAME;
    }
}

if (isset($_GET['surgeons'])) {
    $_SESSION['s_surgeon'] = $_GET['surgeons'];
    $currentDocID = $_SESSION['s_surgeon'];
} else {
    if (isset($_SESSION['s_surgeon'])) {
        $currentDocID = $_SESSION['s_surgeon'];
    }else{

    }
}
$_SESSION['s_surgeon_dsp'] = $surgeonDspName = is_null($arrDoctLst[$currentDocID]) ? '' : $arrDoctLst[$currentDocID];

if (isset($_GET['showlast']) && $_GET['showlast'] == 'true') {
    $objLastDate = $orClass->que_last_day('EYE', $currentDocID);

    if ($objLastDate->json_total == 1) {
        $dataLastDate = $objLastDate->json_data;
        $dataLastDate = $dataLastDate[0];
        $startCalendar = $dataLastDate->LASTDATE;
        $show_last_appointment = 'true';
    } else {
        $startCalendar = date("Y-m-d");
        $show_last_appointment = 'false';
    }
} else {
    $startCalendar = date("Y-m-d");
    $show_last_appointment = 'false';
}
?>
<!-- ***** Welcome Area Start ***** -->
<div class="welcome-area" id="welcome">
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
        <div class="d-flex justify-content-center" style="flex-direction: column; align-items: center;">
            <h5 class="title"><span class="badge badge-pill badge-dark">คิวห้องผ่าตัด <?php echo $surgeonDspName; ?></span></h5>
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
    var surgeon = '<?php echo $currentDocID; ?>';
    var jStartYear = '<?php echo $startCalendar; ?>';
    var showLastDay = <?php echo $show_last_appointment; ?>;
    $(document).ready(function() {
        $.fn.changeMonth = function(varMonth, varYear, varSurgeon) {
            console.log(varMonth + '/' + varYear);
            let datatoken = {
                "model": "que_surgeon",
                "varcode": "EYE",
                "orroom": "46",
                "month": varMonth + 1,
                "year": varYear,
                "surgeon": varSurgeon
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
                            nextPage: value.nextPage,
                            nextHN: value.nextHN,
                            nextNM: value.nextNM,
                            orNM: value.orNM,
                            orNO: value.orNO
                        };
                        hisInfo.push(obj);
                    });
                    // console.log('hisInfo');
                    // console.log(hisInfo);
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
            "model": "que_surgeon",
            "varcode": "EYE",
            "orroom": "46",
            "month": (strMonth + 1),
            "year": strYear,
            "surgeon": surgeon
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
                        nextPage: value.nextPage,
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
                        $(this).changeMonth(month, year, surgeon);
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
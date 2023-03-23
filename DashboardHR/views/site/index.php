<?php

/* @var $this yii\web\View */
use common\widgets\Alert;
use dosamigos\chartjs\ChartJs;
use yii\widgets\ActiveForm;
use kartik\daterange\DateRangePicker;
use yii\helpers\Html;



$this->title = 'My Yii Application';

?>
<div class="site-index">
    <!--     on your view layout file HEAD section -->
    <link rel="stylesheet" href="<?=\yii\helpers\Url::to('@web/../DashboardHR/css/all.css'); ?>">
    <!--     on your view layout file HEAD section-->
    <script defer src="<?=\yii\helpers\Url::to('@web/../DashboardHR/js/all.js'); ?>" crossorigin="anonymous"></script>


    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.0/dist/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0-rc"></script>


    <br><br>
</div>

<?php

echo '<script type="text/javascript">';
if (isset($All_Day_DISTINCT,$All_Day_SUM,$API_HR_DISTINCT,$API_HR_SUM)) {
    $SumOne =  $All_Day_SUM[0][0]->CNT_HOME1;
    $SumAll =  $All_Day_DISTINCT[0][0]->CNT_HOME1;
    $En_Day_DISTINCT=json_encode($All_Day_DISTINCT);
    $En_Day_SUM=json_encode($All_Day_SUM);
    $En_API_HR_DISTINCT=json_encode($API_HR_DISTINCT);
    $En_API_HR_SUM=json_encode($API_HR_SUM);
} // ส่งตัวแปร array จาก PHP ให้ Javascript ทำงานด้วย Json_encode

if (isset($En_Day_DISTINCT,$En_Day_SUM,$En_API_HR_DISTINCT,$En_API_HR_SUM)) {
    echo "var En_Day_DISTINCT = '$En_Day_DISTINCT';";
    echo "var En_Day_SUM = '$En_Day_SUM';";
    echo "var En_API_HR_DISTINCT = '$En_API_HR_DISTINCT';";
    echo "var En_API_HR_SUM = '$En_API_HR_SUM';";
} // ส่งค่า $data จาก PHP ไปยังตัวแปร data ของ Javascript
echo '</script>';
?>

<script type="text/javascript" src="@web/../../DashboardHR/js/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.0.0/chartjs-plugin-datalabels.min.js" integrity="sha512-R/QOHLpV1Ggq22vfDAWYOaMd5RopHrJNMxi8/lJu8Oihwi4Ho4BRFeiMiCefn9rasajKjnx9/fTQ/xkWnkDACg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script language=JavaScript>
    <!--
    ///////////////////////////////////โค้ดห้ามคลิกขวา ห้ามคลุมดำ
    function clickIE() {if (document.all) {alert(message);return false;}}
    function clickNS(e) {if
    (document.layers||(document.getElementById&&!document.all)) {
        if (e.which==2||e.which==3) {alert(message);return false;}}}
    if (document.layers)
    {document.captureEvents(Event.MOUSEDOWN);document.onmousedown=clickNS;}
    else{document.onmouseup=clickNS;document.oncontextmenu=clickIE;}
    document.oncontextmenu=new Function("return false")
    // -->
</script>

<script>
    //    ========================= json_decode in javascript ==========================
    let Object_Day_DISTINCT = JSON.parse(En_Day_DISTINCT);
    let Object_Day_SUM = JSON.parse(En_Day_SUM);
    let Object_API_HR_DISTINCT = JSON.parse(En_API_HR_DISTINCT);
    let Object_API_HR_SUM = JSON.parse(En_API_HR_SUM);
    //    console.log(Object_API_HR_SUM);
    //    =========================================================================

    //    ================================ แปลงเดือนไทย ==================================
    let getMonthTh = function(Month) {
        let CutMonth = Month.substring(0, 2);
        let CutYear = Month.substring(2, 6);
        CutYear  = parseInt( CutYear ) + 543;

        if(CutMonth  === "01"){
            CutMonth = "มกราคม"
        }else  if(CutMonth  === "02"){
            CutMonth = "กุมภาพันธ์"
        }else  if(CutMonth  === "03"){
            CutMonth = "มีนาคม"
        }else  if(CutMonth  === "04"){
            CutMonth = "เมษายน"
        }else  if(CutMonth  === "05"){
            CutMonth = "พฤษภาคม"
        }else  if(CutMonth  === "06"){
            CutMonth = "มิถุนายน"
        }else  if(CutMonth  === "07"){
            CutMonth = "กรกฎาคม"
        }else  if(CutMonth  === "08"){
            CutMonth = "สิงหาคม"
        }else  if(CutMonth  === "09"){
            CutMonth = "กันยายน"
        }else  if(CutMonth  === "10"){
            CutMonth = "ตุลาคม"
        }else  if(CutMonth  === "11"){
            CutMonth = "พฤศจิกายน"
        }else  if(CutMonth  === "12"){
            CutMonth = "ธันวาคม"
        }

        let MonthAndYear;
        MonthAndYear = CutMonth + " " + CutYear;

        return MonthAndYear ;
    };
    //    =========================================================================


    //    ================================ แปลงวันไทย ==================================
    let getDayTh = function(week,Day,Month,Year) {

        let weekTH = week;
        if(weekTH  === 0){
            weekTH = "อา."
        }else  if(weekTH  === 1){
            weekTH = "จ."
        }else  if(weekTH  === 2){
            weekTH = "อ."
        }else  if(weekTH  === 3){
            weekTH = "พ."
        }else  if(weekTH  === 4){
            weekTH = "พฤ."
        }else  if(weekTH  === 5){
            weekTH = "ศ."
        }else  if(weekTH  === 6){
            weekTH = "ส."
        }

//        let monthTH = Month;
//        if(monthTH  === 0){
//            monthTH = "ม.ค."
//        }else  if(monthTH  === 1){
//            monthTH = "ก.พ."
//        }else  if(monthTH  === 2){
//            monthTH = "มี.ค."
//        }else  if(monthTH  === 3){
//            monthTH = "เม.ย."
//        }else  if(monthTH  === 4){
//            monthTH = "พ.ค."
//        }else  if(monthTH  === 5){
//            monthTH = "มิ.ย."
//        }else  if(monthTH  === 6){
//            monthTH = "ก.ค."
//        }else  if(monthTH  === 7){
//            monthTH = "ส.ค."
//        }else  if(monthTH  === 8){
//            monthTH = "ก.ย"
//        }else  if(monthTH  === 9){
//            monthTH = "ต.ค."
//        }else  if(monthTH  === 10){
//            monthTH = "พ.ย."
//        }else  if(monthTH  === 11){
//            monthTH = "ธ.ค"
//        }
//        yearTH  = parseInt(Year) + 543;

        DaysInMonthThai = (weekTH + " " + Day);

        return DaysInMonthThai ;
    };
    //    =========================================================================

    let getColor = function(Color) {
        let Color_DISTINCT = '';

        if(Color === 0){
            Color_DISTINCT = 'rgb(124, 181, 236, 0.5)';
        }else if(Color === 1){
            Color_DISTINCT = 'rgb(67, 67, 72, 0.5)';
        }else if(Color === 2){
            Color_DISTINCT = 'rgb(144, 237, 125, 0.5)';
        }else if(Color === 3){
            Color_DISTINCT = 'rgb(247, 163, 92, 0.5)';
        }else if(Color === 4){
            Color_DISTINCT = 'rgb(128, 133, 233, 0.5)';
        }else if(Color === 5){
            Color_DISTINCT =  'rgb(241, 92, 128, 0.5)';
        }else if(Color === 6){
            Color_DISTINCT = 'rgb(228, 211, 84, 0.5)';
        }else if(Color === 7){
            Color_DISTINCT = 'rgb(43, 144, 143, 0.5)';
        }else if(Color === 8){
            Color_DISTINCT = 'rgb(244, 91, 91, 0.5)';
        }else if(Color === 9){
            Color_DISTINCT = 'rgb(145, 232, 225, 0.5)';
        }else if(Color === 10){
            Color_DISTINCT =  'rgb(124, 181, 236, 0.5)';
        }else if(Color === 11){
            Color_DISTINCT = 'rgb(67, 67, 72, 0.5)';
        }

        return Color_DISTINCT ;
    };

    let getColorSUM = function(Color) {
        let Color_DISTINCT = '';

        if(Color === 0){
            Color_DISTINCT = 'rgb(124, 181, 236)';
        }else if(Color === 1){
            Color_DISTINCT = 'rgb(67, 67, 72)';
        }else if(Color === 2){
            Color_DISTINCT = 'rgb(144, 237, 125)';
        }else if(Color === 3){
            Color_DISTINCT = 'rgb(247, 163, 92)';
        }else if(Color === 4){
            Color_DISTINCT = 'rgb(128, 133, 233)';
        }else if(Color === 5){
            Color_DISTINCT =  'rgb(241, 92, 128)';
        }else if(Color === 6){
            Color_DISTINCT = 'rgb(228, 211, 84)';
        }else if(Color === 7){
            Color_DISTINCT = 'rgb(43, 144, 143)';
        }else if(Color === 8){
            Color_DISTINCT = 'rgb(244, 91, 91)';
        }else if(Color === 9){
            Color_DISTINCT = 'rgb(145, 232, 225)';
        }else if(Color === 10){
            Color_DISTINCT =  'rgb(124, 181, 236)';
        }else if(Color === 11){
            Color_DISTINCT = 'rgb(67, 67, 72)';
        }

        return Color_DISTINCT ;
    };

    let getDate = function(dateArray) {
        //==========================================วันเดือนปี=================================================
        let DateCut = dateArray.split("-");
        let lastMonth = new Date(DateCut[2], DateCut[1]-1, DateCut[0]); //YYYY-MM-DD
        let Get_day;
        //คำสั่งจะ .getFullYear(); รับค่าปีปัจจุบัน
        //คำสั่งจะ .getMonth(); รับค่าเดือนปัจจุบัน ( โดยเดือนมกราจะมีค่าเป็น  0 )
        //คำสั่งจะ .getDate(); รับค่าวันปัจจุบัน ( 1-31 )
        //คำสั่งจะ .getHours(); รับค่าชั่วโมงปัจจุบัน(โดย 0 คือเวลาเที่ยงคืน  และ 23 คือเวลาห้าทุ่ม)
        //คำสั่งจะ .getMinutes(); รับค่านาทีปัจจุบัน (0-59)
        //คำสั่งจะ .getSeconds(); รับค่าวินาทีปัจจุบัน (0-59)
        //คำสั่งจะ .getDay(); รับค่าวันของสัปดาห์ปัจจุบัน (โดย 0 คือวันอาทิตย์ และ 6 คือวันเสาร์ )
        Get_day = getDayTh(lastMonth.getDay(), lastMonth.getDate());
        return Get_day ;
        //=================================================================================================
    };
</script>


<script>
    //    ================================ รายงานจำนวนบุคคลเข้าใช้ระบบย้อนหลัง 12 เดือน ==================================
    let DayDistinct1  = [];let DayDistinct2  = [];let DayDistinct3  = [];let DayDistinct4  = [];
    let DayDistinct5  = [];let DayDistinct6  = [];let DayDistinct7  = [];let DayDistinct8  = [];
    let DayDistinct9  = [];let DayDistinct10  = [];let DayDistinct11 = [];let DayDistinct12  = [];

    for (let i = 0; i < Object_Day_DISTINCT.length; i++){
        for (let j = 0; j < Object_Day_DISTINCT[i].length; j++) {
            if(i === 0){
                let Day_Array_Month = Object_Day_DISTINCT[i][j].MONTH;
                let Day_Array_HOME1 = Object_Day_DISTINCT[i][j].CNT_HOME1;
                let DayTH_Array = getDate(Day_Array_Month);
                DayDistinct1.push({
                    MONTH:DayTH_Array,
                    CNT_HOME1:Day_Array_HOME1
                });
            }else if(i === 1){
                let Day_Array_Month = Object_Day_DISTINCT[i][j].MONTH;
                let Day_Array_HOME1 = Object_Day_DISTINCT[i][j].CNT_HOME1;
                let DayTH_Array = getDate(Day_Array_Month);
                DayDistinct2.push({
                    MONTH:DayTH_Array,
                    CNT_HOME1:Day_Array_HOME1
                });
            }else if(i === 2){
                let Day_Array_Month = Object_Day_DISTINCT[i][j].MONTH;
                let Day_Array_HOME1 = Object_Day_DISTINCT[i][j].CNT_HOME1;
                let DayTH_Array = getDate(Day_Array_Month);
                DayDistinct3.push({
                    MONTH:DayTH_Array,
                    CNT_HOME1:Day_Array_HOME1
                });
            }else if(i === 3){
                let Day_Array_Month = Object_Day_DISTINCT[i][j].MONTH;
                let Day_Array_HOME1 = Object_Day_DISTINCT[i][j].CNT_HOME1;
                let DayTH_Array = getDate(Day_Array_Month);
                DayDistinct4.push({
                    MONTH:DayTH_Array,
                    CNT_HOME1:Day_Array_HOME1
                });
            }else if(i === 4){
                let Day_Array_Month = Object_Day_DISTINCT[i][j].MONTH;
                let Day_Array_HOME1 = Object_Day_DISTINCT[i][j].CNT_HOME1;
                let DayTH_Array = getDate(Day_Array_Month);
                DayDistinct5.push({
                    MONTH:DayTH_Array,
                    CNT_HOME1:Day_Array_HOME1
                });
            }else if(i === 5){
                let Day_Array_Month = Object_Day_DISTINCT[i][j].MONTH;
                let Day_Array_HOME1 = Object_Day_DISTINCT[i][j].CNT_HOME1;
                let DayTH_Array = getDate(Day_Array_Month);
                DayDistinct6.push({
                    MONTH:DayTH_Array,
                    CNT_HOME1:Day_Array_HOME1
                });
            }else if(i === 6){
                let Day_Array_Month = Object_Day_DISTINCT[i][j].MONTH;
                let Day_Array_HOME1 = Object_Day_DISTINCT[i][j].CNT_HOME1;
                let DayTH_Array = getDate(Day_Array_Month);
                DayDistinct7.push({
                    MONTH:DayTH_Array,
                    CNT_HOME1:Day_Array_HOME1
                });
            }else if(i === 7){
                let Day_Array_Month = Object_Day_DISTINCT[i][j].MONTH;
                let Day_Array_HOME1 = Object_Day_DISTINCT[i][j].CNT_HOME1;
                let DayTH_Array = getDate(Day_Array_Month);
                DayDistinct8.push({
                    MONTH:DayTH_Array,
                    CNT_HOME1:Day_Array_HOME1
                });
            }else if(i === 8){
                let Day_Array_Month = Object_Day_DISTINCT[i][j].MONTH;
                let Day_Array_HOME1 = Object_Day_DISTINCT[i][j].CNT_HOME1;
                let DayTH_Array = getDate(Day_Array_Month);
                DayDistinct9.push({
                    MONTH:DayTH_Array,
                    CNT_HOME1:Day_Array_HOME1
                });
            }else if(i === 9){
                let Day_Array_Month = Object_Day_DISTINCT[i][j].MONTH;
                let Day_Array_HOME1 = Object_Day_DISTINCT[i][j].CNT_HOME1;
                let DayTH_Array = getDate(Day_Array_Month);
                DayDistinct10.push({
                    MONTH:DayTH_Array,
                    CNT_HOME1:Day_Array_HOME1
                });
            }else if(i === 10){
                let Day_Array_Month = Object_Day_DISTINCT[i][j].MONTH;
                let Day_Array_HOME1 = Object_Day_DISTINCT[i][j].CNT_HOME1;
                let DayTH_Array = getDate(Day_Array_Month);
                DayDistinct11.push({
                    MONTH:DayTH_Array,
                    CNT_HOME1:Day_Array_HOME1
                });
            }else if(i === 11){
                let Day_Array_Month = Object_Day_DISTINCT[i][j].MONTH;
                let Day_Array_HOME1 = Object_Day_DISTINCT[i][j].CNT_HOME1;
                let DayTH_Array = getDate(Day_Array_Month);
                DayDistinct12.push({
                    MONTH:DayTH_Array,
                    CNT_HOME1:Day_Array_HOME1
                });
            }
        }
    }

    let Object_DayTH_DISTINCT = [
        DayDistinct1,DayDistinct2,DayDistinct3,DayDistinct4,
        DayDistinct5,DayDistinct6,DayDistinct7,DayDistinct8,
        DayDistinct9,DayDistinct10,DayDistinct11,DayDistinct12
    ];

    let DataMAndYDistinct  = [];
    for (let i = 0; i < Object_API_HR_DISTINCT.json_total; i++) {
        let dateArray_DISTINCT = getMonthTh(Object_API_HR_DISTINCT.json_data[i].MONTHS);
        let colorArray_DISTINCT = getColor(i);
        let AmountArray_DISTINCT = Object_API_HR_DISTINCT.json_data[i].CNT_HOME1;
        let DayArray_DISTINCT = Object_DayTH_DISTINCT[i];

        DataMAndYDistinct.push({
            MonthToDay:dateArray_DISTINCT,
            Color:colorArray_DISTINCT,
            Amount:AmountArray_DISTINCT,
            DayAllMonth:DayArray_DISTINCT,
        });
    }
    //    console.log(DataMAndYDistinct);
    //    ========================================== ตรวจสอบสี ===============================================
    let ColorDISTINCT   = [];
    for (let i = 0; i < DataMAndYDistinct.length; i++) {
        ColorDISTINCT.push(DataMAndYDistinct[i].Color);
    }
    //    ================================================================================================

    //    ======================== รายงานการใช้ Mobile เข้าใช้ระบบย้อนหลัง 12 เดือน ==============================
    let DaySUM1  = [];let DaySUM2  = [];let DaySUM3  = [];let DaySUM4  = [];
    let DaySUM5  = [];let DaySUM6  = [];let DaySUM7  = [];let DaySUM8  = [];
    let DaySUM9  = [];let DaySUM10  = [];let DaySUM11 = [];let DaySUM12  = [];

    for (let i = 0; i < Object_Day_SUM.length; i++){
        for (let j = 0; j < Object_Day_SUM[i].length; j++) {
            if(i === 0){
                let Day_Array_Month_SUM = Object_Day_SUM[i][j].MONTH;
                let Day_Array_HOME1_SUM = Object_Day_SUM[i][j].CNT_HOME1;
                let DayTH_Array_SUM = getDate(Day_Array_Month_SUM);
                DaySUM1.push({
                    MONTH:DayTH_Array_SUM,
                    CNT_HOME1:Day_Array_HOME1_SUM
                });
            }else if(i === 1){
                let Day_Array_Month_SUM = Object_Day_SUM[i][j].MONTH;
                let Day_Array_HOME1_SUM = Object_Day_SUM[i][j].CNT_HOME1;
                let DayTH_Array_SUM = getDate(Day_Array_Month_SUM);
                DaySUM2.push({
                    MONTH:DayTH_Array_SUM,
                    CNT_HOME1:Day_Array_HOME1_SUM
                });
            }else if(i === 2){
                let Day_Array_Month_SUM = Object_Day_SUM[i][j].MONTH;
                let Day_Array_HOME1_SUM = Object_Day_SUM[i][j].CNT_HOME1;
                let DayTH_Array_SUM = getDate(Day_Array_Month_SUM);
                DaySUM3.push({
                    MONTH:DayTH_Array_SUM,
                    CNT_HOME1:Day_Array_HOME1_SUM
                });
            }else if(i === 3){
                let Day_Array_Month_SUM = Object_Day_SUM[i][j].MONTH;
                let Day_Array_HOME1_SUM = Object_Day_SUM[i][j].CNT_HOME1;
                let DayTH_Array_SUM = getDate(Day_Array_Month_SUM);
                DaySUM4.push({
                    MONTH:DayTH_Array_SUM,
                    CNT_HOME1:Day_Array_HOME1_SUM
                });
            }else if(i === 4){
                let Day_Array_Month_SUM = Object_Day_SUM[i][j].MONTH;
                let Day_Array_HOME1_SUM = Object_Day_SUM[i][j].CNT_HOME1;
                let DayTH_Array_SUM = getDate(Day_Array_Month_SUM);
                DaySUM5.push({
                    MONTH:DayTH_Array_SUM,
                    CNT_HOME1:Day_Array_HOME1_SUM
                });
            }else if(i === 5){
                let Day_Array_Month_SUM = Object_Day_SUM[i][j].MONTH;
                let Day_Array_HOME1_SUM = Object_Day_SUM[i][j].CNT_HOME1;
                let DayTH_Array_SUM = getDate(Day_Array_Month_SUM);
                DaySUM6.push({
                    MONTH:DayTH_Array_SUM,
                    CNT_HOME1:Day_Array_HOME1_SUM
                });
            }else if(i === 6){
                let Day_Array_Month_SUM = Object_Day_SUM[i][j].MONTH;
                let Day_Array_HOME1_SUM = Object_Day_SUM[i][j].CNT_HOME1;
                let DayTH_Array_SUM = getDate(Day_Array_Month_SUM);
                DaySUM7.push({
                    MONTH:DayTH_Array_SUM,
                    CNT_HOME1:Day_Array_HOME1_SUM
                });
            }else if(i === 7){
                let Day_Array_Month_SUM = Object_Day_SUM[i][j].MONTH;
                let Day_Array_HOME1_SUM = Object_Day_SUM[i][j].CNT_HOME1;
                let DayTH_Array_SUM = getDate(Day_Array_Month_SUM);
                DaySUM8.push({
                    MONTH:DayTH_Array_SUM,
                    CNT_HOME1:Day_Array_HOME1_SUM
                });
            }else if(i === 8){
                let Day_Array_Month_SUM = Object_Day_SUM[i][j].MONTH;
                let Day_Array_HOME1_SUM = Object_Day_SUM[i][j].CNT_HOME1;
                let DayTH_Array_SUM = getDate(Day_Array_Month_SUM);
                DaySUM9.push({
                    MONTH:DayTH_Array_SUM,
                    CNT_HOME1:Day_Array_HOME1_SUM
                });
            }else if(i === 9){
                let Day_Array_Month_SUM = Object_Day_SUM[i][j].MONTH;
                let Day_Array_HOME1_SUM = Object_Day_SUM[i][j].CNT_HOME1;
                let DayTH_Array_SUM = getDate(Day_Array_Month_SUM);
                DaySUM10.push({
                    MONTH:DayTH_Array_SUM,
                    CNT_HOME1:Day_Array_HOME1_SUM
                });
            }else if(i === 10){
                let Day_Array_Month_SUM = Object_Day_SUM[i][j].MONTH;
                let Day_Array_HOME1_SUM = Object_Day_SUM[i][j].CNT_HOME1;
                let DayTH_Array_SUM = getDate(Day_Array_Month_SUM);
                DaySUM11.push({
                    MONTH:DayTH_Array_SUM,
                    CNT_HOME1:Day_Array_HOME1_SUM
                });
            }else if(i === 11){
                let Day_Array_Month_SUM = Object_Day_SUM[i][j].MONTH;
                let Day_Array_HOME1_SUM = Object_Day_SUM[i][j].CNT_HOME1;
                let DayTH_Array_SUM = getDate(Day_Array_Month_SUM);
                DaySUM12.push({
                    MONTH:DayTH_Array_SUM,
                    CNT_HOME1:Day_Array_HOME1_SUM
                });
            }
        }
    }

    let Object_DayTH_SUM = [
        DaySUM1,DaySUM2,DaySUM3,DaySUM4,
        DaySUM5,DaySUM6,DaySUM7,DaySUM8,
        DaySUM9,DaySUM10,DaySUM11,DaySUM12
    ];

    let DataMAndYSUM  = [];
    for (let i = 0; i < Object_API_HR_SUM.json_total; i++) {
        let dateArray_SUM = getMonthTh(Object_API_HR_SUM.json_data[i].MONTHS);
        let colorArray_SUM = getColorSUM(i);
        let AmountArray_SUM = Object_API_HR_SUM.json_data[i].CNT_HOME1;
        let DayArray_SUM = Object_DayTH_SUM[i];

        DataMAndYSUM.push({
            MonthToDay:dateArray_SUM,
            Color:colorArray_SUM,
            Amount:AmountArray_SUM,
            DayAllMonth:DayArray_SUM,
        });
    }
//                    console.log(Object_DayTH_SUM[0]);
    //    ========================================== ตรวจสอบสี ===============================================
    let ColorSUM   = [];
    for (let i = 0; i < DataMAndYSUM.length; i++) {
        ColorSUM.push(DataMAndYSUM[i].Color);
    }
    //    ================================================================================================
</script>


<body>
<script type="text/javascript"></script>

<!--<div class="chartCard">-->
<!--    <div class="chartBox">-->
<!--                <div class="chart-container" style="text-align: center; position: relative; height:40vh; width:90vw">-->
<div class="d-flex justify-content-center"><h3>รายงานจำนวนผู้เข้าใช้ระบบ และ จำนวน Mobile ที่เข้าใช้ระบบ</h3></div>
<div id="CheckDayS3">
    <button onclick="updateChart()" type="button" class="btn btn-outline-dark btn-sm text-danger" style="text-align:center;width:100%;"><b><u> คลิกเที่นี่ เพื่อดูการเข้าใช้ระบบย้อนหลัง 12 เดือน </u></b></button>
</div>
<div id="CheckMonth">
    <button type="button" class="btn btn-dark btn-sm text-white" disabled style="text-align:center;width:100%;" ><b><u> คลิกที่แท่งกราฟ เพื่อดูข้อมูลแบบรายวัน </u></b></button>
</div>
<canvas style="height:40vh; width:80vw" id="myChartDistinct"></canvas>
<!--<canvas style="" id="myChartDistinct"></canvas>-->
<div id="CheckDayS1">
    <button onclick="showAllDayS1(this)" type="button" class="btn btn-danger btn-sm" value="1"  style="text-align:center;width:100%;">【♦ คลิกเพื่อ ดูรายงานทั้งเดือน ♦】</button>
</div>
<div id="CheckDayS2">
    <button onclick="showAllDayS2(this)" type="button" class="btn btn-danger btn-sm" value="2"  style="text-align:center;width:100%;">【♦ คลิกเพื่อ ดูรายงานทั้งเดือน ♦】</button>
</div>
<br>

<div class="card" style="width: 350px;">
    <div class="card-header">
        <b style="font-size: 16px; color: black;"><u>สถิติการเข้าใช้</u></b>
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item"><b style="font-size: 14px; color: black;">จำนวน USER ที่เข้าใช้งาน วันนี้  &nbsp;</b> <b style="font-size: 14px; color: green;"><?php if (isset($SumAll)) {
                    echo number_format($SumAll);
                } ?> </b> <b style="font-size: 14px; color: black;">&nbsp;USER</b></li>
        <li class="list-group-item"><b style="font-size: 14px; color: black;">จำนวน เครื่อง ที่เข้าใช้งาน วันนี้   &nbsp;</b> <b style="font-size: 14px; color: green;"><?php if (isset($SumOne)) {
                    echo number_format($SumOne);
                } ?></b> <b style="font-size: 14px; color: black;">&nbsp;ครั้ง</b></li>
        <li class="list-group-item"><b style="font-size: 14px; color: black;">Hit &nbsp;</b> <b style="font-size: 14px; color: green;"><?php if (isset($SUM_HR_Beginning)) {
                    echo number_format($SUM_HR_Beginning);
                } ?></b> <b style="font-size: 14px; color: black;">&nbsp;ครั้ง</b></li>
    </ul>
</div>
<!--                </div>-->
<!--    </div>-->
<!--</div>-->

<script>
    const coordinates = {
        top: 0,
        bottom: 0,
        left: 0,
        right: 0,
    };

    // setup
    const data = {
        datasets: [
            {
                label: 'รายงานจำนวนบุคคลเข้าใช้ระบบย้อนหลัง 12 เดือน',
                data: DataMAndYDistinct,
                backgroundColor: ColorDISTINCT,
                borderColor: ColorDISTINCT,
                borderWidth: 1,
                datalabels: {
                    display: true, //8 Display Option in Chartjs Plugin Datalabels in Chart.JS ----- ChartDataLabels: true false
                },
                tooltip:{ //How to Display Different Text For Each Bar in the Tooltip in Chart JS
                    callbacks:{
                        label: (context) => {
                            return `${context.label} : ${context.parsed.y.toLocaleString()} User`;
                        },
                    },
                },
            },
            {
                label: 'รายงานการใช้ Mobile เข้าใช้ระบบย้อนหลัง 12 เดือน',
                data: DataMAndYSUM,
                backgroundColor: ColorSUM,
                borderColor: ColorSUM,
                borderWidth: 1,
                datalabels: {
                    display: true, //8 Display Option in Chartjs Plugin Datalabels in Chart.JS ----- ChartDataLabels: true false

                },
                tooltip:{ //How to Display Different Text For Each Bar in the Tooltip in Chart JS
                    callbacks:{
                        label: (context) => {
                            return `${context.label} : ${context.parsed.y.toLocaleString()} ครั้ง`;
                        },
                    },
                },
            }
        ]
    };

    // resetButton plugin
    const resetButton = {
        id : 'resetButton',
        beforeDraw(chart , args , options){
            if(myChartDistinct.config.data.datasets[0].label !== 'รายงานจำนวนบุคคลเข้าใช้ระบบย้อนหลัง 12 เดือน'){
                const { ctx , chartArea: { top, bottom, left, right, width, height} } =
                    chart;
                ctx.save();

                const text = '【♦ ดูข้อมูลย้อนหลัง 12 เดือน ♦】';
                const thickBordar = 3;
                const textWidth = ctx.measureText(text).width;

                //draw Background
                ctx.fillStyle = 'rgb(0, 36, 77)';
                ctx.fillRect(right - (textWidth + 1 + 10 + 25 + 11 ), 5 , textWidth + 10 + 25 + 11, 20);

                // draw text
                ctx.fillStyle = '#FFFFFF';
                ctx.font = '16px Arial';
                ctx.fillText(text, right - (textWidth + 1 + 5 + 46), 16);

                //draw border
                ctx.lineWidth = thickBordar + 'px' ;
                ctx.strokeStyle = 'rgb(111, 129, 179)';
                ctx.strokeRect(right - (textWidth + 1 + 10 + 25 + 11 ), 5, textWidth + 10 + 25 + 11, 20);

                coordinates.top = 5;
                coordinates.bottom = 25;
                coordinates.left = right - (textWidth + 1 + 10 + 25 + 11);
                coordinates.right = right;

                ctx.restore();
            }
        }
    };

    // legendMargin plugin block
    const legendMargin = {
        id: 'legendMargin',
        beforeInit(chart , args , pluginOptions) {
            const  fitValue = chart.legend.fit;

            chart.legend.fit = function fit () {
                fitValue.bind(chart.legend)();
                return this.height += 30;
            }
        }
    };

    // moveChart plugin block
    const moveChart = {
        id: 'moveChart',
        afterEvent(chart , args)  {
            const  { ctx, canvas,  chartArea: { left, right, top, bottom, width, height}}
                = chart;

            canvas.addEventListener('mousemove', (event) => {
                const x = args.event.x;
                const y = args.event.y;

                if(x >= left - 15 && x <= left + 15 && y >= height / 2 + top - 15  && y <=  height / 2 + top + 15){
                    canvas.style.cursor = 'pointer';
                } else if (x >= right - 15 && x <= right + 15 && y >= height / 2 + top - 15  && y <=  height / 2 + top + 15) {
                    canvas.style.cursor = 'pointer';
                } else {
                    canvas.style.cursor = 'default';
                }
            })
        },

        afterDraw(chart , args , pluginOptions)  {
            const  { ctx, chartArea: { left, right, top, bottom, width, height}}
                = chart;

            class  CircleChevron{
                draw(ctx, x1, pixel) {
                    const  angle = Math.PI / 180;
                    ctx.beginPath();
                    ctx.lineWidth = 3;
                    ctx.strokeStyle = 'rgba(102, 102, 102, 0.5)';
                    ctx.fillStyle = 'white';
                    ctx.arc(x1, height / 2 + top, 15, angle * 0, angle * 360, false );
                    ctx.stroke();
                    ctx.fill();
                    ctx.closePath();

                    // chevron Arrow Left
                    ctx.beginPath();
                    ctx.lineWidth = 3;
                    ctx.strokeStyle = 'rgba(255, 26, 104, 1)';
                    ctx.moveTo(x1 + pixel, height / 2 + top - 7.5);
                    ctx.lineTo(x1 - pixel, height / 2 + top);
                    ctx.lineTo(x1 + pixel, height / 2 + top + 7.5);
                    ctx.stroke();
                    ctx.closePath();
                }
            }

            let drawCircleLeft = new CircleChevron();
            drawCircleLeft.draw(ctx, left, 5);

            let drawCircleRight = new CircleChevron();
            drawCircleRight.draw(ctx, right, -5);

        }
    };

    // config
    const config = {
        type: 'bar',
        data,
        options: {
            interaction: {
                mode: 'index'
            },
            plugins:{
                legend: {
                  display: true //1. How to add chartjs-plugin-datalabels to Chart.JS ---- label: true false
                },
                datalabels: { //1. How to add chartjs-plugin-datalabels to Chart.JS
                    color: 'rgb(0, 36, 77)', //2 Configuration Namespace in Chartjs Plugin Datalabels in Chart.JS ---- Color
                    anchor: 'end', //3 Anchor Positioning Option in Chartjs Plugin Datalabels in Chart.JS ----- center start end right bottom left top
                    align: 'end', //4 Align Positioning Option in Chartjs Plugin Datalabels in Chart.JS ----- center start end right bottom left top
                    offset: 5, //4 Align Positioning Option in Chartjs Plugin Datalabels in Chart.JS
                    borderWidth: 1, //6 Border Color Option in Chartjs Plugin Datalabels in Chart.JS ----- Border
                    borderRadius:  5, //7 Border Radius Option in Chartjs Plugin Datalabels in Chart.JS ----- Radius
                    font: { //9 Color and Font Option in Chartjs Plugin Datalabels in Chart.JS ----- font
                        weight: 'bold',
                    },
                    padding: 5, //10 Padding Option in Chartjs Plugin Datalabels in Chart.JS
                    rotation: 0, //12 Rotation Options in Chartjs Plugin Datalabels in Chart.JS
                    opacity: 1, //13 Opacity Options in Chartjs Plugin Datalabels in Chart.JS
                    formatter: function(value, context) { //14 Formatter Options in Chartjs Plugin Datalabels in Chart.JS
                        return Math.round(value).toLocaleString()
                    },
//                    textStrokeColor: 'black', //16 textstrokecolor Options in Chartjs Plugin Datalabels in Chart.JS
//                    textStrokeWidth: 0.1, //16 textstrokecolor Options in Chartjs Plugin Datalabels in Chart.JS
                    textShadowBlur: 1, //17 textshadowblur Options in Chartjs Plugin Datalabels in Chart.JS
                    textShadowColor: 'black', //17 textshadowblur Options in Chartjs Plugin Datalabels in Chart.JS
                },
                title: {
                    display: true,
                    text: ' '
                },
                tooltip:{
                    yAlign: 'bottom',
                }
            },
            onHover: (event,  chartElement) => {
                if(myChartDistinct.config.data.datasets[0].label === 'รายงานจำนวนบุคคลเข้าใช้ระบบย้อนหลัง 12 เดือน') {
                    event.native.target.style.cursor = chartElement[0] ? 'pointer' : 'default';
                }else {
                    event.native.target.style.cursor = 'default';
                }
            },
            parsing:{
                xAxisKey:'MonthToDay',
                yAxisKey:'Amount'
            },
            layout: { //11 Layout Options in Chartjs Plugin Datalabels in Chart.JS
              padding: {
                  right: 18
              }
            },
            scales: {
                x: {
                    min: 0,
                    max: 1, // แสดงกราฟกี่แท่ง
                    grid: { //How to Change Line Thickness of Scales in Chart JS
                        borderWidth: 3,
                        lineWidth: 1,
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'จำนวนผู้เข้าใช้ระบบ และ จำนวน Mobile ที่เข้าใช้ระบบ'
                    },
                    grid: { //How to Change Line Thickness of Scales in Chart JS
                        borderWidth: 3,
                        lineWidth: 1,
                    }
                }
            }
        },
        plugins:[ChartDataLabels,legendMargin,moveChart],
    };

    // render init block
    const  ctx = document.getElementById('myChartDistinct');
    const myChartDistinct = new Chart(
        ctx,
        config
    );

    //==========================================คลิกกราฟ=================================================
    width = screen.width; // หาความกว้างหน้าจอ
    function changeChart (MonthToDay){
        let txtDay1 = document.getElementById("CheckDayS1"); //ซ่อนCheckDayS1
        let txtDay2 = document.getElementById("CheckDayS2"); //ซ่อนCheckDayS2
        let txtDay3 = document.getElementById("CheckDayS3"); //ซ่อนCheckDayS2
        let txtMonth = document.getElementById("CheckMonth"); //ซ่อนCheckMonth
        txtDay1.style.display = "block"; //แสดง
        txtDay2.style.display = "none"; //แสดง
        txtDay3.style.display = "block"; //แสดง
        txtMonth.style.display = "none"; //ซ่อน

        if(width < 500){
            myChartDistinct.options.scales.x.min = 0;
            myChartDistinct.options.scales.x.max = 2; //กำหนดแท่งกราฟกี่แท่ง รายวัน
        }else {
            myChartDistinct.options.scales.x.min = 0;
            myChartDistinct.options.scales.x.max = 6; //กำหนดแท่งกราฟกี่แท่ง รายวัน
        }

        myChartDistinct.config.options.parsing.xAxisKey = "DayAllMonth.MONTH";
        myChartDistinct.config.options.parsing.yAxisKey = "DayAllMonth.CNT_HOME1";

        const vColor = [];
        const vUsers = [];
        const vLabels = DataMAndYDistinct[MonthToDay].DayAllMonth.map(labels => {
            vColor.push(DataMAndYDistinct[MonthToDay].Color);
            vUsers.push(labels.CNT_HOME1);
            return labels.MONTH;
        });
        myChartDistinct.config.data.datasets[0].data = vUsers;
        myChartDistinct.config.data.labels = vLabels;
        myChartDistinct.config.data.datasets[0].backgroundColor = vColor;
        myChartDistinct.config.data.datasets[0].borderColor = vColor;
        myChartDistinct.config.options.plugins.datalabels.backgroundColor = vColor; //5 Background Color Option in Chartjs Plugin Datalabels in Chart.JS ---- Color
        myChartDistinct.config.options.plugins.datalabels.borderColor = vColor; //6 Border Color Option in Chartjs Plugin Datalabels in Chart.JS ---- Color
        myChartDistinct.config.data.datasets[0].label = DataMAndYDistinct[MonthToDay].MonthToDay;

        const vColorSUM = [];
        const vUsersSUM = [];
        const vLabelsSUM = DataMAndYSUM[MonthToDay].DayAllMonth.map(labels => {
            vColorSUM.push(DataMAndYSUM[MonthToDay].Color);
            vUsersSUM.push(labels.CNT_HOME1);
            return labels.MONTH;
        });
        myChartDistinct.config.data.datasets[1].data = vUsersSUM;
        myChartDistinct.config.data.labels = vLabelsSUM;
        myChartDistinct.config.data.datasets[1].backgroundColor = vColorSUM;
        myChartDistinct.config.data.datasets[1].borderColor = vColorSUM;
        myChartDistinct.config.data.datasets[1].label = DataMAndYSUM[MonthToDay].MonthToDay;

        myChartDistinct.update();
    //        console.log(myChartDistinct);
    }

    function clickHandler(click) {
        if(myChartDistinct.config.data.datasets[0].label === 'รายงานจำนวนบุคคลเข้าใช้ระบบย้อนหลัง 12 เดือน'){
            const bar = myChartDistinct.getElementsAtEventForMode(click, 'nearest',{
                intersect: true},true);
            if(bar.length){
                changeChart(bar[0].index);
                console.log(bar[0].index);
            }
        }
    }

    function updateChart(){
        let txtDay1 = document.getElementById("CheckDayS1"); //ซ่อนCheckDayS1
        let txtDay2 = document.getElementById("CheckDayS2"); //ซ่อนCheckDayS2
        let txtDay3 = document.getElementById("CheckDayS3"); //ซ่อนCheckDayS2
        let txtMonth = document.getElementById("CheckMonth"); //ซ่อนCheckMonth
        txtDay1.style.display = "none"; //ซ่อน
        txtDay2.style.display = "none"; //ซ่อน
        txtDay3.style.display = "none"; //ซ่อน
        txtMonth.style.display = "block"; //แสดง

        if(width < 500){
            myChartDistinct.options.scales.x.min = 0;
            myChartDistinct.options.scales.x.max = 2; //กำหนดแท่งกราฟกี่แท่ง รายวัน -> ย้อนหลัง 12 เดือน
        }else {
            myChartDistinct.options.scales.x.min = 0;
            myChartDistinct.options.scales.x.max = 11; //กำหนดแท่งกราฟกี่แท่ง รายวัน -> ย้อนหลัง 12 เดือน
        }

        myChartDistinct.config.options.parsing.xAxisKey = "MonthToDay";
        myChartDistinct.config.options.parsing.yAxisKey = "Amount";

        const bColor = [];
        const bUsers = [];
        const bLabels = DataMAndYDistinct.map(MonthToDay => {
            bColor.push(MonthToDay.Color);
            bUsers.push(MonthToDay.Amount);
            return MonthToDay.MonthToDay;
        });
        myChartDistinct.config.data.datasets[0].data = bUsers ;
        myChartDistinct.config.data.labels = bLabels;
        myChartDistinct.config.data.datasets[0].backgroundColor = bColor;
        myChartDistinct.config.data.datasets[0].borderColor = bColor;
        myChartDistinct.config.options.plugins.datalabels.backgroundColor = bColor; //5 Background Color Option in Chartjs Plugin Datalabels in Chart.JS ---- Color
        myChartDistinct.config.options.plugins.datalabels.borderColor = bColor; //6 Border Color Option in Chartjs Plugin Datalabels in Chart.JS ---- Color
        myChartDistinct.config.data.datasets[0].label = 'รายงานจำนวนบุคคลเข้าใช้ระบบย้อนหลัง 12 เดือน';

        const bColorSUM = [];
        const bUsersSUM = [];
        const bLabelsSUM = DataMAndYSUM.map(MonthToDay => {
            bColorSUM.push(MonthToDay.Color);
            bUsersSUM.push(MonthToDay.Amount);
            return MonthToDay.MonthToDay;
        });

        myChartDistinct.config.data.datasets[1].data = bUsersSUM;
        myChartDistinct.config.data.labels = bLabelsSUM;
        myChartDistinct.config.data.datasets[1].backgroundColor = bColorSUM;
        myChartDistinct.config.data.datasets[1].borderColor = bColorSUM;
        myChartDistinct.config.data.datasets[1].label = 'รายงานการใช้ Mobile เข้าใช้ระบบย้อนหลัง 12 เดือน';

        myChartDistinct.update();
    //        console.log(myChartDistinct);
    }

    function mousemoveHandler(canvas, mousemove) {
        const  x = mousemove.offsetX;
        const  y = mousemove.offsetY;

        if(myChartDistinct.config.data.datasets[0].label !== 'รายงานจำนวนบุคคลเข้าใช้ระบบย้อนหลัง 12 เดือน'){
            if(x > coordinates.left && x < coordinates.right && y > coordinates.top && y < coordinates.bottom){
                canvas.style.cursor = 'pointer' ;
            }else {
                canvas.style.cursor = 'default' ;
            }
        }
    }

    function clickButtonHandler(canvas, click){
        const  x = click.offsetX;
        const  y = click.offsetY;

        if(x > coordinates.left && x < coordinates.right && y > coordinates.top && y < coordinates.bottom){
            updateChart();
        }
    }

    function moveScroll(){
        const  { ctx, canvas, chartArea: { left, right, top, bottom, width, height} }
            = myChartDistinct;
        canvas.addEventListener('click', (event) => {
            const  rect = canvas.getBoundingClientRect();
            const x = event.clientX - rect.left;
            const y = event.clientY - rect.top;

            if(x >= left - 15 && x <= left + 15 && y >= height / 2 + top - 15  && y <=  height / 2 + top + 15){
                if(width < 500){
                    myChartDistinct.options.scales.x.min =  myChartDistinct.options.scales.x.min - 3 ; //กำหนดแท่งกราฟกี่แท่ง เลื่อนย้อนกลับ
                    myChartDistinct.options.scales.x.max =  myChartDistinct.options.scales.x.max - 3 ; //กำหนดแท่งกราฟกี่แท่ง เลื่อนย้อนกลับ
                }else {
                    myChartDistinct.options.scales.x.min =  myChartDistinct.options.scales.x.min - 7 ; //กำหนดแท่งกราฟกี่แท่ง เลื่อนย้อนกลับ
                    myChartDistinct.options.scales.x.max =  myChartDistinct.options.scales.x.max - 7 ; //กำหนดแท่งกราฟกี่แท่ง เลื่อนย้อนกลับ
                }
                if(myChartDistinct.options.scales.x.min <= 0){
                    if(width < 500){
                        myChartDistinct.options.scales.x.min = 0;
                        myChartDistinct.options.scales.x.max = 2; //กำหนดแท่งกราฟกี่แท่ง กรณีเลื่อนย้อนกลับสุดทาง
                    }else {
                        myChartDistinct.options.scales.x.min = 0;
                        myChartDistinct.options.scales.x.max = 6; //กำหนดแท่งกราฟกี่แท่ง กรณีเลื่อนย้อนกลับสุดทาง
                    }
                }
                myChartDistinct.update();
            }

            if(x >= right - 15 && x <= right + 15 && y >= height / 2 + top - 15  && y <=  height / 2 + top + 15){
                if(width < 500){
                    myChartDistinct.options.scales.x.min =  myChartDistinct.options.scales.x.min + 3 ; //กำหนดแท่งกราฟกี่แท่ง เลื่อนไปด้านหน้า
                    myChartDistinct.options.scales.x.max =  myChartDistinct.options.scales.x.max + 3 ; //กำหนดแท่งกราฟกี่แท่ง เลื่อนไปด้านหน้า
                }else {
                    myChartDistinct.options.scales.x.min =  myChartDistinct.options.scales.x.min + 7 ; //กำหนดแท่งกราฟกี่แท่ง เลื่อนไปด้านหน้า
                    myChartDistinct.options.scales.x.max =  myChartDistinct.options.scales.x.max + 7 ; //กำหนดแท่งกราฟกี่แท่ง เลื่อนไปด้านหน้า
                }
                if(myChartDistinct.options.scales.x.max >= data.datasets[0].data.length){
                    if(width < 500){
                        myChartDistinct.options.scales.x.min = data.datasets[0].data.length -3; //กำหนดแท่งกราฟกี่แท่ง กรณีเลื่อนไปด้านหน้าสุดทาง
                        myChartDistinct.options.scales.x.max = data.datasets[0].data.length;
                    }else {
                        myChartDistinct.options.scales.x.min = data.datasets[0].data.length -7; //กำหนดแท่งกราฟกี่แท่ง กรณีเลื่อนไปด้านหน้าสุดทาง
                        myChartDistinct.options.scales.x.max = data.datasets[0].data.length;
                    }
                }
                myChartDistinct.update();
            }
        })
    }
    
    function showAllDayS1(check) {
        console.log(check.value);
        if(check.value === '1'){
            if(width < 500){
                myChartDistinct.options.scales.x.min = 0; //กำหนดแท่งกราฟ รายวัน -> ทั้งเดือน
                myChartDistinct.options.scales.x.max = 30; //กำหนดแท่งกราฟ รายวัน -> ทั้งเดือน
                myChartDistinct.update();
            }else {
                myChartDistinct.options.scales.x.min = 0; //กำหนดแท่งกราฟ รายวัน -> ทั้งเดือน
                myChartDistinct.options.scales.x.max = 30; //กำหนดแท่งกราฟ รายวัน -> ทั้งเดือน
                myChartDistinct.update();
            }
            let txtDay1 = document.getElementById("CheckDayS1");
            let txtDay2 = document.getElementById("CheckDayS2");
            txtDay1.style.display = "none";
            txtDay2.style.display = "block";
        }
    }

    function showAllDayS2(check) {
        if(check.value ===  '2'){
            if(width < 500){
                myChartDistinct.options.scales.x.min = 0; //กำหนดแท่งกราฟกี่แท่ง ทั้งเดือน -> รายวัน
                myChartDistinct.options.scales.x.max = 2; //กำหนดแท่งกราฟกี่แท่ง ทั้งเดือน -> รายวัน
                myChartDistinct.update();
            }else {
                myChartDistinct.options.scales.x.min = 0; //กำหนดแท่งกราฟกี่แท่ง ทั้งเดือน -> รายวัน
                myChartDistinct.options.scales.x.max = 7; //กำหนดแท่งกราฟกี่แท่ง ทั้งเดือน -> รายวัน
                myChartDistinct.update();
            }
            let txtDay1 = document.getElementById("CheckDayS1");
            let txtDay2 = document.getElementById("CheckDayS2");
            txtDay1.style.display = "block";
            txtDay2.style.display = "none";
        }
    }

    myChartDistinct.ctx.onclick = moveScroll();

    ctx.onclick = clickHandler;

    ctx.addEventListener('mousemove', (e) => {
        myChartDistinct.resize();
        mousemoveHandler(ctx, e);
    });

    ctx.addEventListener('click',  (e) => {
        myChartDistinct.resize();
        clickButtonHandler(ctx, e)
    });

    changeChart(0);
    //=================================================================================================
</script>

</body>



<style>
    /*@media (orientation: portrait) {*/
        /*body {*/
            /*-webkit-transform: rotate(-90deg);*/
            /*-moz-transform: rotate(-90deg);*/
            /*-o-transform: rotate(-90deg);*/
            /*-ms-transform: rotate(-90deg);*/
            /*transform: rotate(-90deg);*/
        /*}*/
    /*}*/
    * {
        margin: 0;
        padding: 0;
        font-family: sans-serif;
    }
    .chartMenu {
        width: 100vw;
        height: 40px;
        background: #1A1A1A;
        color: rgba(255, 26, 104, 1);
    }
    .chartMenu p {
        padding: 10px;
        font-size: 20px;
    }
    .chartCard {
        width: 100vw;
        height: calc(100vh - 40px);
        background: rgba(255, 26, 104, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .chartBox {
        width: 700px;
        padding: 20px;
        border-radius: 20px;
        border: solid 3px rgba(255, 26, 104, 1);
        background: white;
    }
</style>


































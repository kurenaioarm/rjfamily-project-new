<?php

/* @var $this yii\web\View */
use common\widgets\Alert;
use yii\widgets\ActiveForm;
use kartik\daterange\DateRangePicker;
use yii\helpers\Html;

$this->title = 'My Yii Application';
$this->registerCssFile(
    '//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
    '//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

?>


<!-- on your view layout file HEAD section -->
<script src="<?=\yii\helpers\Url::to('@web/../RJMedicalRecord/js/jquery.min.js'); ?>"></script>
<script src="<?=\yii\helpers\Url::to('@web/../RJMedicalRecord/js/all.js'); ?>"></script>

<!------------------------------------------------------------------- รอโหลดหน้าเว็บ ---------------------------------------------------------------------------------------->
<style type="text/css">
    /*รอโหลดหน้า*/
    #overlay {
        position: absolute;
        top: 0px;
        left: 0px;
        /*background: #ccc;*/
        width: 100%;
        height: 100%;
        /*opacity: .75;*/
        filter: alpha(opacity=100);
        -moz-opacity: .10;
        z-index: 999;
        background: #fcfdfc url(https://rjfamily.rajavithi.go.th/assets/images/Loading/LoadindV8.gif) 50% 50% no-repeat;
    }
    .main-contain{
        position: absolute;
        top: 0px;
        left: 0px;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }
</style>
<div id="overlay"></div>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------>


<!------------------------------------------------------------------------------------------------------- ตรวจสอบขนาดหน้าจอ PHP ----------------------------------------------------------------------------------------------------------------------->
<?php if (isset($_GET['Screen_Size'])){
    $Check_Length = $_GET['Screen_Size'];
 } else { ?>
    <script>
        width = screen.width;
        window.location.href = "http://rjfamily.com/RJMedicalRecord/index.php/medicalrecord/index?Screen_Size=" + width ; //TEST
//        window.location.href = "https://rjfamily.rajavithi.go.th/RJMedicalRecord/index.php/medicalrecord/index?Screen_Size=" + width ;
    </script>
<?php } ?>
<!-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->



<?php if (isset($StatusMode)) { if($StatusMode == "[User Mode]"){ ?>
    <small><b style="color: #35c285;margin: 15px;"><?php echo $StatusMode; ?></b></small>
<?php }else{ ?>
    <small><b style="color: #ff00ff;margin: 15px;"><?php echo $StatusMode; ?></b></small>
<?php }} ?>

<?php if (isset($Check_Privilege) && isset($Check_Length)) { if($Check_Privilege == "0" || $Check_Privilege == "2"){ ?>
    <div class="main-contain">
        <!---------Alert----------->
        <?= Alert::widget() ?>


        <div class="container">
            <div class="">
                <br> <br>
                <h1 style="color: #b49c73;margin-left: 20px;"><b>ตรวจสอบข้อมูลผู้ป่วย</b></h1><br>
                <div class="input-group mb-3">
                    <h5 style="margin-left: 60px">LEARN ABOUT US</h5>
                </div>
                <div class="input-group mb-0">
                    <h6 style="margin-left: 60px">ระบุเลข HN ในช่องกรอกข้อมูลข้างล่างเพื่อทำการค้นหาข้อมูลผู้ป่วย</h6>
                </div>
                <div class="input-group mb-3">
                    <h6 style="margin-left: 60px">ตรวจสอบการลงข้อมูลแม่และลูก</h6>
               </div>
                <?php $form = ActiveForm::begin(); ?>
                <div class="input-group mb-0">
                    <div class="input-group col">
                        <label>
                            <?= $form->field($model, 'HN')->textInput(['class'=>'form-control' , 'id' => 'HN' , 'style'=> 'width: 300px;margin-left: 45px;' , 'maxlength' => '8'  , 'placeholder'=>'ระบุ HN แม่เพื่อค้นหา' , 'autocomplete'=>'off' , 'disabled' => false ,  'onkeypress' =>"return CheckDate_HN(event)"])->label(false) ?>
                        </label>
                        <label>
                            <?= Html::submitButton('<b>ตรวจสอบข้อมูล <i class="fas fa-file-signature" style="font-size:19px;"></i></b>', ['class' => 'input-group-text btn btn-outline-success', 'name' => 'Check-button' ,'value'=>1,'disabled' => false , 'style'=>'width: 100%;margin-left: 45px;']) ?>
                        </label>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>

                <div class="input-group mb-0 container">
                    <table class="table table-bordered" id="donationdata">
                        <thead>
                        <tr style="background: -webkit-linear-gradient(45deg, #5bccc8,#87dfdc); font-size:15px">
                            <th style="color:black;text-align:center;" width="200 px">ลำดับบุตร</th>
                            <th style="color:black;text-align:center;" width="100 px">HN</th>
                            <th style="color:black;text-align:center;" width="100 px">วัน-เวลาที่เกิด</th>
                            <th style="color:black;text-align:center;" width="200 px">การจัดการ</th>
                        </tr>
                        </thead>

                        <tbody >
                        <?php
                        if (isset($API_check_children)){
                            $number_children = $API_check_children->json_total+1;
                            if($API_check_children->json_result == true ){
                                ?>

                                <?php if($API_check_children->json_data != []){  ?>
                                    <div class="input-group mb-3">
                                            <h6 style="">
                                                <h4><b style="color: #b49c73;">ข้อมูลเบื้องต้น</b></h4>&nbsp;&nbsp;&nbsp;&nbsp;
                                                <h4><b style="color: #b49c73;">HN :</b> <?php echo  $API_check_children->json_data[0]->HN_MUM; ?> </h4>&nbsp;&nbsp;&nbsp;&nbsp;
                                                <h4><b style="color: #b49c73;">ชื่อ :</b> <?php echo  $API_check_children->json_data[0]->DSPNAME_MUM; ?></h4>&nbsp;&nbsp;&nbsp;&nbsp;
                                            </h6>
                                    </div>
                                    <br> <br>
                                <?php } ?>

                                <?php
                                foreach ($API_check_children->json_data as $data){ //วน tr
                                    $number_children--;
                                    ?>

                                    <tr onMouseover="this.style.backgroundColor='#46d2a3';  this.style.color = 'white'; " onMouseout="this.style.backgroundColor='';  this.style.color = '';" >
                                        <td style="font-size:14px;padding: 18px;">
                                            <img src="https://rjfamily.rajavithi.go.th/RJMedicalRecord/images/baby.jpg" style="width: 75px; height: 70px">&nbsp;&nbsp;
                                            <b style="font-size:15px;color: black;"> บุตรคนที่ <?php echo $number_children ?></b>
                                        </td>
                                        <td style="font-size:14px;padding: 42px;">
                                            <b><?php echo $data->HN_CHILDREN ?></b>
                                        </td>
                                        <td style="font-size:14px;padding: 42px;">
                                            <?php if($data->HN_CHILDREN == null){ ?>
                                                <b></b>
                                            <?php }else{ ?>
                                                <?php if($data->DLVBRTHDATE_CHILDREN == $data->PTTBRTHDATE_CHILDREN){ ?>
                                                    <b><?php echo $data->PTTBRTHDATE_CHILDREN ?> <?php echo $data->PTT_BRTHTIME ?></b>
                                                <?php }else{ ?>
                                                    <b style="color: red">[<?php echo $data->DLVBRTHDATE_CHILDREN ?>]</b>
                                                    <b style="color: green">[<?php echo $data->PTTBRTHDATE_CHILDREN ?>]</b>
                                                <?php } ?>
                                            <?php } ?>
                                        </td>

                                        <?php if($data->HN_CHILDREN == null){ ?>
                                            <td style="font-size:14px;padding: 42px;">
                                                <div class="mb-0">
                                                  <b style="color: red;">ไม่พบข้อมูลใน</b>
                                                </div>
                                                <div class="mb-0">
                                                    <b style="color: red;">เวชระเบียน</b>
                                                </div>
                                            </td>
                                        <?php }else{ ?>
                                            <td style="font-size:14px;padding: 42px;">
                                                <?= Html::a('&nbsp;<b>See Profile</b>&nbsp;&nbsp;<i class="fas fa-search"  style="font-size: 1.3em;color: black;" aria-hidden="true"></i>&nbsp;','datachild',
                                                    [
                                                        'class' => 'input-group-text btn btn-warning  btn-sm',
                                                        'target'=>'_blank',
                                                        'style'=>  'color: black;',
                                                        'data'=>[
                                                            'method' => 'post',
                                                            'target'=>'_blank',
                                                            'params'=>[
                                                                'Data[Check_Privilege]' => $Check_Privilege,
                                                                'Data[HN_CHILDREN]' => $data->HN_CHILDREN,
                                                                'Data[HN_MUM]' => $data->HN_MUM,
                                                                'Data[AN_MUM]' => $data->AN_MUM,
                                                                'Data[ANCNO]' => $data->ANCNO,
                                                                'Data[ANCDATE]' => $data->ANCDATE,
                                                                'Data[ANCTIME]' => $data->ANCTIME,
                                                                'Data[BRTHDATE_CHILDREN]' => $data->PTTBRTHDATE_CHILDREN,
                                                                'Data[CARDNO_MUM]' => $data->CARDNO,
                                                                'Data[ADMIT_DATE]' => $data->ADMIT_DATE,
                                                                'Data[DLVSTDATE]' => $data->DLVSTDATE,
                                                                'Data[DLVSTTIME]' => $data->DLVSTTIME,
                                                                'Data[Check_Length]' => $Check_Length,
                                                            ],
                                                        ],
                                                    ]) ?>
                                            </td>
                                        <?php } ?>
                                    </tr>
                                <?php }}}  ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php }else{ ?>
    <div class="main-contain">
        <!---------Alert----------->
        <?= Alert::widget() ?>
        <div class="jumbotron text-center bg-transparent"><br><br><br>
            <h1 class="display-4" style="color: red">IP เครื่องที่คุณใช้อยู่ <br> ไม่มีสิทธิ์ในการเข้าถึงหน้านี้ </h1>
            <i class="fas fa-eye-slash" style="color: red" aria-hidden="true"></i>
            <p class="lead">กรุณาติต่อเจ้าหน้าที่ ผู้ดูแลระบบ</p>
        </div>
    </div>
<?php }} ?>



<?php
$this->registerJS('
                $(function() {
                    $("#donationdata").dataTable({
                        "order": [[0, "desc"]],
                        "bPaginate": true,
                        "bLengthChange": true,
//                        "bFilter": false,
                        "bSort": true,
                        "bInfo": true,
                        "bAutoWidth": true,
//                        "pagingType": "full_numbers"
                    });
                });
            ');
?>




<script type="text/javascript">

    function CheckDate(target, source) {
        //========================================ซ่อนและแสดงรูป===============================================
        document.getElementById(target).innerHTML = document.getElementById(source).innerHTML;
        //===============================================================================================
    }

    function CheckDate_HN(e) {
        //======================================== ไม่ให้พิมตัวอักษร ===========================================
        let vchar = String.fromCharCode(event.keyCode);
//        if ((vchar < '0' || vchar > '9') && (vchar !== '.')) return false;
        if ((vchar < '0' || vchar > '9')) return false;
        e.onKeyPress = vchar;
        //===============================================================================================
    }

    $(function(){
        //========================================รอโหลดหน้า===============================================
        $("#overlay").fadeOut();
        $(".main-contain").removeClass("main-contain");
        //===============================================================================================
    });

</script>

<style>
    /* CSS Table */
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
        border-radius: 25px;
        border: 2px solid #000000;
    }

    td, th {
        border: 1px solid #797070;
        text-align: center;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }

    * {box-sizing: border-box;}
    /* ------------------------------------------------------------ */
    /* CSS Search */
    .topnav {
        overflow: hidden;
        background-color: #e9e9e9;
    }

    .topnav a {
        float: left;
        display: block;
        color: black;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        font-size: 17px;
    }

    .topnav a:hover {
        background-color: #ddd;
        color: black;
    }

    .topnav a.active {
        background-color: #2196F3;
        color: white;
    }

    .topnav .search-container {
        float: right;
    }

    .topnav input[type=text] {
        padding: 6px;
        margin-top: 8px;
        font-size: 17px;
        border: none;
    }

    .topnav .search-container button {
        float: right;
        padding: 6px 10px;
        margin-top: 8px;
        margin-right: 16px;
        background: #ddd;
        font-size: 17px;
        border: none;
        cursor: pointer;
    }

    .topnav .search-container button:hover {
        background: #ccc;
    }
    /* ------------------------------------------------------------ */
</style>
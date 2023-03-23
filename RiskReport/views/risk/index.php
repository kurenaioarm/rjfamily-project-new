<?php
/* @var $this yii\web\View */
use common\widgets\Alert;
use yii\widgets\ActiveForm;
use kartik\daterange\DateRangePicker;
use yii\helpers\Html;
use kartik\select2\Select2;
use kartik\datetime\DateTimePicker;
use yii\helpers\Url;

$this->title = 'My Yii Application';
?>

<!-- on your view layout file HEAD section -->
<script defer src="<?=\yii\helpers\Url::to('@web/../RiskReport/js/all.js'); ?>" crossorigin="anonymous"></script>

<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">รายงานอุบัติเหตุ-อุบัติการณ์</h1>
        <p class="lead">โรงพยาบาลราชวิถี กรมการแพทย์ : Rajavithi Hospital</p>
    </div>

    <div class="body-content">
        <div class="site-index">
            <!--     on your view layout file HEAD section -->
            <link rel="stylesheet" href="<?=\yii\helpers\Url::to('@web/../RJESI/css/all.css'); ?>">
            <!--     on your view layout file HEAD section-->
            <script defer src="<?=\yii\helpers\Url::to('@web/../RJESI/js/all.js'); ?>" crossorigin="anonymous"></script>

            <div class="row">
                <div class="form-group mb-12">
                    <?php $form = ActiveForm::begin(); ?>
                    <!------------------------------------------------------------------------------------------------------- ตรวจสอบขนาดหน้าจอ PHP ----------------------------------------------------------------------------------------------------------------------->
                    <?php if (isset($_GET['Screen_Size'])) {
                        $Check_Length = $_GET['Screen_Size'];
                        if($Check_Length <= 380){ //iPhone SE
                            $TitleArea_Length = 'width: 290px';
                            $LengthArea = 'width: 290px';
                            $Title_Length = 'width: 290px';
                            $Length = 'width: 290px';
                            $Length_V2 = '290px';
                            $FontS_rm='font-size: 12px';
                        }else {
                            if($Check_Length <= 390){  //iPhone 12 Pro
                                $TitleArea_Length = 'width: 310px';
                                $LengthArea = 'width: 310px';
                                $Title_Length = 'width: 310px';
                                $Length = 'width: 310px';
                                $Length_V2 = '310px';
                                $FontS_rm='font-size: 12px';
                            }else {
                                if ($Check_Length <= 414) {   //iPhone XR
                                    $TitleArea_Length = 'width: 330px';
                                    $LengthArea = 'width: 330px';
                                    $Title_Length = 'width: 330px';
                                    $Length = 'width: 330px';
                                    $Length_V2 = '330px';
                                    $FontS_rm='font-size: 12px';
                                } else {
                                    if ($Check_Length <= 896) { //iPad Air
                                        $TitleArea_Length = 'width: 670px';
                                        $LengthArea = 'width: 670px';
                                        $Title_Length = 'width: 170px';
                                        $Length = 'width: 500px';
                                        $Length_V2 = '500px';
                                        $FontS_rm='font-size: 16px';
                                    } else {
                                        if ($Check_Length <= 1180) { //iPad Air
                                            $TitleArea_Length = 'width: 1050px';
                                            $LengthArea = 'width: 1050px';
                                            $Title_Length = 'width: 160px';
                                            $Length = 'width: 380px';
                                            $Length_V2 = '380px';
                                            $FontS_rm='font-size: 16px';
                                        } else {
                                            $TitleArea_Length = 'width: 890px';
                                            $LengthArea = 'width: 890px';
                                            $Title_Length = 'width: 165px';
                                            $Length = 'width: 290px';
                                            $Length_V2 = '290px';
                                            $FontS_rm='font-size: 16px';
                                        }
                                    }
                                }
                            }
                        } ?>
                    <?php } else {
                        $TitleArea_Length = '';
                        $LengthArea = '';
                        $Length = '';
                        $Title_Length = '';
                        $Length_V2 = '';
                        $FontS_rm = '';
                        ;?>
                        <!------------------------------------------------------------------------------------------------------- เช็คขนาดหน้าจอ script ----------------------------------------------------------------------------------------------------------------->
                        <script>
                            width = screen.width;
//                            window.location.href = "http://rjfamily.com/RiskReport/index.php/risk/index?Screen_Size=" + width ; //TEST
                            window.location.href = "https://rjfamily.rajavithi.go.th/RiskReport/index.php/risk/index?Screen_Size=" + width ;
                        </script>
                        <!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------>
                    <?php } ?>
                    <!--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
                    <?php if (isset($FontS_rm)&&isset($Current_DateThai)&&isset($Current_Time)&&isset($Access_Token)) { ?>
                    <div class="card my-3 border-info" >
                        <div class="card-header">
                            <b style="color: black; <?php echo $FontS_rm ?>">ข้อมูลทั่วไป</b>
                        </div>
                        <div class="card-body bg-secondary">
                            <!--'autocomplete'=>'off' = ไม่จำค่าที่เคยกรอกไป -->
                            <br><br>
                            <!-------------------------------------------------------------------------------------------------------วันที่เกิดเหตุ,เวลาที่เกิดเหตุ----------------------------------------------------------------------------------------------------------------------->
                            <div class="input-group mb-3 ">
                                <label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text btn btn-info" style="<?php echo $Title_Length ?>;<?php echo $FontS_rm ?>;">วันที่รายงาน</span>
                                    </div>
                                </label>
                                <label>
                                    <?= $form->field($model, 'Report_Date')->textInput(['class'=>'form-control border-info' , 'id' => 'Report_Date' , 'style'=> $Length , 'value'=>$Current_DateThai , 'autocomplete'=>'off' , 'disabled' => true])->label(false) ?>
                                    <?php echo  Html::hiddenInput('Report_Date', $Current_DateThai); ?>
                                </label>
                                <label>
                                    <div class=" input-group-prepend">
                                        <span class="input-group-text btn btn-info" style="<?php echo $Title_Length ?>;<?php echo $FontS_rm ?>;">เวลารายงาน</span>
                                    </div>
                                </label>
                                <label>
                                    <?= $form->field($model, 'Report_Time')->textInput(['class'=>'form-control border-info' , 'id' => 'Report_Time'  , 'style'=> $Length , 'value'=>$Current_Time , 'autocomplete'=>'off' , 'disabled' => true])->label(false) ?>
                                    <?php echo  Html::hiddenInput('Report_Time', $Current_Time); ?>
                                </label>
                                <label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text btn btn-info" style="<?php echo $Title_Length ?>;<?php echo $FontS_rm ?>;">วันที่เกิดเหตุ</span>
                                    </div>
                                </label>
                                <label>
                                    <?php
                                        // Highlight today, show today button, change date format (use convertFormat
                                        // to auto convert PHP DateTime Format to DateTimePicker format).
                                        echo DateTimePicker::widget([
                                            'name' => 'DT_Incident',
                                            'id' => 'DT_Incident',
                                            'options' => [
                                                'placeholder' => 'Enter event time ...',
                                                'onchange' =>"CheckDate_ALL()",
                                                'autocomplete' => 'off',
                                                'required' => true,
                                            ],
                                            'language' => 'th',
                                            'pluginOptions' => [
                                                'todayHighlight' => true,
                                                'todayBtn' => true,
                                                'format' => 'dd MM yyyy HH:ii',
                                                'autoclose' => true,
                                            ],
                                        ]);
                                    ?>
                                </label>
                                <label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text btn btn-info" style="<?php echo $Title_Length ?>;<?php echo $FontS_rm ?>;">ประเภทเรื่องที่แจ้ง</span>
                                    </div>
                                </label>
                                <label>
                                    <?php
                                        if (isset($Array_rminformtype)) {
                                            echo $form->field($model, 'Type_Reported')->widget(Select2::classname(), [
                                                'data' => $Array_rminformtype,
                                                'size' => Select2::MEDIUM,
                                                'options' => [
                                                    'placeholder' => 'Select a state ...',
                                                    'onchange' =>"CheckDate_ALL()",
                                                ],
                                                'pluginOptions' => [
                                                    'width' => $Length_V2,
                                                    'allowClear' => true
                                                ],
                                            ])->label(false);
                                        }
                                    ?>
                                </label>
                            </div>
                            <!--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
                            <div class="input-group mb-3 ">
                                <label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text btn btn-info" style="<?php echo $Title_Length ?>;<?php echo $FontS_rm ?>;">หน่วยงานเกิดเหตุ</span>
                                    </div>
                                </label>
                                <label>
                                    <?php
                                    if (isset($Array_rmlct)) {
                                        echo '<div id="Box_Incident_Agency">';
                                        echo $this->render('_Incident_Agency', [
                                            'Array_rmlct' => $Array_rmlct,
                                            'model'=> $model,
                                            'Length_V2' => $Length_V2,
                                        ]) ;
                                        echo '</div>';
                                    }
                                    ?>
                                </label>
                                <label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text btn btn-info" style="<?php echo $Title_Length ?>;<?php echo $FontS_rm ?>;"><i class="fas fa-map-marker-alt" style="color: #00b3ee"></i> สถานที่เกิดเหตุ</span>
                                    </div>
                                </label>
                                <label>
                                    <?php
                                    if (isset($Array_rmplace)) {
                                        echo '<div id="Box_Incident_Location">';
                                        echo $this->render('_Incident_Location', [
                                            'Array_rmplace' => $Array_rmplace,
                                            'value'=>"",
                                            'Check_Status'=>"",
                                            'model'=> $model,
                                            'Length_V2' => $Length_V2,
                                        ]) ;
                                        echo '</div>';
                                    }
                                    ?>
                                </label>
                                <label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text btn btn-danger" style="<?php echo $Title_Length ?>;<?php echo $FontS_rm ?>;">ข้อมูลที่ผิด (ชื่อยา)</span>
                                    </div>
                                </label>
                                <label class="align-items-center">
                                    <?= $form->field($model, 'Mis_Drug')->textInput(['class'=>'form-control border-info' , 'id' => 'Mis_Drug' , 'style'=> $Length ,  'autocomplete'=>'off' , 'disabled' => false])->label(false) ?>
                                </label>
                                <label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text btn btn-success" style="<?php echo $Title_Length ?>;<?php echo $FontS_rm ?>;">ข้อมูลที่ถูก (ชื่อยา)</span>
                                    </div>
                                </label>
                                <label>
                                    <?= $form->field($model, 'Correct_Drug')->textInput(['class'=>'form-control border-info' , 'id' => 'Correct_Drug' , 'style'=> $Length ,  'autocomplete'=>'off' , 'disabled' => false])->label(false) ?>
                                </label>
                            </div>
                            <!--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
                            <div class="row">
                                <div class="col-sm">
                                    <div class="">
                                        <span class="btn btn-info" style="<?php echo $TitleArea_Length ?>;<?php echo $FontS_rm ?>;">รายละเอียด/เหตุการณ์โดยย่อ</span>
                                    </div>
                                    <?= $form->field($model, 'Quick_Details')->textArea(['class'=>'' , 'id' => 'Quick_Details' , 'style'=> $LengthArea ,  'autocomplete'=>'off' , 'required' => true , 'onchange' =>"CheckDate_ALL()"])->label(false) ?>
                                </div>
                                <div class="col-sm">
                                    <div class="">
                                        <span class=" btn btn-info" style="<?php echo $TitleArea_Length ?>;<?php echo $FontS_rm ?>;">การดำเนินแก้ไขเบื้องต้น</span>
                                    </div>
                                    <?= $form->field($model, 'Preliminary_Edit')->textArea(['class'=>'' , 'id' => 'Preliminary_Edit' , 'style'=> $LengthArea ,  'autocomplete'=>'off' , 'required' => true , 'onchange' =>"CheckDate_ALL()"])->label(false) ?>
                                </div>
                            </div>

                            <!--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
                            <div class="input-group mb-3 ">

                            </div>
                            <!--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
                            <div class="input-group mb-3 ">
                                <label>
                                    <div class="input-group-prepend ">
                                        <span class="input-group-text btn btn-info" style="<?php echo $Title_Length ?>;<?php echo $FontS_rm ?>;">ชื่อผู้รายงาน</span>
                                    </div>
                                </label>
                                <label class="align-items-center">
                                    <?= $form->field($model, 'Reporter_Name')->textInput(['class'=>'form-control border-info' , 'id' => 'Reporter_Name'  , 'style'=> $Length , 'value'=>$Access_Token['user']->staff_name , 'autocomplete'=>'off' , 'disabled' => true])->label(false) ?>
                                    <?php echo  Html::hiddenInput('Reporter_Name', $Access_Token['user']->staff_name); ?>
                                </label>
                                <label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text btn btn-info" style="<?php echo $Title_Length ?>;<?php echo $FontS_rm ?>;">หน่วยงานที่รายงาน</span>
                                    </div>
                                </label>
                                <label>
                                    <?= $form->field($model, 'Reporter_agency')->textInput(['class'=>'form-control border-info' , 'id' => 'Reporter_agency'  , 'style'=> $Length , 'value'=>$Access_Token['user']->staff_div , 'autocomplete'=>'off' , 'disabled' => true])->label(false) ?>
                                    <?php echo  Html::hiddenInput('Reporter_agency', $Access_Token['user']->staff_div); ?>
                                </label>
                                <label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text btn btn-info" style="<?php echo $Title_Length ?>;<?php echo $FontS_rm ?>;">เบอร์โทรศัพท์</span>
                                    </div>
                                </label>
                                <label>
                                    <?= $form->field($model, 'Phone_Number')->textInput(['class'=>'form-control' , 'id' => 'Phone_Number'  , 'style'=> $Length ,  'autocomplete'=>'off' , 'required' => true , 'onkeypress' =>"return CheckDate_Phone(event)"])->label(false) ?>
                                </label>
                            </div>
                            <!--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
                            <div class="container" id="Alert_Rmleveldtl" style="<?php echo $FontS_rm ?>;display:none;">
                                <div class="alert alert-danger alert-dismissible" id="myAlert">
                                    <strong>✎ กรุณากรอกข้อมูลให้ครบถ้วน</strong> คุณยังไม่ระบุข้อมูล <b><u>ประเภทเรื่องที่แจ้ง</u></b>
                                </div>

                            </div>
                            <div class="container" id="Alert_Agency" style="<?php echo $FontS_rm ?>;display:none;">
                                <div class="alert alert-danger alert-dismissible" id="myAlert">
                                    <strong>✎ กรุณากรอกข้อมูลให้ครบถ้วน</strong> คุณยังไม่ระบุข้อมูล  <b><u>หน่วยงานเกิดเหตุ</u></b>
                                </div>
                            </div>
                            <!--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
                        </div>
                    </div>
                    <?php } ?>
                    <?php if (isset($API_select_rmgrp) && isset($API_select_rmtypegrp) && isset($API_select_rmtype)&& isset($API_select_rmgroup)&& isset($FontS_rm)) { ?>
                    <div class="card my-3 border-info container text-nowrap" id="Box_Risk_Details"  style="background-color:#f7f7f7;display:none;" >
                        <!----------------------------------------------------------------------------------------------- Search ----------------------------------------------------------------------------------------------------------------------------->
                        <div class="input-group md-form form-sm form-1 pl-0" >
                            <div class="input-group-prepend">
                                <span class="input-group-text cyan lighten-2 " id="basic-text1" style="color: black; background-color:#f7f7f7; <?php echo $FontS_rm ?>" ><b>รายละเอียดความเสี่ยง</b></span>
                            </div>
                            <input class="form-control my-0 py-1" type="text" id="SearchRmG" placeholder="Search" aria-label="Search" onkeypress ="return SearchRmGroup(this.value)">
                            <button class="btn btn-secondary" type="button" onclick="SearchRmGroup(SearchRmG.value)">
                                <i class="fas fa-search text-primary" aria-hidden="true" ></i>
                            </button>
                        </div>

                        <div class="card-body bg-secondary" id="Box_Incident_Rmgroup" style="<?php echo $FontS_rm ?>" >
                            <?php
                            echo $this->render('_Incident_Rmgroup', [
                                'API_select_rmgrp' => $API_select_rmgrp,
                                'API_select_rmtypegrp' => $API_select_rmtypegrp,
                                'API_select_rmtype' => $API_select_rmtype,
                                'API_select_rmgroup' => $API_select_rmgroup,
                                'Title_Length' => $Title_Length,
                                'FontS_rm' => $FontS_rm,
                                'Group_Check'=> "1st_Floor",
                            ]) ;
                            ?>
                        </div>
                        <!-----------------------------------------------------------------------------------------------TABLE----------------------------------------------------------------------------------------------------------------------------->
                        <?php if (isset($API_select_rmleveldtl)&& isset($FontS_rm)) { ?>
                            <div class="table-responsive" id="Box_Incident_Rmleveldtl" style="<?php echo $FontS_rm ?>;display:table;">
                                <?php
                                echo $this->render('_Incident_Rmleveldtl', [
                                    'API_select_rmleveldtl' => $API_select_rmleveldtl,
                                    'FontS_rm' => $FontS_rm,
                                    'RMLEVELDTL' => "",
                                ]) ;
                                ?>
                            </div>
                        <?php } ?>
                        <?php } ?>
                        <!-----------------------------------------------------------------------------------------------Button----------------------------------------------------------------------------------------------------------------------------->
                        <br>
                        <div class="container" id="Submit_Succes"  style="<?php echo $FontS_rm ?>;display:none;">
                            <?= Html::submitButton('Check', ['class' => 'btn btn-dark btn-block' , 'id' => 'ConFirm_Disabled', 'name' => 'Check-button', 'value'=>1, 'disabled' => true ,  'onClick'=>"SubmitDate('target', 'replace_target')"]) ?>
                        </div>
                        <br>
                    </div>
                    <!-----------------------------------------------------------------------------------------------Loading---------------------------------------------------------------------------------------------------------------------------->
                    <div>
                        <span id="target"></span>
                    </div>
                    <div class="row" style="display:none">
                        <span id="replace_target"><img src="https://rjhome.rajavithi.go.th/RJESI/images/Loading.gif" style="width: 250px; height: 70px"></span>
                    </div>
                    <!--------------------------------------------------------------------------------------------------Alert------------------------------------------------------------------------------------------------------------------------------>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
            <br> <br> <br> <br> <br> <br>
        </div>
    </div>
</div>




<script type="text/javascript">

    function ShowRmtypegrpTable( type,rmgrp_id ) {
        if(type === "none"){ //none = ปิด & table = เปิด
            document.getElementById('t_rmgrp_'+rmgrp_id).style.display = 'none';
            document.getElementById('n_rmgrp_'+rmgrp_id).style.display = 'table';
        }else {
            document.getElementById('t_rmgrp_'+rmgrp_id).style.display = 'table';
            document.getElementById('n_rmgrp_'+rmgrp_id).style.display = 'none';
        }
    }
    function ShowRmtypeTable( type,rmtypegrp_id ) {
        if(type === "none"){ //none = ปิด & table = เปิด
            document.getElementById('t_rmtypegrp_'+rmtypegrp_id).style.display = 'none';
            document.getElementById('n_rmtypegrp_'+rmtypegrp_id).style.display = 'table';
        }else {
            document.getElementById('t_rmtypegrp_'+rmtypegrp_id).style.display = 'table';
            document.getElementById('n_rmtypegrp_'+rmtypegrp_id).style.display = 'none';
        }
    }

    function SearchRmGroup( data ) {
        document.getElementById('Box_Incident_Rmleveldtl').style.display = 'none';
        document.getElementById('Submit_Succes').style.display = 'none';
        document.getElementById("ConFirm_Disabled").disabled = true; //ทำ disabled ปุ่ม
        Search_RMLEVELDTL();
        $.ajax({
            url: '<?= \yii\helpers\Url::to(['risk/searchrmgroup']) ?>',
            type: 'POST',
            data: 'Data_Rmgroup='+data+'&Title_Length=<?=$Title_Length?>'+'&FontS_rm=<?=$FontS_rm?>',
            success: function (data) {
                $('#Box_Incident_Rmgroup').html(data);
                sessionStorage.removeItem("n_rmtype_id");
            }
        });
    }
    function Search_RMLEVELDTL() {
        $.ajax({
            url: '<?= \yii\helpers\Url::to(['risk/searcrmleveldtl']) ?>',
            type: 'POST',
            data: 'Data_RMLEVELDTL='+"0"+'&FontS_rm=<?=$FontS_rm?>',
            success: function (data) {
                $('#Box_Incident_Rmleveldtl').html(data);
            }
        });
    }

    function Check_RMLEVELDTL(data) {
        //        console.log(Check_oth[1]); //เช็คตัวแปลใน JavaScript
        document.getElementById('Box_Incident_Rmleveldtl').style.display = 'table';
        document.getElementById("ConFirm_Disabled").disabled = true; //ทำ disabled ปุ่ม
        let Check_oth = data.split('-'); //แบ่งข้อความ  JavaScript
        if(Check_oth[1] === "oth"){
            sessionStorage.setItem("n_rmtype_id", Check_oth[0]);
            document.getElementById('n_Note_oth').style.display = '';
            document.getElementById("Note_oth").disabled = false;
            $.ajax({
                url: '<?= \yii\helpers\Url::to(['risk/searcrmleveldtl']) ?>',
                type: 'POST',
                data: 'Data_RMLEVELDTL='+Check_oth[2]+'&FontS_rm=<?=$FontS_rm?>',
                success: function (data) {
                    $('#Box_Incident_Rmleveldtl').html(data);
                }
            });
        }else {
            let RmTyp_ID = sessionStorage.getItem("n_rmtype_id");
            if(RmTyp_ID === null){
                document.getElementById('n_Note_oth').style.display = 'none';
                document.getElementById("Note_oth").disabled = true;
                sessionStorage.removeItem("n_rmtype_id");
                $.ajax({
                    url: '<?= \yii\helpers\Url::to(['risk/searcrmleveldtl']) ?>',
                    type: 'POST',
                    data: 'Data_RMLEVELDTL='+Check_oth[2]+'&FontS_rm=<?=$FontS_rm?>',
                    success: function (data) {
                        $('#Box_Incident_Rmleveldtl').html(data);
                    }
                });
            }else {
                document.getElementById('n_Note_oth').style.display = 'none';
                document.getElementById("Note_oth").disabled = true;
                sessionStorage.removeItem("n_rmtype_id");
                $.ajax({
                    url: '<?= \yii\helpers\Url::to(['risk/searcrmleveldtl']) ?>',
                    type: 'POST',
                    data: 'Data_RMLEVELDTL='+Check_oth[2]+'&FontS_rm=<?=$FontS_rm?>',
                    success: function (data) {
                        $('#Box_Incident_Rmleveldtl').html(data);
                    }
                });
            }
        }
    }

    function CheckDate_ALL(){ //ตรวจสอบช่องว่าง ต่างๆ

        let DT_Incident = $('#DT_Incident').val(); //วันที่เกิดเหตุ
        let Incident_Rmleveldtl = $('#riskreportform-type_reported').val(); //ประเภทเรื่องที่แจ้ง
        let Incident_Agency = $('#Incident_Agency').val(); //หน่วยงานที่เกิดเหตุ
        let Quick_Details = $('#Quick_Details').val(); //รายละเอียด/เหตุการณ์โดยย่อ
        let Preliminary_Edit = $('#Preliminary_Edit').val(); //การดำเนินแก้ไขเบื้องต้น
        let Phone_Number = $('#Phone_Number').val(); //เบอร์โทรศัพท์
        let Note_oth  = $('#Note_oth').val(); //อื่นๆระบุ

        if(Note_oth === ""){
            document.getElementById("Note_oth").style.borderColor  = "red";
            document.getElementById("Note_oth").style.borderBottom = "solid red";
        }else {
            document.getElementById("Note_oth").style.borderColor  = "";
        }

        if(DT_Incident === "" ){
            document.getElementById("DT_Incident").style.borderColor  = "red";
            document.getElementById("DT_Incident").style.borderBottom = "solid red";
            document.getElementById('Box_Risk_Details').style.display = 'none'; // รายละเอียดความเสี่ยง
            //------------------------------------------------------------------------------------------------------------------------
            document.getElementById("Quick_Details").style.borderColor  = ""; //Check NULL
            document.getElementById("Preliminary_Edit").style.borderColor  = ""; //Check NULL
            document.getElementById("Phone_Number").style.borderColor  = ""; //Check NULL
            document.getElementById("Alert_Rmleveldtl").style.display = 'none';
            document.getElementById("Alert_Agency").style.display = 'none';
            //------------------------------------------------------------------------------------------------------------------------
        }else {
            document.getElementById("DT_Incident").style.borderColor  = "";
            if(Quick_Details === "" ){
                document.getElementById("Quick_Details").style.borderColor  = "red";
                document.getElementById("Quick_Details").style.borderBottom = "solid red";
                document.getElementById('Box_Risk_Details').style.display = 'none'; // รายละเอียดความเสี่ยง
                //------------------------------------------------------------------------------------------------------------------------
                document.getElementById("Preliminary_Edit").style.borderColor  = ""; //Check NULL
                document.getElementById("Phone_Number").style.borderColor  = ""; //Check NULL
                document.getElementById("Alert_Rmleveldtl").style.display = 'none';
                document.getElementById("Alert_Agency").style.display = 'none';
                //------------------------------------------------------------------------------------------------------------------------
            }else {
                document.getElementById("Quick_Details").style.borderColor  = "";
                if(Preliminary_Edit === "" ){
                    document.getElementById("Preliminary_Edit").style.borderColor  = "red";
                    document.getElementById("Preliminary_Edit").style.borderBottom = "solid red";
                    document.getElementById('Box_Risk_Details').style.display = 'none'; // รายละเอียดความเสี่ยง
                    //------------------------------------------------------------------------------------------------------------------------
                    document.getElementById("Phone_Number").style.borderColor  = ""; //Check NULL
                    document.getElementById("Alert_Rmleveldtl").style.display = 'none';
                    document.getElementById("Alert_Agency").style.display = 'none';
                    //------------------------------------------------------------------------------------------------------------------------
                }else {
                    document.getElementById("Preliminary_Edit").style.borderColor  = "";
                    if(Phone_Number === "" ){
                        document.getElementById("Phone_Number").style.borderColor  = "red";
                        document.getElementById("Phone_Number").style.borderBottom = "solid red";
                        document.getElementById('Box_Risk_Details').style.display = 'none'; // รายละเอียดความเสี่ยง
                        //------------------------------------------------------------------------------------------------------------------------
                        document.getElementById("Alert_Rmleveldtl").style.display = 'none';
                        document.getElementById("Alert_Agency").style.display = 'none';
                        //------------------------------------------------------------------------------------------------------------------------
                    }else {
                        document.getElementById("Phone_Number").style.borderColor  = "";
                        if(Incident_Rmleveldtl === ""){
                            document.getElementById("Alert_Rmleveldtl").style.display = 'table';
                            document.getElementById("Alert_Agency").style.display = 'none';
                            document.getElementById('Box_Risk_Details').style.display = 'none'; // รายละเอียดความเสี่ยง
                        }else {
                            document.getElementById("Alert_Rmleveldtl").style.display = 'none';
                            if(Incident_Agency === ""){
                                document.getElementById("Alert_Agency").style.display = 'table';
                                document.getElementById('Box_Risk_Details').style.display = 'none'; // รายละเอียดความเสี่ยง
                            }else {
                                document.getElementById("Alert_Agency").style.display = 'none';
                                document.getElementById('Box_Risk_Details').style.display = 'table';
                            }
                        }
                    }
                }
            }
        }

//        document.getElementById("Phone_Number").style.color = "red"; //เปลี่ยนสีตัวอักษร
//        document.getElementById("Phone_Number").style.borderColor  = "red"; //เปลี่ยนสีกรอบ
//        document.getElementById("Phone_Number").style.borderBottomStyle = "solid"; //เปลี่ยน Style กรอบ
//        document.getElementById("ConFirm_Disabled").disabled = false; //ทำ disabled ปุ่ม
    }

    function Rm_Level_Succes() {
        document.getElementById('Submit_Succes').style.display = 'table';
        document.getElementById("ConFirm_Disabled").disabled = false; //ทำ disabled ปุ่ม
    }

    function SubmitDate(target, source) {

//        let Report_Date = $('#Report_Date').val(); //วันที่รายงาน
//        let Report_Time = $('#Report_Time').val(); //เวลารายงาน
//        let DT_Incident = $('#DT_Incident').val(); //วันที่เกิดเหตุ
//        let Incident_Rmleveldtl = $('#riskreportform-type_reported').val(); //ประเภทเรื่องที่แจ้ง
//        let Incident_Agency = $('#Incident_Agency').val(); //หน่วยงานที่เกิดเหตุ
////        let Incident_Location = $('#Incident_Location').val(); //สถานที่เกิดเหตุ
////        let Mis_Drug = $('#Mis_Drug').val(); //ข้อมูลที่ผิด (ชื่อยา)
////        let Correct_Drug = $('#Correct_Drug').val(); //ข้อมูลที่ผิด (ชื่อยา)
//        let Quick_Details = $('#Quick_Details').val(); //รายละเอียด/เหตุการณ์โดยย่อ
//        let Preliminary_Edit = $('#Preliminary_Edit').val(); //การดำเนินแก้ไขเบื้องต้น
//        let Reporter_Name = $('#Reporter_Name').val(); //ชื่อผู้รายงาน
//        let Reporter_agency = $('#Reporter_agency').val(); //หน่วยงานที่รายงาน
//        let Phone_Number = $('#Phone_Number').val(); //เบอร์โทรศัพท์
////        let Note_oth  = $('#Note_oth').val(); //อื่นๆระบุ
//
//        if(Report_Date === "" || Report_Time === "" || DT_Incident === "" || Incident_Rmleveldtl === "" || Incident_Agency === "" || Quick_Details === "" ||
//            Preliminary_Edit === "" || Reporter_Name === "" || Reporter_agency === "" || Phone_Number === ""){
//
//        }else {
            //========================================ซ่อนและแสดงรูป===============================================
            document.getElementById(target).innerHTML = document.getElementById(source).innerHTML;
            //================================================================================================
//        }
    }

    function CheckDate_Phone(e){
        CheckDate_ALL();
        //======================================== ไม่ให้พิมตัวอักษร ===========================================
        let vchar = String.fromCharCode(event.keyCode);
//        if ((vchar < '0' || vchar > '9') && (vchar !== '.')) return false;
        if ((vchar < '0' || vchar > '9')) return false;
        e.onKeyPress = vchar;
        //===============================================================================================
    }


    function Check_rmlc(data){ //ปุ่ม สถานที่เกินเหตุ
        $.ajax({
            url: '<?= \yii\helpers\Url::to(['risk/checkrmlc']) ?>',
            type: 'POST',
            data: 'Incident_Location='+data+'&Length_V2=<?=$Length_V2?>',
            success: function (data) {
                $('#Box_Incident_Agency').html(data);
            }
        });
    }

    function Check_rmplace(data){ //ปุ่ม หน่วยงานที่เกิดเหตุ
        CheckDate_ALL();
        if(data === ""){
            $.ajax({
                url: '<?= \yii\helpers\Url::to(['risk/checkrmplace']) ?>',
                type: 'POST',
                data: 'Incident_Agency='+data+'&Length_V2=<?=$Length_V2?>',
                success: function (data) {
                    $('#Box_Incident_Location').html(data);
                    Check_rmplace_Step2(data);
                }
            });
        }else {
            $.ajax({
                url: '<?= \yii\helpers\Url::to(['risk/checkrmplace']) ?>',
                type: 'POST',
                data: 'Incident_Agency='+data+'&Length_V2=<?=$Length_V2?>',
                success: function (data) {
                    $('#Box_Incident_Location').html(data);
                }
            });
        }
    }

    function Check_rmplace_Step2(data){
        $.ajax({
            url: '<?= \yii\helpers\Url::to(['risk/checkrmplacestep2']) ?>',
            type: 'POST',
            data: 'Length_V2=<?=$Length_V2?>',
            success: function (data) {
                $('#Box_Incident_Agency').html(data)
            }
        });
    }

</script>

<style>

    /*.select2-container .select2-selection--single {*/
        /*border-style: solid !important;*/
        /*border-color: coral !important;*/
    /*}*/

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

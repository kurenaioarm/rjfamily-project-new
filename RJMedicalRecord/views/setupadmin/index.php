<?php

/* @var $this yii\web\View */
use common\widgets\Alert;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'My Yii Application';

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

<div class="container main-contain">
    <br>
    <div class="row">

        <!---------------------------------------------------------------------------------- Popup Add Permission ----------------------------------------------------------------------------------------------------------->
        <b style="font-size:22px;">ระบบงาน สำหรับผู้ดูแลระบบ (Admin)</b>
        <small  style="font-size:16px;"><b style="color: #ff3f59"><u>หน้านี้จำเป็นต้องมี User เข้า RHIS</u></b> <b>:</b> เป็นระบบงาน สำหรับผู้ดูแลระบบ <b>(Admin)</b> ซึ่งเกี่ยวข้องกับ การกำหนดสิทธิ์ให้กับ <b>(User)</b> หรือผู้ใช้ ในการเปิด-ปิดการใช้งาน.</small>
        <div  id="Type_Fixed_IP" style="display:none;">
            <b style="color: #ff3f59">*** กรณีมีการบันทึกหมายเลข IP ในหน้านี้</b> <b style="color: #ff00ff"> <u>ระบบจะเปลี่ยนเป็นโหมด</u> [การใช้งานแบบ Fixed IP] </b> <b style="color: #ff3f59"> : ถ้าไม่มีหมายเลข IP  จะไม่สามารถใช้งานบางเมนูได้</b>
        </div>
        <!---------Alert----------->
        <?= Alert::widget() ?>

        <!------------------------------------------------------------------------------------------- Button เพิ่มสิทธิ์ การเข้าใช้   ---------------------------------------------------------------------------------------------------->
        <div class="form-group mb-12 col col-sm-7">
            <label id="Add_on">
                <!--https://www.w3schools.com/icons/icons_reference.asp => ICON PHP -->
                <br>
                <span class="input-group-text btn btn-outline-success btn-sm" id="contact-icon" style="width: 170px;"><b>เพิ่มสิทธิ์ การเข้าใช้ <i class="fas fa-user-plus" style="font-size:19px;"></i></b></span>
            </label>
        </div>
        <!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
        <div class="form-group mb-12 col col-sm-5">
            <?php $form = ActiveForm::begin(); ?>
            <br>
            <div class="btn-group btn-group-toggle" data-toggle="buttons" style="width: 100%;" >
                <label class="btn btn-secondary active btn-sm">
                    <input type="radio" name="options" id="option3" autocomplete="off" checked onclick="option_Admin()">  Admin Data
                </label>
                <label class="btn btn-secondary  btn-sm">
                    <input type="radio" name="options" id="option4" autocomplete="off" onclick="option_Access_IP()"> Access  IP Data
                </label>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <table id="Type_Admin" style="display:table;">
        <tbody>
        <tr style="border: 2px solid #000000; background: -webkit-linear-gradient(45deg, #5bccc8,#87dfdc); font-size:15px">
            <th style="color:black" width="250 px">ID CARD</th>
            <th style="color:black" width="350 px">ชื่อ-นามสกุล บุคลากร</th>
            <th style="color:black" width="250 px">หน่วยงาน</th>
            <th style="color:black" width="250 px">ระดับสิทธิ์</th>
            <th style="color:black" width="250 px">การจัดการ</th>
        </tr>

        <?php
        if (isset($API_donate_admin)){
        if($API_donate_admin->json_result == true ){
        foreach ($API_donate_admin->json_data as $data){ //วน tr
        ?>
        <tr onMouseover="this.style.backgroundColor='#343434';  this.style.color = 'white'; " onMouseout="this.style.backgroundColor='';  this.style.color = '';">
            <td style="font-size:14px"><?php echo $data->ADMIN_ID;?> </td>
            <td style="font-size:14px"><?php echo $data->ADMIN_NAME;?> </td>
            <td style="font-size:14px">
                <?php
                $API_agency_name = API_agency_name($data->ADMIN_AGENCY_ID,Yii::$app->session->get('arrayAccess_Token')['access_token']);
                if($API_agency_name->json_data == null){
                    echo $data->ADMIN_AGENCY_ID;
                }else{
                    echo $API_agency_name->json_data[0]->DSPNAME;
                }
                ?>
            </td>

            <?php if( $data->TYPE_ID == "1"){ ?>
                <td style="font-size:14px;color: magenta;"><b>SuperAdmin</b></td>
            <?php }elseif ( $data->TYPE_ID == "2"){ ?>
                <td style="font-size:14px;color: #00d200;"><b>Admin</b></td>
            <?php }elseif ( $data->TYPE_ID == "3"){ ?>
                <td style="font-size:14px;color: #5d5d5d;"><b>ผู้ใช้งานทั่วไป</b></td>
            <?php }else{ ?>
                <td style="font-size:14px;color: #0992f0;"><b>ผู้ใช้งานโรงพยาบาลเด็ก</b></td>
            <?php } ?>

            <?php $Access_Token =  Yii::$app->session->get('arrayAccess_Token');?>
            <?php if($Access_Token['admin']->json_data[0]->TYPE_ID === "1" && $Access_Token['admin']->json_data[0]->ADMIN_ID !== $data->ADMIN_ID && $data->ADMIN_ID != "1103700041583"){ ?>
                <td style="font-size:14px">
                    <?= Html::a('&nbsp;<i class="fas fa-user-slash"  style="font-size: 1.3em;" aria-hidden="true"></i>&nbsp;<b>ถอนสิทธิ์ </b>&nbsp;','admin_delete',
                        [
                            'class' => 'input-group-text btn btn-outline-danger btn-sm',
                            'target'=>'',
                            'data'=>[
                                'method' => 'post',
                                'target'=>'_blank',
                                'params'=>[
                                    'User[ADMIN_ID]' => $data->ADMIN_ID,
                                ],
                            ],
                        ]) ?>
                </td>
            <?php }else{ ?>
                <td style="font-size:14px"></td>
            <?php } ?>

            <?php }}} ?>
        </tr>

        </tbody>
    </table>


    <table id="Type_Access_IP" style="display:none;">
        <tbody>
        <tr style="border: 2px solid #000000; background: -webkit-linear-gradient(45deg, #5bccc8,#87dfdc); font-size:15px">
            <th style="color:black" width="80 px">ลำดับ</th>
            <th style="color:black" width="550 px">Fixed IP</th>
            <th style="color:black" width="550 px">Note</th>
            <th style="color:black" width="250 px">การจัดการ</th>
        </tr>

        <?php
        if (isset($API_medr_IP_ALL)){
        if($API_medr_IP_ALL->json_result == true ){
        foreach ($API_medr_IP_ALL->json_data as $dataMedR){ //วน tr
        ?>
        <tr onMouseover="this.style.backgroundColor='#343434';  this.style.color = 'white'; " onMouseout="this.style.backgroundColor='';  this.style.color = '';">
            <td style="font-size:14px"><b><?php echo $dataMedR->IP_ID;?></b></td>
            <td style="font-size:14px"><b><?php echo $dataMedR->ACCESS_IP;?></b></td>
            <td style="font-size:14px"><b><?php echo $dataMedR->NOTE_IP;?></b></td>
            <?php $Access_Token =  Yii::$app->session->get('arrayAccess_Token'); ?>

            <td style="font-size:14px">
                <?= Html::a('&nbsp;<i class="fas fa-lock-open"  style="font-size: 1.3em;" aria-hidden="true"></i>&nbsp;<b>ถอน IP </b>&nbsp;','ip_delete',
                    [
                        'class' => 'input-group-text btn btn-outline-danger btn-sm',
                        'target'=>'',
                        'data'=>[
                            'method' => 'post',
                            'target'=>'_blank',
                            'params'=>[
                                'User[ACCESS_IP]' => $dataMedR->ACCESS_IP,
                            ],
                        ],
                    ]) ?>
            </td>
            <?php }}} ?>
        </tr>

        <?php
        if (isset($API_medr_IP_MAX)){
        if($API_medr_IP_MAX->json_result == true ){
        $MAXID = $API_medr_IP_MAX->json_data[0]->MAXID+1;
        ?>

        <tr onMouseover="this.style.backgroundColor='#343434';  this.style.color = 'white'; " onMouseout="this.style.backgroundColor='';  this.style.color = '';">
            <td style="font-size:14px"><b><?php echo $MAXID ; ?></b></td>
            <td style="font-size:14px"> <input class="form-control my-0 py-1" type="text" id="ACCESS_IP" placeholder="กรอกหมายเลข IP.."   autocomplete="off" onkeypress="return MyKeyIP(event);"> </td>
            <td style="font-size:14px"> <input class="form-control my-0 py-1" type="text" id="NOTE_IP" placeholder="NOTE.."   autocomplete="off"> </td>
            <td style="font-size:14px">
                <span class="input-group-text btn btn-outline-success btn-sm" id="contact-icon" style="width: 102px;" onclick="Check_IP(<?php echo $MAXID ?>,ACCESS_IP.value,NOTE_IP.value)"><b>&nbsp;<i class="fas fa-lock"  style="font-size: 1.3em;" aria-hidden="true"></i>&nbsp;<b>เพิ่ม IP </b>&nbsp;</span>
            </td>
            <?php }} ?>
        </tr>
        </tbody>
    </table>
    <div  id="Type_FixedIMG" style="display:none;" align="center" >
        <br>
        <span id="replace_target"><img src="https://rjfamily.rajavithi.go.th/RJMedicalRecord/images/Fixed_IPV2.gif" style="width: 50%; height: 55%;border: 1px solid black;"></span>
        <br><br>
    </div>

    <?php
    function API_agency_name($LCT,$Token){
        $curl = curl_init();
        $ADMINToken = 'LCT='.$LCT;
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://appintra.rajavithi.go.th/APIRJFamily/allproject_api/agency_name',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $ADMINToken,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$Token,
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }
    ?>

    <!------------------------------------------------------------------ Popup Add Permission -------------------------------------------------------------------------------->
    <div id="contact-popup">
        <form class="contact-form" action="" id="contact-form"
              method="post" enctype="multipart/form-data">
            <h1>SETTING</h1>

            <div class="container btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-outline-dark active" style="width: 50%">
                    <input type="radio" name="options" id="option1" autocomplete="off" checked onclick="option_his()"> <b>HIS</b>
                </label>
                <label class="btn btn-outline-dark" style="width: 50%">
                    <input type="radio" name="options" id="option2" autocomplete="off" onclick="option_idcard()"> <b>ID CARD</b>
                </label>
            </div>

            <br> <br>

            ระดับสิทธิ์
            <div class="popup mb-6" onclick="myFunction()"><i class="fas fa-lightbulb" style="font-size:19px;color: #ff9b2d"></i>
                <span class="popuptext" id="myPopup" style="text-align: left;">
                    <small  style="font-size:16px;"><b>&nbsp;&nbsp;&nbsp;ประเภท ระดับสิทธิ์</b></small><br>
                    <small> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1. SuperAdmin = Everything</small><br>
                    <small> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2. Admin = บันทึกข้อมูลในส่วนโรงพยาบาลราชวิถี</small><br>
                    <small> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3. ผู้ใช้งานทั่วไป = Read Only</small><br>
                    <small> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4. ผู้ใช้งานโรงพยาบาลเด็ก = บันทึกข้อมูลในส่วนโรงพยาบาลเด็ก </small>
                </span>

            </div><br>
            <?php $form = ActiveForm::begin(); ?>
            <div class="row" >
                <div class="form-group mb-12" id="Add_his" style="display:table;">
                    <?= $form->field($model, 'Permission_level')->dropdownList(['1' => 'SuperAdmin','2' => 'Admin','3' => 'ผู้ใช้งานทั่วไป','4' => 'ผู้ใช้งานโรงพยาบาลเด็ก'])->label(false) ?>

                    <?= $form->field($model, 'username')->textInput(['autofocus' => true , 'id' => 'txtusername' , 'placeholder' => 'ระบุ : ชื่อผู้ใช้งาน HIS' , 'maxlength' => '13' , 'autocomplete' => 'off' ])->label(false) ?>

                    <div class="row">
                        <div class="col">
                            <?= Html::submitButton('<b>เพิ่มสิทธิ์ <i class="fas fa-user-plus" style="font-size:19px;"></i></b>', ['class' => 'input-group-text btn btn-outline-success btn-sm',  'name' => 'Check-button' ,'value'=>1 , 'style'=>'width: 100%;']) ?>
                        </div>
                        <div class="col">
                            <?= Html::submitButton('<b>Cancel</b>', ['class' => 'input-group-text btn btn-outline-danger btn-sm',  'name' => 'Check-button' ,'value'=>4 , 'style'=>'width: 100%;' , 'onClick'=>"Check_Cancel();"]) ?>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-12" id="Add_idcard" style="display:none;">
                    <?= $form->field($model, 'Permission_level2')->dropdownList(['1' => 'SuperAdmin','2' => 'Admin','3' => 'ผู้ใช้งานทั่วไป','4' => 'ผู้ใช้งานโรงพยาบาลเด็ก'])->label(false) ?>

                    <?= $form->field($model, 'Idcard')->textInput(['autofocus' => true , 'id' => 'Idcard' , 'value' => '-' , 'placeholder' => 'ระบุ : เลขบัตรประชาชน' , 'maxlength' => '13' , 'autocomplete' => 'off' , 'onkeypress'=>'return MyKeyUsername(event);' ])->label(false) ?>

                    <div class="row">
                        <div class="col">
                            <?= Html::submitButton('<b>เพิ่มสิทธิ์ <i class="fas fa-user-plus" style="font-size:19px;"></i></b>', ['class' => 'input-group-text btn btn-outline-success btn-sm',  'name' => 'Check-button' ,'value'=>2 , 'style'=>'width: 100%;']) ?>
                        </div>
                        <div class="col">
                            <?= Html::submitButton('<b>Cancel</b>', ['class' => 'input-group-text btn btn-outline-danger btn-sm',  'name' => 'Check-button' ,'value'=>4 , 'style'=>'width: 100%;' ,  'onClick'=>"Check_Cancel();"]) ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>

        </form>
    </div>
    <!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------>


    <script type="text/javascript">

        function myFunction() {
            var popup = document.getElementById("myPopup");
            popup.classList.toggle("show");
        }

        function MyKeyUsername(e) {
            //===============================================================================================
            //ไม่ให้พิมตัวอักษร
            var vchar = String.fromCharCode(event.keyCode);
//        if ((vchar < '0' || vchar > '9') && (vchar !== '.')) return false;
            if ((vchar < '0' || vchar > '9')) return false;
            e.onKeyPress = vchar;
            //===============================================================================================
            var keynum;

            if (window.event) { // IE
                keynum = e.keyCode;
            } else if (e.which) { // Netscape/Firefox/Opera
                keynum = e.which;
            }
            //===============================================================================================
            //ทำให้สามารถกด ENTER
            if (keynum === 13) {
                $('#btnlogin').click();
            }
            //===============================================================================================
        }

        function MyKeyIP(e) {
            //===============================================================================================
            //ไม่ให้พิมตัวอักษร
            var vchar = String.fromCharCode(event.keyCode);
            if ((vchar < '0' || vchar > '9') && (vchar !== '.')) return false;
//            if ((vchar < '0' || vchar > '9')) return false;
            e.onKeyPress = vchar;
            //===============================================================================================
            var keynum;

            if (window.event) { // IE
                keynum = e.keyCode;
            } else if (e.which) { // Netscape/Firefox/Opera
                keynum = e.which;
            }
            //===============================================================================================
            //ทำให้สามารถกด ENTER
            if (keynum === 13) {
                $('#btnlogin').click();
            }
            //===============================================================================================
        }

        function mouseDownchangepasswordtotext(e, textbox) {
            //===============================================================================================
            //แสดง password
            if (e.checked === true) {
                textbox.type = "text"
            }
            else {
                textbox.type = "password"
            }
        }

        function CheckDate(target, source) {
            //========================================ซ่อนและแสดงรูป===============================================
            document.getElementById(target).innerHTML = document.getElementById(source).innerHTML;
            //===============================================================================================
        }

        function Check_IP(IP_ID, Access_IP,NOTE_IP) {
            $.ajax({
                url: '<?= \yii\helpers\Url::to(['setupadmin/ip_insert']) ?>',
                type: 'POST',
                data: 'IP_ID='+IP_ID+'&Access_IP='+Access_IP+'&NOTE_IP='+NOTE_IP,
            });
        }

        function option_his(){
            document.getElementById('Add_his').style.display = 'table';
            document.getElementById('txtusername').value = "";

            document.getElementById('Add_idcard').style.display = 'none';
            document.getElementById('Idcard').value = "-";
        }
        function option_idcard(){
            document.getElementById('Add_idcard').style.display = 'table';
            document.getElementById('txtusername').value = "-";

            document.getElementById('Add_his').style.display = 'none';
            document.getElementById('Idcard').value = "";
        }

        function option_Admin(){
            document.getElementById('Type_Admin').style.display = 'table';
            document.getElementById('Type_Access_IP').style.display = 'none';
            document.getElementById('Type_Fixed_IP').style.display = 'none';
            document.getElementById('Type_FixedIMG').style.display = 'none';
        }
        function option_Access_IP(){
            document.getElementById('Type_Admin').style.display = 'none';
            document.getElementById('Type_Access_IP').style.display = 'table';
            document.getElementById('Type_Fixed_IP').style.display = 'table';
            document.getElementById('Type_FixedIMG').style.display = 'table';
        }

        function Check_Cancel(textbox){
            textbox.type = "text";
            document.getElementById('txtusername').value = " ";
            document.getElementById('Idcard').value = " ";
        }

        $(document).ready(function () {//Popup Add Permission
            $("#contact-icon").click(function () {
                $("#contact-popup").show();
            });
            $("#Check-Cancel").click(function () {
                $("#contact-popup").hide();
            });
        });

        $(function(){
            //========================================รอโหลดหน้า===============================================
            $("#overlay").fadeOut();
            $(".main-contain").removeClass("main-contain");
            //===============================================================================================
        });

    </script>

    <style>
        /* Popup container - can be anything you want */
        .popup {
            position: relative;
            display: inline-block;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        /* The actual popup */
        .popup .popuptext {
            visibility: hidden;
            width: 400px;
            background-color: #555;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 8px 0;
            position: absolute;
            z-index: 1;
            bottom: 125%;
            left: 50%;
            margin-left: -80px;
        }

        /* Popup arrow */
        .popup .popuptext::after {
            content: "";
            position: absolute;
            top: 100%;
            left: 50%;
            margin-left: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: #555 transparent transparent transparent;
        }

        /* Toggle this class - hide and show the popup */
        .popup .show {
            visibility: visible;
            -webkit-animation: fadeIn 1s;
            animation: fadeIn 1s;
        }

        /* Add animation (fade in the popup) */
        @-webkit-keyframes fadeIn {
            from {opacity: 0;}
            to {opacity: 1;}
        }

        @keyframes fadeIn {
            from {opacity: 0;}
            to {opacity:1 ;}
        }
    </style>

    <style>
        /* --------------------------------------------------------------- Popup Contact ---------------------------------------------------------------------- */
        body {
            color: #232323;
            font-size: 0.95em;
            font-family: arial;
        }

        div#success {
            text-align: center;
            box-shadow: 1px 1px 5px #455644;
            background: #bae8ba;
            padding: 10px;
            border-radius: 3px;
            margin: 0 auto;
            width: 350px;
        }

        .inputBox {
            width: 100%;
            margin: 5px 0px 15px 0px;
            border: #dedede 1px solid;
            box-sizing: border-box;
            padding: 15px;
        }

        #contact-popup {
            position: absolute;
            top: 0px;
            left: 0px;
            height: 100%;
            width: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            color: #676767;
        }

        .contact-form {
            width: 350px;
            margin: 0px;
            background-color: white;
            font-family: Arial;
            position: relative;
            left: 55%;
            top: 68%;
            margin-left: -210px;
            margin-top: -255px;
            box-shadow: 1px 1px 5px #444444;
            padding: 20px 40px 40px 40px;
        }

        .info {
            color: #d30a0a;
            letter-spacing: 2px;
            padding-left: 5px;
        }

        #send {
            background-color: #09F;
            border: 1px solid #1398f1;
            font-family: Arial;
            color: white;
            width: 100%;
            padding: 10px;
            cursor: pointer;
        }

        #contact-popup h1 {
            font-weight: normal;
            text-align: center;
            margin: 10px 0px 20px 0px;
        }

        .input-error {
            border: #e66262 1px solid;
        }
        /* ------------------------------------------------------------------------------------------------------------------------------------- */


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
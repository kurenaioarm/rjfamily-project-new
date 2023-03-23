<?php


$this->title = 'My Yii Application';
?>
<!-- on your view layout file HEAD section -->
<script defer src="<?=\yii\helpers\Url::to('@web/../RiskReport/js/all.js'); ?>" crossorigin="anonymous"></script>

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
//        window.location.href = "http://rjfamily.com/RiskReport/index.php/superadmin/index?Screen_Size=" + width ; //TEST
        window.location.href = "https://rjfamily.rajavithi.go.th/RiskReport/index.php/superadmin/index?Screen_Size=" + width ;
    </script>
    <!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------>
<?php } ?>

<div class="site-index">
    <div class="card">
        <div class="card-header">
            <b><i class="fas fa-home" style="color: #000000"></i> HOME : SuperAdmin</b>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-outline-dark btn-sm" onclick="OpenRisk_Details()"><b>การจัดการ : รายละเอียดความเสี่ยง</b></button></li>
        </ul>
    </div>

     <?php if (isset($API_select_rmgrp) && isset($API_select_rmtypegrp) && isset($API_select_rmtype)&& isset($API_select_rmgroup)) { ?>
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
        <?php } ?>
    </div>

</div>











<script type="text/javascript">

    function OpenRisk_Details() { //ตรวจสอบ
        if(document.getElementById('Box_Risk_Details').style.display === 'none'){
            document.getElementById('Box_Risk_Details').style.display = 'table'; // รายละเอียดความเสี่ยง
        }else {
            document.getElementById('Box_Risk_Details').style.display = 'none'; // รายละเอียดความเสี่ยง
        }
    }

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
        $.ajax({
            url: '<?= \yii\helpers\Url::to(['superadmin/searchrmgroup']) ?>',
            type: 'POST',
            data: 'Data_Rmgroup='+data+'&Title_Length=<?=$Title_Length?>'+'&FontS_rm=<?=$FontS_rm?>',
            success: function (data) {
                $('#Box_Incident_Rmgroup').html(data);
            }
        });
    }

    function Check_switch( data ) {
        alert(data);
    }

</script>


<style>

    /* ----------------------------------------------------------------------------------------------------- */
    /* Switches */
    /* The switch - the box around the slider */
    .switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 24px;
    }

    /* Hide default HTML checkbox */
    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    /* The slider */
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ff0100;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 17px;
        width: 17px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #009800;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px rgba(0, 152, 0, 0);
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
    /* ----------------------------------------------------------------------------------------------------- */


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

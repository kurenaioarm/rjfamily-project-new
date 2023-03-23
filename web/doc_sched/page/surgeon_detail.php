<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require('page/webservice_login.php');
$AppointResult = new WsAppointment();
require_once('lib/orroom_api.class.php');
$orClass = new Orroom();
// 22/12/2565
$arrDate = explode("/", $_POST['orDate']);

// print_r($_POST);
//'2022-12-26'
$objListResult = $orClass->queDateSurgeon('EYE', ($arrDate[2] - 543) . '-' . $arrDate[1] . '-' . $arrDate[0], $_SESSION['s_surgeon']);

// print_r($objListResult);
$arrAllRoom = array();
$arrQueueByRoom = array();
foreach ($objListResult->json_data as $key => $queueRow) {
    $arrQueueByRoom[$queueRow->ORROOM][] = $queueRow;
    $arrAllRoom[$queueRow->ORROOM] = $queueRow->NAME;
}
$uniqeRoom = array_unique($arrAllRoom);
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
<section class="section home-feature">
    <div class="container">
        <div class="d-flex justify-content-center" style="flex-direction: column; align-items: center;">
            <h5 class="title"><span class="badge badge-pill badge-dark">คิวห้องผ่าตัด <?php echo $_SESSION['s_surgeon_dsp'] . ' วันที่ ' . $_POST['orDate']; ?></span></h5>
        </div>
        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                    <?php
                    $tabCount = 4;
                    $menuTabCss = 'active';
                    $menuTabAria = 'true';
                    foreach ($uniqeRoom as $key => $roomName) {
                        $pt_count = count($arrQueueByRoom[$key]);
                    ?>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link <?php echo $menuTabCss; ?>" href="" data-toggle="pill" data-target="#tab<?php echo $key; ?>" role="tab" aria-controls="pills-patho" aria-selected="<?php echo $menuTabAria; ?>">
                                <?php echo $roomName; ?>
                                <span class="badge badge-pill badge-warning"><?php echo $pt_count; ?></span>
                            </a>
                        </li>
                    <?php
                        $menuTabCss = '';
                        $menuTabAria = 'false';
                    }
                    ?>
                    <li class="nav-item" role="presentation" style="right:8px; position:absolute">
                        <button class="btn btn-warning" onclick="window.history.go(-1); return false;">
                            << ย้อนกลับ </button>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <?php
                    $strCss = 'show active';
                    foreach ($arrQueueByRoom as $key => $queueInRoom) {
                    ?>
                        <div class="tab-pane fade <?php echo $strCss; ?>" id="tab<?php echo $key; ?>" role="tabpanel" aria-labelledby="pills-<?php echo $key; ?>-tab">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="features-small-item2">
                                        <div class="card-body table-responsive">
                                            <table class="table table-head-fixed" style="">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th><span class="badge badge-pill badge-light">ลำดับการเข้าผ่าตัด</span></th>
                                                        <th><span class="badge badge-pill badge-light">ชื่อ - นามสกุล ผู้ป่วย</span></th>
                                                        <th><span class="badge badge-pill badge-light">Diag</span></th>
                                                        <th><span class="badge badge-pill badge-light">Operation</span></th>
                                                        <th><span class="badge badge-pill badge-light">TIME</span></th>
                                                        <th><span class="badge badge-pill badge-light">หมายเหตุ</span></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach ($queueInRoom as $rowList) {
                                                        $firsRow = true;
                                                        foreach ($rowList->OPERATION as $operList) {
                                                    ?>
                                                            <tr>
                                                                <td style="font-size:75%; text-align: center;">
                                                                    <?php if ($firsRow) { ?>
                                                                        <?php echo $rowList->ORORDER; ?>
                                                                    <?php } ?>
                                                                </td>
                                                                <td style="text-align: center;">
                                                                    <?php if ($firsRow) { ?>
                                                                        <span class="badge badge-pill badge-light text-wrap">
                                                                            <!-- Button trigger modal -->
                                                                            <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#exampleModal" data-hn="<?php echo $rowList->HN; ?>" data-date="<?php echo ($arrDate[2] - 543) . '-' . $arrDate[1] . '-' . $arrDate[0]; ?>" data-varcode="EYE">
                                                                                <?php echo $rowList->PTNAME; ?>
                                                                            </button>
                                                                        </span>
                                                                    <?php } ?>
                                                                </td>
                                                                <td style="font-size:75%; text-align: center;">
                                                                    <?php echo $operList->DIAGNOTE; ?>
                                                                </td>
                                                                <td style="font-size:75%; text-align: center;">
                                                                    <?php echo $operList->OPERNOTE; ?>
                                                                </td>
                                                                <td style="font-size:75%; text-align: center;">
                                                                    <?php
                                                                    if (!is_null($rowList->TF)) {
                                                                        echo 'TF' . $rowList->TF;
                                                                    } else {
                                                                        echo $operList->ESTMTIME;
                                                                    }

                                                                    ?>
                                                                </td>
                                                                <td style="font-size:75%; text-align: center;">
                                                                    <?php echo $operList->PROCNOTE; ?>
                                                                </td>
                                                            </tr>
                                                    <?php
                                                            $firsRow = false;
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="features-small-item22" id="sspt_check">
                                    </div>
                                </div>
                                <!-- ***** Features Small Item End ***** -->
                            </div>
                        </div>
                    <?php
                        $strCss = '';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ***** Features Small End ***** -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card mb-3 border border-success w-100">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img id="img_pt" style="width: inherit;" src="" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <p class="card-text" style="font-weight: bold;">อายุ : <label id="lbl_age" class="lbl_data">55</label></p>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <p class="card-text" style="font-weight: bold;">เพศ : <label id="lbl_gender" class="lbl_data">55</label></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <p class="card-text" style="font-weight: bold;">น้ำหนัก : <label id="lbl_weight" class="lbl_data">55</label></p>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <p class="card-text" style="font-weight: bold;">ส่วนสูง : <label id="lbl_tall" class="lbl_data">55</label></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <p class="card-text" style="font-weight: bold;">เบอร์ติดต่อ : <label id="lbl_tell" class="lbl_data">55</label></p>
                                    </div>
                                </div>
                                <!-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-3 w-100 border border-danger">
                    <div class="card-body">
                        <h5 class="card-title">ASA : <span id="spn_asa" class="badge"></span></h5>
                        <p class="card-text" id="p_asa" style="font-weight: bold;"></p>
                        <h5 class="card-title">ความเสียง
                            <span class="badge badge-danger">มีความเสี่ยง</span>
                            <span class="badge badge-success">ไม่มีความเสี่ยง</span>
                            <span class="badge badge-light">ไม่มีข้อมูล</span>
                        </h5>
                        <p class="card-text" style="font-weight: bold;">D+ :
                            <span id="spn_d" class="badge"></span>
                        </p>
                        <p class="card-text" style="font-weight: bold;">hepatitis :
                            <span id="spn_hepa" class="badge"></span>
                        </p>
                        <p class="card-text" style="font-weight: bold;">ติดเชื้อดื้อยา :
                            <span id="spn_resis" class="badge"></span>
                        </p>
                        <p class="card-text" style="font-weight: bold;">ติดเชื้อโรคระบาด :
                            <span id="spn_pest" class="badge"></span>
                        </p>
                    </div>
                </div>

                <div class="card mb-3 w-100 border border-primary">
                    <div class="card-body">
                        <h5 class="card-title">Nursing Record</h5>
                        <h6 class="card-title">LAB : <span id="spn_lab" class="badge"></span></h6>
                        <p class="card-text" id="p_labnote" style="font-weight: bold;"></p>
                        <h6 class="card-title">NOTE (Specials Preparation) : </h6>
                        <p class="card-text" style="font-weight: bold;" id="h_note"></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>
<?php $inc_script = true; ?>
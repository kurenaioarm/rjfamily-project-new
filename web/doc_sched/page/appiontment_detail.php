<?php
require('page/webservice_login.php');
$AppointResult = new WsAppointment();
$detailApp = $AppointResult->DetailAppointMent(hn_sv($_POST['caLHN']), $_SESSION['TOKEN_ENT']);
$hnt = hn_sv($_POST['caLHN']);
$hnPhoto = $AppointResult->HNPhotos($hnt, $_SESSION['TOKEN_ENT']);
$lablist = $AppointResult->LabLists($_SESSION['TOKEN_ENT'], $hnt);
$patholist = $AppointResult->PathoList($_SESSION['TOKEN_ENT'], $hnt);
isset($_POST['Consultbtn']) ? $btnBack = $_POST['Consultbtn'] : $btnBack = '0';

/**
 * !setting PDPA
 */
$showLab = false;
$showPatho = false;

?>

<!-- ***** Welcome Area Start ***** -->
<!-- <div class="welcome-area" id="welcome"> -->
<div class="content_i">
    <!-- <ul class="nav nav-pills" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" data-target="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Home</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" data-target="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Profile</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" data-target="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</a>
        </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">11...</div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">22...</div>
        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">33...</div>
    </div> -->
    <div class="card">
        <div class="card-header p-2">
            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="pills-visit-tab" href="" data-toggle="pill" data-target="#tab1" role="tab" aria-controls="pills-visit" aria-selected="true">Visit</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="pills-lab-tab" href="" data-toggle="pill" data-target="#tab2" role="tab" aria-controls="pills-lab" aria-selected="false">Lab</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="pills-patho-tab" href="" data-toggle="pill" data-target="#tab3" role="tab" aria-controls="pills-patho" aria-selected="false">Patho</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="pills-visit-tab">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="features-small-item2">
                                <div class="row">
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                        <?php if ($hnPhoto->json_data == null) { ?>
                                            <img src="assets/images/user.jpg" alt="" width="60px">
                                        <?php } else { ?>
                                            <img src="data:image/png;base64,<?= $hnPhoto->json_data; ?>" alt="" width="60px">
                                        <?php } ?>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-8 text-left">
                                        <h6 style="margin-left:8px;"><span class="badge badge-pill badge-light">HN : <?= $_POST['caLHN']; ?></span></h6>
                                        <h6 style="margin-left:8px;"><span class="badge badge-pill badge-light">ชื่อ : <?= $_POST['caLHNNM']; ?></span></h6>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                        <?php if ($btnBack == '1') { ?>
                                            <button type="button" class="btn btn-sm btn-light" onClick="location.href='?p=consult_list'"><i class="fa fa-list"></i></button>
                                        <?php } else { ?>
                                            <button type="button" class="btn btn-sm btn-light" onClick="location.href='?p=sch_calendar'"><i class="fa fa-calendar"></i></button>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="card-body table-responsive" style="height: 200px;margin-left:-5px;">
                                    <table class="table table-head-fixed">
                                        <tr class="text-center">
                                            <th><span class="badge badge-pill badge-light">วันที่ตรวจ</span></th>
                                            <th><span class="badge badge-pill badge-light">หน่วยตรวจ</span></th>
                                        </tr>
                                        <?php foreach ($detailApp->json_data as $value_visit) { ?>
                                            <tr>
                                                <td>
                                                    <button type="submit" name="ovst_data" id="ovst_data<?= $value_visit->NO_OVST; ?>" class="btn btn-sm btn-success"><span class="badge badge-pill badge-success text-wrap"><?= $value_visit->VSTDATE2 . ' ' . $value_visit->VSTTIME2; ?> <i class="fas fa-arrow-alt-circle-down"></i> </span></button>
                                                    <input type="hidden" id="ovst_vn<?= $value_visit->NO_OVST; ?>" name="ovst_vn" class="form-control" value="<?= $value_visit->VN; ?>">
                                                    <input type="hidden" id="ovst_fn<?= $value_visit->NO_OVST; ?>" name="ovst_fn" class="form-control" value="<?= $value_visit->FN; ?>">
                                                    <input type="hidden" id="ovst_vstd<?= $value_visit->NO_OVST; ?>" name="ovst_vstd" class="form-control" value="<?= $value_visit->VSTDATERS; ?>">
                                                    <input type="hidden" id="ovst_vstt<?= $value_visit->NO_OVST; ?>" name="ovst_vstt" class="form-control" value="<?= $value_visit->VSTTIME; ?>">
                                                    <input type="hidden" id="ovst_hn<?= $value_visit->NO_OVST; ?>" name="ovst_hn" class="form-control" value="<?= $value_visit->HN; ?>">
                                                    <input type="hidden" id="ovst_token<?= $value_visit->NO_OVST; ?>" name="ovst_token" class="form-control" value="<?= $_SESSION['TOKEN_ENT']; ?>">
                                                </td>
                                                <td><span class="badge badge-pill badge-light text-wrap"><?= $value_visit->CLINM; ?></span></td>
                                            </tr>
                                        <?php } ?>
                                    </table>
                                </div>
                            </div>
                            <div class="features-small-item22" id="sspt_check">
                            </div>
                        </div>
                        <!-- ***** Features Small Item End ***** -->
                    </div>
                </div>
                <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="pills-lab-tab">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="features-small-item2">
                                <div class="row">
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                        <?php if ($hnPhoto->json_data == null) { ?>
                                            <img src="assets/images/user.jpg" alt="" width="60px">
                                        <?php } else { ?>
                                            <img src="data:image/png;base64,<?= $hnPhoto->json_data; ?>" alt="" width="60px">
                                        <?php } ?>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-8 text-left">
                                        <h6 style="margin-left:8px;"><span class="badge badge-pill badge-light">HN : <?= $_POST['caLHN']; ?></span></h6>
                                        <h6 style="margin-left:8px;"><span class="badge badge-pill badge-light">ชื่อ : <?= $_POST['caLHNNM']; ?></span></h6>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                        <button type="button" class="btn btn-sm btn-light" onClick="location.href='?p=sch_calendar'"><i class="fa fa-calendar"></i></button>
                                    </div>
                                </div>
                                <div class="card-body table-responsive" style="height: 200px;margin-left:-5px;">
                                    <table class="table table-head-fixed">
                                        <tr class="text-center">
                                            <th><span class="badge badge-pill badge-light">วันที่ขอตรวจ</span></th>
                                            <th><span class="badge badge-pill badge-light">ประเภท</span></th>
                                        </tr>
                                        <?php
                                        if ($showLab) {
                                            foreach ($lablist->json_data as $key => $value_lab) {
                                        ?>
                                                <tr>

                                                    <td>
                                                        <?php if ($value_lab->LVSTST == '99') {
                                                            echo $value_lab->RQTDATE2 . ' ' . $value_lab->RQTTIME2;
                                                        } else { ?>
                                                            <button type="submit" name="lvst_data" id="lvst_no<?= $value_lab->NO_LVST; ?>" class="btn btn-sm btn-info"><span class="badge badge-pill badge-info text-wrap"><?= $value_lab->RQTDATE2 . ' ' . $value_lab->RQTTIME2; ?> <i class="fas fa-arrow-alt-circle-down"></i> </span></button>
                                                            <input type="hidden" name="pv" class="form-control" value="lvst">
                                                            <input type="hidden" id="lvst_ln<?= $value_lab->NO_LVST; ?>" name="lvst_ln" class="form-control" value="<?= $value_lab->LN; ?>">
                                                            <input type="hidden" id="lvst_date<?= $value_lab->NO_LVST; ?>" name="lvst_date" class="form-control" value="<?= $value_lab->LVSTDATE3; ?>">
                                                            <input type="hidden" id="lvst_time<?= $value_lab->NO_LVST; ?>" name="lvst_time" class="form-control" value="<?= $value_lab->LVSTTIME; ?>">
                                                            <input type="hidden" id="lvst_hn<?= $value_lab->NO_LVST; ?>" name="lvst_hn" class="form-control" value="<?= $value_lab->HN; ?>">
                                                            <input type="hidden" id="lvst_grp<?= $value_lab->NO_LVST; ?>" name="lvst_grp" class="form-control" value="<?= $value_lab->LABGRP; ?>">
                                                            <input type="hidden" id="lvst_grpno<?= $value_lab->NO_LVST; ?>" name="lvst_grpno" class="form-control" value="<?= $value_lab->GRPNO; ?>">
                                                            <input type="hidden" id="lvst_token<?= $value_lab->NO_LVST; ?>" name="lvst_token" class="form-control" value="<?= $_SESSION['TOKEN_ENT']; ?>">
                                                            <input type="hidden" id="lvst_spcmd<?= $value_lab->NO_LVST; ?>" name="lvst_spcmd" class="form-control" value="<?= $value_lab->SPCMDATE2 . ' ' . $value_lab->SPCMTIME2; ?>">
                                                            <input type="hidden" id="lvst_st<?= $value_lab->NO_LVST; ?>" name="lvst_st" class="form-control" value="<?= $value_lab->LVSTSTNM; ?>">
                                                            <input type="hidden" id="lvst_lct<?= $value_lab->NO_LVST; ?>" name="lvst_lct" class="form-control" value="<?= $value_lab->LCTNM; ?>">
                                                            <input type="hidden" id="lvst_note<?= $value_lab->NO_LVST; ?>" name="lvst_note" class="form-control" value="<?= $value_lab->CMMNTORDER; ?>">
                                                            <input type="hidden" id="lvst_header<?= $value_lab->NO_LVST; ?>" name="lvst_header" class="form-control" value="<?= $value_lab->RQTDATE2 . ' ' . $value_lab->RQTTIME2 . ' ' . $value_lab->LABGRPNM; ?>">
                                                        <?php } ?>
                                                    </td>
                                                    <td class="text-wrap"><span class="badge badge-pill badge-secondary text-wrap"><?= $value_lab->LABGRPNM; ?></span></td>
                                                </tr>
                                        <?php
                                            }
                                        } else {
                                            echo '<tr><td colspan="2" style="text-align: center;">ปิดการแสดงผลชั่วคราว เนื่องจากกฏหมายคุ้มครองข้อมูลส่วนบุคคล</td></tr>';
                                        }
                                        ?>
                                    </table>
                                </div>
                            </div>
                            <div class="features-small-item22" id="sspt_check2">

                            </div>
                        </div>
                        <!-- ***** Features Small Item End ***** -->
                    </div>
                </div>
                <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="pills-patho-tab">
                    <div class="row">

                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="features-small-item2">
                                <div class="row">
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                        <?php if ($hnPhoto->json_data == null) { ?>
                                            <img src="assets/images/user.jpg" alt="" width="60px">
                                        <?php } else { ?>
                                            <img src="data:image/png;base64,<?= $hnPhoto->json_data; ?>" alt="" width="60px">
                                        <?php } ?>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-8 text-left">
                                        <h6 style="margin-left:8px;"><span class="badge badge-pill badge-light">HN : <?= $_POST['caLHN']; ?></span></h6>
                                        <h6 style="margin-left:8px;"><span class="badge badge-pill badge-light">ชื่อ : <?= $_POST['caLHNNM']; ?></span></h6>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                        <button type="button" class="btn btn-sm btn-light" onClick="location.href='?p=sch_calendar'"><i class="fa fa-calendar"></i></button>
                                    </div>

                                </div>

                                <div class="card-body table-responsive" style="height: 200px;margin-left:-5px;">
                                    <table class="table table-head-fixed">
                                        <tr class="text-center">
                                            <th><span class="badge badge-pill badge-light">วันที่ขอตรวจ</span></th>
                                            <th><span class="badge badge-pill badge-light">ประเภท</span></th>
                                        </tr>
                                        <?php
                                        if ($showPatho) {
                                            foreach ($patholist->json_data as $key => $value_patho) {
                                        ?>
                                                <tr>

                                                    <td>
                                                        <button type="submit" name="lptvst_data" id="lptvst_no<?= $value_patho->NO_LPTVST; ?>" class="btn btn-sm btn-warning"><span class="badge badge-pill badge-warning text-wrap"><?= $value_patho->LPTDATE2 . ' ' . $value_patho->LPTTIME2; ?> <i class="fas fa-arrow-alt-circle-down"></i> </span></button>
                                                        <input type="hidden" name="pv" class="form-control" value="lpt">
                                                        <input type="hidden" id="lptvst_pn<?= $value_patho->NO_LPTVST; ?>" name="lptvst_pn" class="form-control" value="<?= $value_patho->PN; ?>">
                                                        <input type="hidden" id="lptvst_date<?= $value_patho->NO_LPTVST; ?>" name="lptvst_date" class="form-control" value="<?= $value_patho->LPTDATE; ?>">
                                                        <input type="hidden" id="lptvst_time<?= $value_patho->NO_LPTVST; ?>" name="lptvst_time" class="form-control" value="<?= $value_patho->LPTTIME; ?>">
                                                        <input type="hidden" id="lptvst_hn<?= $value_patho->NO_LPTVST; ?>" name="lptvst_hn" class="form-control" value="<?= $value_patho->HN; ?>">
                                                        <input type="hidden" id="lptvst_grp<?= $value_patho->NO_LPTVST; ?>" name="lptvst_grp" class="form-control" value="<?= $value_patho->LPTGRP; ?>">
                                                        <input type="hidden" id="lptvst_type<?= $value_patho->NO_LPTVST; ?>" name="lptvst_type" class="form-control" value="<?= $value_patho->LPTTYPE; ?>">
                                                        <input type="hidden" id="lptvst_grpnm<?= $value_patho->NO_LPTVST; ?>" name="lptvst_grpnm" class="form-control" value="<?= $value_patho->LPTGRPNM; ?>">
                                                        <input type="hidden" id="lptvst_typenm<?= $value_patho->NO_LPTVST; ?>" name="lptvst_typenm" class="form-control" value="<?= $value_patho->LPTTYPENM; ?>">
                                                        <input type="hidden" id="lptvst_token<?= $value_patho->NO_LPTVST; ?>" name="lptvst_token" class="form-control" value="<?= $_SESSION['TOKEN_ENT']; ?>">
                                                        <input type="hidden" id="lptvst_spcmd<?= $value_patho->NO_LPTVST; ?>" name="lptvst_spcmd" class="form-control" value="<?= $value_patho->SPCMDATE . ' ' . $value_patho->SPCMTIME; ?>">
                                                        <input type="hidden" id="lptvst_st<?= $value_patho->NO_LPTVST; ?>" name="lptvst_st" class="form-control" value="<?= $value_patho->LPTSTNM; ?>">
                                                        <input type="hidden" id="lptvst_lcts<?= $value_patho->NO_LPTVST; ?>" name="lptvst_lcts" class="form-control" value="<?= $value_patho->LPTRFRLCT; ?>">
                                                        <input type="hidden" id="lptvst_lctl<?= $value_patho->NO_LPTVST; ?>" name="lptvst_lctl" class="form-control" value="<?= $value_patho->LPTRESULTLCT; ?>">
                                                        <input type="hidden" id="lptvst_dct<?= $value_patho->NO_LPTVST; ?>" name="lptvst_dct" class="form-control" value="<?= $value_patho->DCTNM; ?>">
                                                        <input type="hidden" id="lptvst_print<?= $value_patho->NO_LPTVST; ?>" name="lptvst_print" class="form-control" value="<?= $value_patho->REPORTDATE . ' ' . $value_patho->REPORTTIME; ?>">
                                                        <input type="hidden" id="lptvst_header<?= $value_patho->NO_LPTVST; ?>" name="lptvst_header" class="form-control" value="<?= $value_patho->LPTDATE2 . ' ' . $value_patho->LPTTIME2 . ' ' . $value_patho->LPTGRPNM; ?>">

                                                    </td>
                                                    <td class="text-wrap"><span class="badge badge-pill badge-light text-wrap"><?= $value_patho->LPTGRPNM; ?></span></td>
                                                </tr>
                                        <?php
                                            }
                                        } else {
                                            echo '<tr><td colspan="2" style="text-align: center;">ปิดการแสดงผลชั่วคราว เนื่องจากกฏหมายคุ้มครองข้อมูลส่วนบุคคล</td></tr>';
                                        }
                                        ?>
                                    </table>

                                </div>
                            </div>
                            <div class="features-small-item22" id="sspt_check3">

                            </div>
                        </div>
                        <!-- ***** Features Small Item End ***** -->
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- </div> -->
<!-- ***** Welcome Area End ***** -->
<script>
    $(document).ready(function() {
        <?php

        for ($i = 1; $i <= $detailApp->json_total; $i++) {
        ?>

            $("#ovst_data<?= $i; ?>").click(function(e) {
                e.preventDefault();
                var ovst_vn = $("#ovst_vn<?= $i; ?>").val();
                var ovst_fn = $("#ovst_fn<?= $i; ?>").val();
                var ovst_vstd = $("#ovst_vstd<?= $i; ?>").val();
                var ovst_vstt = $("#ovst_vstt<?= $i; ?>").val();
                var ovst_hn = $("#ovst_hn<?= $i; ?>").val();
                var ovst_token = $("#ovst_token<?= $i; ?>").val();
                var dataString = 'ovst_vn=' + ovst_vn + '&ovst_fn=' + ovst_fn + '&ovst_vstd=' + ovst_vstd + '&ovst_vstt=' + ovst_vstt + '&ovst_hn=' + ovst_hn + '&ovst_token=' + ovst_token;
                $.ajax({
                    type: 'POST',
                    data: dataString,
                    url: 'page/ovst_result.php',
                    success: function(data) {
                        $('#sspt_check').html(data);
                    }
                });
            });
        <?php }

        for ($i = 1; $i <= $lablist->json_total; $i++) {
        ?>

            $("#lvst_no<?= $i; ?>").click(function(e) {
                e.preventDefault();
                var lvst_ln = $("#lvst_ln<?= $i; ?>").val();
                var lvst_date = $("#lvst_date<?= $i; ?>").val();
                var lvst_time = $("#lvst_time<?= $i; ?>").val();
                var lvst_hn = $("#lvst_hn<?= $i; ?>").val();
                var lvst_grp = $("#lvst_grp<?= $i; ?>").val();
                var lvst_grpno = $("#lvst_grpno<?= $i; ?>").val();
                var lvst_token = $("#lvst_token<?= $i; ?>").val();
                var lvst_spcmd = $("#lvst_spcmd<?= $i; ?>").val();
                var lvst_st = $("#lvst_st<?= $i; ?>").val();
                var lvst_lct = $("#lvst_lct<?= $i; ?>").val();
                var lvst_note = $("#lvst_note<?= $i; ?>").val();
                var lvst_header = $("#lvst_header<?= $i; ?>").val();
                var dataString = 'lvst_ln=' + lvst_ln + '&lvst_date=' + lvst_date + '&lvst_time=' + lvst_time + '&lvst_hn=' + lvst_hn + '&lvst_grp=' + lvst_grp + '&lvst_grpno=' + lvst_grpno + '&lvst_token=' + lvst_token + '&lvst_spcmd=' + lvst_spcmd + '&lvst_st=' + lvst_st + '&lvst_lct=' + lvst_lct + '&lvst_note=' + lvst_note + '&lvst_header=' + lvst_header;
                $.ajax({
                    type: 'POST',
                    data: dataString,
                    url: 'page/lvst_result.php',
                    success: function(data) {
                        // alert(data);
                        $('#sspt_check2').html(data);
                    }
                });
            });

        <?php
        }


        for ($i = 1; $i <= $patholist->json_total; $i++) {
        ?>

            $("#lptvst_no<?= $i; ?>").click(function(e) {
                e.preventDefault();
                var lptvst_pn = $("#lptvst_pn<?= $i; ?>").val();
                var lptvst_date = $("#lptvst_date<?= $i; ?>").val();
                var lptvst_time = $("#lptvst_time<?= $i; ?>").val();
                var lptvst_hn = $("#lptvst_hn<?= $i; ?>").val();
                var lptvst_grp = $("#lptvst_grp<?= $i; ?>").val();
                var lptvst_type = $("#lptvst_type<?= $i; ?>").val();
                var lptvst_grpnm = $("#lptvst_grpnm<?= $i; ?>").val();
                var lptvst_typenm = $("#lptvst_typenm<?= $i; ?>").val();
                var lptvst_token = $("#lptvst_token<?= $i; ?>").val();
                var lptvst_spcmd = $("#lptvst_spcmd<?= $i; ?>").val();
                var lptvst_st = $("#lptvst_st<?= $i; ?>").val();
                var lptvst_lcts = $("#lptvst_lcts<?= $i; ?>").val();
                var lptvst_lctl = $("#lptvst_lctl<?= $i; ?>").val();
                var lptvst_dct = $("#lptvst_dct<?= $i; ?>").val();
                var lptvst_print = $("#lptvst_print<?= $i; ?>").val();
                var lptvst_header = $("#lptvst_header<?= $i; ?>").val();
                var dataString = 'lptvst_pn=' + lptvst_pn +
                    '&lptvst_date=' + lptvst_date +
                    '&lptvst_time=' + lptvst_time +
                    '&lptvst_hn=' + lptvst_hn +
                    '&lptvst_grp=' + lptvst_grp +
                    '&lptvst_type=' + lptvst_type +
                    '&lptvst_grpnm=' + lptvst_grpnm +
                    '&lptvst_typenm=' + lptvst_typenm +
                    '&lptvst_token=' + lptvst_token +
                    '&lptvst_spcmd=' + lptvst_spcmd +
                    '&lptvst_st=' + lptvst_st +
                    '&lptvst_lcts=' + lptvst_lcts +
                    '&lptvst_lctl=' + lptvst_lctl +
                    '&lptvst_dct=' + lptvst_dct +
                    '&lptvst_print=' + lptvst_print +
                    '&lptvst_header=' + lptvst_header;
                $.ajax({
                    type: 'POST',
                    data: dataString,
                    url: 'page/lpt_result.php',
                    success: function(data) {
                        // alert(data);
                        $('#sspt_check3').html(data);
                    }
                });
            });

        <?php
        }
        ?>
    });
</script>
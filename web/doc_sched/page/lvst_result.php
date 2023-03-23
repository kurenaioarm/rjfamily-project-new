<?php

require('webservice_login.php');
$AppointOvst = new WsAppointment();
$labdetails =   $AppointOvst->LabDetail($_POST['lvst_token'], $_POST['lvst_hn'], $_POST['lvst_grp'], $_POST['lvst_grpno'], $_POST['lvst_date'], $_POST['lvst_time'], $_POST['lvst_ln']);
?>


<div class="card">
    <div class="card-header">
        <?php echo '<span class="badge badge-pill badge-light text-wrap">'.$_POST['lvst_header'].' </span> '; ?>
    </div>
    <div class="card-body table-responsive" >

        <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-6">
                <span class="badge badge-pill badge-primary">LN : </span> <span class="badge badge-pill badge-light text-wrap"><?php echo $_POST['lvst_ln']; ?> </span>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6">
                <span class="badge badge-pill badge-primary">วันที่รับสิ่งส่งตรวจ : </span> <span class="badge badge-pill badge-light text-wrap"> <?php echo $_POST['lvst_spcmd']; ?> </span>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6">
                <span class="badge badge-pill badge-primary">สถานะ : </span> <span class="badge badge-pill badge-light text-wrap">  <?php echo $_POST['lvst_st']; ?> </span>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6">
                <span class="badge badge-pill badge-primary">หน่วยงาน : </span> <span class="badge badge-pill badge-light text-wrap"> <?php echo $_POST['lvst_lct']; ?></span>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6">
                <span class="badge badge-pill badge-primary">วันที่รายงานผล : </span> <span class="badge badge-pill badge-light text-wrap"><?php echo $labdetails->json_data['0']->RSLTDATE2 . ' ' . $labdetails->json_data['0']->RSLTTIME2; ?> </span>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6 text-wrap">
                <span class="badge badge-pill badge-primary">หมายเหตุ : </span> <span class="badge badge-pill badge-light text-wrap">  <?php echo $_POST['lvst_note']; ?></span>
            </div>
           
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="table-responsive">
                    <table class="table table-head-fixed text-nowrap" id="lvstViewdt">
                        <thead>
                            <tr>
                                <th><span class="badge badge-pill badge-light">รายการตรวจ</span></th>
                                <th><span class="badge badge-pill badge-light">ผลตรวจ</span></th>
                                <th><span class="badge badge-pill badge-light">Flag</span></th>
                                <th><span class="badge badge-pill badge-light">ค่าอ้างอิง</span></th>
                                <th><span class="badge badge-pill badge-light">หน่วย</span></th>
                                <th><span class="badge badge-pill badge-light">สิ่งส่งตรวจ</span></th>
                                <th><span class="badge badge-pill badge-light">หมายเหตุ</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($labdetails->json_data as $key => $value_ex) { ?>
                                <tr>
                                    <td><span class="badge badge-pill badge-light text-wrap"><b><?= $value_ex->LABNM; ?></b></span></td>
                                    <td><span class="badge badge-pill badge-warning text-wrap"><?= nl2br($value_ex->RESULT); ?></span></td>
                                    <td>
                                        <?php if ($value_ex->ABNMFLG == 'H') { ?>
                                            <i class="fa fa-arrow-up text-danger"></i>
                                        <?php } elseif ($value_ex->ABNMFLG == 'L') { ?>
                                            <i class="fa fa-arrow-down text-info"></i>
                                        <?php } else {
                                        } ?>
                                    </td>
                                    <td><span class="badge badge-pill badge-light"><?= $value_ex->MINNRM . ' - ' . $value_ex->MAXNRM; ?></span></td>
                                    <td><span class="badge badge-pill badge-light"><?= $value_ex->NRMUNIT; ?></span></td>
                                    <td><span class="badge badge-pill badge-light"><?= $value_ex->LABSPCMNM; ?></span></td>
                                    <td><span class="badge badge-pill badge-light"><?= $value_ex->CMMNTREQTEST; ?></span></td>
                                </tr>

                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</div><!-- /.card -->
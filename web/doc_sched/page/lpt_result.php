<?php
require('webservice_login.php');
$AppointLpt = new WsAppointment();
$listDetail = $AppointLpt->PatholistDetail($_POST['lptvst_token'], $_POST['lptvst_hn'], $_POST['lptvst_date'], $_POST['lptvst_time'], $_POST['lptvst_type'], $_POST['lptvst_grp']);
$DetailResult = $AppointLpt->PathoDetailResult($_POST['lptvst_token'], $_POST['lptvst_hn'], $_POST['lptvst_date'], $_POST['lptvst_time'], $_POST['lptvst_type'], $_POST['lptvst_grp'], $_POST['lptvst_pn']);
// echo $_POST['lptvst_token'].'<br>';
// echo $_POST['lptvst_hn'].'<br>';
// echo $_POST['lptvst_date'].'<br>';
// echo $_POST['lptvst_time'].'<br>';
// echo $_POST['lptvst_type'].'<br>';
// echo $_POST['lptvst_grp'].'<br>';
// echo $_POST['lptvst_pn'].'<br>';
// print_r($DetailResult);
?>
<div class="card">
    <div class="card-header">
        <?php echo '<span class="badge badge-pill badge-light text-wrap">' . $_POST['lptvst_header'] . ' </span> '; ?>
    </div>
    <div class="card-body table-responsive">

        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="table-responsive">
                    <table class="table table-head-fixed text-nowrap" id="lvstViewdt">
                        <thead>
                            <tr>
                                <th><span class="badge badge-pill badge-light">รายการตรวจ</span></th>
                                <th><span class="badge badge-pill badge-light">ประเภทการผ่าตัด</span></th>
                                <th><span class="badge badge-pill badge-light">จำนวน</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listDetail->json_data as $key => $value_lpt) { ?>
                                <tr>
                                    <td><span class="badge badge-pill badge-light text-wrap"><?php echo $value_lpt->LPTEXMNM; ?> </span></td>
                                    <td><span class="badge badge-pill badge-light text-wrap"><?php echo $value_lpt->LPONM; ?> </span></td>
                                    <td><span class="badge badge-pill badge-light text-wrap"><?php echo $value_lpt->QTY; ?> </span></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>


            <div class="col-sm-6 col-md-6 col-lg-6">
                <span class="badge badge-pill badge-warning">NO : </span> <span class="badge badge-pill badge-light text-wrap"><?php echo $_POST['lptvst_pn']; ?> </span>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6">
                <span class="badge badge-pill badge-warning">ประเภทงาน : </span> <span class="badge badge-pill badge-light text-wrap"> <?php echo $_POST['lptvst_grpnm']; ?> </span>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6">
                <span class="badge badge-pill badge-warning">สถานะ : </span> <span class="badge badge-pill badge-light text-wrap"> <?php echo $_POST['lptvst_st']; ?> </span>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6">
                <span class="badge badge-pill badge-warning">เวลารับสิ่งส่งตรวจ : </span> <span class="badge badge-pill badge-light text-wrap"> <?php echo $_POST['lptvst_spcmd']; ?></span>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6">
                <span class="badge badge-pill badge-warning">เวลารายงานผล : </span> <span class="badge badge-pill badge-light text-wrap"> <?php  if($_POST['lptvst_print'] == " "){ echo $DetailResult->json_data['0']->PRINTDATE.' '.$DetailResult->json_data['0']->PRINTTIME; }else{ echo $_POST['lptvst_print']; }   ?></span>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6">
                <span class="badge badge-pill badge-warning">หน่วยงานที่ส่งตรวจ : </span> <span class="badge badge-pill badge-light text-wrap"><?php echo $_POST['lptvst_lcts']; ?> </span>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6 text-wrap">
                <span class="badge badge-pill badge-warning">หน่วยงานที่รับผลตรวจ : </span> <span class="badge badge-pill badge-light text-wrap"> <?php echo $_POST['lptvst_lctl']; ?></span>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6 text-wrap">
                <span class="badge badge-pill badge-warning">แพทย์ผู้รักษา : </span> <span class="badge badge-pill badge-light text-wrap"> <?php echo $_POST['lptvst_dct']; ?></span>
            </div>

            <?php if ($_POST['lptvst_type'] == '1' || $_POST['lptvst_type'] == '2' || $_POST['lptvst_type'] == '5' || $_POST['lptvst_type'] == '7' || $_POST['lptvst_type'] == '8' || $_POST['lptvst_type'] == '9'  || $_POST['lptvst_type'] == '10') {
                $DetailResult->json_data['0']->GROSSDESC == "" ? $GROSSDESC = $DetailResult->json_data['1']->GROSSDESC : $GROSSDESC = $DetailResult->json_data['0']->GROSSDESC;
                $DetailResult->json_data['0']->GROSSDESC1 == "" ? $GROSSDESC1 = $DetailResult->json_data['1']->GROSSDESC1 : $GROSSDESC1 = $DetailResult->json_data['0']->GROSSDESC1;
                $DetailResult->json_data['0']->DIAGDESC == "" ? $DIAGDESC = $DetailResult->json_data['1']->DIAGDESC : $DIAGDESC = $DetailResult->json_data['0']->DIAGDESC;
                $DetailResult->json_data['0']->MICRODESC == "" ? $MICRODESC = $DetailResult->json_data['1']->MICRODESC : $MICRODESC = $DetailResult->json_data['0']->MICRODESC;
                $DetailResult->json_data['0']->NOTE == "" ? $NOTE = $DetailResult->json_data['1']->NOTE : $NOTE = $DetailResult->json_data['0']->NOTE;
            ?>
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <hr />
                    <span class="badge badge-pill badge-warning">GROSS DESCRIPTION : </span> <span class="badge badge-pill badge-light text-wrap" style="text-align:left;"><?php echo nl2br($GROSSDESC) . '<br>' . $GROSSDESC1; ?> </span>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <hr />
                    <span class="badge badge-pill badge-warning">PATHOLOGICAL DIAGNOSIS : </span> <span class="badge badge-pill badge-light text-wrap" style="text-align:left;"><?php echo nl2br($DIAGDESC); ?> </span>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <hr />
                    <span class="badge badge-pill badge-warning">MICROSCOPIC DESCRIPTION : </span> <span class="badge badge-pill badge-light text-wrap" style="text-align:left;"><?php echo nl2br($MICRODESC); ?> </span>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <hr />
                    <span class="badge badge-pill badge-warning">NOTE : </span> <span class="badge badge-pill badge-light text-wrap" style="text-align:left;"><?php echo nl2br($NOTE); ?> </span>
                </div>
            <?php } elseif ($_POST['lptvst_type'] == '3' || $_POST['lptvst_type'] == '6') { ?>
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <hr />
                    <span class="badge badge-pill badge-warning">Test Method : </span> <span class="badge badge-pill badge-light text-wrap" style="text-align:left;"> <?php echo $listDetail->json_data['0']->LPTEXMNM; ?> </span>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <hr />
                    <span class="badge badge-pill badge-warning">Source : </span> <span class="badge badge-pill badge-light text-wrap" style="text-align:left;"> <?php if($DetailResult->json_data['0']->SPECIMENTP == ""){ echo $listDetail->json_data['0']->LPONM; }else{ echo $DetailResult->json_data['0']->SPECIMENTP; } ?> </span>
                </div>

                <?php if ($_POST['lptvst_type'] == '3') { ?>
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <hr />
                        <span class="badge badge-pill badge-warning">Specimen Adequacy : </span> <span class="badge badge-pill badge-light text-wrap" style="text-align:left;"> <?php echo nl2br($DetailResult->json_data['0']->ADQCYNM); ?> </span>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <hr />
                        <span class="badge badge-pill badge-warning">General Categorization : </span> <span class="badge badge-pill badge-light text-wrap" style="text-align:left;">  <?php echo nl2br($DetailResult->json_data['0']->CATGZTIONM); ?></span>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <hr />
                        <span class="badge badge-pill badge-warning">Interpretation / Result : </span> <span class="badge badge-pill badge-light text-wrap" style="text-align:left;">  <?php echo nl2br($DetailResult->json_data['0']->RESULTTEXT); ?></span>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <hr />
                        <span class="badge badge-pill badge-warning">Comment: </span> <span class="badge badge-pill badge-light text-wrap" style="text-align:left;"> <?php echo nl2br($DetailResult->json_data['0']->COMMENTTEXT); ?></span>
                    </div>
                <?php } elseif ($_POST['lptvst_type'] == '6') { ?>

                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <hr />
                        <span class="badge badge-pill badge-warning">Specimen : </span> <span class="badge badge-pill badge-light text-wrap" style="text-align:left;"> <?php echo $DetailResult->json_data['0']->SPECIMENTP; ?> </span>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <hr />
                        <span class="badge badge-pill badge-warning">Result : </span> <br>
                        <span class="badge badge-pill badge-light text-wrap" style="text-align:left;"> <i class="fa fa-<?=$DetailResult->json_data['0']->NONDETECTED == '1' ?'check-square':'square';?>"></i> Nondetected </span><br>

                        <span class="badge badge-pill badge-light text-wrap" style="text-align:left;"><i class="fa fa-<?=$DetailResult->json_data['0']->HPVNON == '1' ?'check-square':'square';?>"></i> for HPV DNA non 32 genotype </span><br>
                        <span class="badge badge-pill badge-light text-wrap" style="text-align:left;"> <?=$DetailResult->json_data['0']->HPVNON == '1' ? $DetailResult->json_data['0']->HPVNONTXT :'';?> </span><br>

                        <span class="badge badge-pill badge-light text-wrap" style="text-align:left;"> <i class="fa fa-<?=$DetailResult->json_data['0']->HPVHIGH == '1' ?'check-square':'square';?>"></i> Positive for HPV DNA High Risk type</span><br>
                        <span class="badge badge-pill badge-light text-wrap" style="text-align:left;"> <?=$DetailResult->json_data['0']->HPVHIGH == '1' ? $DetailResult->json_data['0']->HPVHIGHTXT :'';?> </span><br>

                        <span class="badge badge-pill badge-light text-wrap" style="text-align:left;"> <i class="fa fa-<?=$DetailResult->json_data['0']->HPVLOW == '1' ?'check-square':'square';?>"></i> Positive for HPV DNA Low Risk type </span><br>
                        <span class="badge badge-pill badge-light text-wrap" style="text-align:left;"> <?=$DetailResult->json_data['0']->HPVLOW == '1' ? $DetailResult->json_data['0']->HPVLOWTXT :'';?> </span><br>
                    </div>


                <?php } ?>

            <?php } elseif ($_POST['lptvst_type'] == '4') { ?>
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <hr />
                    <span class="badge badge-pill badge-warning">SPECIMEN TYPE : </span> <span class="badge badge-pill badge-light text-wrap" style="text-align:left;"><?php echo nl2br($DetailResult->json_data['0']->SPCMTYPETEXT); ?> </span>
                </div>

                <div class="col-sm-6 col-md-6 col-lg-6">
                    <hr />
                    <span class="badge badge-pill badge-warning">MICROSCOPIC DESCRIPTION : </span> <span class="badge badge-pill badge-light text-wrap" style="text-align:left;"><?php echo nl2br($DetailResult->json_data['0']->MICROTEXT); ?> </span>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <hr />
                    <span class="badge badge-pill badge-warning">CYTOLOGICAL DIAGNOSIS : </span> <span class="badge badge-pill badge-light text-wrap" style="text-align:left;"><?php echo nl2br($DetailResult->json_data['0']->IMPRESTEXT); ?> </span>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <hr />
                    <span class="badge badge-pill badge-warning">RECOMENDATION : </span> <span class="badge badge-pill badge-light text-wrap" style="text-align:left;"><?php echo nl2br($DetailResult->json_data['0']->RECOMDTEXT); ?> </span>
                </div>

            <?php  } ?>


        </div>

    </div>

</div><!-- /.card -->
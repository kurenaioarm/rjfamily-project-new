<?php

require('webservice_login.php');
$AppointOvst = new WsAppointment();

$Resultovst = $AppointOvst->OvstResultHN($_POST['ovst_token'], $_POST['ovst_hn'], $_POST['ovst_vn'], $_POST['ovst_fn'], $_POST['ovst_vstd'], $_POST['ovst_vstt']);
//print_r($Resultovst);
?>


<div class="card">
    <div class="card-header">
        <h6 class="card-title text-center">
             <span class="badge badge-pill badge-light text-wrap"><?php echo $Resultovst->json_data['0']->VSTDATE2 . ' ' . $Resultovst->json_data['0']->VSTTIME2 . '<br>' . $Resultovst->json_data['0']->CLINM; ?> </span>
        </h6>
    </div>
    <div class="card-body table-responsive" >
        <!-- <div class="tab-content"> -->

        <!-- <div class="active tab-pane" id="tab1"> -->

        <div class="callout callout-warning">
            <div class="form-group row">
                <div class="col-sm-12 text-left">
                    <h5><span class="badge badge-pill badge-warning"><i class="far fa-arrow-alt-circle-right"></i> Chief Complaint: </span> </h5>
                    <span><b class="text-dark"> <?php echo nl2br($Resultovst->json_data['0']->CCP); ?> </b></span>
                    <hr />
                </div>

                <div class="col-sm-12 text-left">
                    <h5><span class="badge badge-pill badge-warning"><i class="far fa-arrow-alt-circle-right"></i> Vital Signs: </span> </h5>
                    <span>
                        <b class="text-dark">
                            Temp. <?php echo $Resultovst->json_data['0']->BT . ' °C'; ?> ,PR. <?php echo $Resultovst->json_data['0']->PR; ?> /min , RR. <?php echo $Resultovst->json_data['0']->RR; ?> /min , BW. <?php echo $Resultovst->json_data['0']->WEIGHT; ?> Kgs. , HT.
                            <?php echo $Resultovst->json_data['0']->HEIGHT; ?> Cm. ,BMI. <?php echo $Resultovst->json_data['0']->BMI; ?> , BP. <?php echo $Resultovst->json_data['0']->HBPN; ?> / <?php echo $Resultovst->json_data['0']->LBPN; ?> mmHg.
                        </b>
                    </span>
                    <hr />
                </div>


                <div class="col-sm-12 text-left">
                    <h5><span class="badge badge-pill badge-warning"><i class="far fa-arrow-alt-circle-right"></i> ผลวินิจฉัย: </span> </h5>
                    <span>
                        <?php

                        echo nl2br($Resultovst->json_data['0']->DIAG);
                        echo '<hr/>';
                        echo nl2br($Resultovst->json_data['0']->DIAGSTAT);

                        ?>

                    </span>
                    <hr />
                </div>


                <div class="col-sm-12 text-left">
                    <h5><span class="badge badge-pill badge-warning"><i class="far fa-arrow-alt-circle-right"></i> คำสั่งแพทย์: </span> </h5>
                    <span>
                        <?php
                        if ($Resultovst->json_data['0']->INSTRUCTIVE == '1') {
                            echo '- ให้คำแนะนำ+รับยา ,ไม่นัดตรวจติดตามผล <br>';
                        } else {
                        }
                        if ($Resultovst->json_data['0']->FLUPANDLAB == '1') {
                            echo '- นัดตรวจติดตามการรักษา พร้อมผลเลือด/รังสี ' . $Resultovst->json_data['0']->FLUPANDLABDTL . '<br>';
                        } else {
                        }
                        if ($Resultovst->json_data['0']->FLUPNOTLAB == '1') {
                            echo '- นัดตรวจติดตามการรักษา ไม่ส่งตรวจเลือด/รังสี ' . $Resultovst->json_data['0']->FLUPNOTLABDTL . '<br>';
                        } else {
                        }
                        if ($Resultovst->json_data['0']->FLDRUG == '1') {
                            echo '- นัดรับยาเดิม(ต่อเนื่อง) <br>';
                        } else {
                        }
                        if ($Resultovst->json_data['0']->CONSULT == '1') {
                            echo '- ส่งปรึกษาระหว่างแผนก ' . ' ' . $Resultovst->json_data['0']->LCTNM . ' ' . $Resultovst->json_data['0']->DCTNM . '<br>';
                        } else {
                        }
                        if ($Resultovst->json_data['0']->ADMITHPTFLG == '1') {
                            echo '- admit รพ. ' . $Resultovst->json_data['0']->ADMITHPT . ' <br>- นัดมา admit เพื่อ' . $Resultovst->json_data['0']->ADMITOBJ . ' ในวันที่ ' . $Resultovst->json_data['0']->ADMITDATE2 . '<br>';
                        } else {
                        }
                        if ($Resultovst->json_data['0']->OPRTACTFLG == '1') {
                            echo '- สั่งทำหัตถการ/นัดทำหัตถการ ' . $Resultovst->json_data['0']->OPRTACT . '<br>';
                        } else {
                        }
                        if ($Resultovst->json_data['0']->OTHFLG == '1') {
                            echo '- อื่นๆ ' . $Resultovst->json_data['0']->OTHDETAIL . '<br>';
                        } else {
                        }

                        ?>
                    </span>
                    <hr />
                </div>


                <div class="col-sm-12 text-left">
                    <h5><span class="badge badge-pill badge-warning"><i class="far fa-arrow-alt-circle-right"></i> สั่งยา: </span> </h5>
                    <table class="table table-responsive" width="100%">
                        <tr>
                            <td><?= nl2br($Resultovst->json_data['0']->SP_MED); ?></td>
                            <td><?= nl2br($Resultovst->json_data['0']->SP_QTY); ?></td>
                            <td><?= nl2br($Resultovst->json_data['0']->SP_MEDUSE); ?></td>
                        </tr>
                    </table>
                    <hr />
                </div>


                <div class="col-sm-12 text-left">
                    <h5><span class="badge badge-pill badge-warning"><i class="far fa-arrow-alt-circle-right"></i> ส่งชันสูตร: </span> </h5>
                    <span>
                        <?php

                        echo nl2br($Resultovst->json_data['0']->LAB) . '<hr/>';
                        echo nl2br($Resultovst->json_data['0']->CULTURE) . '<hr/>';
                        echo nl2br($Resultovst->json_data['0']->PATHO) . '<hr/>';

                        ?>
                    </span>
                </div>
                <hr />
                <div class="col-sm-12 text-left">
                    <h5><span class="badge badge-pill badge-warning"><i class="far fa-arrow-alt-circle-right"></i> ส่งรังสี: </span> </h5>
                    <span>
                        <?php
                        echo nl2br($Resultovst->json_data['0']->RDO);

                        ?>
                    </span>
                    <hr />
                </div>

                <div class="col-sm-12 text-left">
                    <h5><span class="badge badge-pill badge-warning"><i class="far fa-arrow-alt-circle-right"></i> ข้อมูลนัด: </span> </h5>
                    <span>
                        <?php
                        echo nl2br($Resultovst->json_data['0']->OAPP);

                        ?>
                    </span>
                    <hr />
                </div>



            </div>
        </div>




    </div>

</div><!-- /.card -->
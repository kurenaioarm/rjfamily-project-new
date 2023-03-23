<?php
    use common\widgets\Alert;
?>
<?= Alert::widget() ?>
<?php
if (isset($API_select_rmgrp) && isset($API_select_rmtypegrp) && isset($API_select_rmtype)&& isset($API_select_rmgroup)&& isset($Group_Check)){

    if($Group_Check == "1st_Floor"){
        $RMGRP_Status_DT = "table";
        $RMGRP_Status_DN = "none";
        $RMTYPEGRP_Status_DT = "table";
        $RMTYPEGRP_Status_DN = "none";
    }else if($Group_Check == "2st_Floor"){
        $RMGRP_Status_DT = "none";
        $RMGRP_Status_DN = "table";
        $RMTYPEGRP_Status_DT = "table";
        $RMTYPEGRP_Status_DN = "none";
    }else if($Group_Check == "3st_Floor"){
        $RMGRP_Status_DT = "none";
        $RMGRP_Status_DN = "table";
        $RMTYPEGRP_Status_DT = "none";
        $RMTYPEGRP_Status_DN = "table";
    }else{
        $RMGRP_Status_DT = "table";
        $RMGRP_Status_DN = "none";
        $RMTYPEGRP_Status_DT = "table";
        $RMTYPEGRP_Status_DN = "none";
    } ?>

    <?php if($API_select_rmgroup->json_result == true ){
        foreach ($API_select_rmgrp->json_data as $data_rmgrp){ //วนrmgrp ?>

            <div id="t_rmgrp_<?php echo $data_rmgrp->RMGRP ?>" name="t_rmgrp" style="display:<?php echo $RMGRP_Status_DT; ?>">
                <b onclick="ShowRmtypegrpTable('none',<?php echo $data_rmgrp->RMGRP ?>)"  style="color: #0200ee"><i class="fas fa-plus-square" style="color: #00b3ee"></i> <?php echo $data_rmgrp->NAMEGRP ?> </b>
            </div>

            <div id="n_rmgrp_<?php echo $data_rmgrp->RMGRP ?>" name="n_rmgrp" style="display:<?php echo $RMGRP_Status_DN; ?>">
                <b onclick="ShowRmtypegrpTable('table',<?php echo $data_rmgrp->RMGRP ?>)"  style="color: #0200ee"><i class="fas fa-minus-square" style="color: #00b3ee"></i> <?php echo $data_rmgrp->NAMEGRP ?> </b>

                <?php foreach ($API_select_rmtypegrp->json_data as $data_rmtypegrp) { //วนrmtypegrp ?>
                    <?php if($data_rmtypegrp->RMGRP == $data_rmgrp->RMGRP){ ?>

                        <div id="t_rmtypegrp_<?php echo $data_rmtypegrp->RMTYPEGRP ?>" name="t_rmtypegrp" style="display:<?php echo $RMTYPEGRP_Status_DT; ?>">
                            &nbsp; &nbsp;&nbsp; &nbsp;<b onclick="ShowRmtypeTable('none',<?php echo $data_rmtypegrp->RMTYPEGRP ?>)" style="color: #ee0072"><i class="fas fa-plus-square" style="color: #ee2587"></i> <?php echo $data_rmtypegrp->NAMETYPEGRP ?> </b>
                        </div>

                        <div id="n_rmtypegrp_<?php echo $data_rmtypegrp->RMTYPEGRP ?>" name="n_rmtypegrp" style="display:<?php echo $RMTYPEGRP_Status_DN; ?>">
                            &nbsp; &nbsp;&nbsp; &nbsp;<b onclick="ShowRmtypeTable('table',<?php echo $data_rmtypegrp->RMTYPEGRP ?>)" style="color: #ee0072"><i class="fas fa-minus-square" style="color: #ee4d66"></i> <?php echo $data_rmtypegrp->NAMETYPEGRP ?> </b>
                            <?php foreach ($API_select_rmtype->json_data as $data_rmtype) { //วนrmtype ?>
                                <?php if($data_rmtypegrp->RMTYPEGRP == $data_rmtype->RMTYPEGRP){ ?>
                                    <?php if($data_rmtype->CENTINIAL == "1") { ?>
                                        <div class="form-check">
                                            <label class="form-check-label ">
                                                &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;<input type="radio" class="form-check-input bg-danger" name="RadiosRMTYPE" value="<?php echo $data_rmtype->RMTYPE ?>-<?php echo $data_rmtype->VARCODE ?>-<?php echo $data_rmtype->RMLEVELDTL ?>" onclick="Check_RMLEVELDTL( this.value )" required>
                                                <b style="color: #ff0b00"><u><?php echo $data_rmtype->NAMETYPE ?></u></b>
                                            </label>
                                        </div>
                                    <?php }else {  ?>
                                        <div class="form-check">
                                            <label class="form-check-label ">
                                                &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;<input type="radio" class="form-check-input " name="RadiosRMTYPE" value="<?php echo $data_rmtype->RMTYPE ?>-<?php echo $data_rmtype->VARCODE ?>-<?php echo $data_rmtype->RMLEVELDTL ?>" onclick="Check_RMLEVELDTL( this.value )" required>
                                                <b style="color: #00536e"><?php echo $data_rmtype->NAMETYPE ?> </b>
                                            </label>
                                        </div>
                                    <?php }
                                }
                            }
                            ?>
                        </div>
                    <?php }
                }?>
            </div>
            <?php
        }
    }else{
        Yii::$app->session->setFlash('error', 'หมดเวลาการเข้าใช้งาน <br> กรุณา Login ใหม่อีกครั้ง');
        return $this->redirect(['login/login_his']);
    }
}
?>
<br>
<?php if (isset($Title_Length) && isset($FontS_rm)){ ?>

    <div  class="input-group mb-3" id="n_Note_oth" style="display:none">
        <div class="input-group-prepend">
            <span class="input-group-text btn btn-primary" style="<?php echo $Title_Length ?>;<?php echo $FontS_rm ?>;"><b style="color: #ffffff;">อื่นๆ (ระบุ)</b></span>
        </div>
        <input type="text" class="form-control" name="Note_oth" id="Note_oth" placeholder="กรุณาระบุ รายละเอียดความเสี่ยง" autocomplete = "off" required onchange="CheckDate_ALL()">
    </div>

<?php } ?>

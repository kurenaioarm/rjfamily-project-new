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

            <div id="t_rmgrp_<?php echo $data_rmgrp->RMGRP ?>" name="t_rmgrp" style="display:<?php echo $RMGRP_Status_DT; ?>;width:100%;">
                <div class="row">
                    <div class="col-sm-7">
                        <b onclick="ShowRmtypegrpTable('none',<?php echo $data_rmgrp->RMGRP ?>)"  style="color: #0200ee"><i class="fas fa-plus-square" style="color: #00b3ee"></i> <?php echo $data_rmgrp->NAMEGRP ?> </b>
                    </div>
                    <div class="col-sm-2">
                        <!-- Rounded switch -->
                        <?php if($data_rmgrp->CRMGRP == null){ ?>
                            <label class="switch">
                                <input type="checkbox" value="<?php echo $data_rmgrp->RMGRP ?>" onclick="Check_switch( this.value )" checked>
                                <span class="slider round"></span>
                            </label>
                        <?php }else {  ?>
                            <label class="switch">
                                <input type="checkbox" value="<?php echo $data_rmgrp->RMGRP ?>" onclick="Check_switch( this.value )" >
                                <span class="slider round"></span>
                            </label>
                        <?php }?>
                    </div>
                    <div class="col-sm-3">.col-sm-4</div>
                </div>
            </div>

            <div id="n_rmgrp_<?php echo $data_rmgrp->RMGRP ?>" name="n_rmgrp" style="display:<?php echo $RMGRP_Status_DN; ?>;width:100%;">
                <div class="row">
                    <div class="col-sm-7">
                        <b onclick="ShowRmtypegrpTable('table',<?php echo $data_rmgrp->RMGRP ?>)"  style="color: #0200ee"><i class="fas fa-minus-square" style="color: #00b3ee"></i> <?php echo $data_rmgrp->NAMEGRP ?> </b>
                    </div>
                    <div class="col-sm-2"></div>
                    <div class="col-sm-3"></div>
                </div>

                <?php foreach ($API_select_rmtypegrp->json_data as $data_rmtypegrp) { //วนrmtypegrp ?>
                    <?php if($data_rmtypegrp->RMGRP == $data_rmgrp->RMGRP){ ?>

                        <div id="t_rmtypegrp_<?php echo $data_rmtypegrp->RMTYPEGRP ?>" name="t_rmtypegrp" style="display:<?php echo $RMTYPEGRP_Status_DT; ?>;width:100%;">
                            <div class="row">
                                <div class="col-sm-7">
                                    &nbsp; &nbsp;&nbsp; &nbsp;<b onclick="ShowRmtypeTable('none',<?php echo $data_rmtypegrp->RMTYPEGRP ?>)" style="color: #ee0072"><i class="fas fa-plus-square" style="color: #ee2587"></i> <?php echo $data_rmtypegrp->NAMETYPEGRP ?> </b>
                                </div>
                                <div class="col-sm-2">
                                    <!-- Rounded switch -->
                                    <?php if($data_rmtypegrp->CRMTYPEGRP == null){ ?>
                                        <label class="switch">
                                            <input type="checkbox" value="<?php echo $data_rmtypegrp->RMTYPEGRP ?>" onclick="Check_switch( this.value )" checked>
                                            <span class="slider round"></span>
                                        </label>
                                    <?php }else {  ?>
                                        <label class="switch">
                                            <input type="checkbox" value="<?php echo $data_rmtypegrp->RMTYPEGRP ?>" onclick="Check_switch( this.value )">
                                            <span class="slider round"></span>
                                        </label>
                                    <?php }?>
                                </div>
                                <div class="col-sm-3">.col-sm-4</div>
                            </div>
                        </div>

                        <div id="n_rmtypegrp_<?php echo $data_rmtypegrp->RMTYPEGRP ?>" name="n_rmtypegrp" style="display:<?php echo $RMTYPEGRP_Status_DN; ?>;width:100%;">
                            <div class="row">
                                <div class="col-sm-7">
                                    &nbsp; &nbsp;&nbsp; &nbsp;<b onclick="ShowRmtypeTable('table',<?php echo $data_rmtypegrp->RMTYPEGRP ?>)" style="color: #ee0072"><i class="fas fa-minus-square" style="color: #ee4d66"></i> <?php echo $data_rmtypegrp->NAMETYPEGRP ?> </b>
                                </div>
                                <div class="col-sm-2"></div>
                                <div class="col-sm-3"></div>
                            </div>

                            <?php foreach ($API_select_rmtype->json_data as $data_rmtype) { //วนrmtype ?>
                                <?php if($data_rmtypegrp->RMTYPEGRP == $data_rmtype->RMTYPEGRP){ ?>
                                    <?php if($data_rmtype->CENTINIAL == "1") { ?>
                                        <div class="form-check">
                                            <div class="row">
                                                <div class="col-sm-8">
                                                    &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;<b style="color: #ff0b00"><u><?php echo $data_rmtype->NAMETYPE ?></u></b>
                                                </div>

                                                <div class="col-sm-1">
                                                    <!-- Rounded switch -->
                                                    <?php if($data_rmtype->CRMTYPE == null){ ?>
                                                        <label class="switch">
                                                            <input type="checkbox" value="<?php echo $data_rmtype->RMTYPE ?>" onclick="Check_switch( this.value )" checked>
                                                            <span class="slider round"></span>
                                                        </label>
                                                    <?php }else {  ?>
                                                        <label class="switch">
                                                            <input type="checkbox" value="<?php echo $data_rmtype->RMTYPE ?>" onclick="Check_switch( this.value )">
                                                            <span class="slider round"></span>
                                                        </label>
                                                    <?php }?>
                                                </div>
                                                <div class="col-sm-3">.col-sm-4</div>
                                            </div>
                                        </div>
                                    <?php }else {  ?>
                                        <div class="form-check">
                                            <div class="row">
                                                <div class="col-sm-8">
                                                    &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;<b style="color: #00536e"><?php echo $data_rmtype->NAMETYPE ?> </b>
                                                </div>
                                                <div class="col-sm-1">
                                                    <!-- Rounded switch -->
                                                    <?php if($data_rmtype->CRMTYPE == null){ ?>
                                                        <label class="switch">
                                                            <input type="checkbox" value="<?php echo $data_rmtype->RMTYPE ?>" onclick="Check_switch( this.value )" checked>
                                                            <span class="slider round"></span>
                                                        </label>
                                                    <?php }else {  ?>
                                                        <label class="switch">
                                                            <input type="checkbox" value="<?php echo $data_rmtype->RMTYPE ?>" onclick="Check_switch( this.value )">
                                                            <span class="slider round"></span>
                                                        </label>
                                                    <?php }?>
                                                </div>
                                                <div class="col-sm-3">.col-sm-4</div>
                                            </div>
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


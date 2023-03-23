<?php
if (isset($API_select_rmleveldtl)&& isset($FontS_rm)&& isset($RMLEVELDTL)){ ?>
    <?php if($API_select_rmleveldtl->json_result == true ){  ?>
        <?php if($API_select_rmleveldtl->json_data != [] ){  ?>
            <div class="table-responsive">
                <table>
                    <tbody>
                    <tr class="btn-info">
                        <th class="border border-info" style="color:yellow; <?php echo $FontS_rm ?>;">  <b><u>คำแนะนำในการให้คะแนนระดับความรุนแรง</u></b></th>
                        <th> </th>
                    </tr>
                    <tr style="background: -webkit-linear-gradient(45deg, #393939,#393939);">
                        <?php if($RMLEVELDTL == "100"){ ?>
                            <th style="color:white; <?php echo $FontS_rm ?>;"><b>Clinic ระดับความรุนแรง</b></th>
                        <?php }else{ ?>
                            <th style="color:white; <?php echo $FontS_rm ?>;"><b>Non Clinic ระดับความรุนแรง</b></th>
                        <?php } ?>
                        <th style="color:white; <?php echo $FontS_rm ?>;"><b>ผลกระทบ</b></th>
                    </tr>
                    <?php  foreach ($API_select_rmleveldtl->json_data as $data_rmleveldtl){ //วนrmgrp ?>
                    <tr onMouseover="this.style.backgroundColor='#95f4f1';  this.style.color = '#00536e'; " onMouseout="this.style.backgroundColor='';  this.style.color = '';">
                        <td class="text-nowrap">
                            <label class="form-check-label" style="float:left;">
                                &nbsp; &nbsp;&nbsp; &nbsp;<input type="radio" class="form-check-input " name="RMLEVEL"  value="<?php echo $data_rmleveldtl->RMLEVEL ?>" onclick="Rm_Level_Succes()" required>
                                <b><?php echo $data_rmleveldtl->RMLEVEL ?></b>&nbsp; &nbsp;<?php echo $data_rmleveldtl->NAME ?>
                            </label>
                        </td>
                        <td class="text-nowrap"><b><?php echo $data_rmleveldtl->FREQDTL ?></b></td>
                        <?php } ?>
                    </tr>
                    <tr class="btn-info" >
                        <th class="border border-info" style="color:#f7f7f7; <?php echo $FontS_rm ?>;">*** <b><u>หมายเหตุ</u></b>&nbsp;&nbsp;<b>การใช้ระดับความรุนแรงจะใช้รูปแบบ A - I แล้วแต่ความเหมาะสม แต่จะต้องใส่ระดับความรุนแรง</b></th>
                        <th> </th>
                    </tr>
                    </tbody>
                </table>
            </div>
        <?php } ?>
    <?php }else{
        Yii::$app->session->setFlash('error', 'หมดเวลาการเข้าใช้งาน <br> กรุณา Login ใหม่อีกครั้ง');
        return $this->redirect(['login/login_his']);
    } ?>
<?php } ?>
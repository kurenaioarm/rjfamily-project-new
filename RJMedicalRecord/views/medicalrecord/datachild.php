<?php

/* @var $this yii\web\View */
use common\widgets\Alert;
use yii\widgets\ActiveForm;
use kartik\daterange\DateRangePicker;
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

    body {
        background-color: #ffffff;
    }
</style>
<div id="overlay"></div>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------>



<?php if (isset($Check_Privilege) && isset($Check_Length)) { if($Check_Privilege == "0" || $Check_Privilege == "2"){ ?>
    <?php if($Check_Length >= 800 ){ ?>
        <?php
        if($Check_Length >= 1500){
            $Font_S = " ";
            $Height_T = "height:0px;";
        }else{
            $Font_S = "font-size: 12px;";
            $Height_T = " height:20px;";
        }
        ?>

        <div class="main-contain">
        <!---------Alert----------->
        <?= Alert::widget() ?>
        <?php $form = ActiveForm::begin(); ?>
        <?php  if (isset($HN_MUM) && isset($AN_MUM) && isset($CARDNO_MUM)  && isset($ADMIT_DATETH) && isset($Data_Children)
            && isset($BRTHDATE_CHILDREN) && isset($EDCMOM) && isset($Data_labmom) && isset($Data_labmom2)  && isset($Data_brthsignmed)
            && isset($Data_mthds)  && isset($Data_previousOB) && isset($Data_presentOB) && isset($Data_dlvstdtapgar) ){ ?>
            <div class="container-fluid" style="border: 4px solid rgba(0,0,0,0);">
                <div class="row">
                    <div class="col-12" style="border: 2px solid rgba(0,0,0,0);">
                        <table>
                            <tr>
                                <th colspan="3" style="background-color: #00bfff;color: black">
                                    <h1><b style="color: black">Form -27 + Delivery</b></h1>
                                </th>
                            </tr>
                            <tr style="background-color: #baeeff;">
                                <td style="width: 33%;text-align: left;"><br>
                                    <div class="row">
                                        <div>
                                            <label>
                                                <h5  style="<?php echo $Font_S;?>"><b style="color: #0200ff">RAJAVITHI HN :</b></h5>
                                            </label>
                                            <label>
                                                <?= $form->field($model, 'HN_RJ')->textInput(['autofocus' => true , 'id' => 'HN_RJ' , 'value' => $Data_Children[0]->HN_CHILDREN , 'placeholder' => 'HN RJ' , 'maxlength' => '13' , 'autocomplete' => 'off', 'disabled' => true ])->label(false) ?>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div>
                                            <label>
                                                <h5  style="<?php echo $Font_S;?>"><b style="color: #0200ff">RAJAVITHI AN :</b></h5>
                                            </label>
                                            <label>
                                                <?= $form->field($model, 'AN_RJ')->textInput(['autofocus' => true , 'id' => 'AN_RJ' , 'value' => $Data_Children[0]->AN_CHILDREN , 'placeholder' => 'AN RJ' , 'maxlength' => '13' , 'autocomplete' => 'off' , 'disabled' => true])->label(false) ?>
                                            </label>
                                        </div>
                                    </div>
                                </td>
                                <td style="width: 33%;text-align: left;" ><br>
                                    <div class="row">
                                        <div>
                                            <label>
                                                <h5  style="<?php echo $Font_S;?>"><b style="color: #0200ff">QSNICH HN :</b></h5>
                                            </label>
                                            <label>
                                                <?= $form->field($model, 'HN_QSNICH')->textInput(['autofocus' => true , 'id' => 'HN_QSNICH' , 'value' => '' , 'placeholder' => 'HN QSNICH' , 'maxlength' => '13' , 'autocomplete' => 'off' , 'onkeypress'=>'return MyKeyHN_QSNICH(event);' ])->label(false) ?>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div>
                                            <label>
                                                <h5  style="<?php echo $Font_S;?>"><b style="color: #0200ff">QSNICH AN :</b></h5>
                                            </label>
                                            <label>
                                                <?= $form->field($model, 'AN_QSNICH')->textInput(['autofocus' => true , 'id' => 'AN_QSNICH' , 'value' => '' , 'placeholder' => 'AN QSNICH' , 'maxlength' => '13' , 'autocomplete' => 'off' , 'onkeypress'=>'return MyKeyAN_QSNICH(event);' ])->label(false) ?>
                                            </label>
                                        </div>
                                    </div>
                                </td>
                                <td style="width: 34%">
                                    <h5  style="text-align: left;<?php echo $Font_S;?>"><b style="color: #0200ff">National ID Newborn :</b><b style="color: #5a5a5a;"> <?php echo $Data_Children[0]->CCARDNO;?></b></h5>
                                    <div class="row align-items-start">
                                        <div class="col-3">
                                            <h5  style="text-align: left;<?php echo $Font_S;?>"><b style="color: #0200ff">TWIN :</b></h5>
                                        </div>
                                        <div class="col-9" style="height: 0px;">
                                            <h5  style="text-align: left;<?php echo $Font_S;?>">
                                                <b style="color: #5a5a5a">
                                                    <?php if($Data_Children[0]->CNT_TWIN > 1){ ?>
                                                        <label>
                                                            <?= $form->field($model, 'TWIN')
                                                                ->radioList([1=>'NO'],[ 'class' => '','style' =>'',
                                                                    'item' => function($index, $label, $name, $checked, $value){
                                                                        return "<label>&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"radio\" name=\"".$name."\" value=\"".$value."\" disabled>"."&nbsp;".$label."</label>";
                                                                    }
                                                                ])->label(false);
                                                            ?>
                                                        </label>
                                                        <label>
                                                            <?= $form->field($model, 'TWIN')
                                                                ->radioList([2=>'YES'],[ 'class' => '','style' =>'',
                                                                    'item' => function($index, $label, $name, $checked, $value){
                                                                        return "<label>&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"radio\" name=\"".$name."\" value=\"".$value."\"checked>"."&nbsp;".$label."</label>";
                                                                    }
                                                                ])->label(false);
                                                            ?>
                                                        </label>
                                                    <?php }else{ ?>
                                                        <label>
                                                            <?= $form->field($model, 'TWIN')
                                                                ->radioList([1=>'NO'],[ 'class' => '','style' =>'',
                                                                    'item' => function($index, $label, $name, $checked, $value){
                                                                        return "<label>&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"radio\" name=\"".$name."\" value=\"".$value."\"checked>"."&nbsp;".$label."</label>";
                                                                    }
                                                                ])->label(false);
                                                            ?>
                                                        </label>
                                                        <label>
                                                            <?= $form->field($model, 'TWIN')
                                                                ->radioList([2=>'YES'],[ 'class' => '','style' =>'',
                                                                    'item' => function($index, $label, $name, $checked, $value){
                                                                        return "<label>&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"radio\" name=\"".$name."\" value=\"".$value."\" disabled>"."&nbsp;".$label."</label>";
                                                                    }
                                                                ])->label(false);
                                                            ?>
                                                        </label>
                                                    <?php }?>
                                                </b>
                                            </h5>
                                        </div>
                                    </div>
                                    <?php if($Data_Children[0]->CNT_TWIN > 1){ ?>
                                        <h5  style="text-align: left;<?php echo $Font_S;?>"><b style="color: #0200ff">Number of Twins :</b><b style="color: #5a5a5a;"> <?php echo $Data_Children[0]->CNT_TWIN;?></b></h5>
                                    <?php }else{ ?>
                                        <h5  style="text-align: left;<?php echo $Font_S;?>"><b style="color: #0200ff">Number of Twins :</b><b style="color: #5a5a5a;"> No Twins </b></h5>
                                    <?php } ?>
                                </td>
                            </tr>
                            <tr style="background-color: #baeeff">
                                <td colspan="2">
                                    <h5  style="text-align: left;<?php echo $Font_S;?>"><b style="color: #0200ff">Child NAME : </b> <b style="color: #5a5a5a;"> <?php echo $Data_Children[0]->CDSPNAME;?></b></h5>
                                    <h5  style="text-align: left;<?php echo $Font_S;?>"><b style="color: #0200ff">DATE BIRTH :</b> <b style="color: #5a5a5a;"> <?php echo $BRTHDATE_CHILDREN;?></b></h5>
                                    <h5  style="text-align: left;<?php echo $Font_S;?>"><b style="color: #0200ff">SEX :</b> <b style="color: #5a5a5a;"> <?php echo $Data_Children[0]->MALE;?></b></h5>
                                </td>
                                <td style="width: 34%;vertical-align: text-top;" >
                                    <h5  style="text-align: left;<?php echo $Font_S;?>"><b style="color: #0200ff">ETHNIC :</b> <b style="color: #5a5a5a;"> <?php echo $Data_Children[0]->ETHNIC;?></b> </h5>
                                    <h5  style="text-align: left;<?php echo $Font_S;?>"><b style="color: #0200ff">Nationnality : </b> <b style="color: #5a5a5a;"> <?php echo $Data_Children[0]->NTNLTY;?> </b></h5>
                                    <h5  style="text-align: left;<?php echo $Font_S;?>"><b style="color: #0200ff">Race : </b> <b style="color: #5a5a5a;"> <?php echo $Data_Children[0]->NRLGN;?> </b></h5>
                                </td>
                            </tr>
                            <tr style="background-color: #baeeff">
                                <td colspan="3">
                                    <h5  style="text-align: left;<?php echo $Font_S;?>">
                                        <b style="color: #0200ff">PERSON TO BE NOTIFIED ADDRESS : </b><br>
                                        <b style="color: #5a5a5a;"> <?php echo $Data_Children[0]->ADDR;?>
                                            ต.<?php echo $Data_Children[0]->TUMBON_NAME;?>
                                            อ.<?php echo $Data_Children[0]->AMPUR_NAME;?>
                                            จ.<?php echo $Data_Children[0]->CHANGWAT_NAME;?>
                                        </b>
                                    </h5>
                                </td>
                            </tr>
                        </table>
                    </div>


                    <div class="col-12" style="border: 2px solid rgba(0,0,0,0);"> <br>
                        <table>
                            <!--                            <tr>-->
                            <!--                                <th colspan="3" style="background-color: #f1bcb7;color: black">-->
                            <!--                                    <h1><b style="color: black;">New Born Sheet</b></h1>-->
                            <!--                                </th>-->
                            <!--                            </tr>-->
                            <tr style="background-color: #fee9e8">
                                <td  style="width: 33%;text-align: left;">
                                    <div class="row">
                                        <div>
                                            <h5  style="<?php echo $Font_S;?>"><b style="color: black">Mother NAME : </b><b style="<?php echo $Font_S;?>"><?php echo $Data_Children[0]->MDSPNAME;?></b></h5>
                                            <h5  style="<?php echo $Font_S;?>"><b style="color: black">Father NAME : </b><b style="<?php echo $Font_S;?>"><?php echo $Data_Children[0]->FDSPNAME;?></b></h5>
                                        </div>
                                    </div>
                                </td>
                                <td  style="background-color: #fee9e8;width: 33%;text-align: left;">
                                    <div class="row">
                                        <div>
                                            <h5  style="<?php echo $Font_S;?>"><b style="color: black">Mother HN : </b><b style="<?php echo $Font_S;?>"><?php echo $HN_MUM ?></b></h5>
                                            <h5  style="<?php echo $Font_S;?>"><b style="color: black">Mother AN : </b><b style="<?php echo $Font_S;?>"><?php echo $AN_MUM ?></b></h5>
                                        </div>
                                    </div>
                                </td>
                                <td  style="background-color: #fee9e8;width: 34%;text-align: left;">
                                    <div class="row">
                                        <div>
                                            <h5><b style="color: black;<?php echo $Font_S;?>">Admit Date :</b> <b style="<?php echo $Font_S;?>"><?php echo $ADMIT_DATETH ?></b></h5>
                                            <h5  style="<?php echo $Font_S;?>"><b style="color: black">MARITAL STATUS : </b>
                                                <b style="<?php echo $Font_S;?>">
                                                    <?php if($Data_Children[0]->MRTLST == 1){ ?>
                                                        SINGLE
                                                    <?php }else if($Data_Children[0]->MRTLST == 2){ ?>
                                                        MARRIED
                                                    <?php }elseif($Data_Children[0]->MRTLST == 5){ ?>
                                                        SEPARATED
                                                    <?php }elseif($Data_Children[0]->MRTLST == 4){ ?>
                                                        DIVORCED
                                                    <?php }elseif($Data_Children[0]->MRTLST == 3){ ?>
                                                        WIDOWED
                                                    <?php }elseif($Data_Children[0]->MRTLST == 6){ ?>
                                                        PRIEST
                                                    <?php } ?>
                                                </b>
                                            </h5>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr style="background-color: #fee9e8">
                                <td colspan="3">
                                    <h5  style="text-align: left;<?php echo $Font_S;?>">
                                        <b style="color:black">PERSON TO BE NOTIFIED ADDRESS : </b><br>
                                        <b style="color: #5a5a5a;"> <?php echo $Data_Children[0]->ADDRMOM;?>
                                            ต.<?php echo $Data_Children[0]->TUMBONMOM;?>
                                            อ.<?php echo $Data_Children[0]->AMPURMOM;?>
                                            จ.<?php echo $Data_Children[0]->CHANGWATMOM;?>
                                        </b>
                                    </h5>
                                </td>
                            </tr>
                        </table>
                    </div>


                    <div class="col-12" style="border: 2px solid rgba(0,0,0,0);"> <br>
                        <table>
                            <tr>
                                <th colspan="3" style="background-color: #00ffb1;color: black">
                                    <h1><b style="color: black">SUMMARY COURSE OF PERINATAL CONDITIONS</b></h1>
                                </th>
                            </tr>

                            <tr style="background-color: #b9ffda;">
                                <td colspan="2" style="text-align: left;width:50%;color: black">
                                    <div class="">
                                        <h5  style="text-align: left;<?php echo $Font_S;?>">
                                            <b style="color: black">OB History</b>
                                            <b style="color: black">G :</b>
                                            <?php if($Data_Children[0]->GMOM == null){ ?>
                                                <b style="<?php echo $Font_S;?>"> - </b>
                                            <?php }else{ ?>
                                                <b style="<?php echo $Font_S;?>"> <?php echo $Data_Children[0]->GMOM; ?></b>
                                            <?php } ?>
                                            <b style="color: black">P :</b>
                                            <?php if($Data_Children[0]->PMOM == null){ ?>
                                                <b style="<?php echo $Font_S;?>"> - </b>
                                            <?php }else{ ?>
                                                <b style="<?php echo $Font_S;?>"> <?php echo $Data_Children[0]->PMOM; ?></b>
                                            <?php } ?>
                                            <b style="color: black">A :</b>
                                            <?php if($Data_Children[0]->AMOM == null){ ?>
                                                <b style="<?php echo $Font_S;?>"> - </b>
                                            <?php }else{ ?>
                                                <b style="<?php echo $Font_S;?>"> <?php echo $Data_Children[0]->AMOM; ?></b>
                                            <?php } ?>
                                            <b style="color: black">L :</b>
                                            <?php if( $Data_labmom2 == [] ){ ?>
                                                <b style="<?php echo $Font_S;?>"> - </b>
                                            <?php }else{ ?>
                                                <?php if($Data_labmom2[0]->LMOM == null ){ ?>
                                                    <b style="<?php echo $Font_S;?>"> - </b>
                                                <?php }else{ ?>
                                                    <b style="<?php echo $Font_S;?>"> <?php echo $Data_Children[0]->LMOM; ?></b>
                                                <?php } ?>
                                            <?php } ?>
                                        </h5>
                                    </div>
                                    <div class="">
                                        <h5  style="<?php echo $Font_S;?>"><b style="color: black">Mother's Blood Group </b>
                                            <?php if($Data_labmom != []){ ?>
                                                <?php if($Data_labmom[0]->BLOODGRP1 == null){ ?>
                                                    <b style="<?php echo $Font_S;?>"> <?php echo $Data_Children[0]->BLOODGRPMOM ?></b>
                                                <?php }else{ ?>
                                                    <?php if($Data_labmom[0]->BLOODGRP1 == null){ ?>
                                                        <b style="<?php echo $Font_S;?>"> - </b>
                                                    <?php }else{ ?>
                                                        <b style="<?php echo $Font_S;?>"> <?php echo $Data_labmom[0]->BLOODGRP1 ?></b>
                                                    <?php } ?>
                                                    <b style="color: black"> ;  Rh : </b>
                                                    <?php if($Data_labmom[0]->RH1 == 'Negative' ){ ?>
                                                        <b style="color: red;<?php echo $Font_S;?>"> <?php echo $Data_labmom[0]->RH1 ?></b>
                                                    <?php }else{ ?>
                                                        <b style="<?php echo $Font_S;?>"> <?php echo $Data_labmom[0]->RH1 ?></b>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php }else{ ?>
                                                <?php if($Data_Children[0]->BLOODGRPMOM == null){ ?>
                                                    <b style="<?php echo $Font_S;?>"> - </b>
                                                <?php }else{ ?>
                                                    <b style="<?php echo $Font_S;?>"> <?php echo $Data_Children[0]->BLOODGRPMOM ?></b>
                                                <?php } ?>
                                                <b style="color: black"> ;  Rh : </b>
                                                <b style="<?php echo $Font_S;?>"> - </b>
                                            <?php } ?>
                                        </h5>
                                    </div>
                                    <div class="">
                                        <h5  style="<?php echo $Font_S;?>">
                                            <b style="color: black">Mother drug abuse :</b>
                                            <b style="<?php echo $Font_S;?>"> - </b>
                                        </h5>
                                    </div>
                                </td>

                                <td style="vertical-align: text-top;text-align: left;width:50%;color: black">
                                    <div class="">
                                        <?php if($EDCMOM == "0"){ ?>
                                            <h5  style="text-align: left;<?php echo $Font_S;?>">
                                                <b style="color: black">EDC : </b>
                                                <b style="color: red;<?php echo $Font_S;?>">ไม่พบข้อมูล</b>
                                            </h5>
                                        <?php }else{ ?>
                                            <?php if($Data_Children[0]->EDCANCVST == $Data_Children[0]->EDCMOM){ ?>
                                                <h5  style="text-align: left;<?php echo $Font_S;?>">
                                                    <b style="color: black">EDC : </b>
                                                    <b style="<?php echo $Font_S;?>"> <?php echo $EDCMOM; ?></b>
                                                </h5>
                                            <?php }else{ ?>
                                                <!--EDC dlvst:ห้องคลอด กับ ancvst:ฝากครรภ์ ไม่ตรงกัน-->
                                                <h5  style="text-align: left;<?php echo $Font_S;?>">
                                                    <b style="color: black">EDC : </b>
                                                    <b style="color: red;<?php echo $Font_S;?>">พบข้อมูลไม่ตรงกัน</b>
                                                </h5>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                    <div class="">
                                        <h5  style="text-align: left;<?php echo $Font_S;?>">
                                            <b style="color: black">ANC : </b>
                                            <?php if($Data_Children[0]->ANCLCTNAME == null){ ?>
                                                <b style="<?php echo $Font_S;?>"> - </b>
                                            <?php }else{ ?>
                                                <b style="<?php echo $Font_S;?>"> <?php echo $Data_Children[0]->ANCLCTNAME ?></b>
                                            <?php } ?>
                                        </h5>
                                    </div>
                                    <div class="" >
                                        <h5  style="<?php echo $Font_S;?>">
                                            <b style="color: black">No.of attendance : </b>
                                            <?php if($Data_Children[0]->ANCNOAMOM == null){ ?>
                                                <b style="<?php echo $Font_S;?>"> - </b>
                                            <?php }else{ ?>
                                                <b style="<?php echo $Font_S;?>"> <?php echo $Data_Children[0]->ANCNOAMOM ?></b>
                                            <?php } ?>
                                        </h5>
                                    </div>
                                </td>
                            </tr>

                            <?php if($Data_labmom == [] || $Data_labmom2 == []  ){  ?>
                                <tr style="background-color: #ff5d69;">
                                    <td colspan="3" style="text-align: left;width:50%;color: black">
                                        <table width="100%" border="0">
                                            <tbody>
                                            <tr style="background-color: #b9ffda;">
                                                <td style="text-align: left;width: 50%;">
                                                    <h5  style="<?php echo $Font_S;?>">
                                                        <b style="color: black">VDRL Syphilis 1 : </b>
                                                        <b style="<?php echo $Font_S;?>"> - </b>
                                                        <b style="color: black">RPR Titer : </b>
                                                        <b style="<?php echo $Font_S;?>"> - </b>
                                                        <b style="color: black">Date : </b>
                                                        <b style="<?php echo $Font_S;?>"> - </b>
                                                    </h5>
                                                    <h5  style="<?php echo $Font_S;?>">
                                                        <b style="color: black">FTA-ABS :</b>
                                                        <b style="<?php echo $Font_S;?>"> - </b>
                                                    </h5>
                                                    <h5  style="<?php echo $Font_S;?>">
                                                        <b style="color: black">VDRL Syphilis 2 : </b>
                                                        <b style="<?php echo $Font_S;?>"> - </b>
                                                        <b style="color: black">RPR Titer : </b>
                                                        <b style="<?php echo $Font_S;?>"> - </b>
                                                        <b style="color: black">Date : </b>
                                                        <b style="<?php echo $Font_S;?>"> - </b>
                                                    </h5>
                                                    <h5  style="<?php echo $Font_S;?>">
                                                        <b style="color: black">FTA-ABS :</b>
                                                        <b style="<?php echo $Font_S;?>"> - </b>
                                                    </h5>
                                                </td>
                                                <td style="vertical-align: text-top;text-align: left;width: 50%;">
                                                    <h5  style="<?php echo $Font_S;?>">
                                                        <b style="color: black">HBsAg1 :</b>
                                                        <b style="<?php echo $Font_S;?>"> - </b>
                                                    </h5>
                                                    <h5  style="<?php echo $Font_S;?>">
                                                        <b style="color: black">HBeAg2 :</b>
                                                        <b style="<?php echo $Font_S;?>"> - </b>
                                                    </h5>
                                                    <h5  style="<?php echo $Font_S;?>">
                                                        <b style="color: black">AntiHIV :</b>
                                                        <b style="<?php echo $Font_S;?>"> - </b>
                                                    </h5>
                                                    <h5  style="<?php echo $Font_S;?>">
                                                        <b style="color: black">DCIP :</b>
                                                        <b style="<?php echo $Font_S;?>"> - </b>
                                                        <b style="color: black">Hb Typing :</b>
                                                        <b style="<?php echo $Font_S;?>"> - </b>
                                                    </h5>
                                                </td>
                                            </tr>
                                            <tr style="background-color: #b9ffda;">
                                                <td colspan="3" style="text-align: left;width: 100%;">
                                                    <h5  style="<?php echo $Font_S;?>">
                                                        <b style="color: black">Thyroid Hormone :</b>
                                                        <b style="<?php echo $Font_S;?>"> - </b>
                                                    </h5>
                                                </td>
                                            </tr>
                                            <tr style="background-color: #b9ffda;">
                                                <td colspan="3" style="width: 100%;">
                                                    <div class="row align-items-center">
                                                        <div class="col">
                                                            <h5  style="text-align: center;<?php echo $Font_S;?>">
                                                                <b style="color: black">Mother Rx for Syphilis </b>
                                                            </h5>
                                                            <h5  style="text-align: center;<?php echo $Font_S;?>"><b style="">-</b></h5>
                                                        </div>
                                                        <div class="col-4">
                                                            <h5  style="text-align: center;<?php echo $Font_S;?>">
                                                                <b style="color: black">Mother Rx last dose</b>
                                                            </h5>
                                                            <h5  style="text-align: center;<?php echo $Font_S;?>"><b style="">-</b></h5>
                                                        </div>
                                                        <div class="col">
                                                            <h5  style="text-align: center;<?php echo $Font_S;?>">
                                                                <b style="color: black">ชื่อยา</b>
                                                            </h5>
                                                            <h5  style="text-align: center;<?php echo $Font_S;?>"><b style="">-</b></h5>
                                                        </div>
                                                    </div>

                                                    <div class="row align-items-center">
                                                        <div class="col">
                                                            <h5  style="text-align: center;<?php echo $Font_S;?>"><b style="color: black">Father Rx for Syphilis </b></h5>
                                                            <h5  style="text-align: center;<?php echo $Font_S;?>"><b style="">-</b></h5>
                                                        </div>
                                                        <div class="col-4">
                                                            <h5  style="text-align: center;<?php echo $Font_S;?>"><b style="color: black">Father Rx last dose</b></h5>
                                                            <h5  style="text-align: center;<?php echo $Font_S;?>"><b style="">-</b></h5>
                                                        </div>
                                                        <div class="col">
                                                            <h5  style="text-align: center;<?php echo $Font_S;?>"><b style="color: black">ชื่อยา</b></h5>
                                                            <h5  style="text-align: center;<?php echo $Font_S;?>"><b style="">-</b></h5>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr style="background-color: #b9ffda;">
                                                <td colspan="3" style="text-align: left;width: 100%;">
                                                    <h5  style="<?php echo $Font_S;?>">
                                                        <b style="color: black">โรคประจำตัวของมารดา :</b>
                                                        <b style="">-</b>
                                                    </h5>
                                                </td>
                                            </tr>
                                            <tr style="background-color: #b9ffda;">
                                                <td colspan="3" style="text-align: left;width: 100%;">
                                                    <h5  style="<?php echo $Font_S;?>">
                                                        <b style="color: black">ยาที่มารดารับประทานขณะตั้งครรภ์ :</b>
                                                        <b style="">-</b>
                                                    </h5>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            <?php }else{ ?>
                                <tr style="background-color: #000000;">
                                    <td colspan="3" style="text-align: left;width:50%;color: black">
                                        <table width="100%" border="0">
                                            <tbody>
                                            <tr style="background-color: #b9ffda;">
                                                <td style="text-align: left;width: 50%;">
                                                    <h5  style="<?php echo $Font_S;?>"><b style="color: black">VDRL/RPR Syphilis 1 : </b>
                                                        <?php if($Data_labmom[0]->VDRL1 == null){ ?>
                                                            <b style="<?php echo $Font_S;?>"> - </b>
                                                        <?php }else{ ?>
                                                            <?php if($Data_labmom[0]->VDRL1 != 'Non-Reactive' ){ ?>
                                                                <b style="color: red;<?php echo $Font_S;?>"> <?php echo $Data_labmom[0]->VDRL1 ?></b>
                                                            <?php }else{ ?>
                                                                <b style="<?php echo $Font_S;?>"> <?php echo $Data_labmom[0]->VDRL1 ?></b>
                                                            <?php } ?>
                                                        <?php } ?>
                                                        <b style="color: black">Date :</b>
                                                        <?php if($Data_labmom[0]->LABDATE1 == null){ ?>
                                                            <b style="<?php echo $Font_S;?>"> - </b>
                                                        <?php }else{ ?>
                                                            <b style="<?php echo $Font_S;?>"> <?php echo $Data_labmom[0]->LABDATE1 ?></b>
                                                        <?php } ?>
                                                    </h5>
                                                    <h5  style="<?php echo $Font_S;?>"><b style="color: black">FTA-ABS :</b>
                                                        <?php if($Data_labmom[0]->FTAABS1 == null){ ?>
                                                            <b style="<?php echo $Font_S;?>"> - </b>
                                                        <?php }else{ ?>
                                                            <?php if($Data_labmom[0]->FTAABS1 == 'Reactive' ){ ?>
                                                                <b style="color: red;<?php echo $Font_S;?>"> <?php echo $Data_labmom[0]->FTAABS1 ?></b>
                                                            <?php }else{ ?>
                                                                <b style="<?php echo $Font_S;?>"> <?php echo $Data_labmom[0]->FTAABS1 ?></b>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </h5>
                                                    <h5  style="<?php echo $Font_S;?>"><b style="color: black">VDRL/RPR Syphilis 2 : </b>
                                                        <?php if($Data_labmom[0]->VDRL2 == null){ ?>
                                                            <b style="<?php echo $Font_S;?>"> - </b>
                                                        <?php }else{ ?>
                                                            <?php if($Data_labmom[0]->VDRL2 != 'Non-Reactive'){ ?>
                                                                <b style="color: red;<?php echo $Font_S;?>"> <?php echo $Data_labmom[0]->VDRL2 ?></b>
                                                            <?php }else{ ?>
                                                                <b style="<?php echo $Font_S;?>"> <?php echo $Data_labmom[0]->VDRL2 ?></b>
                                                            <?php } ?>
                                                        <?php } ?>
                                                        <b style="color: black">Date :</b>
                                                        <?php if($Data_labmom[0]->LABDATE2 == null){ ?>
                                                            <b style="<?php echo $Font_S;?>"> - </b>
                                                        <?php }else{ ?>
                                                            <b style="<?php echo $Font_S;?>"> <?php echo $Data_labmom[0]->LABDATE2 ?></b>
                                                        <?php } ?>
                                                    </h5>
                                                    <h5  style="<?php echo $Font_S;?>"><b style="color: black">FTA-ABS :</b>
                                                        <?php if($Data_labmom[0]->FTAABS2 == null){ ?>
                                                            <b style="<?php echo $Font_S;?>"> - </b>
                                                        <?php }else{ ?>
                                                            <?php if($Data_labmom[0]->FTAABS2 == 'Reactive' ){ ?>
                                                                <b style="color: red;<?php echo $Font_S;?>"> <?php echo $Data_labmom[0]->FTAABS2 ?></b>
                                                            <?php }else{ ?>
                                                                <b style="<?php echo $Font_S;?>"> <?php echo $Data_labmom[0]->FTAABS2 ?></b>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </h5>
                                                </td>
                                                <td style="vertical-align: text-top;text-align: left;width: 50%;">
                                                    <h5  style="<?php echo $Font_S;?>"><b style="color: black">HBsAg :</b>
                                                        <?php if($Data_labmom[0]->HBSAG1 == null){ ?>
                                                            <b style="<?php echo $Font_S;?>"> - </b>
                                                        <?php }else{ ?>
                                                            <?php if($Data_labmom[0]->HBSAG1 == 'Reactive' ){ ?>
                                                                <b style="color: red;<?php echo $Font_S;?>"> <?php echo $Data_labmom[0]->HBSAG1 ?></b>
                                                            <?php }else{ ?>
                                                                <b style="<?php echo $Font_S;?>"> <?php echo $Data_labmom[0]->HBSAG1 ?></b>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </h5>
                                                    <h5  style="<?php echo $Font_S;?>"><b style="color: black">HBeAg :</b>
                                                        <?php if($Data_labmom[0]->HBEAG1 == null){ ?>
                                                            <b style="<?php echo $Font_S;?>"> - </b>
                                                        <?php }else{ ?>
                                                            <?php if($Data_labmom[0]->HBEAG1 == 'Reactive' ){ ?>
                                                                <b style="color: red;<?php echo $Font_S;?>"> <?php echo $Data_labmom[0]->HBEAG1 ?></b>
                                                            <?php }else{ ?>
                                                                <b style="<?php echo $Font_S;?>"> <?php echo $Data_labmom[0]->HBEAG1 ?></b>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </h5>
                                                    <h5  style="<?php echo $Font_S;?>"><b style="color: black">AntiHIV :</b>
                                                        <?php if($Data_labmom[0]->HIV1 == null){ ?>
                                                            <b style="<?php echo $Font_S;?>"> - </b>
                                                        <?php }else{ ?>
                                                            <?php if($Data_labmom[0]->HIV1 == 'Positive' ){ ?>
                                                                <b style="color: red;<?php echo $Font_S;?>"> <?php echo $Data_labmom[0]->HIV1 ?></b>
                                                            <?php }else{ ?>
                                                                <b style="<?php echo $Font_S;?>"> <?php echo $Data_labmom[0]->HIV1 ?></b>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </h5>
                                                    <h5  style="<?php echo $Font_S;?>">
                                                        <b style="color: black">DCIP :</b>
                                                        <?php if($Data_labmom[0]->DCIP == null){ ?>
                                                            <b style="<?php echo $Font_S;?>"> - </b>
                                                        <?php }else{ ?>
                                                            <?php if($Data_labmom[0]->DCIP == 'Positive' ){ ?>
                                                                <b style="color: red;<?php echo $Font_S;?>"> <?php echo $Data_labmom[0]->DCIP ?></b>
                                                            <?php }else{ ?>
                                                                <b style="<?php echo $Font_S;?>"> <?php echo $Data_labmom[0]->DCIP ?></b>
                                                            <?php } ?>
                                                        <?php } ?>
                                                        <b style="color: black">Hb Typing :</b>
                                                        <?php if($Data_labmom[0]->HBTYPING == null){ ?>
                                                            <b style="<?php echo $Font_S;?>"> - </b>
                                                        <?php }else{ ?>
                                                            <b style="<?php echo $Font_S;?>"> <?php echo $Data_labmom[0]->HBTYPING ?></b>
                                                        <?php } ?>
                                                    </h5>
                                                </td>
                                            </tr>
                                            <tr style="background-color: #b9ffda;">
                                                <td colspan="3" style="text-align: left;width: 100%;">
                                                    <h5  style="<?php echo $Font_S;?>"><b style="color: black">Thyroid Hormone :</b></h5>
                                                </td>
                                            </tr>
                                            <tr style="background-color: #b9ffda;">
                                                <td colspan="3" style="width: 100%;">
                                                    <div class="row align-items-center">
                                                        <div class="col">
                                                            <h5  style="text-align: center;<?php echo $Font_S;?>">
                                                                <b style="color: black">Mother Rx for Syphilis </b>
                                                            </h5>
                                                            <?php if($Data_labmom2[0]->RDBNZTHN == null){ ?>
                                                                <?php if($Data_labmom2[0]->NDBNZTHN == null){ ?>
                                                                    <?php if($Data_labmom2[0]->STBNZTHN == null){ ?>
                                                                        <h5  style="text-align: center;<?php echo $Font_S;?>"><b style="">No / Unknown</b></h5>
                                                                    <?php }else{ ?>
                                                                        <h5  style="text-align: center;<?php echo $Font_S;?>"><b style="">Incomplete</b></h5>
                                                                    <?php } ?>
                                                                <?php }else{ ?>
                                                                    <h5  style="text-align: center;<?php echo $Font_S;?>"><b style="">Incomplete</b></h5>
                                                                <?php } ?>
                                                            <?php }else{ ?>
                                                                <h5  style="text-align: center;<?php echo $Font_S;?>"><b style="">Complete</b></h5>
                                                            <?php } ?>
                                                        </div>
                                                        <div class="col-4">
                                                            <h5  style="text-align: center;<?php echo $Font_S;?>">
                                                                <b style="color: black">Mother Rx last dose</b>
                                                            </h5>
                                                            <?php if($Data_labmom2[0]->RDBNZTHN == null){ ?>
                                                                <?php if($Data_labmom2[0]->NDBNZTHN == null){ ?>
                                                                    <?php if($Data_labmom2[0]->STBNZTHN == null){ ?>
                                                                        <h5  style="text-align: center;<?php echo $Font_S;?>"><b style="">-</b></h5>
                                                                    <?php }else{ ?>
                                                                        <h5  style="text-align: center;<?php echo $Font_S;?>"><b style=""><?php echo $Data_labmom2[0]->STBNZTHN;?></b></h5>
                                                                    <?php } ?>
                                                                <?php }else{ ?>
                                                                    <h5  style="text-align: center;<?php echo $Font_S;?>"><b style=""><?php echo $Data_labmom2[0]->NDBNZTHN;?></b></h5>
                                                                <?php } ?>
                                                            <?php }else{ ?>
                                                                <h5  style="text-align: center;<?php echo $Font_S;?>"><b style=""><?php echo $Data_labmom2[0]->RDBNZTHN;?></b></h5>
                                                            <?php } ?>
                                                        </div>
                                                        <div class="col">
                                                            <h5  style="text-align: center;<?php echo $Font_S;?>">
                                                                <b style="color: black">ชื่อยา</b>
                                                            </h5>
                                                            <?php if($Data_labmom2[0]->BNZTHN == '1'){ ?>
                                                                <?php if($Data_labmom2[0]->TREATOTH == '1'){ ?>
                                                                    <h5  style="text-align: center;<?php echo $Font_S;?>"><b style="">Benzathine penicllin , Erythromycin</b></h5>
                                                                <?php }else{ ?>
                                                                    <h5  style="text-align: center;<?php echo $Font_S;?>"><b style="">Benzathine penicllin</b></h5>
                                                                <?php } ?>
                                                            <?php }else{ ?>
                                                                <?php if($Data_labmom2[0]->TREATOTH == '1'){ ?>
                                                                    <h5  style="text-align: center;<?php echo $Font_S;?>"><b style="">Erythromycin</b></h5>
                                                                <?php }else{ ?>
                                                                    <h5  style="text-align: center;<?php echo $Font_S;?>"><b style="">-</b></h5>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </div>
                                                    </div>

                                                    <div class="row align-items-center">
                                                        <div class="col">
                                                            <h5  style="text-align: center;<?php echo $Font_S;?>"><b style="color: black">Father Rx for Syphilis </b></h5>
                                                        </div>
                                                        <div class="col-4">
                                                            <h5  style="text-align: center;<?php echo $Font_S;?>"><b style="color: black">Father Rx last dose</b></h5>
                                                        </div>
                                                        <div class="col">
                                                            <h5  style="text-align: center;<?php echo $Font_S;?>"><b style="color: black">ชื่อยา</b></h5>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr style="background-color: #b9ffda;">
                                                <td colspan="3" style="text-align: left;width: 100%;">
                                                    <h5  style="<?php echo $Font_S;?>">
                                                        <b style="color: black">โรคประจำตัวของมารดา :</b>
                                                        <?php if($Data_mthds== []){ ?>
                                                            <b style="<?php echo $Font_S;?>"> - </b>
                                                        <?php }else{ ?>
                                                            <?php foreach ($Data_mthds as $mthds){ ?>
                                                                <b style="color: black;<?php echo $Font_S;?>">&nbsp;&nbsp;&nbsp;✦</b>
                                                                <b style="<?php echo $Font_S;?>"><?php echo $mthds->MTHDSNAME ?></b>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </h5>
                                                </td>
                                            </tr>
                                            <tr style="background-color: #b9ffda;">
                                                <td colspan="3" style="text-align: left;width: 100%;">
                                                    <h5  style="<?php echo $Font_S;?>">
                                                        <b style="color: black">ยาที่มารดารับประทานขณะตั้งครรภ์ :</b>
                                                        <?php if($Data_brthsignmed[0]->BRTHSIGNMED == null){ ?>
                                                            <b style="<?php echo $Font_S;?>"> - </b>
                                                        <?php }else{ ?>
                                                            <b style="<?php echo $Font_S;?>"> <?php echo $Data_brthsignmed[0]->BRTHSIGNMED ?></b>
                                                        <?php } ?>
                                                    </h5>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            <?php } ?>

                            <tr style="background-color: #b9ffda;">
                                <td colspan="3" style="text-align: left;width:50%;color: black">
                                    <div class="">
                                        <h5  style="margin: 0 12px -14px;<?php echo $Font_S;?>">
                                            <b style="color: #1d28ff;background-color: #d1ffee;<?php echo $Font_S;?>" >&nbsp;previous OB complication&nbsp;</b>
                                        </h5>
                                        <table width="100%" border="0">
                                            <tbody>
                                            <tr >
                                                <th rowspan="2"  style="background-color: #d1ffee;color: black">
                                                    <b style="color: black;<?php echo $Font_S;?>">ครรภ์ที่</b>
                                                </th>
                                                <th rowspan="2"  style="background-color: #d1ffee;color: black">
                                                    <b style="color: black;<?php echo $Font_S;?>">วัน/เดือน/ปี</b>
                                                </th>
                                                <th rowspan="2"  style="background-color: #d1ffee;color: black">
                                                    <b style="color: black;<?php echo $Font_S;?>">สถานที่</b>
                                                </th>
                                                <th rowspan="2" style="background-color: #d1ffee;color: black">
                                                    <b style="color: black;<?php echo $Font_S;?>">ประวัติการคลอด/แท้ง/ความผิดปกติ</b>
                                                </th>
                                                <th colspan="3"  style="background-color: #d1ffee;color: black">
                                                    <b style="color: black;<?php echo $Font_S;?>">ประวัติเด็ก</b>
                                                </th>
                                            </tr>
                                            <tr >
                                                <th  style="background-color: #d1ffee;color: black">
                                                    <b style="color: black;<?php echo $Font_S;?>">น้ำหนักแรกเกิด</b>
                                                </th>
                                                <th  style="background-color: #d1ffee;color: black">
                                                    <b style="color: black;<?php echo $Font_S;?>">เพศ</b>
                                                </th>
                                                <th  style="background-color: #d1ffee;color: black">
                                                    <b style="color: black;<?php echo $Font_S;?>">สุขภาพปัจจุบัน</b>
                                                </th>
                                            </tr>
                                            <?php foreach ($Data_previousOB as $previousOB){ ?>
                                                <tr>
                                                    <td>
                                                        <?php if($previousOB->TIMENO == null){ ?>
                                                            <b style="color: #5a5a5a;<?php echo $Font_S;?>">-</b>
                                                        <?php }else{ ?>
                                                            <b style="color: #5a5a5a;<?php echo $Font_S;?>"><?php echo $previousOB->TIMENO;?></b>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <?php if($previousOB->BRTHDATE == null){ ?>
                                                            <b style="color: #5a5a5a;<?php echo $Font_S;?>">-</b>
                                                        <?php }else{ ?>
                                                            <b style="color: #5a5a5a;<?php echo $Font_S;?>"><?php echo $previousOB->BRTHDATE;?></b>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <?php if($previousOB->HPTNAME == null){ ?>
                                                            <b style="color: #5a5a5a;<?php echo $Font_S;?>">-</b>
                                                        <?php }else{ ?>
                                                            <b style="color: #5a5a5a;<?php echo $Font_S;?>"><?php echo $previousOB->HPTNAME;?></b>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <?php if($previousOB->BRTHDT == null){ ?>
                                                            <b style="color: #5a5a5a;<?php echo $Font_S;?>">-</b>
                                                        <?php }else{ ?>
                                                            <b style="color: #5a5a5a;<?php echo $Font_S;?>"><?php echo $previousOB->BRTHDT;?></b>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <?php if($previousOB->BW == null){ ?>
                                                            <b style="color: #5a5a5a;<?php echo $Font_S;?>">-</b>
                                                        <?php }else{ ?>
                                                            <b style="color: #5a5a5a;<?php echo $Font_S;?>"><?php echo $previousOB->BW;?></b>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <?php if($previousOB->MALE == null){ ?>
                                                            <b style="color: #5a5a5a;<?php echo $Font_S;?>">-</b>
                                                        <?php }else{ ?>
                                                            <b style="color: #5a5a5a;<?php echo $Font_S;?>"><?php echo $previousOB->MALE;?></b>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <?php if($previousOB->HEALTHDT == null){ ?>
                                                            <b style="color: #5a5a5a;<?php echo $Font_S;?>">-</b>
                                                        <?php }else{ ?>
                                                            <b style="color: #5a5a5a;<?php echo $Font_S;?>"><?php echo $previousOB->HEALTHDT;?></b>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                            <tr style="background-color: #b9ffda;">
                                <td colspan="3" style="text-align: left;width:50%;color: black">
                                    <div class="">
                                        <h5  style="margin: 0 12px -14px;<?php echo $Font_S;?>">
                                            <b style="color: #1d28ff;background-color: #d1ffee;<?php echo $Font_S;?>" >&nbsp;present OB complication&nbsp;</b>
                                        </h5>
                                        <h5  style="<?php echo $Font_S;?>">
                                            <?php if($Data_presentOB == []){ ?>
                                                <table width="100%" border="0">
                                                    <tbody>
                                                    <tr>
                                                        <th style="text-align: left;background-color: #d1ffee;color: black">
                                                            <b style="color: black;<?php echo $Font_S;?>"></b>
                                                        </th>
                                                    </tr>
                                                    <tbody>
                                                </table>
                                            <?php }else{ ?>
                                                <table width="100%" border="0">
                                                    <tbody>
                                                    <tr>
                                                        <th style="text-align: left;background-color: #d1ffee;color: black">
                                                           <b style="color: black;<?php echo $Font_S;?>"></b>
                                                        </th>
                                                    </tr>
                                                    <?php foreach ($Data_presentOB as $presentOB){ ?>
                                                        <tr>
                                                            <td style="text-align: left;background-color: #dbffe5;">
                                                                <b style="color: black;<?php echo $Font_S;?>">&nbsp;&nbsp;&nbsp;✦</b>
                                                                <b style="<?php echo $Font_S;?>"><?php echo $presentOB->DIAGNAME ?></b>
                                                                <?php if($presentOB->OTHDETAIL != null){ ?>
                                                                    <b style="<?php echo $Font_S;?>">(<?php echo $presentOB->OTHDETAIL ?>)</b>
                                                                <?php } ?>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                    <tbody>
                                                </table>
                                            <?php } ?>
                                        </h5>
                                    </div>
                                </td>
                            </tr>
                            <tr style="background-color: #b9ffda;">
                                <td colspan="2" style="text-align: left;width:50%;color: black">
                                    <div class="">
                                        <h5  style="<?php echo $Font_S;?>">
                                            <b style="color: black">DELIVERY Gestation </b>
                                            <?php if($Data_brthsignmed[0]->WMBAGE == null){ ?>
                                                <b style="<?php echo $Font_S;?>"> - </b>
                                            <?php }else{ ?>
                                                <b style="<?php echo $Font_S;?>">&nbsp;&nbsp;&nbsp; <?php echo $Data_brthsignmed[0]->WMBAGE ?></b>
                                            <?php } ?>
                                            <b style="color: black">wks by LMP</b>
                                            <?php if($Data_brthsignmed[0]->US == null){ ?>
                                                <b style="<?php echo $Font_S;?>"> - </b>
                                            <?php }else{ ?>
                                                <b style="<?php echo $Font_S;?>">&nbsp;&nbsp;&nbsp; <?php echo $Data_brthsignmed[0]->US ?></b>
                                            <?php } ?>
                                            <b style="color: black">wks by U/S</b>
                                        </h5>
                                    </div>
                                </td>
                                <td style="text-align: left;width:50%;color: black">
                                    <div class="row align-items-start">
                                        <div class="col-4">
                                            <h5  style="text-align: left;<?php echo $Font_S;?>"><b style="color: black">Bleeding :</b></h5>
                                        </div>
                                        <div class="col-8" style="height: 0px;">
                                            <h5  style="text-align: left;<?php echo $Font_S;?>">
                                                <b style="color: #5a5a5a">
                                                    <?php if($Data_brthsignmed[0]->BLDSHED == 1){ ?>
                                                        <label>
                                                            <?= $form->field($model, 'Bleeding')
                                                                ->radioList([1=>'NO'],[ 'class' => '','style' =>'',
                                                                    'item' => function($index, $label, $name, $checked, $value){
                                                                        return "<label>&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"radio\" name=\"".$name."\" value=\"".$value."\" disabled>"."&nbsp;".$label."</label>";
                                                                    }
                                                                ])->label(false);
                                                            ?>
                                                        </label>
                                                        <label>
                                                            <?= $form->field($model, 'Bleeding')
                                                                ->radioList([2=>'YES'],[ 'class' => '','style' =>'',
                                                                    'item' => function($index, $label, $name, $checked, $value){
                                                                        return "<label>&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"radio\" name=\"".$name."\" value=\"".$value."\"checked>"."&nbsp;".$label."</label>";
                                                                    }
                                                                ])->label(false);
                                                            ?>
                                                        </label>
                                                    <?php }else{ ?>
                                                        <label>
                                                            <?= $form->field($model, 'Bleeding')
                                                                ->radioList([1=>'NO'],[ 'class' => '','style' =>'',
                                                                    'item' => function($index, $label, $name, $checked, $value){
                                                                        return "<label>&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"radio\" name=\"".$name."\" value=\"".$value."\"checked>"."&nbsp;".$label."</label>";
                                                                    }
                                                                ])->label(false);
                                                            ?>
                                                        </label>
                                                        <label>
                                                            <?= $form->field($model, 'Bleeding')
                                                                ->radioList([2=>'YES'],[ 'class' => '','style' =>'',
                                                                    'item' => function($index, $label, $name, $checked, $value){
                                                                        return "<label>&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"radio\" name=\"".$name."\" value=\"".$value."\" disabled>"."&nbsp;".$label."</label>";
                                                                    }
                                                                ])->label(false);
                                                            ?>
                                                        </label>
                                                    <?php }?>
                                                </b>
                                            </h5>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr style="background-color: #b9ffda;">
                                <td colspan="2" style="text-align: left;width:50%;color: black">
                                    <div class="row align-items-start">
                                        <div class="col-3">
                                            <h5  style="text-align: left;<?php echo $Font_S;?>"><b style="color: black">BIRTH Place :</b></h5>
                                        </div>
                                        <div class="col-9" style="height: 0px;">
                                            <h5  style="text-align: left;<?php echo $Font_S;?>">
                                                <b style="color: #5a5a5a">
                                                    <?php if($Data_brthsignmed[0]->BBA == 1){ ?>
                                                        <label>
                                                            <?= $form->field($model, 'BBA')
                                                                ->radioList([1=>'Rajavithi Hosp'],[ 'class' => '','style' =>'',
                                                                    'item' => function($index, $label, $name, $checked, $value){
                                                                        return "<label>&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"radio\" name=\"".$name."\" value=\"".$value."\" disabled>"."&nbsp;".$label."</label>";
                                                                    }
                                                                ])->label(false);
                                                            ?>
                                                        </label>
                                                        <label>
                                                            <?= $form->field($model, 'BBA')
                                                                ->radioList([2=>'BBA'],[ 'class' => '','style' =>'',
                                                                    'item' => function($index, $label, $name, $checked, $value){
                                                                        return "<label>&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"radio\" name=\"".$name."\" value=\"".$value."\"checked>"."&nbsp;".$label."</label>";
                                                                    }
                                                                ])->label(false);
                                                            ?>
                                                        </label>
                                                    <?php }else{ ?>
                                                        <label>
                                                            <?= $form->field($model, 'BBA')
                                                                ->radioList([1=>'Rajavithi Hosp'],[ 'class' => '','style' =>'',
                                                                    'item' => function($index, $label, $name, $checked, $value){
                                                                        return "<label>&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"radio\" name=\"".$name."\" value=\"".$value."\"checked>"."&nbsp;".$label."</label>";
                                                                    }
                                                                ])->label(false);
                                                            ?>
                                                        </label>
                                                        <label>
                                                            <?= $form->field($model, 'BBA')
                                                                ->radioList([2=>'BBA'],[ 'class' => '','style' =>'',
                                                                    'item' => function($index, $label, $name, $checked, $value){
                                                                        return "<label>&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"radio\" name=\"".$name."\" value=\"".$value."\" disabled>"."&nbsp;".$label."</label>";
                                                                    }
                                                                ])->label(false);
                                                            ?>
                                                        </label>
                                                    <?php }?>
                                                </b>
                                            </h5>
                                        </div>
                                    </div>
                                </td>

                                <td style="text-align: left;width:50%;color: black">
                                    <div class="row align-items-start">
                                        <div class="col-4">
                                            <h5  style="text-align: left;<?php echo $Font_S;?>"><b style="color: black">Membrane Leakage for :</b></h5>
                                        </div>
                                        <div class="col-8" style="height: 0px;">
                                            <h5  style="text-align: left;<?php echo $Font_S;?>">
                                                <b style="color: #5a5a5a">
                                                    <?php if($Data_brthsignmed[0]->WTBRDATE != null){ ?>
                                                        <label>
                                                            <?= $form->field($model, 'Membrane')
                                                                ->radioList([1=>'NO'],[ 'class' => '','style' =>'',
                                                                    'item' => function($index, $label, $name, $checked, $value){
                                                                        return "<label>&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"radio\" name=\"".$name."\" value=\"".$value."\" disabled>"."&nbsp;".$label."</label>";
                                                                    }
                                                                ])->label(false);
                                                            ?>
                                                        </label>
                                                        <label>
                                                            <?= $form->field($model, 'Membrane')
                                                                ->radioList([2=>'YES'],[ 'class' => '','style' =>'',
                                                                    'item' => function($index, $label, $name, $checked, $value){
                                                                        return "<label>&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"radio\" name=\"".$name."\" value=\"".$value."\"checked>"."&nbsp;".$label."</label>";
                                                                    }
                                                                ])->label(false);
                                                            ?>
                                                        </label>
                                                    <?php }else{ ?>
                                                        <label>
                                                            <?= $form->field($model, 'Membrane')
                                                                ->radioList([1=>'NO'],[ 'class' => '','style' =>'',
                                                                    'item' => function($index, $label, $name, $checked, $value){
                                                                        return "<label>&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"radio\" name=\"".$name."\" value=\"".$value."\"checked>"."&nbsp;".$label."</label>";
                                                                    }
                                                                ])->label(false);
                                                            ?>
                                                        </label>
                                                        <label>
                                                            <?= $form->field($model, 'Membrane')
                                                                ->radioList([2=>'YES'],[ 'class' => '','style' =>'',
                                                                    'item' => function($index, $label, $name, $checked, $value){
                                                                        return "<label>&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"radio\" name=\"".$name."\" value=\"".$value."\" disabled>"."&nbsp;".$label."</label>";
                                                                    }
                                                                ])->label(false);
                                                            ?>
                                                        </label>
                                                    <?php }?>
                                                </b>
                                            </h5>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr style="background-color: #b9ffda;">
                                <td colspan="2" style="text-align: left;width:50%;color: black">
                                    <h5  style="text-align: left;<?php echo $Font_S;?>">
                                        <b style="color: black">DELIVERY : </b>
                                        <?php if($Data_brthsignmed[0]->DLMTHDNAME == null){ ?>
                                            <b style="<?php echo $Font_S;?>"> - </b>
                                        <?php }else{ ?>
                                            <b style="<?php echo $Font_S;?>"> <?php echo $Data_brthsignmed[0]->DLMTHDNAME ?></b>
                                        <?php } ?>
                                    </h5>
                                </td>
                                <td style="text-align: left;width:50%;color: black">
                                    <div class="row align-items-start">
                                        <div class="col-4">
                                            <h5  style="text-align: left;<?php echo $Font_S;?>"><b style="color: black">Haemorrhage :</b></h5>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr style="background-color: #b9ffda;">
                                <td colspan="2" style="text-align: left;width:50%;color: black">
                                    <h5 style="text-align: left;<?php echo $Font_S;?>">
                                        <b style="color: black">CS indication : </b>
                                    </h5>
                                </td>
                                <td style="text-align: left;width:50%;color: black">
                                    <div class="row align-items-start">
                                        <div class="col-4">
                                            <h5  style="text-align: left;<?php echo $Font_S;?>"><b style="color: black">Hysterectomy :</b></h5>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr style="background-color: #b9ffda;">
                                <td colspan="2" style="text-align: left;width:50%;color: black">
                                    <h5 style="text-align: left;<?php echo $Font_S;?>">
                                        <b style="color: black">Amniotic fluid : </b>
                                        <?php if($Data_brthsignmed[0]->FLUIDCOLRNAME == null){ ?>
                                            <b style="<?php echo $Font_S;?>"> - </b>
                                        <?php }else{ ?>
                                            <b style="<?php echo $Font_S;?>"> <?php echo $Data_brthsignmed[0]->FLUIDCOLRNAME ?></b>
                                        <?php } ?>
                                    </h5>
                                </td>
                                <td style="text-align: left;width:50%;color: black">
                                    <div class="row align-items-start">
                                        <div class="col-4">
                                            <h5  style="text-align: left;<?php echo $Font_S;?>"><b style="color: black">Blood transfusion :</b></h5>
                                        </div>
                                        <div class="col-8" style="height: 0px;">
                                            <h5  style="text-align: left;<?php echo $Font_S;?>">
                                                <b style="color: #5a5a5a">
                                                    <label>
                                                        <?= $form->field($model, 'Blood_tr')
                                                            ->radioList([1=>'NO', 2=>'YES'],[ 'class' => '','style' =>'',
                                                                'item' => function($index, $label, $name, $checked, $value){
                                                                    return "<label>&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"radio\" name=\"".$name."\" value=\"".$value."\">"."&nbsp;".$label."</label>";
                                                                }
                                                            ])->label(false);
                                                        ?>
                                                    </label>
                                                </b>
                                            </h5>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr style="background-color: #b9ffda;">
                                <td colspan="3" style="text-align: left;width:50%;color: black">
                                    <div class="">
                                        <table width="100%" border="0">
                                            <tbody>
                                            <tr >
                                                <th  style="background-color: #d1ffee;color: black">
                                                    <b style="color: black;<?php echo $Font_S;?>">Birth Weight</b>
                                                </th>
                                                <th style="background-color: #d1ffee;color: black">
                                                    <b style="color: black;<?php echo $Font_S;?>">Length</b>
                                                </th>
                                                <th style="background-color: #d1ffee;color: black">
                                                    <b style="color: black;<?php echo $Font_S;?>">Head circumference</b>
                                                </th>
                                                <th style="background-color: #d1ffee;color: black">
                                                    <b style="color: black;<?php echo $Font_S;?>">Chest circumference</b>
                                                </th>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <?php if($Data_brthsignmed[0]->WEIGHT == null){ ?>
                                                        <b style="color: #5a5a5a;<?php echo $Font_S;?>">-</b>
                                                    <?php }else{ ?>
                                                        <b style="color: #5a5a5a;<?php echo $Font_S;?>"><?php echo $Data_brthsignmed[0]->WEIGHT ?></b>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php if($Data_brthsignmed[0]->BODY == null){ ?>
                                                        <b style="color: #5a5a5a;<?php echo $Font_S;?>">-</b>
                                                    <?php }else{ ?>
                                                        <b style="color: #5a5a5a;<?php echo $Font_S;?>"><?php echo $Data_brthsignmed[0]->BODY ?></b>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php if($Data_brthsignmed[0]->HEAD == null){ ?>
                                                        <b style="color: #5a5a5a;<?php echo $Font_S;?>">-</b>
                                                    <?php }else{ ?>
                                                        <b style="color: #5a5a5a;<?php echo $Font_S;?>"><?php echo $Data_brthsignmed[0]->HEAD ?></b>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php if($Data_brthsignmed[0]->CHEST == null){ ?>
                                                        <b style="color: #5a5a5a;<?php echo $Font_S;?>">-</b>
                                                    <?php }else{ ?>
                                                        <b style="color: #5a5a5a;<?php echo $Font_S;?>"><?php echo $Data_brthsignmed[0]->CHEST ?></b>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                            <tr style="background-color: #b9ffda;">
                                <td colspan="3" style="text-align: left;width:50%;color: black">
                                    <div class="">
                                        <h5  style="margin: 0 12px -14px;<?php echo $Font_S;?>">
                                            <b style="color: red;background-color: #d1ffee;<?php echo $Font_S;?>" >&nbsp;Baby Temp&nbsp;</b>
                                        </h5>
                                        <table width="100%" border="0">
                                            <tbody>
                                            <tr >
                                                <th  style="background-color: #d1ffee;color: black">
                                                    <b style="color: black;<?php echo $Font_S;?>">Temperature in labour room</b>
                                                </th>
                                                <th style="background-color: #d1ffee;color: black">
                                                    <b style="color: black;<?php echo $Font_S;?>">Temperature in NS</b>
                                                </th>
                                                <th style="background-color: #d1ffee;color: black">
                                                    <b style="color: black;<?php echo $Font_S;?>">Temperature in NS2</b>
                                                </th>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <?php if($Data_brthsignmed[0]->BT == null){ ?>
                                                        <b style="color: #5a5a5a;<?php echo $Font_S;?>">-</b>
                                                    <?php }else{ ?>
                                                        <b style="color: #5a5a5a;<?php echo $Font_S;?>"><?php echo $Data_brthsignmed[0]->BT ?></b>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php if($Data_brthsignmed[0]->STBT == null){ ?>
                                                        <b style="color: #5a5a5a;<?php echo $Font_S;?>">-</b>
                                                    <?php }else{ ?>
                                                        <b style="color: #5a5a5a;<?php echo $Font_S;?>"><?php echo $Data_brthsignmed[0]->STBT ?></b>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php if($Data_brthsignmed[0]->NDBT == null){ ?>
                                                        <b style="color: #5a5a5a;<?php echo $Font_S;?>">-</b>
                                                    <?php }else{ ?>
                                                        <b style="color: #5a5a5a;<?php echo $Font_S;?>"><?php echo $Data_brthsignmed[0]->NDBT ?></b>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>

                            <tr style="background-color: #b9ffda;">
                                <td colspan="2" style="text-align: left;width:50%;color: black">
                                    <div class="">
                                        <h5  style="margin: 0 12px -14px;<?php echo $Font_S;?>">
                                            <b style="color: #1d28ff;background-color: #d1ffee;<?php echo $Font_S;?>" >&nbsp;Apgar Score&nbsp;</b>
                                        </h5>
                                        <table width="100%" border="0">
                                            <tbody>
                                            <tr >
                                                <th  style="background-color: #d1ffee;color: black">
                                                    <b style="color: black;<?php echo $Font_S;?>">1 min</b>
                                                </th>
                                                <th style="background-color: #d1ffee;color: black">
                                                    <b style="color: black;<?php echo $Font_S;?>">5 min</b>
                                                </th>
                                                <th style="background-color: #d1ffee;color: black">
                                                    <b style="color: black;<?php echo $Font_S;?>">10 min</b>
                                                </th>
                                                <th style="background-color: #d1ffee;color: black">
                                                    <b style="color: black;<?php echo $Font_S;?>">15 min</b>
                                                </th>
                                                <th style="background-color: #d1ffee;color: black">
                                                    <b style="color: black;<?php echo $Font_S;?>">20 min</b>
                                                </th>
                                            </tr>
                                            <tr>

                                                <td>
                                                    <?php foreach ($Data_dlvstdtapgar as $dlvstdtapgar){ ?>
                                                        <?php if($dlvstdtapgar->MINUTE == 1){ ?>
                                                            <?php if($dlvstdtapgar->TOTAL == null){ ?>
                                                                <input class="form-control my-0 py-1" style="" type="text" id="1_MIN" value="-" disabled autocomplete="off" >
                                                            <?php }else{ ?>
                                                                <input class="form-control my-0 py-1" style="" type="text" id="1_MIN" value="<?php echo $dlvstdtapgar->TOTAL ?>" disabled autocomplete="off" >
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php foreach ($Data_dlvstdtapgar as $dlvstdtapgar){ ?>
                                                        <?php if($dlvstdtapgar->MINUTE == 5){ ?>
                                                            <?php if($dlvstdtapgar->TOTAL == null){ ?>
                                                                <input class="form-control my-0 py-1" style="" type="text" id="5_MIN" value="-" disabled autocomplete="off" >
                                                            <?php }else{ ?>
                                                                <input class="form-control my-0 py-1" style="" type="text" id="5_MIN" value="<?php echo $dlvstdtapgar->TOTAL ?>" disabled autocomplete="off" >
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php foreach ($Data_dlvstdtapgar as $dlvstdtapgar){ ?>
                                                        <?php if($dlvstdtapgar->MINUTE == 10){ ?>
                                                            <?php if($dlvstdtapgar->TOTAL == null){ ?>
                                                                <input class="form-control my-0 py-1" style="" type="text" id="10_MIN" value="-" disabled autocomplete="off" >
                                                            <?php }else{ ?>
                                                                <input class="form-control my-0 py-1" style="" type="text" id="10_MIN" value="<?php echo $dlvstdtapgar->TOTAL ?>" disabled autocomplete="off" >
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <input class="form-control my-0 py-1" style="" type="text" id="15_MIN" autocomplete="off" >
                                                </td>
                                                <td>
                                                    <input class="form-control my-0 py-1" style="" type="text" id="20_MIN" autocomplete="off" >
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                                <td colspan="2" style="text-align: left;width:50%;color: black">
                                    <div class="">
                                        <h5  style="<?php echo $Font_S;?>">
                                            <b style="color: red">Resuscitation :</b>
                                        </h5>
                                    </div>
                                </td>
                            </tr>

                        </table>
                    </div>
                </div>


















                <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br><br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br><br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br>















                <div class="row" style="border: 13px solid rgba(0,0,0,0);">
                    <table>
                        <tr>
                            <th colspan="2" style="background-color: #00ffb1;color: black">
                                <h1><b style="color: black">SUMMARY COURSE OF PERINATAL CONDITIONS</b></h1>
                            </th>
                        </tr>
                        <tr>
                            <td style="background-color: #dcffed">
                                <h5  style="text-align: left;"><b style="color: black">Mother's Blood Group</b></h5>
                                <h5  style="text-align: left;"><b style="color: black">Mother drug abuse </b></h5>
                            </td>
                            <td style="background-color: #ffffff"></td>
                        </tr>
                        <tr>
                            <td style="background-color: #dcffed">
                                <table width="100%" border="0">
                                    <tbody>
                                    <tr>
                                        <td>
                                            <h6  style="text-align: left;"><b style="color: black">VDRL Syphilis 1 : Non-Reactive   Titer :</b></h6>
                                            <h6  style="text-align: left;"><b style="color: black">FTA-ABS :</b></h6>
                                            <h6  style="text-align: left;"><b style="color: black">VDRL Syphilis 2 : Non-Reactive   Titer :</b></h6>
                                            <h6  style="text-align: left;"><b style="color: black">FTA-ABS :</b></h6>
                                            <h6  style="text-align: left;"><b style="color: black">HBsAg1 :</b></h6>
                                            <h6  style="text-align: left;"><b style="color: black">HBeAg2 :</b></h6>
                                            <h6  style="text-align: left;"><b style="color: black">AntiHIV :</b></h6>
                                            <h6  style="text-align: left;"><b style="color: black">DCIP :</b></h6>
                                            <h6  style="text-align: left;"><b style="color: black">Hb Typing :</b></h6>
                                            <h6  style="text-align: left;"><b style="color: black">Thyroid Hormone :</b></h6>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                            <td style="background-color: #ffffff;vertical-align: text-top;">
                                <h5  style="text-align: left;"><b style="color: black">DISCHARGE date :</b></h5>
                                <h5  style="text-align: left;"><b style="color: black">DISCHARGE Wt. </b></h5>
                                <h5  style="text-align: left;"><b style="color: black">Condition Normal </b></h5>
                                <h5  style="text-align: left;"><b style="color: black">Condition Improved </b></h5>
                                <h5  style="text-align: left;"><b style="color: black">Condition Transfer </b></h5>
                                <h5  style="text-align: left;"><b style="color: black">Condition Expired </b></h5>
                                <h5  style="text-align: left;"><b style="color: black">Condition Against Advice </b></h5>
                                <h5  style="text-align: left;"><b style="color: black">Disposition Vitamin </b></h5>
                                <h5  style="text-align: left;"><b style="color: black">Disposition Iron </b></h5>
                                <h5  style="text-align: left;"><b style="color: black">Disposition AntiHIV Medication </b></h5>
                                <h5  style="text-align: left;"><b style="color: black">Disposition Other </b></h5>
                            </td>
                        </tr>
                        <tr>
                            <td style="background-color: #dcffed;vertical-align: text-top;">
                                <h5  style="text-align: left;"><b style="color: black">Nationnality </b></h5>
                                <h5  style="text-align: left;"><b style="color: black">OB History G </b></h5>
                                <h5  style="text-align: left;"><b style="color: black">EDC  </b></h5>
                                <h5  style="text-align: left;"><b style="color: black">ANC  </b></h5>
                                <h5  style="text-align: left;"><b style="color: black">No.of attendance </b></h5>
                            </td>
                            <td style="background-color: #ffffff;" rowspan="6">
                                <h5  style="text-align: left;"><b style="color: black">Blood gr Infant : </b></h5>
                                <div class="row align-items-start">
                                    <div class="col-3">
                                        <h5  style="text-align: left;"><b style="color: black">Rh Infant</b></h5>
                                    </div>
                                    <div class="col-9" style="height: 0px;">
                                        <?= $form->field($model, 'Radio_MARITAL')
                                            ->radioList(['Positive'=>'Positive','Negative'=>'Negative'],[ 'class' => '','style' =>'text-align: left;color: black;',
                                                'item' => function($index, $label, $name, $checked, $value){
                                                    return "<label>&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"radio\" name=\"".$name."\" value=\"".$value."\">"."&nbsp;".$label."</label>";
                                                }
                                            ])->label(false);
                                        ?>
                                    </div>
                                </div>
                                <h5 style="text-align: left;"><b style="color: black">Direct Coomb's  </b></h5>
                                <h5  style="text-align: left;"><b style="color: black">Indirect Coomb's  </b></h5>
                                <h5  style="text-align: left;"><b style="color: black">Infant RPR </b></h5>
                                <h5  style="text-align: left;"><b style="color: black">infant FTA-ABS</b></h5>
                                <h5  style="text-align: left;"><b style="color: black">infant HBsAg </b></h5>
                                <h5  style="text-align: left;"><b style="color: black">infant PCR for HIV</b></h5>
                                <h5  style="text-align: left;"><b style="color: black">Preterm :</b></h5>
                                <h5  style="text-align: left;"><b style="color: black">Postterm :</b></h5>
                                <h5  style="text-align: left;"><b style="color: black">Term</b></h5>
                                <h5  style="text-align: left;"><b style="color: black">LGA</b></h5>
                                <h5  style="text-align: left;"><b style="color: black">AGA</b></h5>
                                <h5  style="text-align: left;"><b style="color: black">SGA</b></h5>
                                <h5  style="text-align: left;"><b style="color: black">Perinatal asphyxia</b></h5>
                            </td>
                        </tr>
                        <tr>
                            <td style="background-color: #dcffed;width: 50%">
                                <h5  style="text-align: left;"><b style="color: black">previous OB complication</b></h5>
                            </td>
                        </tr>
                        <tr>
                            <td style="background-color: #dcffed;width: 50%">
                                <h5  style="text-align: left;"><b style="color: black">present OB complication</b></h5>
                            </td>
                        </tr>
                        <tr>
                            <td style="background-color: #dcffed;width: 50%">
                                <h5  style="text-align: left;"><b style="color: black">Haemorrhage </b></h5>
                                <h5  style="text-align: left;"><b style="color: black">Hysterectomy</b></h5>
                                <h5  style="text-align: left;"><b style="color: black">Blood transfusion</b></h5>
                            </td>
                        </tr>
                        <tr>
                            <td style="background-color: #dcffed;">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h5  style="text-align: center;"><b style="color: black">Mother Rx for Syphilis </b></h5>
                                    </div>
                                    <div class="col-4">
                                        <h5  style="text-align: center;"><b style="color: black">Mother Rx last dose</b></h5>
                                    </div>
                                    <div class="col">
                                        <h5  style="text-align: center;"><b style="color: black">ชื่อยา</b></h5>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="background-color: #dcffed;">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h5  style="text-align: center;"><b style="color: black">Father Rx for Syphilis </b></h5>
                                        <h5  style="text-align: left;"><b style="color: black">Bleeding </b></h5>
                                    </div>
                                    <div class="col-4">
                                        <h5  style="text-align: center;"><b style="color: black">Father Rx last dose</b></h5>
                                    </div>
                                    <div class="col">
                                        <h5  style="text-align: center;"><b style="color: black">ชื่อยา</b></h5>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="background-color: #dcffed;" rowspan="2">
                                <h5  style="text-align: left;"><b style="color: black">Membrane Leakage for</b></h5>
                            </td>
                            <td style="background-color: #ffffff;">
                                <h5  style="text-align: left;"><b style="color: black">Birth trauma</b></h5>
                            </td>
                        </tr>
                        <tr style="background-color: #ffffff;">
                            <td> <h5  style="text-align: left;"><b style="color: black">Hyperbilirubinemia</b></h5></td>
                        </tr>
                        <tr>
                            <td style="background-color: #dcffed;" rowspan="5">
                                <h5  style="text-align: left;"><b style="color: black">DELIVERY Gestation</b></h5>
                                <h5  style="text-align: left;"><b style="color: black">DELIVERY</b></h5>
                                <h5  style="text-align: left;"><b style="color: black">CS indication</b></h5>
                                <h5  style="text-align: left;"><b style="color: black">Amniotic fluid</b></h5>
                                <h5  style="text-align: left;"><b style="color: black">Delivery other complication</b></h5>
                                <h5  style="text-align: left;"><b style="color: black">Newborn complication at PP</b></h5>
                                <h5  style="text-align: left;"><b style="color: black">BIRTH Place</b></h5>
                            </td>
                            <td style="background-color: #ffffff;">
                                <h5  style="text-align: left;"><b style="color: black">Congenital anomalies</b></h5>
                            </td>
                        </tr>
                        <tr>
                            <td style="background-color: #ffffff;">
                                <h5  style="text-align: left;"><b style="color: black">Infection</b></h5>
                            </td>
                        </tr>
                        <tr>
                            <td style="background-color: #ffffff;">
                                <h5  style="text-align: left;"><b style="color: black">Hematologic Problems</b></h5>
                            </td>
                        </tr>
                        <tr>
                            <td style="background-color: #ffffff;">
                                <h5  style="text-align: left;"><b style="color: black">Respiratory Distress</b></h5>
                            </td>
                        </tr>
                        <tr>
                            <td style="background-color: #ffffff;">
                                <h5  style="text-align: left;"><b style="color: black">Seizure </b></h5>
                                <h5  style="text-align: left;"><b style="color: black">Cardiac problem </b></h5>
                                <h5  style="text-align: left;"><b style="color: black">Metabolic problem </b></h5>
                                <h5  style="text-align: left;"><b style="color: black">Autopsy  </b></h5>
                                <h5  style="text-align: left;"><b style="color: black">Other  </b></h5>
                            </td>
                        </tr>
                        <tr>
                            <td style="background-color: #dcffed;">
                                <h5  style="text-align: left;"><b style="color: black">Apgar Score</b></h5>
                                <div class="row">
                                    <div class="col-2">
                                        <h5  style="text-align: left;"><b style="color: black">1 min</b></h5>
                                    </div>
                                    <div class="col-2">
                                        <h5  style="text-align: left;"><b style="color: black">5 min</b></h5>
                                    </div>
                                    <div class="col-2">
                                        <h5  style="text-align: left;"><b style="color: black">10 min</b></h5>
                                    </div>
                                    <div class="col-2">
                                        <h5  style="text-align: left;"><b style="color: black">15 min</b></h5>
                                    </div>
                                    <div class="col-2">
                                        <h5  style="text-align: left;"><b style="color: black">20 min</b></h5>
                                    </div>
                                    <div class="col-2">
                                    </div>
                                </div>
                            </td>
                            <td style="background-color: #ffffff;">
                                <h5  style="text-align: left;"><b style="color: black">Hct :  </b></h5>
                                <h5  style="text-align: left;"><b style="color: black">POCT for glucose : </b></h5>
                            </td>
                        </tr>
                        <tr>
                            <td style="background-color: #dcffed;">
                                <h5  style="text-align: left;"><b style="color: black">Resuscitation</b></h5>
                                <h5  style="text-align: left;"><b style="color: black">Resuscitation Other</b></h5>
                                <h5  style="text-align: left;"><b style="color: black">Medication</b></h5>
                            </td>
                            <td style="background-color: #ffffff;">
                                <h5  style="text-align: left;"><b style="color: black">Bilirubin Total : </b></h5>
                                <h5  style="text-align: left;"><b style="color: black">Bilirubin Direct : </b></h5>
                                <h5  style="text-align: left;"><b style="color: black">Bilirubin Indirect : </b></h5>
                            </td>
                        </tr>
                        <tr>
                            <td style="background-color: #dcffed;">
                                <div class="row">
                                    <div class="col">
                                        <h5  style="text-align: left;"><b style="color: black">Birth Weight</b></h5>
                                    </div>
                                    <div class="col">
                                        <h5  style="text-align: left;"><b style="color: black">Length</b></h5>
                                    </div>
                                </div>
                            </td>
                            <td style="background-color: #ffffff;">
                                <h5  style="text-align: left;"><b style="color: black">Bilirubin DC Total : </b></h5>
                                <h5  style="text-align: left;"><b style="color: black">Bilirubin DC Direct : </b></h5>
                                <h5  style="text-align: left;"><b style="color: black">Bilirubin DC Indirect : </b></h5>
                            </td>
                        </tr>
                        <tr>
                            <td style="background-color: #dcffed;">
                                <div class="row">
                                    <div class="col">
                                        <h5  style="text-align: left;"><b style="color: black">Head circumfernce </b></h5>
                                    </div>
                                    <div class="col">
                                        <h5  style="text-align: left;"><b style="color: black">Chest </b></h5>
                                    </div>
                                </div>
                            </td>
                            <td rowspan="4" style="background-color: #ffffff;">
                                <h5  style="text-align: left;"><b style="color: black">X-ray Number : </b></h5>
                                <h5  style="text-align: left;"><b style="color: black">Hemoculture test </b></h5>
                                <h5  style="text-align: left;"><b style="color: black">Hemoculture </b></h5>
                                <h5  style="text-align: left;"><b style="color: black">CSF Culture test </b></h5>
                                <h5  style="text-align: left;"><b style="color: black">CSF Culture </b></h5>
                                <h5  style="text-align: left;"><b style="color: black">Treatment </b></h5>
                                <h5  style="text-align: left;"><b style="color: black">Medication</b></h5>
                                <h5  style="text-align: left;"><b style="color: black">Phototherapy</b></h5>
                                <h5  style="text-align: left;"><b style="color: black">Respiratory Support :</b></h5>
                                <h5  style="text-align: left;"><b style="color: black">CCHD :</b></h5>
                                <h5  style="text-align: left;"><b style="color: black">Hearing test</b></h5>
                                <h5  style="text-align: left;"><b style="color: black">Metabolic test</b></h5>
                                <h5  style="text-align: left;"><b style="color: black">G6PD test</b></h5>
                            </td>
                        </tr>
                        <tr>
                            <td style="background-color: #dcffed;">
                                <h5  style="text-align: left;"><b style="color: black">Temperature in labour room</b></h5>
                            </td>
                        </tr>

                    </table>
                </div>
            </div>
            </div>
        <?php } ?>
        <?php ActiveForm::end(); ?>
    <?php }else{ ?>
        <div class="main-contain">
            <!---------Alert----------->
            <?= Alert::widget() ?>
            <div class="jumbotron text-center bg-transparent">
                <h1 class="display-4">ขนาดหน้าจอที่ใช้อยู่ <br> ไม่สามารถเข้าถึงหน้านี้ได้</h1>
                <i class="fas fa-eye-slash" style="color: #ff5e52" aria-hidden="true"></i>
                <p class="lead">กรุณาติต่อเจ้าหน้าที่ ผู้ดูแลระบบ</p>
                <p><a class="btn btn-lg btn-success" href="#">Contact Staff</a></p>
            </div>
        </div>
    <?php } ?>
<?php }else{ ?>
    <div class="main-contain">
        <!---------Alert----------->
        <?= Alert::widget() ?>
        <div class="jumbotron text-center bg-transparent">
            <h1 class="display-4">IP เครื่องที่คุณใช้อยู่ <br> ไม่มีสิทธิ์ในการเข้าถึงหน้านี้ssssss
                <i class="fas fa-eye-slash" style="color: #ff5e52" aria-hidden="true"></i>
                <p class="lead">กรุณาติต่อเจ้าหน้าที่ ผู้ดูแลระบบ</p>
                <p><a class="btn btn-lg btn-success" href="#">Contact Staff</a></p>
        </div>
    </div>
<?php }} ?>



<?php
$this->registerJS('
                $(function() {
                    $("#donationdata").dataTable({
                        "order": [[0, "desc"]],
                        "bPaginate": true,
                        "bLengthChange": true,
//                        "bFilter": false,
                        "bSort": true,
                        "bInfo": true,
                        "bAutoWidth": true,
//                        "pagingType": "full_numbers"
                    });
                });
            ');
?>




<script type="text/javascript">

    function MyKeyHN_QSNICH() {
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
    function MyKeyAN_QSNICH() {
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

    function CheckDate(target, source) {
        //========================================ซ่อนและแสดงรูป===============================================
        document.getElementById(target).innerHTML = document.getElementById(source).innerHTML;
        //===============================================================================================
    }

    $(function(){
        //========================================รอโหลดหน้า===============================================
        $("#overlay").fadeOut();
        $(".main-contain").removeClass("main-contain");
        //===============================================================================================
    });

</script>

<style>
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
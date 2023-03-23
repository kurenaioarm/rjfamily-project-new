<?php
    use kartik\select2\Select2;
    use yii\helpers\Html;
?>

<?php
    if (isset($Array_rmplace , $Length_V2 , $value )) {
        //    -------------------------------------------------------------- ตรวจสอบค่าว่าง ------------------------------------------------------------------
        if($Check_Status == ""){
            $disabled = false;
            $Data_value = null;
        }else {
            $disabled = true;
            $Data_value = $value;
            echo  Html::hiddenInput('RiskReportForm[Incident_Location]', $value);
        }
        //    --------------------------------------------------------------------------------------------------------------------------------------------
        //    ------------------------------------------------ Select2 Incident_Location สถานที่เกิดเหตุ ----------------------------------------------------
//        echo $form->field($model, 'Incident_Location')->widget(Select2::classname(), [
//            'name' => 'Incident_Location',
//            'id' => 'Incident_Location',
//            'value' => $Data_value, // initial value
//            'data' => $Array_rmplace,
//            'disabled' => $disabled,
//            'size' => Select2::MEDIUM,
//            'options' => [
//                'placeholder' => 'Select a state ...',
//                'onchange' =>"Check_rmlc(this.value);",
//            ],
//            'pluginOptions' => [
//                'width' => $Length_V2,
//                'allowClear' => true
//            ],
//        ]);
//        //    ------------------------------------------------------------ Select2 ไม่ใช้ form ----------------------------------------------------------------
        echo Select2::widget([
            'name' => 'Incident_Location',
            'id' => 'Incident_Location',
            'value' => $Data_value, // initial value
            'data' => $Array_rmplace,
            'disabled' => $disabled,
            'size' => Select2::MEDIUM,
            'options' => [
                'placeholder' => 'Select a state ...',
                'onchange' =>"Check_rmlc(this.value);",
            ],
            'pluginOptions' => [
                'width' => $Length_V2,
                'allowClear' => true,
            ],
        ]);
        //    ----------------------------------------------------------------------------------------------------------------------------------------------
    }
?>



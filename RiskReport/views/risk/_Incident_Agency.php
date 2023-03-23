<?php
    use kartik\select2\Select2;

    if (isset($Array_rmlct , $Length_V2 )) {
        //    ------------------------------------------------ Select2 Incident_Agency หน่วยงานที่เกิดเหตุ ----------------------------------------------------
//        echo $form->field($model, 'Incident_Agency')->widget(Select2::classname(), [
//            'name' => 'RiskReportForm[Incident_Agency]',
//            'id' => 'Incident_Agency',
//            'data' => $Array_rmlct,
//            'size' => Select2::MEDIUM,
//            'options' => [
//                'placeholder' => 'Select a state ...',
//                'onchange' =>"Check_rmplace(this.value);",
//            ],
//            'pluginOptions' => [
//                'width' => $Length_V2,
//                'allowClear' => true,
//            ],
//        ])->label(false);
        //    ------------------------------------------------------------ Select2 ไม่ใช้ form ----------------------------------------------------------------
        echo Select2::widget([
            'name' => 'RiskReportForm[Incident_Agency]',
            'id' => 'Incident_Agency',
            'data' => $Array_rmlct,
            'size' => Select2::MEDIUM,
            'options' => [
                'placeholder' => 'Select a state ...',
                'onchange' =>"Check_rmplace(this.value);",
            ],
            'pluginOptions' => [
                'width' => $Length_V2,
                'allowClear' => true,
            ],
        ]);
        //    ----------------------------------------------------------------------------------------------------------------------------------------------
    }
?>

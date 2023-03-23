<?php

use yii\helpers\Html;

echo Html::tag('option', 'เลือก อำเภอ/เขต', ['value'=>'']);
//var_dump($Array_rmlct);
foreach($Array_rmlct as $rmlct){
    echo Html::tag('option', Html::encode($rmlct), ['value'=>$rmlct]);
}
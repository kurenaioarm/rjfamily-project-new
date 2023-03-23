<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Ot */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ot-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'd1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'd2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'd3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'd4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'd5')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'd6')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'd7')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'd8')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'd9')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'd10')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'd11')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'd12')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'd13')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'd14')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'd15')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'd16')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'd17')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'd18')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'd19')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'd20')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'd21')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'd22')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'd23')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'd24')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'd25')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'd26')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'd27')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'd28')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'd29')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'd30')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'd31')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'etc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'add_timestamp')->textInput() ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

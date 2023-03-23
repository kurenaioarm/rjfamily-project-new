<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ot */

$this->title = 'Update Ot: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Ots', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ot-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

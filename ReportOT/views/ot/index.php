<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OtSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>

<?php

$this->title = 'Ots';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ot-index">

    <p>
        <?= Html::a('Create Ot', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => [
            'class' => 'table table-striped table-hover',
            'width'=>'100%',
            'cellspacing'=> '0'
        ],
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'id',
                'header' => 'รหัส',
                'filter' => false,
            ],
            [
                'attribute' => 'name',
                'header' => 'ชื่อ-นามสกุล',
                'filter' => false

            ],
            'd1',
            'd2',
            'd3',
            'd4',
            'd5',
            'd6',
            'd7',
            'd8',
            'd9',
            'd10',
            'd11',
            'd12',
            'd13',
            'd14',
            'd15',
            'd16',
            'd17',
            'd18',
            'd19',
            'd20',
            'd21',
            'd22',
            'd23',
            'd24',
            'd25',
            'd26',
            'd27',
            'd28',
            'd29',
            'd30',
            'd31',
//            'etc',
//            'add_timestamp',
//            'status',
//            [
//                'class' => ActionColumn::className(),
//                'urlCreator' => function ($action, Ot $model, $key, $index, $column) {
//                    return Url::toRoute([$action, 'id' => $model->id]);
//                 }
//            ],
        ],
    ]); ?>


</div>

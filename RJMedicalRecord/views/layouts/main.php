<?php

/* @var $this \yii\web\View */
/* @var $content string */

use common\widgets\Alert;
//use RJMedicalRecord\assets\AppAsset;
use RJMedicalRecord\assets\MintyAsset;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

/*
The directory is not writable by the Web process ....AppAsset
chmod -R 777 /var/www/html/backend/web/assets
*/

MintyAsset::register($this);
//AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>" class="h-100">
    <head>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
        <!--ICON => https://www.w3schools.com/icons/icons_reference.asp-->
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <header>
        <?php  $Access_Token =  Yii::$app->session->get('arrayAccess_Token'); ?>

        <?php
        NavBar::begin([
            'brandLabel' => 'RJ Medical Record',
            'brandUrl' => ['/medicalrecord/index'],
            'options' => [
                'class' => 'navbar navbar-expand-md navbar-dark fixed-top ',
                'style'=>'font-size: 19px;background-color: #151515;',
            ],
        ]);

        if($Access_Token['admin']->json_data === []){
            $menuItems = [
                ['label' => ' งานบันทึกข้อมูลแม่และเด็ก ', 'url' => ['/medicalrecord/index'],
                    'options' => [
                        'style'=>'font-size: 17px;',
                    ]],
                ['label' => 'ออกจากระบบ', 'url' => ['/login/login_his'],
                    'options' => [
                        'class' => 'font-weight-bold btn btn-danger',
                        'style'=>'font-size: 16px;position: absolute;right: 30px; top: 30px; width:160px;background-color: #FF3F59; border: 2px solid white;',
                    ]],
            ];
        }else{
            $menuItems = [
                ['label' => ' งานบันทึกข้อมูลแม่และเด็ก ', 'url' => ['/medicalrecord/index'],
                    'options' => [
                        'style'=>'font-size: 17px;',
                    ]],
                ['label' => 'จัดการผู้ใช้งาน', 'url' => ['/setupadmin/index'],'visible' => $Access_Token['admin']->json_data[0]->TYPE_ID === "1",
                    'options' => [
                        'class' => 'font-weight-bold btn btn-info',
                        'style'=>'font-size: 16px;position: absolute;right: 200px;top: 70%; width:160px;background-color: #17a2b8;color:black; border: 2px solid white;',
                    ]],
                ['label' => 'ออกจากระบบ', 'url' => ['/login/login_his'],
                    'options' => [
                        'class' => 'font-weight-bold btn btn-danger ',
                        'style'=>'font-size: 16px;position: absolute;right: 30px; top: 70%; width:160px;background-color: #FF3F59; border: 2px solid white;',
                    ]],
            ];
        }

        echo Nav::widget([
            'options' => ['class' => 'navbar-nav'],
            'items' => $menuItems,
        ]);
        NavBar::end();
        ?>
    </header>

    <main role="main" class="flex-shrink-0">
        <div class="" style="width: 100%">
            <div class="h-100 d-inline-flex align-items-center py-2 px-3" style="font-size: 12px; margin-top: 54px">
                <i class="fas fa-user-alt text-primary mr-2"></i>
                <?php if($Access_Token['admin']->json_data == []){  ?>
                    <small>ผู้ใช้งาน : <?php echo $Access_Token["user"]->staff_name ?> <b style="color: red">[ยังไม่ได้ลงทะเบียนสิทธิ์การใช้งาน]</b> : <?php echo ' '.$_SERVER['REMOTE_ADDR']; ?></small>
                <?php }else{ ?>
                    <?php if($Access_Token['admin']->json_data[0]->TYPE_ID === "1"){ ?>
                        <small>ผู้ใช้งาน : <?php echo $Access_Token["user"]->staff_name ?> [SuperAdmin] : <?php echo ' '.$_SERVER['REMOTE_ADDR']; ?></small>
                    <?php }elseif ($Access_Token['admin']->json_data[0]->TYPE_ID === "2") { ?>
                        <small>ผู้ใช้งาน : <?php echo $Access_Token["user"]->staff_name ?> [Admin] : <?php echo ' '.$_SERVER['REMOTE_ADDR']; ?></small>
                    <?php }elseif ($Access_Token['admin']->json_data[0]->TYPE_ID === "3") { ?>
                        <small>ผู้ใช้งาน : <?php echo $Access_Token["user"]->staff_name ?> [ผู้ใช้งานทั่วไป] : <?php echo ' '.$_SERVER['REMOTE_ADDR']; ?></small>
                    <?php }else{ ?>
                        <small>ผู้ใช้งาน : <?php echo $Access_Token["user"]->staff_name ?> [ผู้ใช้งานโรงพยาบาลเด็ก] : <?php echo ' '.$_SERVER['REMOTE_ADDR']; ?></small>
                    <?php } ?>
                <?php } ?>
            </div>

            <?php if($Access_Token['admin']->json_data == []){  ?>
                <div class="main-contain">
                    <!---------Alert----------->
                    <?= Alert::widget() ?>
                    <div class="jumbotron text-center bg-transparent"><br><br><br>
                        <h1 class="display-4" style="color: red">คุณยังไม่ได้ลงทะเบียนสิทธิ์การใช้งาน <br> ไม่มีสิทธิ์ในการเข้าถึงหน้านี้ </h1>
                        <i class="fas fa-eye-slash" style="color: red" aria-hidden="true"></i>
                        <p class="lead">กรุณาติต่อเจ้าหน้าที่ ผู้ดูแลระบบ</p>
                    </div>
                </div>
            <?php }else{ ?>
                <hr style="border: 1px; margin-top: -3px">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?= Alert::widget() ?>

                <?= $content ?>
            <?php } ?>
        </div>
    </main>

    <footer class="footer mt-auto py-3 text-muted " style="font-size: 12px;background-color: #151515;">
        <small style="float:left;"> &nbsp;&nbsp;&nbsp; © Copyright © Registration Of Mother & Child Information WebApplication</small>
        <small style="float:right;">Designed by จัดทำโดย ศูนย์คอมพิวเตอร์ รพ.ราชวิถี&nbsp;&nbsp;&nbsp; </small>
    </footer>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage(); ?>




<?php

/* @var $this \yii\web\View */
/* @var $content string */

use common\widgets\Alert;
//use RiskReport\assets\AppAsset;
use RiskReport\assets\MintyAsset;
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
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <header >

        <?php

        NavBar::begin([
            'brandLabel' => 'รายงานความเสี่ยง โรงพยาบาลราชวิถี',
            'brandUrl' => ['/risk/index'],
            'options' => [
                'class' => 'navbar navbar-expand-lg navbar-dark bg-dark', // สี header
            ],
        ]);

        $Access_Token =  Yii::$app->session->get('arrayAccess_Token');
//        var_dump($Access_Admin);die();

        if($Access_Token['admin']->json_data === []){
            $menuItems = [
                ['label' => '', 'url' => ['/risk/index']],
                ['label' => '', 'url' => ['/risk/index']],

                ['label' => 'รายงานอุบัติเหตุ-อุบัติการณ์', 'url' => ['/risk/index']],
                ['label' => 'Logout', 'url' => ['/login/login_his']], //'visible' => 2 === 2],
                //        ['label' => 'Contact', 'url' => ['/site/contact']],
            ];
        }else{
            $menuItems = [
                ['label' => '', 'url' => ['/risk/index']],
                ['label' => '', 'url' => ['/risk/index']],

                ['label' => 'รายงานอุบัติเหตุ-อุบัติการณ์', 'url' => ['/risk/index']],
                ['label' => 'SuperAdmin', 'url' => ['/superadmin/index'],'visible' => $Access_Token['admin']->json_data[0]->TYPE_ID === "1"],
                ['label' => 'Admin', 'url' => ['/risk/index'],'visible' => $Access_Token['admin']->json_data[0]->TYPE_ID === "2"],
                ['label' => 'Logout', 'url' => ['/login/login_his']], //'visible' => 2 === 2],
                //        ['label' => 'Contact', 'url' => ['/site/contact']],
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
        <div class="p-4 my-4 " style="width: 100%">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>

            <?= $content ?>
        </div>
    </main>

    <footer class="footer mt-auto py-3 text-muted">

    </footer>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage();


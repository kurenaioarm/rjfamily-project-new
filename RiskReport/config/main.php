<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-RiskReport',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'th',
    'timeZone' => 'Asia/Bangkok',
    'homeUrl' => '/RiskReport',
//    'layoutPath' => '@app/views/layouts',
    'controllerNamespace' => 'RiskReport\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-appRiskReport',
            'csrfCookie' => [
                'httpOnly' => true,
                'path' => '/RiskReport',
            ],
            'baseUrl' => '/RiskReport',
            'enableCsrfValidation'=>false,
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-RiskReport', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the RiskReport
            'name' => 'advanced-RiskReport',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => true,
            'rules' => [
            ],
        ],
    ],
    'params' => $params,
];

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
//    $config['bootstrap'][] = 'debug';
//    $config['modules']['debug'] = [
//        'class' => 'yii\debug\Module',
//    ];
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['*'],
    ];
}


<?php
        $tns = "(DESCRIPTION =
                  (ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = 192.168.1.90)(PORT = 1521)) )
                  (CONNECT_DATA = (SERVICE_NAME = rjdb) )
              )";
return [
    'components' => [
        'db_ot' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=192.168.1.45;dbname=computer',
            'username' => 'root',
            'password' => 'ik=;b5u@65',
            'charset' => 'utf8',
        ],

        'oci' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'oci:dbname='.$tns.';charset=UTF8',
            'username' => 'H_NUTCHANON',
            'password' => '1234',
        ],



        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
        ],
    ],
];

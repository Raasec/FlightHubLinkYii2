<?php

return [
    'id' => 'app-backend-tests',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',

    'components' => [
        'request' => [
            'cookieValidationKey' => 'test',
            'enableCsrfValidation' => false,
        ],

        
        'user' => [
            'identityClass' => common\models\User::class,
            'enableSession' => true, // !! 
            'loginUrl' => ['site/login'],
        ],
        
        /*
        'session' => [
            'class' => yii\web\Session::class,
        ],
        */

        'db' => [
            'class' => yii\db\Connection::class,
            'dsn' => 'mysql:host=localhost;dbname=aeroportodb_test',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],

        'urlManager' => [
            'enablePrettyUrl' => false,
            'showScriptName' => true,
        ],

        'assetManager' => [
            'basePath' => '@backend/web/assets',
        ],
    ],

    'params' => require __DIR__ . '/../../common/config/params.php',
];

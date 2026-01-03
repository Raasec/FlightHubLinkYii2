<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'api' => [
            'class' => 'backend\modules\api\ModuleAPI',
        ]
    ],
    'layout' => 'main',
    'as access' => [
        'class' => yii\filters\AccessControl::class,
        'except' => [
            'site/login',
            'site/error',
            'site/logout',
            'api/*',
        ],
        'rules' => [
            [
                'allow' => true,
<<<<<<< Updated upstream
                'roles' => ['administrador', 'funcionario'],
=======
                'roles' => ['administrador','funcionario'],   // só ADMIN pode aceder
>>>>>>> Stashed changes
            ],
        ],
    ],


    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'enableSession' => true,  
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            [
                'class' => 'yii\rest\UrlRule',
                'controller' => 'api/auth',
                'pluralize' => false,
            ],
            [
                'class' => 'yii\rest\UrlRule',
                'controller' => 'api/voo',
                'pluralize' => false,
                'extraPatterns' => [
                    'GET origem/{cidade}' => 'porOrigem',
                ],
                'tokens' => [
                    '{cidade}' => '<cidade:[^\/]+>',
                ],
            ],
            [
                'class' => 'yii\rest\UrlRule',
                'controller' => 'api/bilhete',
                'pluralize' => false,
            ],
            [
                'class' => 'yii\rest\UrlRule',
                'controller' => 'api/review',
                'pluralize' => false,
            ],
            [
                'class' => 'yii\rest\UrlRule',
                'controller' => 'api/user-profile',
                'pluralize' => false,
                'extraPatterns' => [
                    'GET me' => 'me',
                    'PUT update' => 'update',
                ],
            ],
        ]

        ],

        'assetManager' => [
            'bundles' => [
                'dmstr\web\AdminLteAsset' => [
                    'class' => 'hail812\adminlte3\assets\AdminLteAsset'
                ],
            ],
        ],    
    ],
    
    'params' => $params,
];

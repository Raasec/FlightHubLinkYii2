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
        'ruleConfig' => [
            'class' => yii\filters\AccessRule::class,
        ],

        // Páginas que nao requer permissoes
        'except' => ['site/login', 'site/error', 'site/logout'], // permitir login
        'rules' => [
            [
                'allow' => true,
                'roles' => ['administrador','funcionario'],   // só ADMIN pode aceder  <- FILHO DA PUTA ROMAN U MISS TYPED IT AND BECAUSE OF THAT I HAD TO CHECK EVERYSINGLE THING NONSTOP AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
            ],
        ],
    ],

    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
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
            //'enableStrictParsing' => false,
            /*'rules' => [
                'class' => 'yii\rest\UrlRule',
                'controller' => [
                    'api/voo',
                    'api/bilhete',
                    'api/notificacao',
                    'api/review'
                ],*/
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'api/voo',
                    'pluralize' => false
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'api/bilhete',
                    'pluralize' => false
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'api/notificacao',
                    'pluralize' => false
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'api/review',
                    'pluralize' => false
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

<?php

use yii\helpers\ArrayHelper;

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return ArrayHelper::merge(

    // Common base config
    require __DIR__ . '/../../common/config/main.php',
    require __DIR__ . '/../../common/config/main-local.php',

    [
        'id' => 'app-backend',
        'basePath' => dirname(__DIR__),
        'controllerNamespace' => 'backend\controllers',
        'bootstrap' => ['log'],
        'layout' => 'main',

        'modules' => [
            'api' => [
                'class' => 'backend\modules\api\ModuleAPI',
            ],
        ],

        //
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
                    'roles' => ['administrador', 'funcionario'],
                ],
            ],
        ],

        'components' => [

            'request' => [
                'csrfParam' => '_csrf-backend',
                'parsers' => [
                    'application/json' => yii\web\JsonParser::class,
                ],
            ],

            'user' => [
                'identityClass' => common\models\User::class,
                'enableAutoLogin' => true,
                'enableSession' => true,
                'identityCookie' => [
                    'name' => '_identity-backend',
                    'httpOnly' => true,
                ],
            ],

            'authManager' => [
                'class' => yii\rbac\DbManager::class,
            ],

            'session' => [
                'name' => 'advanced-backend',
            ],

            'log' => [
                'traceLevel' => YII_DEBUG ? 3 : 0,
                'targets' => [
                    [
                        'class' => yii\log\FileTarget::class,
                        'levels' => ['error', 'warning'],
                    ],
                ],
            ],

            'errorHandler' => [
                'errorAction' => 'site/error',
            ],

            // URL RULES 
            'urlManager' => [
                'enablePrettyUrl' => true,
                'showScriptName' => false,
                'rules' => [

                    [
                        'class' => yii\rest\UrlRule::class,
                        'controller' => 'api/auth',
                        'pluralize' => false,
                    ],
                    [
                        'class' => yii\rest\UrlRule::class,
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
                        'class' => yii\rest\UrlRule::class,
                        'controller' => 'api/bilhete',
                        'pluralize' => false,
                    ],
                    [
                        'class' => yii\rest\UrlRule::class,
                        'controller' => 'api/review',
                        'pluralize' => false,
                    ],
                    [
                        'class' => yii\rest\UrlRule::class,
                        'controller' => 'api/user-profile',
                        'pluralize' => false,
                        'extraPatterns' => [
                            'GET me' => 'me',
                            'PUT update' => 'update',
                        ],
                    ],
                ],
            ],

            'assetManager' => [
                'bundles' => [
                    'dmstr\web\AdminLteAsset' => [
                        'class' => hail812\adminlte3\assets\AdminLteAsset::class,
                    ],
                ],
            ],
        ],

        'params' => $params,
    ]
);

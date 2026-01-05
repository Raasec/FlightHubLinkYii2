<?php

return [
    'id' => 'app-common-tests',
    'basePath' => dirname(__DIR__),

    'components' => [
        'db' => require __DIR__ . '/test-local.php',
    ],

    'params' => require __DIR__ . '/params.php',
];

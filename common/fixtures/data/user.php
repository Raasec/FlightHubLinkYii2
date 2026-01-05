<?php

return [
    'admin' => [
        'id' => 1,
        'username' => 'admin',
        'auth_key' => 'testkey_admin',
        'password_hash' => Yii::$app->security->generatePasswordHash('admin1234'),
        'email' => 'admin@test.com',
        'status' => 10,
    ],
    'funcionario' => [
        'id' => 2,
        'username' => 'func',
        'auth_key' => 'testkey_func',
        'password_hash' => Yii::$app->security->generatePasswordHash('func1234'),
        'email' => 'func@test.com',
        'status' => 10,
    ],
    'passageiro' => [
        'id' => 3,
        'username' => 'pass',
        'auth_key' => 'testkey_pass',
        'password_hash' => Yii::$app->security->generatePasswordHash('pass1234'),
        'email' => 'pass@test.com',
        'status' => 10,
    ],
];

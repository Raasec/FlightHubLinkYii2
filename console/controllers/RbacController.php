<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll(); // limpa tudo

        // Roles 
        $guest = $auth->createRole('guest');
        $auth->add($guest);

        $passageiro = $auth->createRole('passageiro');
        $auth->add($passageiro);

        $funcionario = $auth->createRole('funcionario');
        $auth->add($funcionario);

        $admin = $auth->createRole('admin');
        $auth->add($admin);

        // Permissions
        $manageUsers = $auth->createPermission('manageUsers');
        $manageUsers->description = 'Gerir utilizadores';
        $auth->add($manageUsers);

        $manageFlights = $auth->createPermission('manageFlights');
        $manageFlights->description = 'Gerir voos';
        $auth->add($manageFlights);

        $manageNotifications = $auth->createPermission('manageNotifications');
        $manageNotifications->description = 'Gerir notificações';
        $auth->add($manageNotifications);

        // Atribui as permitissions as roles
        $auth->addChild($funcionario, $manageFlights);
        $auth->addChild($funcionario, $manageNotifications);

        $auth->addChild($admin, $manageUsers);
        $auth->addChild($admin, $funcionario); // herda permissões de funcionário

        // ROLE DEFAULT 
        $auth->addChild($passageiro, $guest);

        echo "RBAC configurado com sucesso!\n";
    }
}

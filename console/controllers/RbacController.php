<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll(); // limpa tudo antes de recriar

        // Roles 
        $guest = $auth->createRole('guest');
        $auth->add($guest);

        $passageiro = $auth->createRole('passageiro');
        $auth->add($passageiro);

        $funcionario = $auth->createRole('funcionario');
        $auth->add($funcionario);

        $admin = $auth->createRole('admin');
        $auth->add($admin);


        // Permissions base
        $manageUsers = $auth->createPermission('manageUsers');
        $manageUsers->description = 'Gerir utilizadores';
        $auth->add($manageUsers);

        $manageFlights = $auth->createPermission('manageFlights');
        $manageFlights->description = 'Gerir voos';
        $auth->add($manageFlights);

        $manageNotifications = $auth->createPermission('manageNotifications');
        $manageNotifications->description = 'Gerir notificações';
        $auth->add($manageNotifications);

        
        // Novas permissões básicas do front-office
        $viewFlights = $auth->createPermission('viewFlights');
        $viewFlights->description = 'Ver voos e informações públicas';
        $auth->add($viewFlights);

        $doCheckin = $auth->createPermission('doCheckin');
        $doCheckin->description = 'Realizar check-in';
        $auth->add($doCheckin);

        $viewHistory = $auth->createPermission('viewHistory');
        $viewHistory->description = 'Ver histórico de voos';
        $auth->add($viewHistory);

        $editProfile = $auth->createPermission('editProfile');
        $editProfile->description = 'Editar perfil do utilizador';
        $auth->add($editProfile);

        $receiveNotifications = $auth->createPermission('receiveNotifications');
        $receiveNotifications->description = 'Receber notificaçoes de alterações de voos';
        $auth->add($receiveNotifications);

        $replanFlight = $auth->createPermission('replanFlight');
        $replanFlight->description = 'Replaneamento de voos e sugestões de voos alternativos';
        $auth->add($replanFlight);

        $makePayment = $auth->createPermission('makePayment');
        $makePayment->description = 'Fazer pagamentos';
        $auth->add($makePayment);

        $requestAssistance = $auth->createPermission('requestAssistance');
        $requestAssistance->description = 'Submeter pedidos de assistência';
        $auth->add($requestAssistance);

        $viewMaps = $auth->createPermission('viewMaps');
        $viewMaps->description = 'Visualizar mapas de terminais e aeroporto';
        $auth->add($viewMaps);

        $viewServices = $auth->createPermission('viewServices');
        $viewServices->description = 'Visualizar lojas, restaurantes e serviços';
        $auth->add($viewServices);

        $submitComplaint = $auth->createPermission('submitComplaint');
        $submitComplaint->description = 'Submeter reclamaçoẽs ou pedidos de objetos perdidos';
        $auth->add($submitComplaint);

        $rateServices = $auth->createPermission('rateServices');
        $rateServices->description = 'Avaliar serviços';
        $auth->add($rateServices);

        $viewNews = $auth->createPermission('viewNews');
        $viewNews->description = 'Consultar noticias e dicas de viagem';
        $auth->add($viewNews);

        $resetPassword = $auth->createPermission('resetPassword');
        $resetPassword->description = 'Resetar a password';
        $auth->add($resetPassword);

        // permissões básicas do back-office
        $manageContent = $auth->createPermission('manageContent');
        $manageContent->description = 'Gerir conteudo do front-office';
        $auth->add($manageContent);

        $manageIncidents = $auth->createPermission('manageIncidents');
        $manageIncidents->description = 'Gerir incidentes do aeroporto';
        $auth->add($manageIncidents);


        // atribuicao das permissões aos roles
        // guest: so pode ver voos, podemos meter tipo serviços mais tarde??? <--- TODO
        $auth->addChild($guest, $viewFlights);

        // passageiro: tudo do guest + coisas proprias
        $auth->addChild($passageiro, $guest);
        $auth->addChild($passageiro, $doCheckin);
        $auth->addChild($passageiro, $viewHistory);
        $auth->addChild($passageiro, $editProfile);

        // funcionario: perms do back-office + herdadas do passageiro
        $auth->addChild($funcionario, $passageiro);
        $auth->addChild($funcionario, $manageFlights);
        $auth->addChild($funcionario, $manageNotifications);
        $auth->addChild($funcionario, $manageIncidents);
        $auth->addChild($funcionario, $manageContent);

        // admin: tudo do funcionario + gestao de utilizadores
        $auth->addChild($admin, $funcionario); // herda tudo
        $auth->addChild($admin, $manageUsers);

        echo "RBAC configurado com sucesso\n";
    }
}

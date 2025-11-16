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

        $admin = $auth->createRole('administrador');
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

        
        // permissões do front-office (acredito que estajam quase todas)
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

        $manageSpecialAssistance = $auth->createPermission('manageSpecialAssistance');
        $manageSpecialAssistance->description = 'Gerir pedidos de assistência especial';
        $auth->add($manageSpecialAssistance);

        $manageStores = $auth->createPermission('manageStores');
        $manageStores->description = 'Gerir lojas e restaurantes';
        $auth->add($manageStores);

        $managePredefinedNotifications = $auth->createPermission('managePredefinedNotifications');
        $managePredefinedNotifications->description = 'Gerir notificações predefinidas';
        $auth->add($managePredefinedNotifications);

        $manageReports = $auth->createPermission('manageReports');
        $manageReports->description = 'Gerar relatórios e consultar logs de atividade';
        $auth->add($manageReports);

        $manageFrequentPassengers = $auth->createPermission('manageFrequentPassengers');
        $manageFrequentPassengers->description = 'Gerir base de dados de passageiros frequentes';
        $auth->add($manageFrequentPassengers);

        $manageUserAccessLogs = $auth->createPermission('manageUserAccessLogs');
        $manageUserAccessLogs->description = 'Controlar histórico de login e ações dos utilizadores';
        $auth->add($manageUserAccessLogs);

        $managePhysicalInventory = $auth->createPermission('managePhysicalInventory');
        $managePhysicalInventory->description = 'Gerir inventário de recursos físicos';
        $auth->add($managePhysicalInventory);

        $manageSchedules = $auth->createPermission('manageSchedules');
        $manageSchedules->description = 'Gerir horários de trabalho e turnos do pessoal';
        $auth->add($manageSchedules);

        $manageEquipment = $auth->createPermission('manageEquipment');
        $manageEquipment->description = 'Gerir inventário de equipamentos';
        $auth->add($manageEquipment);

        $approveContent = $auth->createPermission('approveContent');
        $approveContent->description = 'Aprovar e publicar atualizações do front-office';
        $auth->add($approveContent);

        $manageSettings = $auth->createPermission('manageSettings');
        $manageSettings->description = 'Gerir configurações gerais do aeroporto';
        $auth->add($manageSettings);

        $generatePassword = $auth->createPermission('generatePassword');
        $generatePassword->description = 'Gerar password para utilizador';
        $auth->add($generatePassword);


        // atribuicao das permissões aos roles
        // guest: 
        $auth->addChild($guest, $viewFlights);
        $auth->addChild($guest, $viewMaps);
        $auth->addChild($guest, $viewServices);
        $auth->addChild($guest, $viewNews);

        // passageiro: tudo do guest + coisas proprias
        $auth->addChild($passageiro, $guest);
        $auth->addChild($passageiro, $doCheckin);
        $auth->addChild($passageiro, $viewHistory);
        $auth->addChild($passageiro, $editProfile);
        $auth->addChild($passageiro, $receiveNotifications);
        $auth->addChild($passageiro, $replanFlight);
        $auth->addChild($passageiro, $makePayment);
        $auth->addChild($passageiro, $requestAssistance);
        $auth->addChild($passageiro, $submitComplaint);
        $auth->addChild($passageiro, $rateServices);
        $auth->addChild($passageiro, $resetPassword);

        // funcionario: perms do back-office + herdadas do passageiro
        $auth->addChild($funcionario, $passageiro);
        $auth->addChild($funcionario, $manageFlights);
        $auth->addChild($funcionario, $manageNotifications);
        $auth->addChild($funcionario, $manageIncidents);
        $auth->addChild($funcionario, $manageContent);
        $auth->addChild($funcionario, $manageSpecialAssistance);
        $auth->addChild($funcionario, $manageStores);
        $auth->addChild($funcionario, $managePredefinedNotifications);
        $auth->addChild($funcionario, $manageReports);
        $auth->addChild($funcionario, $manageFrequentPassengers);
        $auth->addChild($funcionario, $manageUserAccessLogs);
        $auth->addChild($funcionario, $managePhysicalInventory);
        $auth->addChild($funcionario, $manageSchedules);
        $auth->addChild($funcionario, $manageEquipment);
        $auth->addChild($funcionario, $approveContent);
        $auth->addChild($funcionario, $manageSettings);
        $auth->addChild($funcionario, $generatePassword);


        // admin: tudo do funcionario + gestao de utilizadores
        $auth->addChild($admin, $funcionario); // herda tudo
        $auth->addChild($admin, $manageUsers);

        echo "RBAC configurado com sucesso\n";
    }
}

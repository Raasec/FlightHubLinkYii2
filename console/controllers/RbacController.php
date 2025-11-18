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


        // Permissions para managing de users
        $createUser = $auth->createPermission('createUser');
        $createUser->description = 'Criar utilizador';
        $auth->add($createUser);

        $viewUser = $auth->createPermission('viewUser');
        $viewUser->description = 'Ver utilizador';
        $auth->add($viewUser);

        $updateUser = $auth->createPermission('updateUser');
        $updateUser->description = 'Editar utilizador';
        $auth->add($updateUser);

        $deleteUser = $auth->createPermission('deleteUser');
        $deleteUser->description = 'Eliminar utilizador';
        $auth->add($deleteUser);

        $manageUsers = $auth->createPermission('manageUsers');
        $manageUsers->description = 'Gerir utilizadores (CRUD)';
        $auth->add($manageUsers);
        $auth->addChild($manageUsers, $createUser);
        $auth->addChild($manageUsers, $viewUser);
        $auth->addChild($manageUsers, $updateUser);
        $auth->addChild($manageUsers, $deleteUser);
        
        // Permissions para managing de Flights
        $createFlight = $auth->createPermission('createFlight');
        $createFlight->description = 'Criar voo';
        $auth->add($createFlight);

        $viewFlight = $auth->createPermission('viewFlight');
        $viewFlight->description = 'Ver voo';
        $auth->add($viewFlight);

        $updateFlight = $auth->createPermission('updateFlight');
        $updateFlight->description = 'Editar voo';
        $auth->add($updateFlight);

        $deleteFlight = $auth->createPermission('deleteFlight');
        $deleteFlight->description = 'Eliminar voo';
        $auth->add($deleteFlight);

        $manageFlights = $auth->createPermission('manageFlights');
        $manageFlights->description = 'Gerir voos (CRUD)';
        $auth->add($manageFlights);
        $auth->addChild($manageFlights, $createFlight);
        $auth->addChild($manageFlights, $viewFlight);
        $auth->addChild($manageFlights, $updateFlight);
        $auth->addChild($manageFlights, $deleteFlight);


        // Permissions para managing de Incidentes

        $createIncident = $auth->createPermission('createIncident');
        $createIncident->description = 'Criar incidente';
        $auth->add($createIncident);

        $viewIncident = $auth->createPermission('viewIncident');
        $viewIncident->description = 'Ver incidente';
        $auth->add($viewIncident);

        $updateIncident = $auth->createPermission('updateIncident');
        $updateIncident->description = 'Editar incidente';
        $auth->add($updateIncident);

        $deleteIncident = $auth->createPermission('deleteIncident');
        $deleteIncident->description = 'Eliminar incidente';
        $auth->add($deleteIncident);

        $manageIncidents = $auth->createPermission('manageIncidents');
        $manageIncidents->description = 'Gerir incidentes (CRUD)';
        $auth->add($manageIncidents);
        $auth->addChild($manageIncidents, $createIncident);
        $auth->addChild($manageIncidents, $viewIncident);
        $auth->addChild($manageIncidents, $updateIncident);
        $auth->addChild($manageIncidents, $deleteIncident);

        // Permissions para managing de notificações
        $createNotification = $auth->createPermission('createNotification');
        $createNotification->description = 'Criar notificação';
        $auth->add($createNotification);

        $viewNotification = $auth->createPermission('viewNotification');
        $viewNotification->description = 'Ver notificação';
        $auth->add($viewNotification);

        $updateNotification = $auth->createPermission('updateNotification');
        $updateNotification->description = 'Editar notificação';
        $auth->add($updateNotification);

        $deleteNotification = $auth->createPermission('deleteNotification');
        $deleteNotification->description = 'Eliminar notificação';
        $auth->add($deleteNotification);

        $sendNotification = $auth->createPermission('sendNotification');
        $sendNotification->description = 'Enviar notificação';
        $auth->add($sendNotification);

        $manageNotifications = $auth->createPermission('manageNotifications');
        $manageNotifications->description = 'Gerir notificações (CRUD + envio)';
        $auth->add($manageNotifications);
        $auth->addChild($manageNotifications, $createNotification);
        $auth->addChild($manageNotifications, $viewNotification);
        $auth->addChild($manageNotifications, $updateNotification);
        $auth->addChild($manageNotifications, $deleteNotification);
        $auth->addChild($manageNotifications, $sendNotification);

        // Permissions para managing de notificações
        $createReview = $auth->createPermission('createReview');
        $createReview->description = 'Criar avaliação';
        $auth->add($createReview);

        $viewReview = $auth->createPermission('viewReview');
        $viewReview->description = 'Ver avaliação';
        $auth->add($viewReview);

        $updateReview = $auth->createPermission('updateReview');
        $updateReview->description = 'Editar avaliação';
        $auth->add($updateReview);

        $deleteReview = $auth->createPermission('deleteReview');
        $deleteReview->description = 'Eliminar avaliação';
        $auth->add($deleteReview);

        $manageReviews = $auth->createPermission('manageReviews');
        $manageReviews->description = 'Gerir avaliações (CRUD)';
        $auth->add($manageReviews);
        $auth->addChild($manageReviews, $createReview);
        $auth->addChild($manageReviews, $viewReview);
        $auth->addChild($manageReviews, $updateReview);
        $auth->addChild($manageReviews, $deleteReview);


        //Falta lojas crud, retirar os repetidos aqui em baixo






        
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
    }
}

<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;
use console\rbac\ViewOwnFuncionarioRule;

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

        

        //region ---- Permissions CRUD Funcionarios ----
        // ------------------------------------------

        $createFuncionario = $auth->createPermission('createFuncionario');
        $createFuncionario->description = 'Criar funcionário';
        $auth->add($createFuncionario);

        $viewFuncionario = $auth->createPermission('viewFuncionario');
        $viewFuncionario->description = 'Ver funcionário';
        $auth->add($viewFuncionario);

        $viewOwnFuncionario = $auth->createPermission('viewOwnFuncionario');
        $viewOwnFuncionario->description = 'Ver o próprio perfil de funcionário';
        $auth->add($viewOwnFuncionario);
        // Rule (regras) para a confirmar na visualização se o perfil é o próprio
        $rule = new ViewOwnFuncionarioRule();
        $auth->add($rule);
        $viewOwnFuncionario->ruleName =$rule->name;
        $auth->update($viewOwnFuncionario->name, $viewOwnFuncionario);

        $updateFuncionario = $auth->createPermission('updateFuncionario');
        $updateFuncionario->description = 'Editar funcionário';
        $auth->add($updateFuncionario);

        $deleteFuncionario = $auth->createPermission('deleteFuncionario');
        $deleteFuncionario->description = 'Eliminar funcionário';
        $auth->add($deleteFuncionario);

        // Group permission
        $manageFuncionarios = $auth->createPermission('manageFuncionarios');
        $manageFuncionarios->description = 'Gerir funcionários (CRUD)';
        $auth->add($manageFuncionarios);

        // Set inheritance
        $auth->addChild($manageFuncionarios, $createFuncionario);
        $auth->addChild($manageFuncionarios, $viewFuncionario);
        $auth->addChild($manageFuncionarios, $updateFuncionario);
        $auth->addChild($manageFuncionarios, $deleteFuncionario);

        //endregion 
        // ---- (...)
        // END Permission CRUD Funcionarios
        //-----------------------------------

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

         // Permissions Reviews
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

        // Permissions para managing das Airlines
        $createAirline = $auth->createPermission('createAirline');
        $createAirline->description = 'Criar companhia aérea';
        $auth->add($createAirline);

        $viewAirline = $auth->createPermission('viewAirline');
        $viewAirline->description = 'Ver companhia aérea';
        $auth->add($viewAirline);

        $updateAirline = $auth->createPermission('updateAirline');
        $updateAirline->description = 'Editar companhia aérea';
        $auth->add($updateAirline);

        $deleteAirline = $auth->createPermission('deleteAirline');
        $deleteAirline->description = 'Eliminar companhia aérea';
        $auth->add($deleteAirline);

        $manageAirlines = $auth->createPermission('manageAirlines');
        $manageAirlines->description = 'Gerir companhias aéreas (CRUD)';
        $auth->add($manageAirlines);
        $auth->addChild($manageAirlines, $createAirline);
        $auth->addChild($manageAirlines, $viewAirline);
        $auth->addChild($manageAirlines, $updateAirline);
        $auth->addChild($manageAirlines, $deleteAirline);

        // Permissions Services lojas
        $createService = $auth->createPermission('createService');
        $createService->description = 'Criar serviço';
        $auth->add($createService);

        $viewService = $auth->createPermission('viewService');
        $viewService->description = 'Ver serviço';
        $auth->add($viewService);

        $updateService = $auth->createPermission('updateService');
        $updateService->description = 'Editar serviço';
        $auth->add($updateService);

        $deleteService = $auth->createPermission('deleteService');
        $deleteService->description = 'Eliminar serviço';
        $auth->add($deleteService);

        $manageServices = $auth->createPermission('manageServices');
        $manageServices->description = 'Gerir serviços (CRUD)';
        $auth->add($manageServices);
        $auth->addChild($manageServices, $createService);
        $auth->addChild($manageServices, $viewService);
        $auth->addChild($manageServices, $updateService);
        $auth->addChild($manageServices, $deleteService);

        // permissions para o managing dos bilhetes

        $createTicket = $auth->createPermission('createTicket');
        $createTicket->description = 'Criar bilhete';
        $auth->add($createTicket);

        $viewTicket = $auth->createPermission('viewTicket');
        $viewTicket->description = 'Ver bilhete';
        $auth->add($viewTicket);

        $updateTicket = $auth->createPermission('updateTicket');
        $updateTicket->description = 'Editar bilhete';
        $auth->add($updateTicket);

        $deleteTicket = $auth->createPermission('deleteTicket');
        $deleteTicket->description = 'Eliminar bilhete';
        $auth->add($deleteTicket);

        $manageTickets = $auth->createPermission('manageTickets');
        $manageTickets->description = 'Gerir bilhetes (CRUD)';
        $auth->add($manageTickets);
        $auth->addChild($manageTickets, $createTicket);
        $auth->addChild($manageTickets, $viewTicket);
        $auth->addChild($manageTickets, $updateTicket);
        $auth->addChild($manageTickets, $deleteTicket);

        // Permissions checkins
        $createCheckin = $auth->createPermission('createCheckin');
        $createCheckin->description = 'Criar check-in';
        $auth->add($createCheckin);

        $viewCheckin = $auth->createPermission('viewCheckin');
        $viewCheckin->description = 'Ver check-in';
        $auth->add($viewCheckin);

        $updateCheckin = $auth->createPermission('updateCheckin');
        $updateCheckin->description = 'Editar check-in';
        $auth->add($updateCheckin);

        $deleteCheckin = $auth->createPermission('deleteCheckin');
        $deleteCheckin->description = 'Eliminar check-in';
        $auth->add($deleteCheckin);

        $manageCheckins = $auth->createPermission('manageCheckins');
        $manageCheckins->description = 'Gerir check-ins (CRUD)';

        $auth->add($manageCheckins);
        $auth->addChild($manageCheckins, $createCheckin);
        $auth->addChild($manageCheckins, $viewCheckin);
        $auth->addChild($manageCheckins, $updateCheckin);
        $auth->addChild($manageCheckins, $deleteCheckin);

        // Permissions para os tickets
        $createSupportTicket = $auth->createPermission('createSupportTicket');
        $createSupportTicket->description = 'Criar ticket de suporte';
        $auth->add($createSupportTicket);

        $viewSupportTicket = $auth->createPermission('viewSupportTicket');
        $viewSupportTicket->description = 'Ver ticket de suporte';
        $auth->add($viewSupportTicket);

        $updateSupportTicket = $auth->createPermission('updateSupportTicket');
        $updateSupportTicket->description = 'Editar ticket de suporte';
        $auth->add($updateSupportTicket);

        $deleteSupportTicket = $auth->createPermission('deleteSupportTicket');
        $deleteSupportTicket->description = 'Eliminar ticket de suporte';
        $auth->add($deleteSupportTicket);

        $manageSupportTickets = $auth->createPermission('manageSupportTickets');
        $manageSupportTickets->description = 'Gerir tickets de suporte (CRUD)';
        $auth->add($manageSupportTickets);
        $auth->addChild($manageSupportTickets, $createSupportTicket);
        $auth->addChild($manageSupportTickets, $viewSupportTicket);
        $auth->addChild($manageSupportTickets, $updateSupportTicket);
        $auth->addChild($manageSupportTickets, $deleteSupportTicket);


        // Perms gerias, fora CRUDS

        $editProfile = $auth->createPermission('editProfile');
        $editProfile->description = 'Editar perfil próprio';
        $auth->add($editProfile);


        // atribuicao das perms aos roles
        // guest: 
        $auth->addChild($guest, $viewFlight);
        $auth->addChild($guest, $viewService);
        $auth->addChild($guest, $viewReview);
        $auth->addChild($guest, $viewAirline);

        /* passageiro: tudo do guest + coisas proprias, temos de implentar rules aqui suponho, ou separar em mais perms
          ou um CRUD proprio separado para as coisas, tipo o crud usado aqui fica so para o backend com o funcionario
        e o passageiro tens os proprios*/

        $auth->addChild($passageiro, $guest);
        $auth->addChild($passageiro, $manageCheckins);       
        $auth->addChild($passageiro, $manageReviews);        
        $auth->addChild($passageiro, $manageTickets);        
        $auth->addChild($passageiro, $manageSupportTickets); 
        $auth->addChild($passageiro, $editProfile);

        // funcionario: perms do back-office + herdadas do passageiro, talvez separar em mais 1 role no futuro?
        $auth->addChild($funcionario, $passageiro);
        $auth->addChild($funcionario, $manageFlights);
        $auth->addChild($funcionario, $manageNotifications);
        $auth->addChild($funcionario, $manageIncidents);
        $auth->addChild($funcionario, $manageAirlines);
        $auth->addChild($funcionario, $manageServices);
        $auth->addChild($funcionario, $viewOwnFuncionario);

        // admin: tudo do funcionario + gestao de utilizadores
        $auth->addChild($admin, $funcionario);
        $auth->addChild($admin, $manageUsers);
        $auth->addChild($admin, $manageFuncionarios);

    }
    
}

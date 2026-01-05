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


        //region ---- Permissions Users -----
        //-----------------------------------

        $createUser = $auth->createPermission('createUser');
        $createUser->description = 'Create User';
        $auth->add($createUser);

        $viewUser = $auth->createPermission('viewUser');
        $viewUser->description = 'View User';
        $auth->add($viewUser);

        $updateUser = $auth->createPermission('updateUser');
        $updateUser->description = 'Update User';
        $auth->add($updateUser);

        $deleteUser = $auth->createPermission('deleteUser');
        $deleteUser->description = 'Delete User';
        $auth->add($deleteUser);

        $manageUsers = $auth->createPermission('manageUsers');
        $manageUsers->description = 'Manage Users (CRUD)';
        $auth->add($manageUsers);
        $auth->addChild($manageUsers, $createUser);
        $auth->addChild($manageUsers, $viewUser);
        $auth->addChild($manageUsers, $updateUser);
        $auth->addChild($manageUsers, $deleteUser);

        //  --- END Permission CRUD Users
        //endregion 
        
        //  --- END Permission CRUD Users
        //  -----------------------------------


        //region ---- Permissions Administrador ----
        // ------------------------------------------

        $createAdministrador = $auth->createPermission('createAdministrador');
        $auth->add($createAdministrador);

        $viewAdministrador = $auth->createPermission('viewAdministrador');
        $auth->add($viewAdministrador);

        $updateAdministrador = $auth->createPermission('updateAdministrador');
        $auth->add($updateAdministrador);

        $deleteAdministrador = $auth->createPermission('deleteAdministrador');
        $auth->add($deleteAdministrador);

        $manageAdministradores = $auth->createPermission('manageAdministradores');
        $manageAdministradores->description = 'Manage administradores (CRUD)';
        $auth->add($manageAdministradores);

        $auth->addChild($manageAdministradores, $createAdministrador);
        $auth->addChild($manageAdministradores, $viewAdministrador);
        $auth->addChild($manageAdministradores, $updateAdministrador);
        $auth->addChild($manageAdministradores, $deleteAdministrador);

        // END Permission CRUD Administrador        
        //endregion 
        
        // END Permission CRUD Administrador
        //-----------------------------------



        //region ---- Permissions Funcionarios ----
        // ------------------------------------------

        $createFuncionario = $auth->createPermission('createFuncionario');
        $createFuncionario->description = 'Create Employee';
        $auth->add($createFuncionario);

        $viewFuncionario = $auth->createPermission('viewFuncionario');
        $viewFuncionario->description = 'View Employee';
        $auth->add($viewFuncionario);

        $viewOwnFuncionario = $auth->createPermission('viewOwnFuncionario');
        $viewOwnFuncionario->description = 'View Employee Own Profile';
        $auth->add($viewOwnFuncionario);
        // Rule (regras) para a confirmar na visualização se o perfil é o próprio
        $rule = new ViewOwnFuncionarioRule();
        $auth->add($rule);
        $viewOwnFuncionario->ruleName =$rule->name;
        $auth->update($viewOwnFuncionario->name, $viewOwnFuncionario);

        $updateFuncionario = $auth->createPermission('updateFuncionario');
        $updateFuncionario->description = 'Update Employee';
        $auth->add($updateFuncionario);

        $deleteFuncionario = $auth->createPermission('deleteFuncionario');
        $deleteFuncionario->description = 'Delete Employee';
        $auth->add($deleteFuncionario);

        // Group permission
        $manageFuncionarios = $auth->createPermission('manageFuncionarios');
        $manageFuncionarios->description = 'Manage Employees (CRUD)';
        $auth->add($manageFuncionarios);

        // Set inheritance
        $auth->addChild($manageFuncionarios, $createFuncionario);
        $auth->addChild($manageFuncionarios, $viewFuncionario);
        $auth->addChild($manageFuncionarios, $updateFuncionario);
        $auth->addChild($manageFuncionarios, $deleteFuncionario);

        // END Permission CRUD Funcionarios        
        //endregion 
        
        // END Permission CRUD Funcionarios
        //-----------------------------------



        //region --- Permissions passageiro ----
        // -------------------------------------


        $createPassageiro = $auth->createPermission('createPassageiro');
        $auth->add($createPassageiro);

        $viewPassageiro = $auth->createPermission('viewPassageiro');
        $auth->add($viewPassageiro);

        $updatePassageiro = $auth->createPermission('updatePassageiro');
        $auth->add($updatePassageiro);

        $deletePassageiro = $auth->createPermission('deletePassageiro');
        $auth->add($deletePassageiro);

        $managePassageiros = $auth->createPermission('managePassageiros');
        $managePassageiros->description = 'Manage passageiros (CRUD)';
        $auth->add($managePassageiros);

        $auth->addChild($managePassageiros, $createPassageiro);
        $auth->addChild($managePassageiros, $viewPassageiro);
        $auth->addChild($managePassageiros, $updatePassageiro);
        $auth->addChild($managePassageiros, $deletePassageiro);



        //END Permission CRUD Passageiros
        //endregion

        // END Permission CRUD Passageiros
        //-----------------------------------




        //region --- Permissions Profile ---
        //----------------------------------

        $createUserProfile = $auth->createPermission('createUserProfile');
        $createUserProfile->description = ' Create User Profile';
        $auth->add($createUserProfile);

        $viewUserProfile = $auth->createPermission('viewUserProfile');
        $viewUserProfile->description = 'View User Profile';
        $auth->add($viewUserProfile);

        $updateUserProfile = $auth->createPermission('updateUserProfile');
        $updateUserProfile->description = 'Update User Profile';
        $auth->add($updateUserProfile);

        $deleteUserProfile = $auth->createPermission('deleteUserProfile');
        $deleteUserProfile->description = 'Delete User Profile';
        $auth->add($deleteUserProfile);

        // Group permission (ADMIN)
        $manageUserProfiles = $auth->createPermission('manageUserProfiles');
        $manageUserProfiles->description = 'Manage User Profiles (CRUD)';
        $auth->add($manageUserProfiles);

        $auth->addChild($manageUserProfiles, $createUserProfile);
        $auth->addChild($manageUserProfiles, $viewUserProfile);
        $auth->addChild($manageUserProfiles, $updateUserProfile);
        $auth->addChild($manageUserProfiles, $deleteUserProfile);

      // -----                            -----
      //  Own-Profile permissions (with rule)
      // -----                            -----

        $viewOwnUserProfile = $auth->createPermission('viewOwnUserProfile');
        $viewOwnUserProfile->description = 'View own user profile';
        $auth->add($viewOwnUserProfile);

        $updateOwnUserProfile = $auth->createPermission('updateOwnUserProfile');
        $updateOwnUserProfile->description = 'Update own user profile';
        $auth->add($updateOwnUserProfile);

        // Rule  
        $rule = new \console\rbac\ViewOwnUserProfileRule();
        $auth->add($rule);

        $viewOwnUserProfile->ruleName = $rule->name;
        $updateOwnUserProfile->ruleName = $rule->name;

        $auth->update($viewOwnUserProfile->name, $viewOwnUserProfile);
        $auth->update($updateOwnUserProfile->name, $updateOwnUserProfile);

        // Own perms imply base perms
        $auth->addChild($viewOwnUserProfile, $viewUserProfile);
        $auth->addChild($updateOwnUserProfile, $updateUserProfile);


        // END Permission CRUD User Profile        
        //endregion 
        
        // END Permission CRUD Profile
        //-----------------------------------

        

        //region ---- Permissions Flights -----
        // ------------------------------------

        $createFlight = $auth->createPermission('createFlight');
        $createFlight->description = 'Create voo';
        $auth->add($createFlight);

        $viewFlight = $auth->createPermission('viewFlight');
        $viewFlight->description = 'View voo';
        $auth->add($viewFlight);

        $updateFlight = $auth->createPermission('updateFlight');
        $updateFlight->description = 'Edit voo';
        $auth->add($updateFlight);

        $deleteFlight = $auth->createPermission('deleteFlight');
        $deleteFlight->description = 'Delete voo';
        $auth->add($deleteFlight);

        $manageFlights = $auth->createPermission('manageFlights');
        $manageFlights->description = 'Manage voos (CRUD)';
        $auth->add($manageFlights);
        $auth->addChild($manageFlights, $createFlight);
        $auth->addChild($manageFlights, $viewFlight);
        $auth->addChild($manageFlights, $updateFlight);
        $auth->addChild($manageFlights, $deleteFlight);

        // END Permission CRUD Flights
        //endregion 

        // END Permission CRUD Flights
        //-----------------------------------



        //region ---- Permissions Incidentes ----
        // --------------------------------------

        $createIncident = $auth->createPermission('createIncident');
        $createIncident->description = 'Create Incident';
        $auth->add($createIncident);

        $viewIncident = $auth->createPermission('viewIncident');
        $viewIncident->description = 'View Incident';
        $auth->add($viewIncident);

        $updateIncident = $auth->createPermission('updateIncident');
        $updateIncident->description = 'Update Incident';
        $auth->add($updateIncident);

        $deleteIncident = $auth->createPermission('deleteIncident');
        $deleteIncident->description = 'Delete Incident';
        $auth->add($deleteIncident);

        $manageIncidents = $auth->createPermission('manageIncidents');
        $manageIncidents->description = 'Manage Incident (CRUD)';
        $auth->add($manageIncidents);
        $auth->addChild($manageIncidents, $createIncident);
        $auth->addChild($manageIncidents, $viewIncident);
        $auth->addChild($manageIncidents, $updateIncident);
        $auth->addChild($manageIncidents, $deleteIncident);

        // END Permission Incidents CRUD
        //endregion 

        // END Permission Incidents CRUD
        //-----------------------------------



        //region --- Permissions Notificações ----
        // ---------------------------------------

        $createNotification = $auth->createPermission('createNotification');
        $createNotification->description = 'Create Notification';
        $auth->add($createNotification);

        $viewNotification = $auth->createPermission('viewNotification');
        $viewNotification->description = 'View Notification';
        $auth->add($viewNotification);

        $updateNotification = $auth->createPermission('updateNotification');
        $updateNotification->description = 'Update Notification';
        $auth->add($updateNotification);

        $deleteNotification = $auth->createPermission('deleteNotification');
        $deleteNotification->description = 'Delete Notification';
        $auth->add($deleteNotification);

        $sendNotification = $auth->createPermission('sendNotification');
        $sendNotification->description = 'Send Notification';
        $auth->add($sendNotification);

        $manageNotifications = $auth->createPermission('manageNotifications');
        $manageNotifications->description = 'Manage Notifications (CRUD + sending)';
        $auth->add($manageNotifications);
        $auth->addChild($manageNotifications, $createNotification);
        $auth->addChild($manageNotifications, $viewNotification);
        $auth->addChild($manageNotifications, $updateNotification);
        $auth->addChild($manageNotifications, $deleteNotification);
        $auth->addChild($manageNotifications, $sendNotification);

        // END Permission CRUD Notifications
        //endregion 

        // END Permission CRUD Notifications
        //-------------------------------------



        //region --- Permissions Reviews ----
        // ----------------------------------

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

        // END Permission CRUD Reviews        
        //endregion 

        // END Permission CRUD Reviews
        //--------------------------------------



        //region --- Permissions Airlines ---
        // ---------- Companhias areas ------
        
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

        // END Permission CRUD Airlines        
        //endregion 

        // END Permission CRUD Airlines
        //-----------------------------------



        //region Permissions Services lojas
        // -------------------------------------

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

        // END Permission CRUD serviços loja        
        //endregion 

        // END Permission CRUD serviços loja
        //--------------------------------------



        //region --- permissions bilhetes ----
        // -------------------------------------

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

        // END Permission CRUD Bilhetes        
        //endregion 

        // END Permission CRUD Bilhetes
        //--------------------------------------



        //region ----- Permissions checkins -----
        // --------------------------------------

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

        // END Permission CRUD Check in        
        //endregion 

        // END Permission CRUD Check ins
        //--------------------------------------



        //region --- Permissions pedido assistencia ----
        // ---------------------------------------------

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

        // END Permission CRUD pedido assistencia        
        //endregion 

        // END Permission CRUD pedido assistencia
        //--------------------------------------



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
        $auth->addChild($passageiro, $editProfile);


        // funcionario: perms do back-office + herdadas do passageiro, talvez separar em mais 1 role no futuro?
        $auth->addChild($funcionario, $passageiro);
        $auth->addChild($funcionario, $manageFlights);
        $auth->addChild($funcionario, $manageNotifications);
        $auth->addChild($funcionario, $manageIncidents);
        $auth->addChild($funcionario, $manageAirlines);
        $auth->addChild($funcionario, $manageServices);
        $auth->addChild($funcionario, $viewOwnFuncionario);
        $auth->addChild($funcionario, $manageTickets);
        $auth->addChild($funcionario, $manageCheckins);
        $auth->addChild($funcionario, $manageSupportTickets);

        $auth->addChild($funcionario, $viewOwnUserProfile);
        $auth->addChild($funcionario, $updateOwnUserProfile);


        // admin: tudo do funcionario + gestao de utilizadores
        $auth->addChild($admin, $funcionario);
        $auth->addChild($admin, $manageUsers);
        $auth->addChild($admin, $manageFuncionarios);
        $auth->addChild($admin, $manageAdministradores);
        $auth->addChild($admin, $manageUserProfiles);
        $auth->addChild($admin, $manageTickets);
        $auth->addChild($admin, $manageCheckins);
        $auth->addChild($admin, $manageSupportTickets);


    }
    
}

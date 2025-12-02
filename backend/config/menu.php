<?php
// backend/config/menu.php

return [
    // DASHBOARD
    [
        'label' => 'Dashboard',
        'icon' => 'tachometer-alt',
        'url' => ['/site/index'],
    ],

    // GESTÃO DE UTILIZADORES
    ['label' => 'User Management', 'header' => true],

    [
        'label' => 'Users',
        'icon'  => 'fas fa-user',
        'url'   => ['/user/index'],   // UtilizadorController (a criar)
    ],

    
    [
        'label' => 'Administrator',
        'icon'  => 'fas fa-user-shield',
        'url'   => ['/administrador/index'], // AdministradorController
        //'visible' => Yii::$app->user->can('administrador'),
        // opcao acima faz com que o administrador fique invisvel para os funcionarios , nao sei ponho ou nao.
    ],
    [
        'label' => 'Employees',
        'icon'  => 'fas fa-user-tie',
        'url'   => ['/funcionario/index'],   // FuncionarioController
    ],
    [
        'label' => 'Passengers',
        'icon'  => 'fas fa-user-friends',
        'url'   => ['/passageiro/index'],    // PassageiroController
    ],

    // OPERAÇÕES DE VOO
    ['label' => 'Flight Operations', 'header' => true],

    [
        'label' => 'Airlines',
        'icon'  => 'fas fa-building',
        'url'   => ['/companhia-aerea/index'], // CompanhiaAereaController
    ],
    [
        'label' => 'Flights',
        'icon'  => 'fas fa-plane-departure',
        'url'   => ['/voo/index'],           // VooController
    ],
    [
        'label' => 'Tickets',
        'icon'  => 'fas fa-ticket-alt',
        'url'   => ['/bilhete/index'],       // BilheteController
    ],
    [
        'label' => 'Check-ins',
        'icon'  => 'fas fa-clipboard-check',
        'url'   => ['/checkin/index'],       // CheckinController
    ],

    // APOIO AO PASSAGEIRO
    ['label' => 'Passenger Support', 'header' => true],

    [
        'label' => 'Assistance Requests',
        'icon'  => 'fas fa-hands-helping',
        'url'   => ['/pedido-assistencia/index'], // PedidoAssistenciaController
    ],
    [
        'label' => 'Airport Services',
        'icon'  => 'fas fa-concierge-bell',
        'url'   => ['/servico-aeroporto/index'],  // ServicoAeroportoController
    ],

    // COMUNICAÇÃO & QUALIDADE
    ['label' => 'Communication', 'header' => true],

    [
        'label' => 'Notifications',
        'icon'  => 'fas fa-bell',
        'url'   => ['/notificacao/index'],       // NotificacaoController
    ],
    [
        'label' => 'Incidents',
        'icon'  => 'fas fa-exclamation-triangle',
        'url'   => ['/incidente/index'],        // IncidenteController
    ],
    [
        'label' => 'Reviews',
        'icon'  => 'fas fa-star',
        'url'   => ['/review/index'],           // ReviewController
    ],

];

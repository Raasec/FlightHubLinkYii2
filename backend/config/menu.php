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
    ['label' => 'Gestão de Utilizadores', 'header' => true],

    [
        'label' => 'Utilizadores',
        'icon'  => 'fas fa-user',
        'url'   => ['/user/index'],   // UtilizadorController (a criar)
    ],
    [
        'label' => 'Administradores',
        'icon'  => 'fas fa-user-shield',
        'url'   => ['/administrador/index'], // AdministradorController
    ],
    [
        'label' => 'Funcionários',
        'icon'  => 'fas fa-user-tie',
        'url'   => ['/funcionario/index'],   // FuncionarioController
    ],
    [
        'label' => 'Passageiros',
        'icon'  => 'fas fa-user-friends',
        'url'   => ['/passageiro/index'],    // PassageiroController
    ],

    // OPERAÇÕES DE VOO
    ['label' => 'Operações de Voo', 'header' => true],

    [
        'label' => 'Companhias Aéreas',
        'icon'  => 'fas fa-building',
        'url'   => ['/companhia-aerea/index'], // CompanhiaAereaController
    ],
    [
        'label' => 'Voos',
        'icon'  => 'fas fa-plane-departure',
        'url'   => ['/voo/index'],           // VooController
    ],
    [
        'label' => 'Bilhetes',
        'icon'  => 'fas fa-ticket-alt',
        'url'   => ['/bilhete/index'],       // BilheteController
    ],
    [
        'label' => 'Check-ins',
        'icon'  => 'fas fa-clipboard-check',
        'url'   => ['/checkin/index'],       // CheckinController
    ],

    // APOIO AO PASSAGEIRO
    ['label' => 'Apoio ao Passageiro', 'header' => true],

    [
        'label' => 'Pedidos de Assistência',
        'icon'  => 'fas fa-hands-helping',
        'url'   => ['/pedido-assistencia/index'], // PedidoAssistenciaController
    ],
    [
        'label' => 'Serviços de Aeroporto',
        'icon'  => 'fas fa-concierge-bell',
        'url'   => ['/servico-aeroporto/index'],  // ServicoAeroportoController
    ],

    // COMUNICAÇÃO & QUALIDADE
    ['label' => 'Comunicação', 'header' => true],

    [
        'label' => 'Notificações',
        'icon'  => 'fas fa-bell',
        'url'   => ['/notificacao/index'],       // NotificacaoController
    ],
    [
        'label' => 'Incidentes',
        'icon'  => 'fas fa-exclamation-triangle',
        'url'   => ['/incidente/index'],        // IncidenteController
    ],
    [
        'label' => 'Reviews',
        'icon'  => 'fas fa-star',
        'url'   => ['/review/index'],           // ReviewController
    ],

    // API (REST)
    ['label' => 'API (REST)', 'header' => true],

    [
        'label' => 'API Voo',
        'icon'  => 'fas fa-paper-plane',
        'url'   => ['/api/voo/index'],          // módulo backend\modules\api
    ],
    [
        'label' => 'API Bilhete',
        'icon'  => 'fas fa-receipt',
        'url'   => ['/api/bilhete/index'],
    ],
    [
        'label' => 'API Notificação',
        'icon'  => 'fas fa-broadcast-tower',
        'url'   => ['/api/notificacao/index'],
    ],
    [
        'label' => 'API Review',
        'icon'  => 'fas fa-comment-dots',
        'url'   => ['/api/review/index'],
    ],
];

<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
    'user.passwordResetTokenExpire' => 3600,
    'user.passwordMinLength' => 8,
    
    // mqtt config
    'mqtt' => [
        'host' => 'test.mosquitto.org', // n sei se esta bem aq
        'port' => 1883,
        'clientId' => 'flighthub-api',
    ],
];

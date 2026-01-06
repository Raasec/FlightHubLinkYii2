<?php

namespace common\services;

use common\models\Voo;
use common\models\Bilhete;

class FlightUtilityService
{
    public static function deactivateExpiredFlights()
    {
        return Voo::updateAll(
            ['status' => 0], 
            [
                'and', 
                ['!=', 'status', 0], 
                ['<', 'departure_date', date('Y-m-d H:i:s')]
            ]
        );
    }

    public static function updateTicketStatuses()
    {
        $now = date('Y-m-d H:i:s');
        
        $subQuery = Voo::find()
            ->select('id_voo')
            ->where(['<', 'arrival_date', $now]);

        return Bilhete::updateAll(
            ['status' => 'Used'],
            [
                'and',
                ['in', 'id_voo', $subQuery],
                ['in', 'status', ['Paid', 'Check-in']]
            ]
        );
    }
}

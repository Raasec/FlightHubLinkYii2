<?php

namespace common\services;

use common\models\CompanhiaAerea;
use Yii;

class AirlineSeeder
{
    /**
     * Sincroniza o dataset de companhias aéreas.
     * - Cria as que não existem
     * - Atualiza (overwrite) as existentes
     * - Não duplica (iata_code é UNIQUE)
     */
    public static function syncDefaultAirlines(): array
    {
        $data = self::defaultData();

        $created = 0;
        $updated = 0;

        foreach ($data as $airline) {
            $model = CompanhiaAerea::findOne([
                'iata_code' => $airline['iata_code']
            ]);

            if ($model === null) {
                $model = new CompanhiaAerea();
                $created++;
            } else {
                $updated++;
            }

            $model->name = $airline['name'];
            $model->iata_code = $airline['iata_code'];
            $model->country_origin = $airline['country_origin'];
            $model->image = $airline['image'];

            if (!$model->save()) {
                Yii::error($model->errors, 'airlineSeeder');
            }
        }

        return [
            'total'   => count($data),
            'created' => $created,
            'updated' => $updated,
        ];
    }

    /**
     * Dataset oficial de companhias aéreas
     */
    private static function defaultData(): array
    {
        return [
            ['name'=>'TAP Air Portugal','iata_code'=>'TP','country_origin'=>'Portugal','image'=>'TAPairline.png'],
            ['name'=>'SATA Azores Airlines','iata_code'=>'S4','country_origin'=>'Portugal','image'=>'Azores-Airlines-Logo.png'],
            ['name'=>'SATA Air Açores','iata_code'=>'SP','country_origin'=>'Portugal','image'=>'SataAirAcores.png'],
            ['name'=>'Lufthansa','iata_code'=>'LH','country_origin'=>'Germany','image'=>'Lufthansa-logo.png'],
            ['name'=>'Air France','iata_code'=>'AF','country_origin'=>'France','image'=>'Air-France-Logo.png'],
            ['name'=>'Iberia','iata_code'=>'IB','country_origin'=>'Spain','image'=>'Iberia-logo.png'],
            ['name'=>'KLM','iata_code'=>'KL','country_origin'=>'Netherlands','image'=>'KLM-Logo.png'],
            ['name'=>'Swiss International Air Lines','iata_code'=>'LX','country_origin'=>'Switzerland','image'=>'Swiss-International-Air-Lines-Emblem.png'],
            ['name'=>'British Airways','iata_code'=>'BA','country_origin'=>'United Kingdom','image'=>'British-Airways-Logo.png'],
            ['name'=>'Ryanair','iata_code'=>'FR','country_origin'=>'Ireland','image'=>'ryanair-logo.png'],
            ['name'=>'easyJet','iata_code'=>'U2','country_origin'=>'United Kingdom','image'=>'easyJet-logo.png'],
            ['name'=>'Vueling','iata_code'=>'VY','country_origin'=>'Spain','image'=>'vuelingAirlines.png'],
            ['name'=>'Eurowings','iata_code'=>'EW','country_origin'=>'Germany','image'=>'Eurowings-Logo.png'],
            ['name'=>'Transavia','iata_code'=>'HV','country_origin'=>'Netherlands','image'=>'Transavia-Logo.png'],
            ['name'=>'Wizz Air','iata_code'=>'W6','country_origin'=>'Hungary','image'=>'Wizz_Air_logo.png'],
            ['name'=>'United Airlines','iata_code'=>'UA','country_origin'=>'United States','image'=>'United-logo.png'],
            ['name'=>'American Airlines','iata_code'=>'AA','country_origin'=>'United States','image'=>'american-airlines-logo.png'],
            ['name'=>'Azul Brazilian Airlines','iata_code'=>'AD','country_origin'=>'Brazil','image'=>'Azul-Brazilian-Airlines-Logo.png'],
        ];
    }
}



?>
<?php

namespace common\services;

use Yii;
use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\ConnectionSettings;

/** 
 * used para notificações em tempo real no Android
 * Canais e topics:
 * flighthub/voo/{id_voo} - Updates de voo status gate e por ai
 * flighthub/alertas - alertas gerais do aeroporto
 * flighthub/user/{id}/notificacoes - notificações pessoais
 */
class MqttService
{
    // config do broker  (override por params)
    private static $host;
    private static $port;
    private static $clientId;

    // inicializa configs do MQTT a partir de params
    private static function initConfig()
    {
        self::$host = Yii::$app->params['mqtt']['host'] ?? 'test.mosquitto.org';
        self::$port = Yii::$app->params['mqtt']['port'] ?? 1883;
        self::$clientId = Yii::$app->params['mqtt']['clientId'] ?? 'flighthub-api-' . uniqid();
    }

    /**
     * publica uma mensagem num topic MQTT
     * 
     * @param string $topic o topic/channel para publicar
     * @param array|string $message a mensagem (é JSON encoded se for um array)
     * @param int $qos quality of service 0 1 ou 2
     * @return bool sucesso ou falha
     */
    public static function publish($topic, $message, $qos = 0)
    {
        self::initConfig();

        // Se mensagem for array faz para JSON
        if (is_array($message)) {
            $message = json_encode($message, JSON_UNESCAPED_UNICODE);
        }

        try {
            $mqtt = new MqttClient(self::$host, self::$port, self::$clientId);
            
            $connectionSettings = (new ConnectionSettings())
                ->setConnectTimeout(5)
                ->setKeepAliveInterval(60);

            $mqtt->connect($connectionSettings, true);
            $mqtt->publish($topic, $message, $qos);
            $mqtt->disconnect();

            Yii::info("MQTT publicado em '$topic': $message", 'mqtt');
            return true;

        } catch (\Exception $e) {
            Yii::error("Falha MQTT em '$topic': " . $e->getMessage(), 'mqtt');
            return false;
        }
    }

    
    // topico: flighthub/voo/id_voo

    public static function publishFlightUpdate($voo)
    {
        $topic = "flighthub/voo/{$voo->id_voo}";
        $message = [
            'type' => 'flight_update',
            'id_voo' => $voo->id_voo,
            'numero_voo' => $voo->numero_voo,
            'origin' => $voo->origin,
            'destination' => $voo->destination,
            'departure_date' => $voo->departure_date,
            'arrival_date' => $voo->arrival_date,
            'gate' => $voo->gate,
            'status' => $voo->status,
            'tipo_voo' => $voo->tipo_voo,
            'timestamp' => date('Y-m-d H:i:s'),
        ];

        return self::publish($topic, $message);
    }

    // topico: flighthub/alertas
    public static function publishAirportAlert($titulo, $mensagem, $tipo = 'info')
    {
        $topic = "flighthub/alertas";
        $message = [
            'type' => 'airport_alert',
            'titulo' => $titulo,
            'mensagem' => $mensagem,
            'tipo' => $tipo, // info, warning, emergency
            'timestamp' => date('Y-m-d H:i:s'),
        ];

        return self::publish($topic, $message);
    }

    // topico: flighthub/voo/id_voo/notificacoes
    public static function publishFlightNotification($notificacao)
    {
        $topic = "flighthub/voo/{$notificacao->id_voo}/notificacoes";
        $message = [
            'type' => 'flight_notification',
            'id_notificacao' => $notificacao->id_notificacao,
            'id_voo' => $notificacao->id_voo,
            'titulo' => $notificacao->titulo ?? 'Notificação',
            'mensagem' => $notificacao->mensagem,
            'timestamp' => $notificacao->creation_date ?? date('Y-m-d H:i:s'),
        ];

        return self::publish($topic, $message);
    }
}

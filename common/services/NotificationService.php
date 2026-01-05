<?php

namespace common\services;

use Yii;
use common\models\Notificacao;
use common\models\Bilhete;

// cria notificacoes para passageiros de um voo
class NotificationService
{
    // notifica todos os passageiros de um voo sobre atraso
    public static function notifyFlightDelay($voo, $delayMinutes)
    {
        $bilhetes = Bilhete::find()
            ->where(['id_voo' => $voo->id_voo])
            ->all();

        if (empty($bilhetes)) {
            return 0;
        }

        // cria notificacao para o voo (fica ligada ao voo)
        $notif = new Notificacao();
        $notif->id_voo = $voo->id_voo;
        $notif->type = 'delay';
        $notif->message = "O voo {$voo->numero_voo} ({$voo->origin} → {$voo->destination}) foi atrasado em {$delayMinutes} minutos. Nova hora de partida: " . Yii::$app->formatter->asDatetime($voo->departure_date);
        $notif->sent_at = date('Y-m-d H:i:s');
        $notif->save();

        return count($bilhetes);
    }

    // notifica mudanca de gate
    public static function notifyGateChange($voo, $oldGate, $newGate)
    {
        $notif = new Notificacao();
        $notif->id_voo = $voo->id_voo;
        $notif->type = 'gate_change';
        $notif->message = "O voo {$voo->numero_voo} mudou de gate: {$oldGate} → {$newGate}";
        $notif->sent_at = date('Y-m-d H:i:s');
        $notif->save();

        return true;
    }

    // notificacao generica para um voo
    public static function notifyFlight($voo, $type, $message)
    {
        $notif = new Notificacao();
        $notif->id_voo = $voo->id_voo;
        $notif->type = $type;
        $notif->message = $message;
        $notif->sent_at = date('Y-m-d H:i:s');
        
        return $notif->save();
    }

    // busca notificacoes para um passageiro (pelos voos dos seus bilhetes)
    public static function getNotificationsForUser($userId)
    {
        // buscar id_passageiro
        $passageiro = \common\models\Passageiro::find()
            ->where(['id_utilizador' => $userId])
            ->one();

        if (!$passageiro) {
            return [];
        }

        // buscar voos dos bilhetes do passageiro
        $vooIds = Bilhete::find()
            ->select('id_voo')
            ->where(['id_passageiro' => $passageiro->id_passageiro])
            ->column();

        // Query: id_voo matches user's flights OR id_voo is NULL
        $query = Notificacao::find();

        if (!empty($vooIds)) {
            $query->where(['or',
                ['in', 'id_voo', $vooIds],
                ['is', 'id_voo', null]
            ]);
        } else {
            $query->where(['is', 'id_voo', null]);
        }
        
        if ($passageiro->last_notification_read_at) {
             $query->andWhere(['>', 'sent_at', $passageiro->last_notification_read_at]);
        }

        return $query->orderBy(['sent_at' => SORT_DESC])
            ->limit(10)
            ->all();
    }
}

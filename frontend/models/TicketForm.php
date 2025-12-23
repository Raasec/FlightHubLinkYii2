<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\PedidoAssistencia;

class TicketForm extends Model
{
    public $type;
    public $description;

    public function rules()
    {
        return [
            [['type', 'description'], 'required'],
            [['description'], 'string'],
            [['type'], 'string', 'max' => 100],
        ];
    }

    public function attributeLabels()
    {
        return [
            'type' => 'Type of Request',
            'description' => 'Problem Description',
        ];
    }

    public function save($id_passageiro)
    {
        $ticket = new \common\models\PedidoAssistencia();
        $ticket->id_passageiro = $id_passageiro;
        $ticket->type = $this->type;
        $ticket->description = $this->description;
        $ticket->request_date = date('Y-m-d'); // se queres datetime, usa 'Y-m-d H:i:s'
        $ticket->status = 'open'; // status inicial

        if (!$ticket->save()) {
            // debug
            Yii::error($ticket->errors, __METHOD__);
            return false;
        }

        return true;
    }
    
}

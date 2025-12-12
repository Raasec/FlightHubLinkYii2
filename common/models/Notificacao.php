<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "notificacao".
 *
 * @property int $id_notificacao
 * @property int $id_voo
 * @property string|null $type
 * @property string|null $message
 * @property string|null $sent_at
 *
 * @property Incidente[] $incidentes
 * @property Voo $voo
 */
class Notificacao extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notificacao';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'message', 'sent_at'], 'default', 'value' => null],
            [['id_voo'], 'required'],
            [['id_voo'], 'integer'],
            [['message'], 'string'],
            [['sent_at'], 'safe'],
            [['type'], 'string', 'max' => 50],
            //FK
            [['id_voo'], 'exist', 'skipOnError' => true, 'targetClass' => Voo::class, 'targetAttribute' => ['id_voo' => 'id_voo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_notificacao' => 'Notification ID',
            'id_voo'         => 'Flight ID',
            'type'           => 'Type',
            'message'        => 'Message',
            'sent_at'        => 'Sent At',
        ];
    }

    /**
     * Gets query for [[Incidentes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIncidentes()
    {
        return $this->hasMany(Incidente::class, ['id_notificacao' => 'id_notificacao']);
    }

    /**
     * Gets query for [[Voo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVoo()
    {
        return $this->hasOne(Voo::class, ['id_voo' => 'id_voo']);
    }

}

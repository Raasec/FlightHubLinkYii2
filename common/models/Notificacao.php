<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "notificacao".
 *
 * @property int $id_notificacao
 * @property int $id_voo
 * @property string|null $tipo
 * @property string|null $mensagem
 * @property string|null $data_envio
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
            [['tipo', 'mensagem', 'data_envio'], 'default', 'value' => null],
            [['id_voo'], 'required'],
            [['id_voo'], 'integer'],
            [['mensagem'], 'string'],
            [['data_envio'], 'safe'],
            [['tipo'], 'string', 'max' => 50],
            [['id_voo'], 'exist', 'skipOnError' => true, 'targetClass' => Voo::class, 'targetAttribute' => ['id_voo' => 'id_voo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_notificacao' => 'Id Notificacao',
            'id_voo' => 'Id Voo',
            'tipo' => 'Tipo',
            'mensagem' => 'Mensagem',
            'data_envio' => 'Data Envio',
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

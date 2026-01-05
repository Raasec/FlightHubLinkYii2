<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "incidente".
 *
 * @property int $id_incidente
 * @property int $id_notificacao
 * @property int|null $id_funcionario
 * @property string|null $type
 * @property string|null $description
 * @property string|null $created_at
 *
 * @property Notificacao $notificacao
 * @property Funcionario $funcionario
 */ 
class Incidente extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'incidente';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_funcionario', 'type', 'description', 'created_at', 'id_notificacao'], 'default', 'value' => null],
            [['description'], 'required'], 
            [['id_notificacao', 'id_funcionario'], 'integer'],
            [['description'], 'string'],
            [['created_at'], 'safe'],
            [['type'], 'string', 'max' => 50],

            //FK: incidente.id_notificacao -> notificacao-id_notificacao
            [
                ['id_notificacao'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Notificacao::class,
                'targetAttribute' => ['id_notificacao' => 'id_notificacao']
            ],

            //FK: incidente.id_idfuncionario -> funcionario.id_funcionario
            [
                ['id_funcionario'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Funcionario::class,
                'targetAttribute' => ['id_funcionario' => 'id_funcionario']
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_incidente'   => 'Incident ID',
            'id_notificacao' => 'Notification ID',
            'id_funcionario' => 'Employee ID',
            'type'           => 'Type',
            'description'    => 'Description',
            'created_at'     => 'Created At',
        ];
    }

    /**
     * Gets query for [[Notificacao]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotificacao()
    {
        return $this->hasOne(Notificacao::class, ['id_notificacao' => 'id_notificacao']);
    }

    public function getFuncionario()
    {
        return $this->hasOne(Funcionario::class, ['id_funcionario' => 'id_funcionario']);
    }
    
}

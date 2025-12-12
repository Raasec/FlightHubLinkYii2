<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pedido_assistencia".
 *
 * @property int $id_pedido
 * @property int $id_passageiro
 * @property int|null $id_funcionario_resolve
 * @property string|null $type
 * @property string $request_date
 * @property string|null $resolution_date
 * @property string|null $status
 * @property string|null $description
 *
 * @property Funcionario $funcionarioResolve
 * @property Passageiro $passageiro
 */
class PedidoAssistencia extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pedido_assistencia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_funcionario_resolve', 'type', 'resolution_date', 'status', 'description'], 'default', 'value' => null],

            [['id_passageiro', 'request_date'], 'required'],

            [['id_passageiro', 'id_funcionario_resolve'], 'integer'],

            [['request_date', 'resolution_date'], 'safe'],

            // new field -> descricao TEXT not null
            [['description'], 'string'],

            [['type'], 'string', 'max' => 100],
            [['status'], 'string', 'max' => 50],

            //FK
            [['id_funcionario_resolve'], 'exist', 'skipOnError' => true, 'targetClass' => Funcionario::class, 'targetAttribute' => ['id_funcionario_resolve' => 'id_funcionario']],
            [['id_passageiro'], 'exist', 'skipOnError' => true, 'targetClass' => Passageiro::class, 'targetAttribute' => ['id_passageiro' => 'id_passageiro']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_pedido'                 => 'Request ID',
            'id_passageiro'             => 'Passenger ID',
            'id_funcionario_resolve'    => 'Handled By (Employee)',
            'type'                      => 'Type of Request',
            'description'               => 'Problem Description', //new
            'request_date'              => 'Request Date',
            'resolution_date'           => 'Resolution Date',
            'status'                    => 'Status',
        ];
    }

    /**
     * Gets query for [[FuncionarioResolve]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFuncionarioResolve()
    {
        return $this->hasOne(Funcionario::class, ['id_funcionario' => 'id_funcionario_resolve']);
    }

    /**
     * Gets query for [[Passageiro]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPassageiro()
    {
        return $this->hasOne(Passageiro::class, ['id_passageiro' => 'id_passageiro']);
    }

}

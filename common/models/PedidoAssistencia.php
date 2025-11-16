<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pedido_assistencia".
 *
 * @property int $id_pedido
 * @property int $id_passageiro
 * @property int|null $id_funcionario_resolve
 * @property string|null $tipo
 * @property string $data_pedido
 * @property string|null $data_resolucao
 * @property string|null $estado
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
            [['id_funcionario_resolve', 'tipo', 'data_resolucao', 'estado'], 'default', 'value' => null],
            [['id_passageiro', 'data_pedido'], 'required'],
            [['id_passageiro', 'id_funcionario_resolve'], 'integer'],
            [['data_pedido', 'data_resolucao'], 'safe'],
            [['tipo'], 'string', 'max' => 100],
            [['estado'], 'string', 'max' => 50],
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
            'id_pedido' => 'Id Pedido',
            'id_passageiro' => 'Id Passageiro',
            'id_funcionario_resolve' => 'Id Funcionario Resolve',
            'tipo' => 'Tipo',
            'data_pedido' => 'Data Pedido',
            'data_resolucao' => 'Data Resolucao',
            'estado' => 'Estado',
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

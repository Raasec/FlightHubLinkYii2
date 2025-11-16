<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "voo".
 *
 * @property int $id_voo
 * @property int|null $id_companhia
 * @property string|null $numero_voo
 * @property string|null $origem
 * @property string|null $destino
 * @property string|null $data_registo
 * @property string|null $porta_embarque
 * @property string|null $data_chegada
 * @property int|null $id_funcionario_responsavel
 * @property string|null $estado
 *
 * @property Bilhete[] $bilhetes
 * @property CompanhiaAerea $companhia
 * @property Funcionario $funcionarioResponsavel
 * @property Notificacao[] $notificacaos
 * @property Review[] $reviews
 */
class Voo extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'voo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_companhia', 'numero_voo', 'origem', 'destino', 'data_registo', 'porta_embarque', 'data_chegada', 'id_funcionario_responsavel', 'estado'], 'default', 'value' => null],
            [['id_companhia', 'id_funcionario_responsavel'], 'integer'],
            [['data_registo', 'data_chegada'], 'safe'],
            [['numero_voo', 'origem', 'destino', 'porta_embarque', 'estado'], 'string', 'max' => 50],
            [['id_companhia'], 'exist', 'skipOnError' => true, 'targetClass' => CompanhiaAerea::class, 'targetAttribute' => ['id_companhia' => 'id_companhia']],
            [['id_funcionario_responsavel'], 'exist', 'skipOnError' => true, 'targetClass' => Funcionario::class, 'targetAttribute' => ['id_funcionario_responsavel' => 'id_funcionario']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_voo' => 'Id Voo',
            'id_companhia' => 'Id Companhia',
            'numero_voo' => 'Numero Voo',
            'origem' => 'Origem',
            'destino' => 'Destino',
            'data_registo' => 'Data Registo',
            'porta_embarque' => 'Porta Embarque',
            'data_chegada' => 'Data Chegada',
            'id_funcionario_responsavel' => 'Id Funcionario Responsavel',
            'estado' => 'Estado',
        ];
    }

    /**
     * Gets query for [[Bilhetes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBilhetes()
    {
        return $this->hasMany(Bilhete::class, ['id_voo' => 'id_voo']);
    }

    /**
     * Gets query for [[Companhia]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompanhia()
    {
        return $this->hasOne(CompanhiaAerea::class, ['id_companhia' => 'id_companhia']);
    }

    /**
     * Gets query for [[FuncionarioResponsavel]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFuncionarioResponsavel()
    {
        return $this->hasOne(Funcionario::class, ['id_funcionario' => 'id_funcionario_responsavel']);
    }

    /**
     * Gets query for [[Notificacaos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotificacaos()
    {
        return $this->hasMany(Notificacao::class, ['id_voo' => 'id_voo']);
    }

    /**
     * Gets query for [[Reviews]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Review::class, ['id_voo' => 'id_voo']);
    }

}

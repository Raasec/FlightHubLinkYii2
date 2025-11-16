<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "incidente".
 *
 * @property int $id_incidente
 * @property int $id_notificacao
 * @property int|null $id_funcionario
 * @property string|null $tipo
 * @property string|null $descricao
 * @property string|null $data_registo
 *
 * @property Notificacao $notificacao
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
            [['id_funcionario', 'tipo', 'descricao', 'data_registo'], 'default', 'value' => null],
            [['id_notificacao'], 'required'],
            [['id_notificacao', 'id_funcionario'], 'integer'],
            [['descricao'], 'string'],
            [['data_registo'], 'safe'],
            [['tipo'], 'string', 'max' => 50],
            [['id_notificacao'], 'exist', 'skipOnError' => true, 'targetClass' => Notificacao::class, 'targetAttribute' => ['id_notificacao' => 'id_notificacao']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_incidente' => 'Id Incidente',
            'id_notificacao' => 'Id Notificacao',
            'id_funcionario' => 'Id Funcionario',
            'tipo' => 'Tipo',
            'descricao' => 'Descricao',
            'data_registo' => 'Data Registo',
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

}

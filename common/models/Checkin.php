<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "checkin".
 *
 * @property int $id_checkin
 * @property int $id_bilhete
 * @property int|null $id_funcionario
 * @property string $data_checkin
 * @property string|null $metodo
 *
 * @property Bilhete $bilhete
 * @property Funcionario $funcionario
 */
class Checkin extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'checkin';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_funcionario', 'metodo'], 'default', 'value' => null],
            [['id_bilhete', 'data_checkin'], 'required'],
            [['id_bilhete', 'id_funcionario'], 'integer'],
            [['data_checkin'], 'safe'],
            [['metodo'], 'string', 'max' => 50],
            [['id_bilhete'], 'unique'],
            [['id_bilhete'], 'exist', 'skipOnError' => true, 'targetClass' => Bilhete::class, 'targetAttribute' => ['id_bilhete' => 'id_bilhete']],
            [['id_funcionario'], 'exist', 'skipOnError' => true, 'targetClass' => Funcionario::class, 'targetAttribute' => ['id_funcionario' => 'id_funcionario']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_checkin' => 'Id Checkin',
            'id_bilhete' => 'Id Bilhete',
            'id_funcionario' => 'Id Funcionario',
            'data_checkin' => 'Data Checkin',
            'metodo' => 'Metodo',
        ];
    }

    /**
     * Gets query for [[Bilhete]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBilhete()
    {
        return $this->hasOne(Bilhete::class, ['id_bilhete' => 'id_bilhete']);
    }

    /**
     * Gets query for [[Funcionario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFuncionario()
    {
        return $this->hasOne(Funcionario::class, ['id_funcionario' => 'id_funcionario']);
    }

}

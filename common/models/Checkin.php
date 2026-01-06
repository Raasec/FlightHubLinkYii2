<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "checkin".
 *
 * @property int $id_checkin
 * @property int $id_bilhete
 * @property int|null $id_funcionario
 * @property string $checkin_datetime
 * @property string|null $method
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
            [['id_bilhete', 'checkin_datetime'], 'required'],
            [['id_bilhete', 'id_funcionario'], 'integer'],
            [['checkin_datetime'], 'safe'],
            [['method'], 'string', 'max' => 50],

            [['id_bilhete'], 'unique'],
            //FK
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
            'id_checkin'       => 'Check-In ID',
            'id_bilhete'       => 'Ticket ID',
            'id_funcionario'   => 'Employee ID',
            'checkin_datetime' => 'Check-In Date/Time',
            'method'           => 'Method',
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

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        // define automaticamente a data/hora
        $this->checkin_datetime = date('Y-m-d H:i:s');

        return true;
    }


}

<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "bilhete".
 *
 * @property int $id_bilhete
 * @property int $id_passageiro
 * @property int|null $id_voo
 * @property string|null $gate
 * @property string|null $issue_date
 * @property float|null $price
 * @property string|null $travel_class
 * @property string|null $seat
 * @property string|null $status
 *
 * @property Checkin $checkin
 * @property Passageiro $passageiro
 * @property Voo $voo
 */
class Bilhete extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bilhete';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_passageiro'], 'required'],
            [['id_passageiro', 'id_voo'], 'integer'],
            [['issue_date'], 'safe'],
            [['price'], 'number'],
            [['gate', 'travel_class', 'status'], 'string', 'max' => 50],
            [['seat'], 'string', 'max' => 10],
            //FK
            [['id_passageiro'], 'exist', 'skipOnError' => true, 'targetClass' => Passageiro::class, 'targetAttribute' => ['id_passageiro' => 'id_passageiro']],
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
            'id_bilhete'        => 'Ticket ID',
            'id_passageiro'     => 'Passenger ID',
            'id_voo'            => 'Flight ID',
            'gate'              => 'Gate',
            'issue_date'        => 'Issue Date',
            'price'             => 'Price',
            'travel_class'      => 'Travel Class',
            'seat'              => 'Seat',
            'status'            => 'Status',
        ];
    }

    /**
     * Gets query for [[Checkin]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCheckin()
    {
        return $this->hasOne(Checkin::class, ['id_bilhete' => 'id_bilhete']);
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

    /**
     * Gets query for [[Voo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVoo()
    {
        return $this->hasOne(Voo::class, ['id_voo' => 'id_voo']);
    }

    public function beforeSave($insert)
    {
        if ($insert && empty($this->issue_date)) {
            $this->issue_date = date('Y-m-d H:i:s');
        }

        return parent::beforeSave($insert);
    }
}

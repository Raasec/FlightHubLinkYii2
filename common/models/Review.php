<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "review".
 *
 * @property int $id_review
 * @property int $id_passageiro
 * @property int $id_voo
 * @property int|null $rating
 * @property string|null $comment
 * @property string|null $review_date
 *
 * @property Passageiro $passageiro
 * @property Voo $voo
 */
class Review extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'review';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rating', 'comment', 'review_date'], 'default', 'value' => null],

            [['id_passageiro', 'id_voo'], 'required'],

            [['id_passageiro', 'id_voo', 'rating'], 'integer'],

            [['comment'], 'string'],

            [['review_date'], 'safe'],

            //FK
            [['id_passageiro'], 'exist', 'skipOnError' => true, 'targetClass' => Passageiro::class, 'targetAttribute' => ['id_passageiro' => 'id_passageiro']],
            [['id_voo'], 'exist', 'skipOnError' => true, 'targetClass' => Voo::class, 'targetAttribute' => ['id_voo' => 'id_voo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_review'     => 'Review ID',
            'id_passageiro' => 'Passenger',
            'id_voo'        => 'Flight',
            'rating'        => 'Rating',
            'comment'       => 'Comment',
            'review_date'   => 'Review Date',
        ];
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

}

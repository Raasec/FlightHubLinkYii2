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
 * @property string|null $comentario
 * @property string|null $data_review
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
            [['rating', 'comentario', 'data_review'], 'default', 'value' => null],
            [['id_passageiro', 'id_voo'], 'required'],
            [['id_passageiro', 'id_voo', 'rating'], 'integer'],
            [['comentario'], 'string'],
            [['data_review'], 'safe'],
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
            'id_review' => 'Id Review',
            'id_passageiro' => 'Id Passageiro',
            'id_voo' => 'Id Voo',
            'rating' => 'Rating',
            'comentario' => 'Comentario',
            'data_review' => 'Data Review',
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

<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "passageiro".
 *
 * @property int $id_passageiro
 * @property int $id_utilizador
 * @property int|null $user_profile_id
 * @property string|null $preferences
 * 
 *
 * @property User $user
 * @property UserProfile $userProfile  //new
 * @property Bilhete[] $bilhetes
 * @property PedidoAssistencia[] $pedidoAssistencias
 * @property Review[] $reviews
 */
class Passageiro extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'passageiro';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_utilizador'], 'required'],
            [['id_utilizador', 'user_profile_id'], 'integer'],

            [['preferences'], 'string'],

            // FK para user(id)
            [
                ['id_utilizador'],
                'exist',
                'skipOnError' => true,
                'targetClass' => User::class,
                'targetAttribute' => ['id_utilizador' => 'id']
            ],

            // FK para UserProfile
            [
                ['user_profile_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => UserProfile::class,
                'targetAttribute' => ['user_profile_id' => 'id']
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_passageiro'   => 'Passenger ID',
            'id_utilizador'   => 'User ID',
            'user_profile_id' => 'User Profile',
            'preferences'     => 'Preferences',
        ];
    }

    /** ---------- RELAÇÕES ---------- */

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'id_utilizador']);
    }

    // New Relação para o Perfil do Utilizador
        public function getUserProfile()
    {
        return $this->hasOne(UserProfile::class, ['id' => 'user_profile_id']);
    }

    /**
     * Gets query for [[Bilhetes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBilhetes()
    {
        return $this->hasMany(Bilhete::class, ['id_passageiro' => 'id_passageiro']);
    }

    /**
     * Gets query for [[PedidoAssistencias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPedidoAssistencias()
    {
        return $this->hasMany(PedidoAssistencia::class, ['id_passageiro' => 'id_passageiro']);
    }

    /**
     * Gets query for [[Reviews]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Review::class, ['id_passageiro' => 'id_passageiro']);
    }

}

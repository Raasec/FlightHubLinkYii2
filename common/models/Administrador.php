<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "administrador".
 *
 * @property int $id_admin
 * @property int $id_utilizador
 * @property string|null $access_level
 * @property string|null $area_responsible
 * @property int|null $user_profile_id
 *
 * @property User $user
 * @property UserProfile $userProfile  //new
 */
class Administrador extends \yii\db\ActiveRecord
{
    
    /**
     * ENUM / DROPDOWN OPTIONS
     */
    public static function optsNiveisAcesso()
    {
        return [
            'superadmin'        => 'Super Administrator',
            'system_admin'      => 'System Administrator',
            'operations_admin'  => 'Operational Administrator',
        ];
    }

    public static function optsResponsavelArea()
    {
        return [
            'flight_operations'     => 'Flight Operations',
            'security'              => 'Security',
            'Customer_support'      => 'Customer Support',
            'logistic'              => 'Logistics',
            'finances'              => 'Finance',
            'human_resources'       => 'Human Resources',
        ];
    }


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'administrador';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_utilizador'], 'required'],
            [['id_utilizador', 'user_profile_id'], 'integer'],

            [['access_level'], 'string', 'max' => 50],
            [['area_responsible'], 'string', 'max' => 100],

            // FK para user(id)
            [
                ['id_utilizador'],
                'exist',
                'skipOnError' => true,
                'targetClass' => User::class,
                'targetAttribute' => ['id_utilizador' => 'id'],
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
            'id_admin'         => 'Administrator ID',
            'id_utilizador'    => 'User ID',
            'access_level'     => 'Access Level',
            'area_responsible' => 'Area Responsible',
            'user_profile_id'  => 'User Profile',
        ];
    }

    /**
     * Gets query for [[Utilizador]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'id_utilizador']);
    }

    // New Relação para o Perfil do Utilizador
        public function getUserProfile()
    {
        return $this->hasOne(UserProfile::class, ['id' => 'user_profile_id']);
    }

}

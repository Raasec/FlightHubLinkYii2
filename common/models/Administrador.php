<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "administrador".
 *
 * @property int $id_admin
 * @property int $id_utilizador
 * @property string|null $nivel_acesso
 * @property string|null $responsavel_area
 *
 * @property User $user
 */
class Administrador extends \yii\db\ActiveRecord
{


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
            [['id_utilizador'], 'integer'],

            [['nivel_acesso'], 'string', 'max' => 50],
            [['responsavel_area'], 'string', 'max' => 100],

            [
                ['id_utilizador'],
                'exist',
                'skipOnError' => true,
                'targetClass' => User::class,
                'targetAttribute' => ['id_utilizador' => 'id'],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_admin' => 'Id Admin',
            'id_utilizador' => 'Id Utilizador',
            'nivel_acesso' => 'Nivel Acesso',
            'responsavel_area' => 'Responsavel Area',
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

}

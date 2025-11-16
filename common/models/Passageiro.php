<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "passageiro".
 *
 * @property int $id_passageiro
 * @property int $id_utilizador
 * @property string|null $nif
 * @property string|null $telefone
 * @property string|null $nacionalidade
 * @property string|null $data_nascimento
 * @property string|null $preferencias
 *
 * @property User $user
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
            [['nif', 'telefone', 'nacionalidade', 'data_nascimento', 'preferencias'], 'default', 'value' => null],

            [['id_utilizador'], 'required'],
            [['id_utilizador'], 'integer'],

            [['data_nascimento'], 'safe'],
            [['preferencias'], 'string'],

            [['nif'], 'string', 'max' => 15],
            [['telefone'], 'string', 'max' => 20],
            [['nacionalidade'], 'string', 'max' => 50],

            // FK para user(id)
            [
                ['id_utilizador'],
                'exist',
                'skipOnError' => true,
                'targetClass' => User::class,
                'targetAttribute' => ['id_utilizador' => 'id']
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_passageiro' => 'ID Passageiro',
            'id_utilizador' => 'User',
            'nif' => 'NIF',
            'telefone' => 'Telefone',
            'nacionalidade' => 'Nacionalidade',
            'data_nascimento' => 'Data de Nascimento',
            'preferencias' => 'Preferências',
        ];
    }

    /** ---------- RELAÇÕES ---------- */

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'id_utilizador']);
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

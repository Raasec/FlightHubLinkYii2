<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "voo".
 *
 * @property int $id_voo
 * @property int|null $id_companhia
 * @property string|null $numero_voo
 * @property string|null $origin
 * @property string|null $destination
 * @property string|null $tipo_voo
 * @property string|null $departure_date
 * @property string|null $gate
 * @property string|null $arrival_date
 * @property int|null $id_funcionario_responsavel
 * @property string|null $status
 *
 * @property Bilhete[] $bilhetes
 * @property CompanhiaAerea $companhia
 * @property Funcionario $funcionarioResponsavel
 * @property Notificacao[] $notificacaos
 * @property Review[] $reviews
 */
class Voo extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'voo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_companhia', 'numero_voo', 'origin', 'destination', 'departure_date', 'gate', 'arrival_date', 'id_funcionario_responsavel', 'status', 'tipo_voo'], 'default', 'value' => null],

            [['id_companhia', 'id_funcionario_responsavel'], 'integer'],

            [['departure_date', 'arrival_date'], 'safe'],

            [['numero_voo', 'origin', 'destination', 'gate', 'status'], 'string', 'max' => 50],

            //adicionar tbm o tipo de voo (departure/arrival)
            [['tipo_voo'], 'in', 'range' => ['departure', 'arrival']],

            //FK
            [['id_companhia'], 'exist', 'skipOnError' => true, 'targetClass' => CompanhiaAerea::class, 'targetAttribute' => ['id_companhia' => 'id_companhia']],

            [['id_funcionario_responsavel'], 'exist', 'skipOnError' => true, 'targetClass' => Funcionario::class, 'targetAttribute' => ['id_funcionario_responsavel' => 'id_funcionario']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_voo'                    => 'Flight ID',
            'id_companhia'              => 'Airline ID',
            'numero_voo'                => 'Flight Number',
            'origin'                    => 'Origin',
            'destination'               => 'Destination',
            'tipo_voo'                  => 'Flight Type',
            'departure_date'            => 'Departure Date',
            'gate'                      => 'Gate',
            'arrival_date'              => 'Arrival Date',
            'id_funcionario_responsavel'=> 'Responsible Employee',
            'status'                    => 'Status',
        ];
    }

    /**
     * Gets query for [[Bilhetes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBilhetes()
    {
        return $this->hasMany(Bilhete::class, ['id_voo' => 'id_voo']);
    }

    /**
     * Gets query for [[Companhia]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompanhia()
    {
        return $this->hasOne(CompanhiaAerea::class, ['id_companhia' => 'id_companhia']);
    }

    /**
     * Gets query for [[FuncionarioResponsavel]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFuncionarioResponsavel()
    {
        return $this->hasOne(Funcionario::class, ['id_funcionario' => 'id_funcionario_responsavel']);
    }

    /**
     * Gets query for [[Notificacaos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotificacaos()
    {
        return $this->hasMany(Notificacao::class, ['id_voo' => 'id_voo']);
    }

    /**
     * Gets query for [[Reviews]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Review::class, ['id_voo' => 'id_voo']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->departure_date) {
                $this->departure_date = str_replace('T', ' ', $this->departure_date);
            }
            if ($this->arrival_date) {
                $this->arrival_date = str_replace('T', ' ', $this->arrival_date);
            }
            return true;
        }
        return false;
    }
}

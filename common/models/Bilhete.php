<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "bilhete".
 *
 * @property int $id_bilhete
 * @property int $id_passageiro
 * @property int|null $id_voo
 * @property string|null $porta_embarque
 * @property string|null $data_emissao
 * @property float|null $preco
 * @property string|null $classe
 * @property string|null $assento
 * @property string|null $estado
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
            [['id_voo', 'porta_embarque', 'data_emissao', 'preco', 'classe', 'assento', 'estado'], 'default', 'value' => null],
            [['id_passageiro'], 'required'],
            [['id_passageiro', 'id_voo'], 'integer'],
            [['data_emissao'], 'safe'],
            [['preco'], 'number'],
            [['porta_embarque', 'classe', 'estado'], 'string', 'max' => 50],
            [['assento'], 'string', 'max' => 10],
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
            'id_bilhete' => 'Id Bilhete',
            'id_passageiro' => 'Id Passageiro',
            'id_voo' => 'Id Voo',
            'porta_embarque' => 'Porta Embarque',
            'data_emissao' => 'Data Emissao',
            'preco' => 'Preco',
            'classe' => 'Classe',
            'assento' => 'Assento',
            'estado' => 'Estado',
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

}

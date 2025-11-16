<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "companhia_aerea".
 *
 * @property int $id_companhia
 * @property string $nome
 * @property string|null $codigo_iata
 * @property string|null $pais_origem
 *
 * @property Voo[] $voos
 */
class CompanhiaAerea extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'companhia_aerea';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codigo_iata', 'pais_origem'], 'default', 'value' => null],
            [['nome'], 'required'],
            [['nome'], 'string', 'max' => 100],
            [['codigo_iata'], 'string', 'max' => 10],
            [['pais_origem'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_companhia' => 'Id Companhia',
            'nome' => 'Nome',
            'codigo_iata' => 'Codigo Iata',
            'pais_origem' => 'Pais Origem',
        ];
    }

    /**
     * Gets query for [[Voos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVoos()
    {
        return $this->hasMany(Voo::class, ['id_companhia' => 'id_companhia']);
    }

}

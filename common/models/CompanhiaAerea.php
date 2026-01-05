<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "companhia_aerea".
 *
 * @property int $id_companhia
 * @property string $name
 * @property string|null $iata_code
 * @property string|null $country_origin
 * @property string|null $image
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
            [['iata_code', 'country_origin', 'image'], 'default', 'value' => null],
            [['name'], 'required'],
            [['name'], 'string', 'max' => 100],
            [['iata_code'], 'string', 'max' => 10],
            [['country_origin'], 'string', 'max' => 50],
            [['image'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_companhia' => 'Airline ID',
            'name' => 'Name',
            'iata_code' => 'Code IATA',
            'country_origin' => 'Country of Origin',
            'image' => 'Logo image',
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


    public function getImageUrl()
    {
        $basePath = Yii::getAlias('@webroot/uploads/Airline-logo/');
        $baseUrl  = Yii::getAlias('@web/uploads/Airline-logo/');

        if ($this->image && file_exists($basePath . '/' . $this->image)) {
            return $baseUrl . '/' . $this->image;
        }

        return $baseUrl . '/default.png';
    }

}

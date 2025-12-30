<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "servico_aeroporto".
 *
 * @property int $id_servico
 * @property string|null $name
 * @property string|null $type
 * @property string|null $location
 * @property string|null $opening_hours
 * @property string|null $image
 * @property string|null $url
 */
class ServicoAeroporto extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'servico_aeroporto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'type', 'location', 'opening_hours', 'image', 'url'], 'default', 'value' => null],
            [['name', 'type', 'location', 'opening_hours'], 'string', 'max' => 100],
            [['image', 'url'], 'string', 'max' => 255], //new field para imagem
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_servico' => 'Service ID',
            'name' => 'Name',
            'type' => 'Type',
            'location' => 'Location',
            'opening_hours' => 'Opening Hours',
            'image' => 'image', //new
            'url' => 'Website Link' //new
        ];
    }

    // n sei se o formating esta bem feito eu roubei da net, testamos depois com o CRUD completo
    public function getEstado()
    {
        if (!$this->opening_hours) {
            return "Unknown";
        }

        if (preg_match('/(\d{2}:\d{2})\s*-\s*(\d{2}:\d{2})/', $this->opening_hours, $m)) {
            $agora = date("H:i");
            return ($agora >= $m[1] && $agora <= $m[2]) ? "Open" : "Closed";
        }

        return "Unknown";
    }


    public function getImagemUrl()
    {
        // fallback, n temos default.jpg devo meter um default.jpg depois
        $imgName = $this->image ? $this->image : 'default.jpg';
        
        return Yii::getAlias("@web") . "/img/services/" . $imgName;
    }

}

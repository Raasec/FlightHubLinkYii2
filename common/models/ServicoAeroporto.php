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




    // isto so vai funcionar quando alguem fizer a migration que precisamos das images

    /*public function getImagem()
    {
        $defaultUrl = Yii::getAlias("@imgUrl") . "/destination-1.jpg";

        if (!$this->tipo) {
            return $defaultUrl;
        }

        $filename = strtolower(str_replace(' ', '', $this->tipo));

        $filePath = Yii::getAlias("@imgRoot/services/$filename.jpg");
        $urlPath  = Yii::getAlias("@imgUrl") . "/services/$filename.jpg";

        return file_exists($filePath) ? $urlPath : $defaultUrl;
    }
    */

    public function getImagemUrl()
    {
        // If no image in DB, fallback
        if (!$this->image) {
            return Yii::getAlias("@imgUrl") . "/services/default.jpg";
        }

        return Yii::getAlias("@imgUrl") . "/services/" . $this->image;
    }

}

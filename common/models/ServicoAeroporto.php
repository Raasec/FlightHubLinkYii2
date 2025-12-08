<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "servico_aeroporto".
 *
 * @property int $id_servico
 * @property string|null $nome
 * @property string|null $tipo
 * @property string|null $localizacao
 * @property string|null $horario_funcionamento
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
            [['nome', 'tipo', 'localizacao', 'horario_funcionamento'], 'default', 'value' => null],
            [['nome', 'tipo', 'localizacao', 'horario_funcionamento'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_servico' => 'Id Servico',
            'nome' => 'Nome',
            'tipo' => 'Tipo',
            'localizacao' => 'Localizacao',
            'horario_funcionamento' => 'Horario Funcionamento',
        ];
    }

    // n sei se o formating esta bem feito eu roubei da net, testamos depois com o CRUD completo
    public function getEstado()
    {
        if (!$this->horario_funcionamento) {
            return "Unknown";
        }

        if (preg_match('/(\d{2}:\d{2})\s*-\s*(\d{2}:\d{2})/', $this->horario_funcionamento, $m)) {
            $agora = date("H:i");
            return ($agora >= $m[1] && $agora <= $m[2]) ? "Open" : "Closed";
        }

        return "Unknown";
    }

    // isto so vai funcionar quando alguem fizer a migration que precisamos das images
    public function getImagem()
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


}

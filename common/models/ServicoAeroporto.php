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

}

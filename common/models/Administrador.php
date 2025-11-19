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
     * ENUM / DROPDOWN OPTIONS
     */
    public static function optsNiveisAcesso()
    {
        return [
            'super_admin' => 'Super Administrador',
            'admin_sistema' => 'Administrador de Sistema',
            'admin_operacional' => 'Administrador Operacional',
        ];
    }

    public static function optsResponsavelArea()
    {
        return [
            'operacoes' => 'Operações de Voo',
            'seguranca' => 'Segurança Aeroportuária',
            'suporte' => 'Suporte ao Cliente',
            'logistica' => 'Logística e Equipamentos',
            'financas' => 'Finanças / Contabilidade',
            'recursos_humanos' => 'Recursos Humanos',
        ];
    }


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
            'id_admin' => 'ID Administrador',
            'id_utilizador' => 'ID Utilizador',
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

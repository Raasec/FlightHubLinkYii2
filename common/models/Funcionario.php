<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "funcionario".
 *
 * @property int $id_funcionario
 * @property int $id_utilizador
 * @property string|null $departamento
 * @property string|null $cargo
 * @property string|null $turno
 * @property string|null $data_contratacao
 *
 * @property User $user
 * @property Checkin[] $checkins
 * @property PedidoAssistencia[] $pedidoAssistencias
 * @property Voo[] $voos
 */
class Funcionario extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const TURNO_DIA = 'dia';
    const TURNO_TARDE = 'tarde';
    const TURNO_NOITE = 'noite';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'funcionario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_utilizador'], 'required'],
            [['id_utilizador'], 'integer'],

            [['turno'], 'string'],
            [['data_contratacao'], 'safe'],

            [['departamento', 'cargo'], 'string', 'max' => 100],

            ['turno', 'in', 'range' => array_keys(self::optsTurno())],

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
            'id_funcionario' => 'ID Funcionário',
            'id_utilizador' => 'ID Utilizador',
            'departamento' => 'Departamento',
            'cargo' => 'Cargo',
            'turno' => 'Turno',
            'data_contratacao' => 'Data Contratacao',
        ];
    }

    /** ------------------ RELAÇÕES ------------------ **/
    /**
     * Relação com tabela user
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'id_utilizador']);
    }

    /**
     * Gets query for [[Checkins]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCheckins()
    {
        return $this->hasMany(Checkin::class, ['id_funcionario' => 'id_funcionario']);
    }

    /**
     * Gets query for [[PedidoAssistencias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPedidoAssistencias()
    {
        return $this->hasMany(PedidoAssistencia::class, ['id_funcionario_resolve' => 'id_funcionario']);
    }

    /**
     * Gets query for [[Voos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVoos()
    {
        return $this->hasMany(Voo::class, ['id_funcionario_responsavel' => 'id_funcionario']);
    }


    /**
     * column turno ENUM value labels
     * @return string[]
     */
    public static function optsTurno()
    {
        return [
            self::TURNO_DIA => 'dia',
            self::TURNO_TARDE => 'tarde',
            self::TURNO_NOITE => 'noite',
        ];
    }

    /**
     * @return string
     */
    public function displayTurno()
    {
        return $this->turno !== null && isset(self::optsTurno()[$this->turno])
        ? self::optsTurno()[$this->turno]
        : '(não definido)';
    }

    /**
     * @return bool
     */
    public function isTurnoDia()
    {
        return $this->turno === self::TURNO_DIA;
    }

    public function setTurnoToDia()
    {
        $this->turno = self::TURNO_DIA;
    }

    /**
     * @return bool
     */
    public function isTurnoTarde()
    {
        return $this->turno === self::TURNO_TARDE;
    }

    public function setTurnoToTarde()
    {
        $this->turno = self::TURNO_TARDE;
    }

    /**
     * @return bool
     */
    public function isTurnoNoite()
    {
        return $this->turno === self::TURNO_NOITE;
    }

    public function setTurnoToNoite()
    {
        $this->turno = self::TURNO_NOITE;
    }

    public static function optsCargo()
    {
        return [
            'responsavel_operacoes' => 'Responsável de Operações',
            'gestor_atendimento' => 'Gestor de Atendimento',
            'tecnico_pista' => 'Técnico de Pista',
            'gestor_seguranca' => 'Gestor de Segurança',
            'supervisor_turno' => 'Supervisor de Turno',
        ];
    }

    public static function optsDepartamento()
    {
        return [
            'operacoes_voo' => 'Operações de Voo',
            'atendimento_passageiro' => 'Atendimento ao Passageiro',
            'servicos_tecnicos' => 'Serviços Técnicos',
            'seguranca' => 'Segurança Aeroportuária',
            'administracao' => 'Administração',
        ];
    }

}

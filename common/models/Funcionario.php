<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "funcionario".
 *
 * @property int $id_funcionario
 * @property int $id_utilizador
 * @property string|null $department
 * @property string|null $job_position
 * @property string|null $shift
 * @property string|null $hire_date
 * @property int|null $user_profile_id
 *
 * @property User $user
 * @property UserProfile $userProfile  //new
 * @property Checkin[] $checkins
 * @property PedidoAssistencia[] $pedidoAssistencias
 * @property Voo[] $voos
 */
class Funcionario extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const SHIFT_DAY = 'day';
    const SHIFT_AFTERNOON = 'afternoon';
    const SHIFT_NIGHT = 'night';

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
            [['id_utilizador', 'user_profile_id'], 'integer'],

            [['hire_date'], 'safe'],

            [['department', 'job_position'], 'string', 'max' => 100],

            [['shift'], 'string', 'max' => 20],

            ['shift', 'in', 'range' => array_keys(self::shiftOptions())],

            // FK para user(id)
            [
                ['id_utilizador'],
                'exist',
                'skipOnError' => true,
                'targetClass' => User::class,
                'targetAttribute' => ['id_utilizador' => 'id']
            ],

            // FK para UserProfile
            [
                ['user_profile_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => UserProfile::class,
                'targetAttribute' => ['user_profile_id' => 'id']
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_funcionario'  => 'Employee ID',
            'id_utilizador'   => 'User ID',
            'department'      => 'Department',
            'job_position'    => 'Job Position',
            'shift'           => 'Shift',
            'hire_date'       => 'Hire Date',
            'user_profile_id' => 'User Profile',
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

    // New Relação para o Perfil do Utilizador
        public function getUserProfile()
    {
        return $this->hasOne(UserProfile::class, ['id' => 'user_profile_id']);
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
    public static function shiftOptions()
    {
        return [
            self::SHIFT_DAY => 'Day',
            self::SHIFT_AFTERNOON => 'Afternoon',
            self::SHIFT_NIGHT => 'Night',
        ];
    }

    /**
     * @return string
     */
    public function getShiftLabel()
    {
        return self::shiftOptions()[$this->shift] ?? '(not assigned)';
    }

    /*
    public function displayTurno()
    {
        return $this->turno !== null && isset(self::optsTurno()[$this->turno])
        ? self::optsTurno()[$this->turno]
        : '(não definido)';
    }
    */

    /**
     * @return bool
     */
    public function isShiftDay()
    {
        return $this->shift === self::SHIFT_DAY;
    }

    public function setShiftDay()
    {
        $this->shift = self::SHIFT_DAY;
    }

    public function isShiftAfternoon()
    {
        return $this->shift === self::SHIFT_AFTERNOON;
    }

    public function setShiftAfternoon()
    {
        $this->shift = self::SHIFT_AFTERNOON;
    }

    public function isShiftNight()
    {
        return $this->shift === self::SHIFT_NIGHT;
    }

    public function setShiftNight()
    {
        $this->shift = self::SHIFT_NIGHT;
    }

    public static function optsCargo()
    {
        return [
            'operations_manager' => 'Operations Manager',
            'customer_manager' => 'Customer Service Manager',
            'track_technician' => 'Track Technician',
            'security_manager' => 'Security Manager',
            'shift_supervisor' => 'Shift Supervisor',
        ];
    }

    public static function optsDepartamento()
    {
        return [
            'flight_operations' => 'Flight Operations',
            'passenger_service' => 'Passenger Assistance',
            'technical_services' => 'Technical Services',
            'security' => 'Airport Security',
            'administration' => 'Administration',
        ];
    }

}

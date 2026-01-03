<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_profile".
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $image
 * @property string|null $full_name
 * @property string|null $gender
 * @property string|null $date_of_birth
 * @property string|null $phone
 * @property string|null $nif
 * @property string|null $nationality
 * @property string|null $country
 * @property string|null $address
 * @property string|null $postal_code
 * @property string $role_type
 *
 * @property Administrador[] $administradors
 * @property Funcionario[] $funcionarios
 * @property Passageiro[] $passageiros
 * @property User $user
 */
class UserProfile extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const GENDER_MALE = 'male';
    const GENDER_FEMALE = 'female';
    const GENDER_OTHER = 'other';
    const ROLE_TYPE_ADMINISTRADOR = 'administrador';
    const ROLE_TYPE_FUNCIONARIO = 'funcionario';
    const ROLE_TYPE_PASSAGEIRO = 'passageiro';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['image', 'full_name', 'gender', 'date_of_birth', 'phone', 'nif', 'nationality', 'country', 'address', 'postal_code'], 'default', 'value' => null],
            [['user_id', 'role_type'], 'required'],
            [['user_id'], 'integer'],
            [['gender', 'role_type'], 'string'],
            [['date_of_birth'], 'safe'],
            [['image', 'full_name', 'address'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 20],
            [['nif', 'postal_code'], 'string', 'max' => 15],
            [['nationality', 'country'], 'string', 'max' => 50],
            ['gender', 'in', 'range' => array_keys(self::optsGender())],
            ['role_type', 'in', 'range' => array_keys(self::optsRoleType())],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'image' => 'Image',
            'full_name' => 'Full Name',
            'gender' => 'Gender',
            'date_of_birth' => 'Date Of Birth',
            'phone' => 'Phone',
            'nif' => 'Nif',
            'nationality' => 'Nationality',
            'country' => 'Country',
            'address' => 'Address',
            'postal_code' => 'Postal Code',
            'role_type' => 'Role Type',
        ];
    }

    /**
     * Gets query for [[Administradors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAdministradors()
    {
        return $this->hasMany(Administrador::class, ['user_profile_id' => 'id']);
    }

    /**
     * Gets query for [[Funcionarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFuncionarios()
    {
        return $this->hasMany(Funcionario::class, ['user_profile_id' => 'id']);
    }

    /**
     * Gets query for [[Passageiros]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPassageiros()
    {
        return $this->hasMany(Passageiro::class, ['user_profile_id' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }


    /**
     * column gender ENUM value labels
     * @return string[]
     */
    public static function optsGender()
    {
        return [
            self::GENDER_MALE => 'male',
            self::GENDER_FEMALE => 'female',
            self::GENDER_OTHER => 'other',
        ];
    }

    /**
     * column role_type ENUM value labels
     * @return string[]
     */
    public static function optsRoleType()
    {
        return [
            self::ROLE_TYPE_ADMINISTRADOR => 'administrador',
            self::ROLE_TYPE_FUNCIONARIO => 'funcionario',
            self::ROLE_TYPE_PASSAGEIRO => 'passageiro',
        ];
    }

    /**
     * @return string
     */
    public function displayGender()
    {
        return self::optsGender()[$this->gender];
    }

    /**
     * @return bool
     */
    public function isGenderMale()
    {
        return $this->gender === self::GENDER_MALE;
    }

    public function setGenderToMale()
    {
        $this->gender = self::GENDER_MALE;
    }

    /**
     * @return bool
     */
    public function isGenderFemale()
    {
        return $this->gender === self::GENDER_FEMALE;
    }

    public function setGenderToFemale()
    {
        $this->gender = self::GENDER_FEMALE;
    }

    /**
     * @return bool
     */
    public function isGenderOther()
    {
        return $this->gender === self::GENDER_OTHER;
    }

    public function setGenderToOther()
    {
        $this->gender = self::GENDER_OTHER;
    }

    /**
     * @return string
     */
    public function displayRoleType()
    {
        return self::optsRoleType()[$this->role_type];
    }

    /**
     * @return bool
     */
    public function isRoleTypeAdministrador()
    {
        return $this->role_type === self::ROLE_TYPE_ADMINISTRADOR;
    }

    public function setRoleTypeToAdministrador()
    {
        $this->role_type = self::ROLE_TYPE_ADMINISTRADOR;
    }

    /**
     * @return bool
     */
    public function isRoleTypeFuncionario()
    {
        return $this->role_type === self::ROLE_TYPE_FUNCIONARIO;
    }

    public function setRoleTypeToFuncionario()
    {
        $this->role_type = self::ROLE_TYPE_FUNCIONARIO;
    }

    /**
     * @return bool
     */
    public function isRoleTypePassageiro()
    {
        return $this->role_type === self::ROLE_TYPE_PASSAGEIRO;
    }

    public function setRoleTypeToPassageiro()
    {
        $this->role_type = self::ROLE_TYPE_PASSAGEIRO;
    }

    public function getImageUrl()
    {
        if (!empty($this->image)) {
            return Yii::getAlias('@web/uploads/profile-img/' . $this->image);
        }

        return Yii::getAlias('@web/uploads/profile-img/default.png');
    }

    public static function profileImages()
    {
        return [
            'male_4214141.png',
            'male_10245125.png',
            'male_18931210.png',
            'man_6997487.png',
            'man_6997673.png',
            'male_captain_1241.png',
            'female_421479.png',
            'female_4174578.png',
            'female_8231214.png',
            'female_12566773.png',
            'female_15746374.png',
            'female_34214563.png',
            
        ];
    }




}

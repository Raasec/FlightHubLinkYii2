<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use common\models\Administrador;
use common\models\Funcionario;
use common\models\Passageiro;


/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $nome
 * @property string $email
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string|null $verification_token
 * @property string $auth_key
 * @property string|null $tipo_utilizador
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string|null $data_registo
 *
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],

            [['username', 'email'], 'required'],

            [['nome'], 'string', 'max' => 100],
            [['email'], 'email'],
            [['email'], 'string', 'max' => 255],

            [['tipo_utilizador'], 'string', 'max' => 50], // ex: ADMIN, FUNCIONARIO, PASSAGEIRO

            [['data_registo'], 'safe'],

            [['username', 'email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds user by verification email token
     *
     * @param string $token verify email token
     * @return static|null
     */
    public static function findByVerificationToken($token) {
        return static::findOne([
            'verification_token' => $token,
            'status' => self::STATUS_INACTIVE
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Generates new token for email verification
     */
    public function generateEmailVerificationToken()
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function getAdministrador()
    {
        return $this->hasOne(Administrador::class, ['id_utilizador' => 'id']);
    }

    public function getFuncionario()
    {
        return $this->hasOne(Funcionario::class, ['id_utilizador' => 'id']);
    }

    public function getPassageiro()
    {
        return $this->hasOne(Passageiro::class, ['id_utilizador' => 'id']);
    }






    
        /**
     * Depois de guardar o User:
     *  - sincroniza o ROLE de RBAC com o tipo_utilizador
     *  - cria/atualiza o registo na tabela filha (passageiro/funcionario/administrador)
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        // 1) Sincronizar RBAC (roles)
        $this->syncRoleWithTipoUtilizador();

        // 2) Sincronizar registo na tabela filha
        $this->syncChildRecord($insert, $changedAttributes);
    }



    /**
     * Atribui o role de RBAC correspondente ao tipo_utilizador.
     * tipos: passageiro | funcionario | administrador
     * roles RBAC: passageiro | funcionario | administrador
     */
    protected function syncRoleWithTipoUtilizador()
    {
        $auth = Yii::$app->authManager;
        if (!$auth) {
            return;
        }

        // Limpa roles anteriores
        $auth->revokeAll($this->id);

        $tipo = $this->tipo_utilizador;

        switch ($tipo) {
            case 'administrador':
                $roleName = 'administrador';
                break;
            case 'funcionario':
                $roleName = 'funcionario';
                break;
            default:
                // fallback: passageiro
                $roleName = 'passageiro';
                break;
        }

        $role = $auth->getRole($roleName);
        if ($role) {
            $auth->assign($role, $this->id);
        }
    }

    /**
     * Garante que existe exatamente um registo na tabela filha
     * correspondente ao tipo_utilizador atual.
     *
     * Se o tipo for alterado (ex: passageiro -> funcionario),
     * apaga o registo antigo e cria o novo.
     */
    protected function syncChildRecord($insert, $changedAttributes)
    {
        $tipoAtual = $this->tipo_utilizador;

        // Se for update e o tipo mudou, apagar registo antigo
        if (!$insert && array_key_exists('tipo_utilizador', $changedAttributes)) {
            $tipoAntigo = $changedAttributes['tipo_utilizador'];

            if ($tipoAntigo && $tipoAntigo !== $tipoAtual) {
                switch ($tipoAntigo) {
                    case 'passageiro':
                        Passageiro::deleteAll(['id_utilizador' => $this->id]);
                        break;
                    case 'funcionario':
                        Funcionario::deleteAll(['id_utilizador' => $this->id]);
                        break;
                    case 'administrador':
                        Administrador::deleteAll(['id_utilizador' => $this->id]);
                        break;
                }
            }
        }

        // Criar (se não existir) o registo correspondente ao tipo atual
        switch ($tipoAtual) {
            case 'passageiro':
                if (!Passageiro::find()->where(['id_utilizador' => $this->id])->exists()) {
                    $p = new Passageiro();
                    $p->id_utilizador = $this->id;
                    $p->save(false);
                }
                break;

            case 'funcionario':
                if (!Funcionario::find()->where(['id_utilizador' => $this->id])->exists()) {
                    $f = new Funcionario();
                    $f->id_utilizador = $this->id;
                    $f->save(false);
                }
                break;

            case 'administrador':
                if (!Administrador::find()->where(['id_utilizador' => $this->id])->exists()) {
                    $a = new Administrador();
                    $a->id_utilizador = $this->id;
                    $a->save(false);
                }
                break;
        }
    }

}

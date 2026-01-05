<?php

namespace common\tests\unit;

use yii\console\Application;
use yii\db\Connection;
use Yii;
use common\models\User;
use common\models\UserProfile;
use common\models\Administrador;

class AdministradorTest extends \Codeception\Test\Unit
{
    protected function _before(): void
    {
        new Application([
            'id' => 'test-app',
            'basePath' => dirname(__DIR__, 2),
            'components' => [
                'db' => [
                    'class' => Connection::class,
                    'dsn' => 'mysql:host=localhost;dbname=aeroportodb_test',
                    'username' => 'root',
                    'password' => '',
                    'charset' => 'utf8',
                ],
            ],
        ]);
    }

    protected function createUser(): User
    {
        $user = new User();
        $user->scenario = 'create';
        $user->username = 'admin_' . Yii::$app->security->generateRandomString(8);
        $user->email = Yii::$app->security->generateRandomString(8) . '@test.com';
        $user->password = '12341234';
        $user->setPassword($user->password);
        $user->generateAuthKey();
        $user->save(false);

        return $user;
    }

    protected function createUserProfile(User $user): UserProfile
    {
        $profile = new UserProfile();
        $profile->user_id = $user->id;
        $profile->role_type = UserProfile::ROLE_TYPE_ADMINISTRADOR;
        $profile->gender = UserProfile::GENDER_OTHER;
        $profile->save(false);

        return $profile;
    }

    protected function createValidAdministrador(): Administrador
    {
        $user = $this->createUser();
        $profile = $this->createUserProfile($user);

        $admin = new Administrador();
        $admin->id_utilizador = $user->id;
        $admin->user_profile_id = $profile->id;
        $admin->access_level = 'system_admin';
        $admin->area_responsible = 'security';

        return $admin;
    }

    public function testUserIdIsRequired(): void
    {
        $admin = new Administrador();

        $this->assertFalse($admin->validate(['id_utilizador']));
    }

    public function testUserMustExist(): void
    {
        $admin = new Administrador();
        $admin->id_utilizador = 999999;

        $this->assertFalse($admin->validate(['id_utilizador']));
    }

    public function testAdministradorIsSavedInDatabase(): void
    {
        $admin = $this->createValidAdministrador();

        $this->assertTrue($admin->save());
        $this->assertNotNull($admin->id_admin);
    }

    public function testAdministradorUserRelation(): void
    {
        $admin = $this->createValidAdministrador();
        $admin->save(false);

        $this->assertNotNull($admin->user);
        $this->assertEquals($admin->id_utilizador, $admin->user->id);
    }

    public function testAdministradorUserProfileRelation(): void
    {
        $admin = $this->createValidAdministrador();
        $admin->save(false);

        $this->assertNotNull($admin->userProfile);
        $this->assertEquals($admin->user_profile_id, $admin->userProfile->id);
    }
}

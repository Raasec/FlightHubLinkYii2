<?php

namespace common\tests\unit;

use yii\console\Application;
use yii\db\Connection;
use Yii;
use common\models\User;
use common\models\UserProfile;

class UserProfileTest extends \Codeception\Test\Unit
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
        $user->username = 'user_' . Yii::$app->security->generateRandomString(8);
        $user->email = Yii::$app->security->generateRandomString(8) . '@test.com';
        $user->password = '12341234';
        $user->setPassword($user->password);
        $user->generateAuthKey();
        $user->save(false);

        return $user;
    }

    protected function createValidProfile(): UserProfile
    {
        $user = $this->createUser();

        $profile = new UserProfile();
        $profile->user_id = $user->id;
        $profile->role_type = UserProfile::ROLE_TYPE_PASSAGEIRO;
        $profile->gender = UserProfile::GENDER_MALE;
        $profile->phone = '+351912345678';
        $profile->country = 'Portugal';
        $profile->nationality = 'Portuguese';

        return $profile;
    }

    public function testUserIdIsRequired(): void
    {
        $profile = new UserProfile();
        $profile->role_type = UserProfile::ROLE_TYPE_PASSAGEIRO;

        $this->assertFalse($profile->validate(['user_id']));
    }

    public function testRoleTypeIsRequired(): void
    {
        $profile = new UserProfile();
        $profile->user_id = 1;

        $this->assertFalse($profile->validate(['role_type']));
    }

    public function testGenderMustBeValid(): void
    {
        $profile = $this->createValidProfile();
        $profile->gender = 'invalid';

        $this->assertFalse($profile->validate(['gender']));
    }

    public function testPhoneMustBeValid(): void
    {
        $profile = $this->createValidProfile();
        $profile->phone = 'abc123';

        $this->assertFalse($profile->validate(['phone']));
    }

    public function testUserProfileIsSavedInDatabase(): void
    {
        $profile = $this->createValidProfile();

        $this->assertTrue($profile->save());
        $this->assertNotNull($profile->id);
        $this->assertNotNull($profile->user);
    }
}

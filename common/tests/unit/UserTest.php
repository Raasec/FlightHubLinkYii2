<?php

namespace common\tests\unit;

use yii\db\Connection;
use yii\console\Application;
use common\models\User;

class UserTest extends \Codeception\Test\Unit
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
            'params' => [
                'user.passwordMinLength' => 8,
            ],
        ]);
    }

    protected function createValidUser(): User
    {
        $user = new User();
        $rand = \Yii::$app->security->generateRandomString(8);
        $user->scenario = 'create';
        $user->username = 'user_' . \Yii::$app->security->generateRandomString(10);
        $user->email = \Yii::$app->security->generateRandomString(10) . '@test.com';
        $user->password = '12341234';
        $user->setPassword($user->password);
        $user->generateAuthKey();
        return $user;
    }

    public function testUsernameIsRequired(): void
    {
        $user = $this->createValidUser();
        $user->username = null;

        $this->assertFalse($user->validate(['username']));
    }

    public function testEmailIsRequired(): void
    {
        $user = $this->createValidUser();
        $user->email = null;

        $this->assertFalse($user->validate(['email']));
    }

    public function testEmailMustBeValid(): void
    {
        $user = $this->createValidUser();
        $user->email = 'invalid-email';

        $this->assertFalse($user->validate(['email']));
    }

    public function testPasswordIsHashed(): void
    {
        $user = $this->createValidUser();

        $this->assertNotEquals('12341234', $user->password_hash);
        $this->assertTrue($user->validatePassword('12341234'));
    }

    public function testUserIsSavedInDatabase(): void
    {
        $user = $this->createValidUser();

        $this->assertTrue($user->save());
        $this->assertNotNull($user->id);
    }

    public function testFindUserByUsername(): void
    {
        $user = $this->createValidUser();
        $user->status = User::STATUS_ACTIVE;
        $user->save(false);

        $found = User::findByUsername($user->username);

        $this->assertNotNull($found);
        $this->assertEquals($user->id, $found->id);
    }

    public function testAuthKeyIsGenerated(): void
    {
        $user = $this->createValidUser();

        $this->assertNotEmpty($user->auth_key);
    }

}

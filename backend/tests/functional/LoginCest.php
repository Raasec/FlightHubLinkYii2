<?php

namespace backend\tests\functional;

use backend\tests\FunctionalTester;
use common\fixtures\UserFixture;
use Yii;
use common\models\User;
/**
 * Class LoginCest
 */
class LoginCest
{
    /**
     * Load fixtures before db transaction begin
     * Called in _before()
     * @see \Codeception\Module\Yii2::_before()
     * @see \Codeception\Module\Yii2::loadFixtures()
     * @return array
     */
    public function _fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::class,
                'dataFile' => codecept_data_dir() . 'login_data.php'
            ]
        ];
    }
    
    /**
     * @param FunctionalTester $I
     */
    public function loginUser(FunctionalTester $I)
    {
        $I->amOnRoute('/site/login');

        $I->fillField('Username', 'erau');
        $I->fillField('Password', 'password_0');
        $I->click('Login');

        $I->seeResponseCodeIs(200);
    }


    public function loginFailsWithWrongPassword(FunctionalTester $I)
    {
        $I->amOnRoute('/site/login');

        $I->fillField('Username', 'erau');
        $I->fillField('Password', 'wrong');
        $I->click('Login');

        $I->see('Incorrect username or password');
    }

}

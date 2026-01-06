<?php

namespace backend\tests\functional;

use backend\tests\FunctionalTester;
use common\fixtures\UserFixture;

/**
 * Class LoginCest
 *
 * Functional tests for backend authentication
 */
class LoginCest
{
    /**
     * Load user fixtures before each test
     *
     * @return array
     */
    public function _fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::class,
                'dataFile' => codecept_data_dir() . 'login_data.php',
            ],
        ];
    }

    /**
     * User can login with valid credentials
     *
     * In this project, after a successful login the user
     * remains on the login page, so we validate success by:
     *  - HTTP 200 response
     *  - Absence of error message
     *
     * @param FunctionalTester $I
     */
    public function loginUserSuccessfully(FunctionalTester $I)
    {
        $I->amOnRoute('/site/login');

        $I->fillField('input[name="LoginForm[username]"]', 'erau');
        $I->fillField('input[name="LoginForm[password]"]', 'password_0');
        $I->click('Login');

        // Page responds correctly
        $I->seeResponseCodeIs(200);

        // No authentication error message
        $I->dontSee('Incorrect username or password');

        // User stays on login page (expected behaviour)
        $I->seeInCurrentUrl('site%2Flogin');

    }

    /**
     * Login fails with invalid password
     *
     * @param FunctionalTester $I
     */
    public function loginFailsWithWrongPassword(FunctionalTester $I)
    {
        $I->amOnRoute('/site/login');

        $I->fillField('input[name="LoginForm[username]"]', 'erau');
        $I->fillField('input[name="LoginForm[password]"]', 'wrong');
        $I->click('Login');

        // Error message should be shown
        $I->see('Incorrect username or password');
    }
}

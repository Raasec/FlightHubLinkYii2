<?php

namespace backend\tests\functional;

use backend\tests\FunctionalTester;
use common\fixtures\UserFixture;

/**
 * Tests direct URL access to protected actions
 */
class AcessoDiretoProtegidoCest
{
    /**
     * Load users
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
     * Authenticated user without permission
     * tries to access a protected create action directly via URL
     */
    public function userCannotBypassSecurityWithDirectUrl(FunctionalTester $I)
    {
        // User exists but has no permission for this action
        $I->amLoggedInAs(1);

        // Direct access to protected action
        $I->amOnRoute('/voo/create');

        // Must be forbidden
        $I->seeResponseCodeIs(403);
    }

}

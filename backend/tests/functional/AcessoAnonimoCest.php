<?php

namespace backend\tests\functional;

use backend\tests\FunctionalTester;

class AcessoAnonimoCest
{
    public function guestIsRedirectedToLogin(FunctionalTester $I)
    {
        // User is NOT logged in
        $I->amOnRoute('/voo/index');

        // Yii redirects guest to login
        $I->seeResponseCodeIs(200);
        $I->seeInCurrentUrl('site%2Flogin');
    }
}

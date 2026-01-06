<?php

namespace backend\tests\functional;

use backend\tests\FunctionalTester;
use common\fixtures\UserFixture;
use common\fixtures\AuthItemFixture;
use common\fixtures\AuthAssignmentFixture;


class VooCest
{
    public function _fixtures()
    {
        return [
            'user' => UserFixture::class,
            'auth_item' => AuthItemFixture::class,
            'auth_assignment' => AuthAssignmentFixture::class,
        ];
    }
    public function adminCannotAccessCreateVoo(FunctionalTester $I)
    {
        $I->amLoggedInAs(1);
        $I->amOnRoute('/voo/create');
        $I->seeResponseCodeIs(403);
    }

}

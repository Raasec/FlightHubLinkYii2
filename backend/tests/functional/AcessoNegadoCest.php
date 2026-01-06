<?php

namespace backend\tests\functional;

use backend\tests\FunctionalTester;
use common\fixtures\UserFixture;
use common\fixtures\AuthItemFixture;
use common\fixtures\AuthAssignmentFixture;
use Yii;
use common\models\User;



class AcessoNegadoCest
{
    public function _fixtures()
    {
        return [
            'users' => UserFixture::class,
            'auth_item' => AuthItemFixture::class,
            'auth_assignment' => AuthAssignmentFixture::class, 
        ];
    }
    public function userCannotAccessAdminPage(\backend\tests\FunctionalTester $I)
    {
        // assumes que o user id 3 já existe (fixture)
        $I->amLoggedInAs(3);

        $I->amOnRoute('/administrador/index');
        $I->seeResponseCodeIs(403);
    }


}

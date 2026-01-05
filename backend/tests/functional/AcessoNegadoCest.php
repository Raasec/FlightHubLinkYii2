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
    public function userCannotAccessAdminPage(FunctionalTester $I)
    {
        $I->executeInYii(function () {
            Yii::$app->user->setIdentity(User::findOne(3)); // passageiro
        });

        $I->amOnRoute('/administrador/index');
        $I->seeResponseCodeIs(403);
    }

}

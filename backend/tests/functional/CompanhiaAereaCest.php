<?php

namespace backend\tests\functional;

use backend\tests\FunctionalTester;
use common\fixtures\UserFixture;
use common\fixtures\AuthItemFixture;
use common\fixtures\AuthAssignmentFixture;
use Yii;
use common\models\User;

class CompanhiaAereaCest
{
    public function _fixtures()
    {
        return [
            'user' => UserFixture::class,
            'auth_item' => AuthItemFixture::class,
            'auth_assignment' => AuthAssignmentFixture::class,
        ];
    }
    public function adminCanAccessCreateCompanhia(FunctionalTester $I)
    {
        $I->executeInYii(function () {
            Yii::$app->user->setIdentity(User::findOne(1)); // admin
        });

        $I->amOnRoute('/companhia-aerea/create');
        $I->seeResponseCodeIs(200);
    }


}

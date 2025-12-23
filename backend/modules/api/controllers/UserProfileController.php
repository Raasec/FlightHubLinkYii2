<?php

namespace backend\modules\api\controllers;

use Yii;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use backend\modules\api\components\CustomAuth;
use common\models\UserProfile;

class UserProfileController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => CustomAuth::class,
        ];

        return $behaviors;
    }

    // Ver o proprio perfil GET
    public function actionMe()
    {
        $profile = UserProfile::find()
            ->where(['user_id' => Yii::$app->params['id']])
            ->one();

        if ($profile === null) {
            throw new NotFoundHttpException('Perfil não encontrado.');
        }

        return $profile;
    }

    // Atualizar o proprio perfil PUT /api/user-profile/update (testar isto bem)
    public function actionUpdate()
    {
        $profile = UserProfile::find()
            ->where(['user_id' => Yii::$app->params['id']])
            ->one();

        if ($profile === null) {
            throw new NotFoundHttpException('Perfil não encontrado.');
        }

        $profile->load(Yii::$app->request->bodyParams, '');

        // security extra, nunca pode alterar estes campos
        $profile->user_id = Yii::$app->params['id'];
        $profile->role_type = UserProfile::ROLE_TYPE_PASSAGEIRO;

        if (!$profile->save()) {
            return [
                'success' => false,
                'errors' => $profile->errors,
            ];
        }

        return [
            'success' => true,
            'profile' => $profile,
        ];
    }
}

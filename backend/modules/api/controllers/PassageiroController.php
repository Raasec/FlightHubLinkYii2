<?php

namespace backend\modules\api\controllers;

use Yii;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;
use backend\modules\api\components\CustomAuth;
use common\models\Passageiro;

class PassageiroController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => \yii\filters\auth\CompositeAuth::class,
            'authMethods' => [
                \backend\modules\api\components\CustomAuth::class,
                [
                    'class' => \yii\filters\auth\QueryParamAuth::class,
                    'tokenParam' => 'auth_key',
                ],
            ],
        ];
        return $behaviors;
    }

    /**
     * Get the passenger ID for the currently authenticated user.
     * GET /api/passageiro/my-id
     */
    public function actionMyId()
    {
        $userId = Yii::$app->user->id;
        
        $passageiro = Passageiro::findOne(['id_utilizador' => $userId]);

        if ($passageiro === null) {
            throw new NotFoundHttpException('Passenger profile not found for this user.');
        }

        return [
            'id_passageiro' => $passageiro->id_passageiro,
        ];
    }
}

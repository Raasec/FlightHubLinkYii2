<?php
namespace backend\modules\api\controllers;

use Yii;
use yii\rest\Controller;
use common\models\User;
use yii\web\BadRequestHttpException;

class AuthController extends Controller
{

    public function actionLogin()
    {
        
        $params = Yii::$app->request->bodyParams;

        if (!isset($params['username']) || !isset($params['password'])) {
            throw new BadRequestHttpException('Username e password são obrigatórios');
        }

        $user = User::findByUsername($params['username']);

        if (!$user || !$user->validatePassword($params['password'])) {
            return ['success' => false, 'message' => 'Credenciais inválidas'];
        }


        return [
            'success' => true,
            'token' => $user->auth_key,
            'user' => [
                'id' => $user->id,
                'username' => $user->username,
            ],
        ];
    }
}

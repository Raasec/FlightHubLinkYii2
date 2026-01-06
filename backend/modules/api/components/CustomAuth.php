<?php
namespace backend\modules\api\components;
use Yii;
use yii\filters\auth\AuthMethod;

class CustomAuth extends AuthMethod
{
    public function authenticate($user, $request, $response)
    {
        $authToken = $request->getQueryString();
        $token=explode('=', $authToken)[1];
        $userIdentity = \common\models\User::findIdentityByAccessToken($token);
        if(!$userIdentity)
        {
            throw new \yii\web\ForbiddenHttpException('No authentication');
        }
        Yii::$app->params['id'] = $userIdentity->id;
        
        Yii::$app->params['id'] = $userIdentity->id;
        
        $user->login($userIdentity);
        
        return $userIdentity;
    }
}

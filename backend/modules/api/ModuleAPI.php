<?php

namespace backend\modules\api;

use Yii;
use yii\base\Module;

class ModuleAPI extends Module
{
    public $controllerNamespace = 'backend\modules\api\controllers';

    public function init()
    {
        parent::init();

        \Yii::$app->set('user', [
            'class' => '\yii\web\User',
            'identityClass' => 'common\models\User',
            'enableSession' => false, // API SIM
            'loginUrl' => null,
        ]);

    // Desativar CSRF apenas em contexto web
        if (Yii::$app instanceof \yii\web\Application) {
            Yii::$app->request->enableCsrfValidation = false;
        }
    }

}

<?php

namespace backend\modules\api;

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

        \Yii::$app->request->enableCsrfValidation = false;
    }

}

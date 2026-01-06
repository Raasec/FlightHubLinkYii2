<?php

namespace backend\modules\api\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;
use backend\modules\api\components\CustomAuth;
use common\models\Review;

class ReviewController extends ActiveController
{
    public $modelClass = 'common\models\Review';

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        // autentication com via query param 
        $behaviors['authenticator'] = [
            'class' => CustomAuth::class,
        ];

        return $behaviors;
    }

    // Controlo de perms (ownership) 
    public function checkAccess($action, $model = null, $params = [])
    {
        // criar review -> passageiro autenticado
        if ($action === 'create') {
            return;
        }

        // update ou delete -> só o dono
        if (in_array($action, ['update', 'delete'])) {
            if ($model->id_passageiro != Yii::$app->params['id']) {
                throw new ForbiddenHttpException('Só pode alterar as suas próprias reviews.');
            }
        }
    }

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create']); // Custom create implementation
        return $actions;
    }

    public function actionCreate()
    {
        $this->checkAccess('create');

        $model = new Review();
        $model->load(Yii::$app->request->bodyParams, '');
        $model->id_passageiro = Yii::$app->params['id'];
        $model->review_date = date('Y-m-d H:i:s');

        if ($model->save()) {
            return $model;
        } elseif (!$model->hasErrors()) {
            throw new \yii\web\ServerErrorHttpException('Falha ao criar review por razões desconhecidas.');
        }

        return $model;
    }
}

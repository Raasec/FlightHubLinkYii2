<?php

namespace backend\modules\api\controllers;

use Yii;
use common\models\CompanhiaAerea;
use common\models\CompanhiaAereaSearch;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;

class CompanhiaAereaController extends ActiveController
{
    public $modelClass = 'common\models\CompanhiaAerea';

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create'], $actions['update'], $actions['delete']);
        
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        return $actions;
    }

    public function prepareDataProvider()
    {
        $searchModel = new CompanhiaAereaSearch();
        return $searchModel->search(Yii::$app->request->queryParams);
    }

    public function checkAccess($action, $model = null, $params = [])
    {
        if (in_array($action, ['index', 'view'])) {
             return; 
        }
        
        if (in_array($action, ['create', 'update', 'delete'])) {
            if (!Yii::$app->user->can('funcionario')) {
                throw new ForbiddenHttpException('Apenas funcionários podem gerir companhias aéreas.');
            }
        }
    }
}

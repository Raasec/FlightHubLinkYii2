<?php

namespace backend\modules\api\controllers;

use Yii;
use common\models\CompanhiaAerea;
use common\models\CompanhiaAereaSearch;
use yii\data\ActiveDataProvider;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;

class CompanhiaAereaController extends Controller
{

    public function actionIndex()
    {
        $this->checkAccess('index'); // RBAC

        $searchModel = new CompanhiaAereaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $dataProvider;
    }

    public function actionView($id)
    {
        $this->checkAccess('view', $id); // RBAC

        return $this->findModel($id);
    }

    protected function findModel($id)
    {
        if (($model = CompanhiaAerea::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Companhia aérea não encontrada.');
    }

    protected function checkAccess($action, $model = null, $params = [])
    {
        if (!Yii::$app->user->can('passageiro') && !Yii::$app->user->can('guest')) {
            throw new \yii\web\ForbiddenHttpException('Não tem permissão para aceder a esta ação.');
        }
    }
}

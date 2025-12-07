<?php

namespace backend\modules\api\controllers;

use Yii;
use common\models\Bilhete;
use common\models\BilheteSearch;
use yii\data\ActiveDataProvider;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;

class BilheteController extends Controller
{
    public function actionIndex()
    {
        $this->checkAccess('index');

        $searchModel = new BilheteSearch();
        $params = Yii::$app->request->queryParams;

        // força filtro pelo passageiro logado
        $params['id_passageiro'] = Yii::$app->user->id;

        $dataProvider = $searchModel->search($params);

        return $dataProvider;
    }

    public function actionView($id)
    {
        $bilhete = $this->findModel($id);
        $this->checkAccess('view', $bilhete);

        return $bilhete;
    }

    protected function findModel($id)
    {
        if (($model = Bilhete::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('Bilhete não encontrado.');
    }

    protected function checkAccess($action, $model = null, $params = [])
    {

        if (!Yii::$app->user->can('passageiro')) {
            throw new ForbiddenHttpException('Não tem permissão para aceder a esta ação.');
        }

        // se ja temos o modelo, ve se pertence ao passageiro logado
        if ($model !== null && $model->id_passageiro !== Yii::$app->user->id) {
            throw new ForbiddenHttpException('Não pode aceder a bilhetes de outro passageiro.');
        }
    }
}

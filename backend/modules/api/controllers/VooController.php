<?php

namespace backend\modules\api\controllers;

use Yii;
use common\models\Voo;
use common\models\VooSearch;
use yii\data\ActiveDataProvider;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;

class VooController extends Controller
{

    public function actionIndex()
    {
        $this->checkAccess('index'); // RBAC

        $searchModel = new VooSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $dataProvider;
    }

    public function actionView($id)
    {
        $this->checkAccess('view', $id); // RBAC

        return $this->findModel($id);
    }

    public function actionPorOrigem($cidade)
    {
        $this->checkAccess('porOrigem'); // RBAC

        $search = Voo::find()->where(['origin' => $cidade])->all();
        return $search;
    }

    /* Master/Detail: Bilhetes de um voo
    GET /api/voo/{id}/bilhetes*/
    public function actionBilhetes($id)
    {
        $this->checkAccess('bilhetes');
        
        $voo = $this->findModel($id);
        return $voo->bilhetes;
    }

    /* Master/Detail: Notificações de um voo
    GET /api/voo/{id}/notificacoes */
    public function actionNotificacoes($id)
    {
        $this->checkAccess('notificacoes');
        
        $voo = $this->findModel($id);
        return $voo->notificacaos;
    }

    /* Master/Detail: Reviews de um voo
    GET /api/voo/{id}/reviews*/
    public function actionReviews($id)
    {
        $this->checkAccess('reviews');
        
        $voo = $this->findModel($id);
        return $voo->reviews;
    }

    protected function findModel($id)
    {
        if (($model = Voo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Voo não encontrado.');
    }

    protected function checkAccess($action, $model = null, $params = [])
    {
        if (!Yii::$app->user->can('passageiro') && !Yii::$app->user->can('guest')) {
            throw new ForbiddenHttpException('Não tem permissão para aceder a esta ação.');
        }
    }
}

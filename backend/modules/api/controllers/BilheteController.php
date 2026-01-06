<?php

namespace backend\modules\api\controllers;

use Yii;
use common\models\Bilhete;
use common\models\BilheteSearch;
use common\models\Passageiro;
use common\models\Voo;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use backend\modules\api\components\CustomAuth;

class BilheteController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => CustomAuth::class,
        ];
        return $behaviors;
    }

    public function actionIndex()
    {
        $this->checkAccess('index');

        $searchModel = new BilheteSearch();
        $params = Yii::$app->request->queryParams;
        $params['id_passageiro'] = $this->getPassageiroLogado()->id_passageiro;

        return $searchModel->search($params);
    }

    public function actionView($id)
    {
        $bilhete = $this->findModel($id);
        $this->checkAccess('view', $bilhete);
        return $bilhete;
    }

    // POST /api/bilhete (Comprar Bilhete)
    public function actionCreate()
    {
        $this->checkAccess('create');

        $passageiro = $this->getPassageiroLogado();
        $request = Yii::$app->request;

        $model = new Bilhete();
        $model->id_passageiro = $passageiro->id_passageiro;
        $model->id_voo = $request->post('id_voo');
        $model->travel_class = $request->post('travel_class', 'Economy');
        $model->seat = $request->post('seat');
        $model->status = 'Confirmed';
        $model->issue_date = date('Y-m-d H:i:s');
        
        $model->price = 300.00; 

        if ($model->validate() && $model->save()) {
             Yii::$app->response->statusCode = 201;
             return $model;
        }

        return ['success' => false, 'errors' => $model->errors];
    }

    // PUT /api/bilhete/{id} (Alterar lugar ou classe)
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $this->checkAccess('update', $model);

        $request = Yii::$app->request;
        
        // Apenas permite alterar lugar
        if ($request->post('seat')) {
            $model->seat = $request->post('seat');
        }

        if ($model->save()) {
            return $model;
        }

        return ['success' => false, 'errors' => $model->errors];
    }

    // DELETE /api/bilhete/{id} (Cancelar Bilhete)
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $this->checkAccess('delete', $model);

        if ($model->delete()) {
            return ['success' => true, 'message' => 'Bilhete cancelado e reembolsado.'];
        }

        return ['success' => false, 'message' => 'Erro ao cancelar.'];
    }

    protected function findModel($id)
    {
        if (($model = Bilhete::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('Bilhete não encontrado.');
    }

    protected function getPassageiroLogado()
    {
        $user = Yii::$app->user;
        if (!$user || !$user->id) {
             throw new ForbiddenHttpException('Acesso negado.');
        }

        $passageiro = Passageiro::findOne(['id_utilizador' => $user->id]);
        if (!$passageiro) {
            throw new ForbiddenHttpException('Não é um passageiro válido.');
        }
        return $passageiro;
    }

    protected function checkAccess($action, $model = null, $params = [])
    {
        // Apenas passageiros podem usar este controller (comprar, ver etc)
        $passageiro = $this->getPassageiroLogado();

        if ($model && $model->id_passageiro !== $passageiro->id_passageiro) {
            throw new ForbiddenHttpException('Não tem permissão para aceder a este bilhete.');
        }
    }
}

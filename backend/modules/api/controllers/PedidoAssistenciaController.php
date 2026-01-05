<?php

namespace backend\modules\api\controllers;

use Yii;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use backend\modules\api\components\CustomAuth;
use common\models\PedidoAssistencia;
use common\models\PedidoAssistenciaSearch;


class PedidoAssistenciaController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => CustomAuth::class,
        ];

        return $behaviors;
    }

    // GET /api/pedido-assistencia
    public function actionIndex()
    {
        $userId = Yii::$app->params['id'];

        // Buscar id_passageiro pelo user_id
        $passageiro = \common\models\Passageiro::find()
            ->where(['id_user' => $userId])
            ->one();

        if (!$passageiro) {
            return [];
        }

        return PedidoAssistencia::find()
            ->where(['id_passageiro' => $passageiro->id_passageiro])
            ->orderBy(['request_date' => SORT_DESC])
            ->all();
    }

    // GET /api/pedido-assistencia/{id}
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $this->checkAccess('view', $model);
        return $model;
    }

    // POST /api/pedido-assistencia
    public function actionCreate()
    {
        $userId = Yii::$app->params['id'];

        $passageiro = \common\models\Passageiro::find()
            ->where(['id_user' => $userId])
            ->one();

        if (!$passageiro) {
            throw new ForbiddenHttpException('Perfil de passageiro não encontrado.');
        }

        $model = new PedidoAssistencia();
        $model->load(Yii::$app->request->bodyParams, '');
        
        $model->id_passageiro = $passageiro->id_passageiro;
        $model->request_date = date('Y-m-d H:i:s');
        $model->status = 'Pending';

        if ($model->save()) {
            Yii::$app->response->statusCode = 201;
            return $model;
        }

        return ['success' => false, 'errors' => $model->errors];
    }

    // PUT /api/pedido-assistencia/{id}
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $this->checkAccess('update', $model);

        // updates so podem acontecer se ainda n foi respondido 
        if ($model->response !== null) {
            throw new ForbiddenHttpException('Não pode alterar um pedido já respondido.');
        }

        $model->load(Yii::$app->request->bodyParams, '');
        
        // não deixa alterar esses campos
        $model->id_passageiro = $model->getOldAttribute('id_passageiro');
        $model->request_date = $model->getOldAttribute('request_date');

        if ($model->save()) {
            return $model;
        }

        return ['success' => false, 'errors' => $model->errors];
    }

    // DELETE /api/pedido-assistencia/{id}
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $this->checkAccess('delete', $model);

        // só pode eliminar se ainda nao foi respondido
        if ($model->response !== null) {
            throw new ForbiddenHttpException('Não pode eliminar um pedido já respondido.');
        }

        $model->delete();
        return ['success' => true, 'message' => 'Pedido eliminado.'];
    }

    protected function findModel($id)
    {
        if (($model = PedidoAssistencia::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('Pedido de assistência não encontrado.');
    }

    protected function checkAccess($action, $model = null)
    {
        $userId = Yii::$app->params['id'];

        // buscar passageiro do user
        $passageiro = \common\models\Passageiro::find()
            ->where(['id_user' => $userId])
            ->one();

        if (!$passageiro) {
            throw new ForbiddenHttpException('Perfil de passageiro não encontrado.');
        }

        // verificar ownership
        if ($model !== null && $model->id_passageiro !== $passageiro->id_passageiro) {
            throw new ForbiddenHttpException('Não pode aceder a pedidos de outro passageiro.');
        }
    }
}

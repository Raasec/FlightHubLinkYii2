<?php

namespace backend\modules\api\controllers;

use Yii;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use common\models\Notificacao;
use common\models\NotificacaoSearch;

class NotificacaoController extends Controller
{
    public function actionIndex()
    {
        $this->checkAccess('index');

        $searchModel = new NotificacaoSearch();
        $params = Yii::$app->request->queryParams;
        
        
        // SE FOR PASSAGEIRO FORÇA FILTRAR NOTIFICACOS DO SEU VOO
        if (Yii::$app->user->can('passageiro')) {

            $params['id_voo'] = Notificacao::find()
                ->select('id_voo')
                ->distinct()
                ->where([
                    'id_voo' =>
                        (new \yii\db\Query())
                        ->select('id_voo')
                        ->from('bilhete')
                        ->where(['id_passageiro' => Yii::$app->user->id])
                ]);
        }

        return $searchModel->search($params);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
        $this->checkAccess('view', $model);
        return $model;
    }

    public function actionCreate()
    {
        $this->checkAccess('create');

        $model = new Notificacao();
        $model->load(Yii::$app->request->post(), '');

        if ($model->save()) {
            return $model;
        }

        return $model->errors;
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $this->checkAccess('update', $model);

        $model->load(Yii::$app->request->post(), '');

        if ($model->save()) {
            return $model;
        }

        return $model->errors;
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $this->checkAccess('delete', $model);

        $model->delete();
        return ['message' => 'Notificação eliminada.'];
    }

    protected function findModel($id)
    {
        if (($model = Notificacao::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('Notificação não encontrada.');
    }

    protected function checkAccess($action, $model = null)
    {
        $user = Yii::$app->user;

        // Passageiro só pode ver notis dos seus voos
        if ($user->can('passageiro')) {

            if ($action !== 'index' && $action !== 'view') {
                throw new ForbiddenHttpException('Não autorizado.');
            }

            if ($model !== null) {
                $voosDoPassageiro = (new \yii\db\Query())
                    ->select('id_voo')
                    ->from('bilhete')
                    ->where(['id_passageiro' => $user->id])
                    ->column();

                if (!in_array($model->id_voo, $voosDoPassageiro)) {
                    throw new ForbiddenHttpException('Notificação não pertence ao seu voo.');
                }
            }

            return;
        }

        // funcionari com acess a tudo menos leitura publica
        if ($user->can('funcionario')) {
            return;
        }

        throw new ForbiddenHttpException('Acesso negado.');
    }
}

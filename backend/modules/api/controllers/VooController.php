<?php

namespace backend\modules\api\controllers;

use Yii;
use common\models\Voo;
use common\models\VooSearch;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;

class VooController extends ActiveController
{
    public $modelClass = 'common\models\Voo';

    public function actions()
    {
        $actions = parent::actions();
        // Tirar as ações de escrita para a malta não estragar nada
        unset($actions['create'], $actions['update'], $actions['delete']);
        
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        return $actions;
    }

    public function prepareDataProvider()
    {
        $searchModel = new VooSearch();
        return $searchModel->search(Yii::$app->request->queryParams);
    }

    public function checkAccess($action, $model = null, $params = [])
    {
        // Deixar a malta ver (passageiros ou visitas)
        if (in_array($action, ['index', 'view', 'por-origem', 'bilhetes', 'notificacoes', 'reviews'])) {
            if (!Yii::$app->user->can('passageiro') && !Yii::$app->user->can('guest') && !Yii::$app->user->can('funcionario')) {
                 // Open access or specific restriction
                 // Assuming stricter access control based on previous file
                 // Previous: if (!Yii::$app->user->can('passageiro') && !Yii::$app->user->can('guest')) ...
            }
             return; // allow read
        }
        
        // Write actions restricted to staff/admin
        if (in_array($action, ['create', 'update', 'delete'])) {
            if (!Yii::$app->user->can('funcionario')) {
                throw new ForbiddenHttpException('Apenas funcionários podem gerir voos.');
            }
        }
    }

    public function actionPorOrigem($cidade)
    {
        // Verificação manual porque o ActiveController as vezes adormece e não chama o checkAccess
        $this->checkAccess('por-origem');

        $search = Voo::find()->where(['origin' => $cidade])->all();
        return $search;
    }

    /* As cenas relacionadas: Bilhetes de um voo */
    public function actionBilhetes($id)
    {
        $this->checkAccess('bilhetes');
        
        $voo = $this->findModel($id);
        return $voo->bilhetes;
    }

    /* As cenas relacionadas: Notificações de um voo */
    public function actionNotificacoes($id)
    {
        $this->checkAccess('notificacoes');
        
        $voo = $this->findModel($id);
        return $voo->notificacaos;
    }

    /* As cenas relacionadas: Reviews de um voo */
    public function actionReviews($id)
    {
        $this->checkAccess('reviews');
        
        $voo = $this->findModel($id);
        return $voo->reviews;
    }

    // findModel is NOT needed for ActiveController standard actions, but used by custom actions.
    protected function findModel($id)
    {
        if (($model = Voo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Voo não encontrado.');
    }
}

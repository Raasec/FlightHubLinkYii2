<?php

namespace backend\controllers;

use Yii;
use common\models\PedidoAssistencia;
use common\models\PedidoAssistenciaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PedidoAssistenciaController implements the CRUD actions for PedidoAssistencia model.
 */
class PedidoAssistenciaController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all PedidoAssistencia models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PedidoAssistenciaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PedidoAssistencia model.
     * @param int $id_pedido Id Pedido
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_pedido)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_pedido),
        ]);
    }

    /**
     * Creates a new PedidoAssistencia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PedidoAssistencia();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_pedido' => $model->id_pedido]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PedidoAssistencia model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_pedido Id Pedido
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_pedido)
    {
        $model = $this->findModel($id_pedido);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_pedido' => $model->id_pedido]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing PedidoAssistencia model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_pedido Id Pedido
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_pedido)
    {
        $this->findModel($id_pedido)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PedidoAssistencia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_pedido Id Pedido
     * @return PedidoAssistencia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_pedido)
    {
        if (($model = PedidoAssistencia::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

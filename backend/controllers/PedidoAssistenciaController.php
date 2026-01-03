<?php

namespace backend\controllers;

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
     * @inheritDoc
     */
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
<<<<<<< Updated upstream
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => \yii\filters\AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['administrador', 'funcionario'],
                        ],
=======
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index', 'view', 'create', 'update', 'delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['administrador','funcionario'],
>>>>>>> Stashed changes
                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all PedidoAssistencia models.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->can('viewSupportTicket')) {
            throw new \yii\web\ForbiddenHttpException(
                'You do not have permission to view support tickets.'
            );
        }

        $searchModel = new PedidoAssistenciaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PedidoAssistencia model.
     * @param int $id_pedido Id Pedido
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_pedido)
    {
        if (!Yii::$app->user->can('viewSupportTicket')) {
            throw new \yii\web\ForbiddenHttpException(
                'You do not have permission to view this support ticket.'
            );
        }

        return $this->render('view', [
            'model' => $this->findModel($id_pedido),
        ]);
    }

    /**
     * Creates a new PedidoAssistencia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        if (!Yii::$app->user->can('createSupportTicket')) {
            throw new \yii\web\ForbiddenHttpException(
                'You do not have permission to create support tickets.'
            );
        }

        $model = new PedidoAssistencia();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_pedido' => $model->id_pedido]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PedidoAssistencia model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_pedido Id Pedido
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_pedido)
    {
        if (!Yii::$app->user->can('updateSupportTicket')) {
            throw new \yii\web\ForbiddenHttpException(
                'You do not have permission to update support tickets.'
            );
        }

        $model = $this->findModel($id_pedido);

        if ($this->request->isPost && $model->load($this->request->post())) {
            
            // Auto-set resolution metadata
            if ($model->status === 'resolved' || !empty($model->response)) {
                if (empty($model->resolution_date)) {
                    $model->resolution_date = date('Y-m-d H:i:s');
                }
                
                // Get the funcionario ID linked to this user
                $userId = \Yii::$app->user->id;
                $funcionario = \common\models\Funcionario::findOne(['id_utilizador' => $userId]);
                if ($funcionario) {
                    $model->id_funcionario_resolve = $funcionario->id_funcionario;
                }
            }

            if ($model->save()) {
                return $this->redirect(['view', 'id_pedido' => $model->id_pedido]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing PedidoAssistencia model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_pedido Id Pedido
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_pedido)
    {
        if (!Yii::$app->user->can('deleteSupportTicket')) {
            throw new \yii\web\ForbiddenHttpException(
                'You do not have permission to delete support tickets.'
            );
        }

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
        if (($model = PedidoAssistencia::findOne(['id_pedido' => $id_pedido])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

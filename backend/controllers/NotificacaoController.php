<?php

namespace backend\controllers;

use Yii;
use common\models\Notificacao;
use common\models\NotificacaoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NotificacaoController implements the CRUD actions for Notificacao model.
 */
class NotificacaoController extends Controller
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
     * Lists all Notificacao models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NotificacaoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Notificacao model.
     * @param int $id_notificacao Id Notificacao
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_notificacao)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_notificacao),
        ]);
    }

    /**
     * Creates a new Notificacao model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Notificacao();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_notificacao' => $model->id_notificacao]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Notificacao model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_notificacao Id Notificacao
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_notificacao)
    {
        $model = $this->findModel($id_notificacao);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_notificacao' => $model->id_notificacao]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Notificacao model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_notificacao Id Notificacao
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_notificacao)
    {
        $this->findModel($id_notificacao)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Notificacao model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_notificacao Id Notificacao
     * @return Notificacao the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_notificacao)
    {
        if (($model = Notificacao::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

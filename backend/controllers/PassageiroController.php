<?php

namespace backend\controllers;

use Yii;
use common\models\Passageiro;
use common\models\PassageiroSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PassageiroController implements the CRUD actions for Passageiro model.
 */
class PassageiroController extends Controller
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
     * Lists all Passageiro models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PassageiroSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Passageiro model.
     * @param int $id_passageiro Id Passageiro
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_passageiro)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_passageiro),
        ]);
    }

    /**
     * Creates a new Passageiro model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Passageiro();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_passageiro' => $model->id_passageiro]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Passageiro model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_passageiro Id Passageiro
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_passageiro)
    {
        $model = $this->findModel($id_passageiro);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_passageiro' => $model->id_passageiro]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Passageiro model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_passageiro Id Passageiro
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_passageiro)
    {
        $this->findModel($id_passageiro)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Passageiro model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_passageiro Id Passageiro
     * @return Passageiro the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_passageiro)
    {
        if (($model = Passageiro::findOne($id_passageiro)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

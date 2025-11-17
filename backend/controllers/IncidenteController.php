<?php

namespace backend\controllers;

use Yii;
use common\models\Incidente;
use common\models\IncidenteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * IncidenteController implements the CRUD actions for Incidente model.
 */
class IncidenteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['administrador','funcionario'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Incidente models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new IncidenteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Incidente model.
     * @param int $id_incidente Id Incidente
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_incidente)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_incidente),
        ]);
    }

    /**
     * Creates a new Incidente model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Incidente();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_incidente' => $model->id_incidente]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Incidente model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_incidente Id Incidente
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_incidente)
    {
        $model = $this->findModel($id_incidente);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_incidente' => $model->id_incidente]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Incidente model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_incidente Id Incidente
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_incidente)
    {
        $this->findModel($id_incidente)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Incidente model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_incidente Id Incidente
     * @return Incidente the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_incidente)
    {
        if (($model = Incidente::findOne($id_incidente)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

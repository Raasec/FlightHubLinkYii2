<?php

namespace backend\controllers;

use Yii;
use common\models\CompanhiaAerea;
use common\models\CompanhiaAereaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * CompanhiaAereaController implements the CRUD actions for CompanhiaAerea model.
 */
class CompanhiaAereaController extends Controller
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
     * Lists all CompanhiaAerea models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CompanhiaAereaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CompanhiaAerea model.
     * @param int $id_companhia Id Companhia
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_companhia)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_companhia),
        ]);
    }

    /**
     * Creates a new CompanhiaAerea model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CompanhiaAerea();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_companhia' => $model->id_companhia]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing CompanhiaAerea model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_companhia Id Companhia
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_companhia)
    {
        $model = $this->findModel($id_companhia);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_companhia' => $model->id_companhia]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing CompanhiaAerea model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_companhia Id Companhia
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_companhia)
    {
        $this->findModel($id_companhia)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CompanhiaAerea model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_companhia Id Companhia
     * @return CompanhiaAerea the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_companhia)
    {
        if (($model = CompanhiaAerea::findOne($id_companhia)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

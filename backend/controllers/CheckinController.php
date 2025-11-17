<?php

namespace backend\controllers;

use Yii;
use common\models\Checkin;
use common\models\CheckinSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * CheckinController implements the CRUD actions for Checkin model.
 */
class CheckinController extends Controller
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
     * Lists all Checkin models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CheckinSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Checkin model.
     * @param int $id_checkin Id Checkin
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_checkin)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_checkin),
        ]);
    }

    /**
     * Creates a new Checkin model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Checkin();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_checkin' => $model->id_checkin]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Checkin model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_checkin Id Checkin
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_checkin)
    {
        $model = $this->findModel($id_checkin);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_checkin' => $model->id_checkin]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Checkin model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_checkin Id Checkin
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_checkin)
    {
        $this->findModel($id_checkin)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Checkin model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_checkin Id Checkin
     * @return Checkin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_checkin)
    {
        if (($model = Checkin::findOne($id_checkin)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

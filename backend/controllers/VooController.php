<?php

namespace backend\controllers;

use Yii;
use common\models\Voo;
use common\models\VooSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * VooController implements the CRUD actions for Voo model.
 */
class VooController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index', 'view', 'create', 'update', 'delete'],
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
     * Lists all Voo models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->can('viewFlight')) {
            throw new \yii\web\ForbiddenHttpException(
                'You do not have permission to view flights.'
            );
        }

        $searchModel = new VooSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Voo model.
     * @param int $id_voo Id Voo
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_voo)
    {
        if (!Yii::$app->user->can('viewFlight')) {
            throw new \yii\web\ForbiddenHttpException(
                'You do not have permission to view this flight.'
            );
        }

        return $this->render('view', [
            'model' => $this->findModel($id_voo),
        ]);
    }

    /**
     * Creates a new Voo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (!Yii::$app->user->can('createFlight')) {
            throw new \yii\web\ForbiddenHttpException(
                'You do not have permission to create flights.'
            );
        }
        
        $model = new Voo();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_voo' => $model->id_voo]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Voo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_voo Id Voo
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_voo)
    {
        if (!Yii::$app->user->can('updateFlight')) {
            throw new \yii\web\ForbiddenHttpException(
                'You do not have permission to update flights.'
            );
        }
        
        $model = $this->findModel($id_voo);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_voo' => $model->id_voo]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Voo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_voo Id Voo
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_voo)
    {
        if (!Yii::$app->user->can('deleteFlight')) {
            throw new \yii\web\ForbiddenHttpException(
                'You do not have permission to delete flights.'
            );
        }

        $this->findModel($id_voo)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Voo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_voo Id Voo
     * @return Voo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_voo)
    {
        if (($model = Voo::findOne($id_voo)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

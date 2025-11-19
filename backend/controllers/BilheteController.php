<?php

namespace backend\controllers;

use Yii;
use common\models\Bilhete;
use common\models\BilheteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * BilheteController implements the CRUD actions for Bilhete model.
 */
class BilheteController extends Controller
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
     * Lists all Bilhete models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BilheteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Bilhete model.
     * @param int $id_bilhete Id Bilhete
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_bilhete)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_bilhete),
        ]);
    }

    /**
     * Creates a new Bilhete model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(Yii::$app->user->can('createBilhete')){
            $model = new Bilhete();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_bilhete' => $model->id_bilhete]);
            }

            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Bilhete model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_bilhete Id Bilhete
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_bilhete)
    {
        $model = $this->findModel($id_bilhete);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_bilhete' => $model->id_bilhete]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Bilhete model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_bilhete Id Bilhete
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_bilhete)
    {
        $this->findModel($id_bilhete)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Bilhete model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_bilhete Id Bilhete
     * @return Bilhete the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_bilhete)
    {
        if (($model = Bilhete::findOne($id_bilhete)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

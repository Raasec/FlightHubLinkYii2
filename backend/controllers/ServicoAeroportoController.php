<?php

namespace backend\controllers;

use Yii;
use common\models\ServicoAeroporto;
use common\models\ServicoAeroportoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * ServicoAeroportoController implements the CRUD actions for ServicoAeroporto model.
 */
class ServicoAeroportoController extends Controller
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
     * Lists all ServicoAeroporto models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ServicoAeroportoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ServicoAeroporto model.
     * @param int $id_servico Id Servico
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_servico)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_servico),
        ]);
    }

    /**
     * Creates a new ServicoAeroporto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ServicoAeroporto();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_servico' => $model->id_servico]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ServicoAeroporto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_servico Id Servico
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_servico)
    {
        $model = $this->findModel($id_servico);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_servico' => $model->id_servico]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ServicoAeroporto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_servico Id Servico
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_servico)
    {
        $this->findModel($id_servico)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ServicoAeroporto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_servico Id Servico
     * @return ServicoAeroporto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_servico)
    {
        if (($model = ServicoAeroporto::findOne($id_servico)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

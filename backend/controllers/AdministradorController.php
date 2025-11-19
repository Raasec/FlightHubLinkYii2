<?php

namespace backend\controllers;

use Yii;
use common\models\Administrador;
use common\models\AdministradorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * AdministradorController implements the CRUD actions for Administrador model.
 */
class AdministradorController extends Controller
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
                        'roles' => ['administrador'], // só administrador pode entrar 
                    ],
                ],
                'denyCallback' => function () {
                    throw new \yii\web\ForbiddenHttpException('Apenas administradores podem aceder a esta area do back-office.');
                },
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
     * Lists all Administrador models.
     * @return mixed
     */
    public function actionIndex()
    {

        if (!Yii::$app->user->can('administrador')) {
            throw new \yii\web\ForbiddenHttpException('Acesso negado.');
        }

        $searchModel = new AdministradorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Administrador model.
     * @param int $id_admin Id Admin
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_admin)
    {
        if (!Yii::$app->user->can('administrador')) {
            throw new \yii\web\ForbiddenHttpException('Acesso negado.');
        }

        return $this->render('view', [
            'model' => $this->findModel($id_admin),
        ]);
    }

    /**
     * Creates a new Administrador model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (!Yii::$app->user->can('administrador')) {
            throw new \yii\web\ForbiddenHttpException('Acesso negado.');
        }

        $model = new Administrador();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_admin' => $model->id_admin]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Administrador model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_admin Id Admin
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_admin)
    {

        if (!Yii::$app->user->can('administrador')) {
            throw new \yii\web\ForbiddenHttpException('Acesso negado.');
        }

        $model = $this->findModel($id_admin);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_admin' => $model->id_admin]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Administrador model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_admin Id Admin
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_admin)
    {

        if (!Yii::$app->user->can('administrador')) {
            throw new \yii\web\ForbiddenHttpException('Acesso negado.');
        }

        $this->findModel($id_admin)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Administrador model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_admin Id Admin
     * @return Administrador the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_admin)
    {
        if (($model = Administrador::findOne($id_admin)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

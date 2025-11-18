<?php

namespace backend\controllers;

use Yii;
use common\models\Funcionario;
use common\models\FuncionarioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\User;


/**
 * FuncionarioController implements the CRUD actions for Funcionario model.
 */
class FuncionarioController extends Controller
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
                        'roles' => ['administrador'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['view'],
                        'roles' => ['funcionario'],
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
     * Lists all Funcionario models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FuncionarioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Funcionario model.
     * @param int $id_funcionario Id Funcionario
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_funcionario)
    {
        $model = $this->findModel($id_funcionario);

        /** @var \common\models\User $user */  //buscar o User para conseguir identificar no tipo
        $user = Yii::$app->user->identity;

        // Se o utilizador for Funcionario entao ele so podera ver
        if ($user->tipo_utilizador === 'funcionario') {

            // Bloqueia acesso a dados de outros funcionarios
            if ($model->id_utilizador !== Yii::$app->user->id){
                throw new \yii\web\ForbiddenHttpException(
                    'Não pode ver dados de outros Funcionarios'
                );
            }

        }
        return $this->render('view', [
            'model' => $this->findModel($id_funcionario),
        ]);
    }

    /**
     * Creates a new Funcionario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Funcionario();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_funcionario' => $model->id_funcionario]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Funcionario model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_funcionario Id Funcionario
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_funcionario)
    {
        $model = $this->findModel($id_funcionario);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_funcionario' => $model->id_funcionario]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Funcionario model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_funcionario Id Funcionario
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_funcionario)
    {
        $this->findModel($id_funcionario)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Funcionario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_funcionario Id Funcionario
     * @return Funcionario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_funcionario)
    {
        if (($model = Funcionario::findOne($id_funcionario)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

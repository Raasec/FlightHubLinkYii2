<?php

namespace backend\controllers;

use Yii;
use common\models\Funcionario;
use common\models\FuncionarioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;


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
                        //alteração para roles novamente

                        // Quem tiver permissao para ver o Funcionario tem acesso ao index / view
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['viewFuncionario'],
                        
                    ],
                    // Funcionarios so podem ver o proprio perfil
                    [
                        'allow' => true,
                        'actions' => ['view'],
                        'roles' => ['viewFuncionario', 'viewOwnFuncionario'],
                    ],

                    [
                        // Permissoes para Criar
                        'allow' => true,
                        'actions' => ['create'],
                        'roles' => ['createFuncionario'],
                    ],

                    [
                        // Update permiss
                        'allow' => true,
                        'actions' => ['update'],
                        'roles' => ['updateFuncionario'],
                    ],

                    [
                        // Permissoes de Delete
                        'allow' => true,
                        'actions' => ['delete'],
                        'roles' => ['deleteFuncionario'],
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
    // Listagem de Todos os Funcionarios
    public function actionIndex()
    {
        // Apenas administradores podem listar funcionários
        if (!Yii::$app->user->can('viewFuncionario')) {
            throw new \yii\web\ForbiddenHttpException('Acesso negado, Sem permissões para listar Funcionários');
        }


        
        $searchModel = new FuncionarioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        //var_dump(Yii::$app->user->identity->id);
        //var_dump(Yii::$app->authManager->getRolesByUser(Yii::$app->user->id));
        //var_dump(Yii::$app->user->can('viewFuncionario'));

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
    // VER PERFIL
    public function actionView($id_funcionario)
    {
        $model = $this->findModel($id_funcionario);

        $user = Yii::$app->user->identity;

        // Se o user pode ver todos os Funcionarios entao a permission deixa passar
        if (Yii::$app->user->can('viewFuncionario')) {
            return $this->render('view', [
                'model' => $model,
                'user' => $user,
            ]);

        }
        else {
           // Se nao deixou passar para ver todos os funcionarios
            // Então vai ver se pode ver o próprio perfil (com a rule check)
            if (Yii::$app->user->can('viewOwnFuncionario', ['model' => $model])) {

                return $this->render('view', [
                    'model' => $model,
                    'user' => $user,
                ]);     
            } 
        }
        throw new \yii\web\ForbiddenHttpException("Acesso negado.");

    }

    /**
     * Creates a new Funcionario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    //Criar um Funcionario
    public function actionCreate()
    {
        if (!Yii::$app->user->can('createFuncionario')) {
            throw new \yii\web\ForbiddenHttpException('Denied Acess. You need to be Administrator to create Employees.');
        }

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
    // Atualizar Funcionario 
    public function actionUpdate($id_funcionario)
    {
        if (!Yii::$app->user->can('updateFuncionario')) {
            throw new \yii\web\ForbiddenHttpException('Acess Denied. The User needs to be Admin to update the Employee');
        }

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
    // Deletar Funcionarios
    public function actionDelete($id_funcionario)
    {
        if (!Yii::$app->user->can('deleteFuncionario')) {
            throw new \yii\web\ForbiddenHttpException('Acess Denied. The User needs to be Administrator to delete the Employee');
        }

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

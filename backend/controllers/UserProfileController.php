<?php

namespace backend\controllers;

use Yii;
use common\models\UserProfile;
use common\models\UserProfileSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * UserProfileController implements the CRUD actions for UserProfile model.
 */
class UserProfileController extends Controller
{
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [

            // RBAC ACCESS CONTROL
            'access' => [
                'class' => AccessControl::class,
                'rules' => [

                    // administrador tem acesso total
                    [
                        'allow' => true,
                        'roles' => ['manageUserProfiles'],
                    ],

                    // Ffuncionario so pode ver o próprio perfil
                    [
                        'allow' => true,
                        'actions' => ['view'],
                        'roles' => ['viewOwnUserProfile'],
                    ],

                    // Ffuncionario so pode editar o próprio perfil
                    [
                        'allow' => true,
                        'actions' => ['update'],
                        'roles' => ['updateOwnUserProfile'],
                    ],
                ],
            ],

            // HTTP verbs
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ]);
    }

    /**
     * Lists all UserProfile models.
     * Apenas ADMIN
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->can('manageUserProfiles')) {
            throw new ForbiddenHttpException();
        }

        $searchModel = new UserProfileSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserProfile model.
     * ADMIN ou FUNCIONARIO (apenas o próprio)
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        if (
            !Yii::$app->user->can('viewOwnUserProfile', ['model' => $model]) &&
            !Yii::$app->user->can('manageUserProfiles')
        ) {
            throw new ForbiddenHttpException();
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new UserProfile model.
     * Apenas ADMIN
     */
    public function actionCreate()
    {
        /*
        if (!Yii::$app->user->can('manageUserProfiles')) {
            throw new ForbiddenHttpException();
        }

        $model = new UserProfile();

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
        */
    }

    /**
     * Updates an existing UserProfile model.
     * ADMIN ou FUNCIONARIO (apenas o próprio)
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (
            !Yii::$app->user->can('updateOwnUserProfile', ['model' => $model]) &&
            !Yii::$app->user->can('manageUserProfiles')
        ) {
            throw new ForbiddenHttpException();
        }

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing UserProfile model.
     * Apenas ADMIN
     */
    public function actionDelete($id)
    {
        if (!Yii::$app->user->can('manageUserProfiles')) {
            throw new ForbiddenHttpException();
        }

        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the UserProfile model.
     */
    protected function findModel($id)
    {
        if (($model = UserProfile::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

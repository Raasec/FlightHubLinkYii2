<?php

namespace backend\controllers;

use common\models\LoginForm;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                    
                // Login e erro sempre permitidos
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],

                    // Logout permitido para qualqer utilizador autenticado
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'], //adicionar admin e funcionario
                    ],

                    // A página index do backend só pode ser acedida por administrador + funcionario
                    [
                        'actions' => ['index', 'recent-activity', 'system-resume'],
                        'allow' => true,
                        'roles' => ['administrador', 'funcionario'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post', 'get'], // permitir GET para evitar ficar preso
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        // !SE ja esta autenticado mas nao for ou admin ou func, entao manda embora
        if (!Yii::$app->user->isGuest) {
            if (!Yii::$app->user->can('administrador') && !Yii::$app->user->can('funcionario')){
                Yii::$app->user->logout();
                return $this->redirect(['site/login']);
            }

            return $this->goHome();
    
        }


        $this->layout = 'blank';


        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            // Depois do login, confirmar o tipo de utilizador

            if (!Yii::$app->user->can('administrador') && !Yii::$app->user->can('funcionario')) {
                Yii::$app->user->logout();
                Yii::$app->session->setFlash('error', 'Sem permissões para aceder ao backoffice.');
                return $this->redirect(['site/login']);
            }

            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }


    // render da page do recent Activity
    public function actionRecentActivity()
    {
        return $this->render('recent-activity');
    }

    // render da page do System Resume
    public function actionSystemResume ()
    {
        return $this->render('system-resume');
    }
}

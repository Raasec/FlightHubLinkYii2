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
        // 1. Counts for Top Gadgets
        $totalVoos = \common\models\Voo::find()->count();
        $totalBilhetes = \common\models\Bilhete::find()->count();
        $totalNotificacoes = \common\models\Notificacao::find()->count();
        $totalPedidos = \common\models\PedidoAssistencia::find()->count();
        $totalFuncionarios = \common\models\Funcionario::find()->count();
        $totalPassageiros = \common\models\Passageiro::find()->count();

        // 2. Recent Departures (limit 5)
        $recentDepartures = \common\models\Voo::find()
            ->where(['tipo_voo' => 'departure'])
            ->orderBy(['departure_date' => SORT_DESC])
            ->limit(5)
            ->all();

        // 3. Recent Arrivals (limit 5)
        $recentArrivals = \common\models\Voo::find()
            ->where(['tipo_voo' => 'arrival'])
            ->orderBy(['arrival_date' => SORT_DESC])
            ->limit(5)
            ->all();

        // 4. Recent Notifications (limit 5)
        $recentNotifications = \common\models\Notificacao::find()
            ->orderBy(['sent_at' => SORT_DESC])
            ->limit(5)
            ->all();


        return $this->render('index', [
            'totalVoos' => $totalVoos,
            'totalBilhetes' => $totalBilhetes,
            'totalNotificacoes' => $totalNotificacoes,
            'totalPedidos' => $totalPedidos,
            'recentDepartures' => $recentDepartures,
            'recentArrivals' => $recentArrivals,
            'totalFuncionarios' => $totalFuncionarios,
            'totalPassageiros' => $totalPassageiros,
            'recentNotifications' => $recentNotifications,
        ]);
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



}

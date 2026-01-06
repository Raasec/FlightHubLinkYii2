<?php

namespace backend\controllers;

use Yii;
use common\models\Bilhete;
use common\models\BilheteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use common\models\Passageiro;
use common\models\Voo;

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
                'only' => ['index', 'view', 'create', 'update', 'delete', 'update-statuses'],
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
                    'update-statuses' => ['POST'],
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
        if (!Yii::$app->user->can('viewTicket')) 
        {
            throw new \yii\web\ForbiddenHttpException("You do not have permission to view tickets.");
        }

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
        if (!Yii::$app->user->can('viewTicket')) 
        {
            throw new \yii\web\ForbiddenHttpException("You do not have permission to view this ticket.");
        }


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
        if (!Yii::$app->user->can('createTicket')) {
            throw new \yii\web\ForbiddenHttpException(
                "You do not have permission to create tickets."
            );
        }

        $model = new Bilhete();

        //  usa Passageiro.id_passageiro 
        $passageiros = ArrayHelper::map(
            Passageiro::find()
                ->innerJoin('user', 'user.id = passageiro.id_utilizador')
                ->innerJoin(
                    'auth_assignment',
                    'auth_assignment.user_id = user.id'
                )
                ->where(['auth_assignment.item_name' => 'passageiro'])
                ->all(),
            'id_passageiro',
            function ($p) {
                return $p->user->username;
            }
        );

        // voos
        $voos = ArrayHelper::map(
            Voo::find()->all(),
            'id_voo',
            'numero_voo'
        );

        if ($model->load(Yii::$app->request->post())) {

            $model->issue_date = date('Y-m-d'); 

            if ($model->save()) {
                return $this->redirect([
                    'view',
                    'id_bilhete' => $model->id_bilhete
                ]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'passageiros' => $passageiros,
            'voos' => $voos,
        ]);
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
        if (!Yii::$app->user->can('updateTicket')) {
            throw new \yii\web\ForbiddenHttpException(
                "You do not have permission to update tickets."
            );
        }

        // carrega o bilhete 
        $model = $this->findModel($id_bilhete);

        //usa Passageiro.id_passageiro 
        $passageiros = ArrayHelper::map(
            Passageiro::find()
                ->innerJoin('user', 'user.id = passageiro.id_utilizador')
                ->innerJoin(
                    'auth_assignment',
                    'auth_assignment.user_id = user.id'
                )
                ->where(['auth_assignment.item_name' => 'passageiro'])
                ->all(),
            'id_passageiro',
            function ($p) {
                return $p->user->username;
            }
        );

        // voos
        $voos = ArrayHelper::map(
            Voo::find()->all(),
            'id_voo',
            'numero_voo'
        );

        if ($model->load(Yii::$app->request->post())) {

            $model->issue_date = date('Y-m-d'); 

            if ($model->save()) {
                return $this->redirect([
                    'view',
                    'id_bilhete' => $model->id_bilhete
                ]);
            }
        }
        
        // RENDERIZA UPDATE 
        return $this->render('update', [
            'model' => $model,
            'passageiros' => $passageiros,
            'voos' => $voos,
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
        if (!Yii::$app->user->can('deleteTicket')) 
        {
            throw new \yii\web\ForbiddenHttpException("You do not have permission to delete tickets.");
        }

        $this->findModel($id_bilhete)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Updates tickets statuses (e.g. Paid -> Used upon arrival).
     */
    public function actionUpdateStatuses()
    {
        if (!Yii::$app->user->can('updateTicket')) {
            throw new \yii\web\ForbiddenHttpException("You do not have permission to perform this action.");
        }

        try {
            $count = \common\services\FlightUtilityService::updateTicketStatuses();
            if ($count > 0) {
                 Yii::$app->session->setFlash('success', "Sucesso: $count bilhetes atualizados para 'Used'.");
            } else {
                 Yii::$app->session->setFlash('info', "Nenhum bilhete precisou de atualização.");
            }
        } catch (\Exception $e) {
            Yii::$app->session->setFlash('error', "Erro: " . $e->getMessage());
        }

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

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
                'only' => ['index', 'view', 'create', 'update', 'delete', 'feed', 'delay'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'delay'],
                        'roles' => ['administrador','funcionario'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['feed'],
                        'roles' => ['administrador'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'delay' => ['POST'],
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

    // atrasa um voo e notifica passageiros
    public function actionDelay($id_voo)
    {
        $model = $this->findModel($id_voo);
        $delayMinutes = Yii::$app->request->post('delay_minutes', 30);

        if ($delayMinutes < 1 || $delayMinutes > 1440) {
            Yii::$app->session->setFlash('error', 'Tempo de atraso inválido (1-1440 min).');
            return $this->redirect(['view', 'id_voo' => $id_voo]);
        }

        // atualiza departure e arrival
        $oldDeparture = $model->departure_date;
        $model->departure_date = date('Y-m-d H:i:s', strtotime($model->departure_date . " +{$delayMinutes} minutes"));
        $model->arrival_date = date('Y-m-d H:i:s', strtotime($model->arrival_date . " +{$delayMinutes} minutes"));

        if ($model->save()) {
            // cria notificacao para passageiros
            $count = \common\services\NotificationService::notifyFlightDelay($model, $delayMinutes);
            Yii::$app->session->setFlash('success', "Voo atrasado em {$delayMinutes} min. {$count} passageiros notificados.");
        } else {
            Yii::$app->session->setFlash('error', 'Erro ao atualizar voo.');
        }

        return $this->redirect(['view', 'id_voo' => $id_voo]);
    }

    /**
     * MOCK DATA GENERATOR (UI version)
     */
    public function actionFeed()
    {
        if (!Yii::$app->user->can('administrador')) {
            throw new \yii\web\ForbiddenHttpException('Apenas administradores podem gerar dados de teste.');
        }

        $airlines = \common\models\CompanhiaAerea::find()->column();
        if (empty($airlines)) {
            Yii::$app->session->setFlash('error', 'Crie pelo menos uma Companhia Aérea antes de gerar voos.');
            return $this->redirect(['index']);
        }

        $employees = \common\models\Funcionario::find()->column();
        $gates = ['A', 'B', 'C', 'D'];
        $cities = ['Lisboa', 'Porto', 'Faro', 'Funchal', 'Madrid', 'Paris', 'Londres', 'Berlim', 'Roma', 'Amesterdão'];
        $prefixes = ['TP', 'LH', 'AF', 'BA', 'FR'];

        $created = 0;
        for ($i = 0; $i < 10; $i++) {
            $voo = new Voo();
            $isDeparture = (rand(0, 1) == 1);
            $origin = $isDeparture ? 'Lisboa' : $cities[array_rand($cities)];
            $dest = $isDeparture ? $cities[array_rand($cities)] : 'Lisboa';
            
            if ($origin == $dest) $dest = 'Ponta Delgada';

            $voo->id_companhia = $airlines[array_rand($airlines)];
            $voo->numero_voo = $prefixes[array_rand($prefixes)] . rand(100, 999);
            $voo->origin = $origin;
            $voo->destination = $dest;
            $voo->tipo_voo = $isDeparture ? 'departure' : 'arrival';
            $voo->gate = $gates[array_rand($gates)];
            $voo->status = 1;
            
            if (!empty($employees)) {
                $voo->id_funcionario_responsavel = $employees[array_rand($employees)];
            }

            $daysOffset = rand(1, 5); // start from tomorrow for clean tests
            $hoursOffset = rand(0, 23);
            $date = date('Y-m-d H:i:s', strtotime("+$daysOffset days +$hoursOffset hours"));
            
            $voo->departure_date = $date;
            $voo->arrival_date = date('Y-m-d H:i:s', strtotime($date . ' +2 hours'));

            if ($voo->save()) {
                $created++;
            }
        }

        Yii::$app->session->setFlash('success', "Sucesso! Gerados $created voos aleatórios para os próximos dias.");
        return $this->redirect(['index']);
    }
}

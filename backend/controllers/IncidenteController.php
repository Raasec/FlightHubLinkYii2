<?php

namespace backend\controllers;

use Yii;
use common\models\Incidente;
use common\models\IncidenteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Notificacao;
use common\services\MqttService;

/**
 * IncidenteController implements the CRUD actions for Incidente model.
 */
class IncidenteController extends Controller
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
     * Lists all Incidente models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->can('viewIncident')) {
            throw new \yii\web\ForbiddenHttpException(
                'You do not have permission to view incidents.'
            );
        }

        $searchModel = new IncidenteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Incidente model.
     * @param int $id_incidente Id Incidente
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_incidente)
    {
        if (!Yii::$app->user->can('viewIncident')) {
            throw new \yii\web\ForbiddenHttpException(
                'You do not have permission to view this incident.'
            );
        }

        return $this->render('view', [
            'model' => $this->findModel($id_incidente),
        ]);
    }

    /**
     * Creates a new Incidente model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (!Yii::$app->user->can('createIncident')) {
            throw new \yii\web\ForbiddenHttpException(
                'You do not have permission to create incidents.'
            );
        }

        $model = new Incidente();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_incidente' => $model->id_incidente]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Incidente model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_incidente Id Incidente
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_incidente)
    {
        if (!Yii::$app->user->can('updateIncident')) {
            throw new \yii\web\ForbiddenHttpException(
                'You do not have permission to update incidents.'
            );
        }

        $model = $this->findModel($id_incidente);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_incidente' => $model->id_incidente]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Incidente model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_incidente Id Incidente
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_incidente)
    {
        if (!Yii::$app->user->can('deleteIncident')) {
            throw new \yii\web\ForbiddenHttpException(
                'You do not have permission to delete incidents.'
            );
        }

        $this->findModel($id_incidente)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Sends a notification for this incident.
     * @param int $id_incidente
     * @return mixed
     */
    public function actionNotify($id_incidente)
    {
        if (!Yii::$app->user->can('updateIncident')) { // Assuming update permission is enough
             throw new \yii\web\ForbiddenHttpException('You do not have permission to send notifications.');
        }

        $model = $this->findModel($id_incidente);

        // Create Notification
        $notificacao = new Notificacao();
        $notificacao->id_voo = null; // Global alert
        $notificacao->type = 'alert';
        $notificacao->message = $model->description; // Use incident description
        $notificacao->sent_at = date('Y-m-d H:i:s');
        
        if ($notificacao->save()) {
            // Link back to Incident
            $model->id_notificacao = $notificacao->id_notificacao;
            $model->save(false); // Skip validation to just save the ID

            // Broadcast MQTT
            try {
                MqttService::publishGlobalAlert($notificacao);
                Yii::$app->session->setFlash('success', 'Notificação enviada com sucesso e publicada via MQTT!');
            } catch (\Exception $e) {
                Yii::$app->session->setFlash('error', 'Notificação salva, mas falha no MQTT: ' . $e->getMessage());
            }
        } else {
            Yii::$app->session->setFlash('error', 'Erro ao criar notificação: ' . json_encode($notificacao->errors));
        }

        return $this->redirect(['view', 'id_incidente' => $id_incidente]);
    }

    /**
     * Finds the Incidente model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_incidente Id Incidente
     * @return Incidente the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_incidente)
    {
        if (($model = Incidente::findOne($id_incidente)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

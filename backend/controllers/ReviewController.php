<?php

namespace backend\controllers;

use Yii;
use common\models\Review;
use common\models\ReviewSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * ReviewController implements the CRUD actions for Review model.
 */
class ReviewController extends Controller
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
     * Lists all Review models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->can('viewReview')) {
            throw new \yii\web\ForbiddenHttpException(
                'You do not have permission to view reviews.'
            );
        }

        $searchModel = new ReviewSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Review model.
     * @param int $id_review Id Review
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_review)
    {
        if (!Yii::$app->user->can('viewReview')) {
            throw new \yii\web\ForbiddenHttpException(
                'You do not have permission to view this review.'
            );
        }

        return $this->render('view', [
            'model' => $this->findModel($id_review),
        ]);
    }

    /**
     * Creates a new Review model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (!Yii::$app->user->can('createReview')) {
            throw new \yii\web\ForbiddenHttpException(
                'You do not have permission to create reviews.'
            );
        }

        $model = new Review();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_review' => $model->id_review]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Review model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_review Id Review
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_review)
    {
        if (!Yii::$app->user->can('updateReview')) {
            throw new \yii\web\ForbiddenHttpException(
                'You do not have permission to update reviews.'
            );
        }

        $model = $this->findModel($id_review);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_review' => $model->id_review]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Review model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_review Id Review
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_review)
    {
        if (!Yii::$app->user->can('deleteReview')) {
            throw new \yii\web\ForbiddenHttpException(
                'You do not have permission to delete reviews.'
            );
        }

        $this->findModel($id_review)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Review model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_review Id Review
     * @return Review the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_review)
    {
        if (($model = Review::findOne($id_review)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

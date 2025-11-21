<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\FuncionarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Funcionarios';
$this->params['breadcrumbs'][] = $this->title;

// Agora usamos RBAC em vez de tipo-utilizador para se fazer a identifacao do utilizador
$isAdmin = Yii::$app->user->can('administrador');

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <!--
                        <div class="col-md-12">
                            <php /*?= Html::a('Create Funcionario', ['create'], ['class' => 'btn btn-success']) */?>
                        </div>
                        -->
                    </div>


                    <?php $this->render('_search', ['model' => $searchModel]); ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            'id_utilizador',
                            [
                                'attribute' => 'username',
                                'label' => 'Username',
                                'value' => function($model) {
                                    return $model->user->username ?? '(sem user)';
                                }
                            ],
                            'id_funcionario',
                            [
                                'attribute' => 'email',
                                'label' => 'Email',
                                'value' => function($model) {
                                    return $model->user->email ?? '(sem email)';
                                }
                            ],
                            'departamento',
                            'cargo',
                            'turno',
                            //'data_contratacao',

                            [
                                'class' => 'yii\grid\ActionColumn',

                                'template' => $isAdmin ? '{view} {update} {delete}' : '{view}',

                                'urlCreator' => function ($action, $model, $key, $index) {
                                    return Url::to([$action, 'id_funcionario' => $model->id_funcionario]); },

                                'visibleButtons' => [
                                    // butao que fica visivel
                                    'update' => function ($url, $model, $key) use ($isAdmin) {
                                        if ($isAdmin) {
                                            return true;
                                        }
                                        // se o proprio f
                                        return $model->id_utilizador == Yii::$app->user->id;
                                    },
                                    'delete' => function () use ($isAdmin) {
                                        return $isAdmin;
                                    },
                                ],
                            ],
                        ],
                        'summaryOptions' => ['class' => 'summary mb-2'],
                        'pager' => [
                            'class' => 'yii\bootstrap4\LinkPager',
                        ]
                    ]); ?>


                </div>
                <!--.card-body-->
            </div>
            <!--.card-->
        </div>
        <!--.col-md-12-->
    </div>
    <!--.row-->
</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PassageiroSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Passageiros';
$this->params['breadcrumbs'][] = $this->title;

$user = Yii::$app->user->identity;
$isAdmin = Yii::$app->user->can('administrador');
$isFuncionario = Yii::$app->user->can('funcionario');

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <?php /*if ($isAdmin || $isFuncionario): ?>
                                <?= Html::a('Create Passageiro', ['create'], ['class' => 'btn btn-success']) ?>
                            <?php endif; */?>
                        </div>
                    </div>


                    <?php $this->render('_search', ['model' => $searchModel]); ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            'id_utilizador',                            
                            [
                                'label' => 'Username',
                                'value' => function ($model) {
                                    return $model->user ? $model->user->username : '(n/d)';
                                }
                            ],
                            'id_passageiro',
                            [
                                'label' => 'Email',
                                'value' => function ($model) {
                                    return $model->user ? $model->user->email : '(n/d)';
                                }
                            ],
                            'nif',
                            'telefone',
                            'nacionalidade',
                            'data_nascimento',
                            //'preferencias:ntext',

                            [
                                'class' => '\yii\grid\ActionColumn',
                                'header' => 'Ações',

                                // Corrige o problema dos IDs
                                'urlCreator' => function ($action, $model) {
                                    return [$action, 'id_passageiro' => $model->id_passageiro];
                                },

                                'template' => '{view} {update} {delete}',

                                'visibleButtons' => [
                                    'update' => $isAdmin || $isFuncionario,
                                    'delete' => $isAdmin,
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

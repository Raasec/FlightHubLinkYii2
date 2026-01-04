<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Voo;

/* @var $this yii\web\View */
/* @var $searchModel common\models\VooSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Flights';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <?= Html::a('<i class="fas fa-plus me-1"></i> Create Flight', ['create'], ['class' => 'btn btn-success']) ?>
                            
                            <?php if (Yii::$app->user->can('administrador')): ?>
                                <?= Html::a('<i class="fas fa-magic me-1"></i> Generate Mock Flights', ['feed'], [
                                    'class' => 'btn btn-info text-white',
                                    'data' => [
                                        'confirm' => 'Deseja gerar 10 voos random ?',
                                        'method' => 'post',
                                    ],
                                ]) ?>
                            <?php endif; ?>
                        </div>
                    </div>


                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            'id_voo',
                            'id_companhia',
                            'numero_voo',
                            'origin',
                            'destination',
                            'departure_date',
                            [
                                'attribute' => 'gate',
                                'value' => function($model) {
                                    return $model::optsGate()[$model->gate] ?? $model->gate;
                                },
                                'filter' => Voo::optsGate(),
                            ],
                            [
                                'attribute' => 'status',
                                'format' => 'raw',
                                'value' => function($model) {
                                    $label = Voo::optsStatus()[$model->status] ?? $model->status;
                                    $class = $model->status == 1 ? 'badge-success' : 'badge-secondary';
                                    return Html::tag('span', $label, ['class' => 'badge ' . $class]);
                                },
                                'filter' => Voo::optsStatus(),
                            ],

                            [
                                'class' => 'hail812\adminlte3\yii\grid\ActionColumn',
                                'urlCreator' => function ($action, $model, $key, $index) {
                                    return \yii\helpers\Url::to([$action, 'id_voo' => $model->id_voo]);
                                }
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

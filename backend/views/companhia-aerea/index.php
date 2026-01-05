<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CompanhiaAereaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->registerCssFile(
    Yii::getAlias('@web/css/site.css'),
    ['depends' => [\hail812\adminlte3\assets\AdminLteAsset::class]]
);

$this->title = 'Airlines';

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-12 d-flex align-items-center gap-2">
                            <?= Html::a('Create Airline', ['create'], ['class' => 'btn btn-success']) ?>

                            <div class="ml-auto">
                                <?= Html::a(
                                    'SEED / Sync Default Airlines',
                                    ['sync-default'],
                                    [
                                        'class' => 'btn btn-warning',
                                        'data' => [
                                            'confirm' => 'This will sync the default airlines dataset. Continue?',
                                            'method' => 'post',
                                        ],
                                    ]
                                ) ?>
                            </div>
                        </div>
                    </div>

                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= GridView::widget([
                        'tableOptions' => ['class' => 'table table-striped table-hover airline-table'],
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [

                            'id_companhia',
                            [
                                'attribute' => 'image',
                                'label' => 'Logo',
                                'format' => 'raw',
                                'contentOptions' => ['class' => 'text-center'],
                                'value' => function ($model) {
                                    return Html::a(
                                        Html::img(
                                            $model->imageUrl,
                                            [
                                                // fixo tamanho para nao dar break na table
                                                'style' => 'width:70px;height:45px;object-fit:contain;',
                                                'class' => 'airline-logo',
                                                'alt' => $model->name,
                                                'title' => 'View airline details',
                                            ]
                                        ),
                                        ['view', 'id_companhia' => $model->id_companhia]
                                    );
                                }
                            ], 
                            'name',
                            [
                                'attribute' => 'iata_code',
                                'label' => 'Code IATA',
                                'format' => 'raw',
                                'contentOptions' => ['class' => 'text-center'],
                                'value' => function ($model) {
                                    return Html::tag(
                                        'span',
                                        $model->iata_code,
                                        ['class' => 'badge badge-pill badge-info airline-iata']
                                    );
                                }
                            ],
                            'country_origin',                          

                            [
                                'class' => 'hail812\adminlte3\yii\grid\ActionColumn',
                                'urlCreator' => function ($action, $model) {
                                    return [$action, 'id_companhia' => $model->id_companhia];
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

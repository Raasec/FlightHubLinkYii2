<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CompanhiaAereaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Airlines';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <?= Html::a('Create Airline', ['create'], ['class' => 'btn btn-success']) ?>
                        </div>
                    </div>


                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            'id_companhia',
                            'name',
                            'iata_code',
                            'country_origin',
                            [
                                'attribute' => 'image',
                                'label' => 'Logo',
                                'format' => 'raw',
                                'value' => function ($model) {
                                    if (!$model->image) return '(no image)';
                                    return Html::img(
                                        Yii::getAlias('@imgUrl') . '/airlines/' . $model->image,
                                        ['width' => '60px']
                                    );
                                }
                            ],                            

                            ['class' => 'hail812\adminlte3\yii\grid\ActionColumn'],
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

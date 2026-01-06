<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\BilheteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'Tickets';

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <?= Html::a('Create Ticket', ['create'], ['class' => 'btn btn-success']) ?>
                            <?= Html::a('<i class="fas fa-sync me-1"></i> Update Statuses', ['update-statuses'], [
                                'class' => 'btn btn-warning',
                                'title' => 'Updates Paid/Check-in tickets of landed flights to Used',
                                'data' => [
                                    'confirm' => 'Atualizar status de bilhetes de voos já realizados?',
                                    'method' => 'post',
                                ],
                            ]) ?>
                        </div>
                    </div>


                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            'id_bilhete',
                            'id_passageiro',
                            'id_voo',
                            'gate',
                            'issue_date',
                            //'price',
                            'travel_class',
                            //'seat',
                            'status',

                            [
                                'class' => 'hail812\adminlte3\yii\grid\ActionColumn',
                                'urlCreator' => function ($action, $model, $key, $index) {
                                    return \yii\helpers\Url::to([$action, 'id_bilhete' => $model->id_bilhete]);
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

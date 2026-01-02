<?php

use common\models\PedidoAssistencia;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\PedidoAssistenciaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Pedido Assistencias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pedido-assistencia-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Pedido Assistencia', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_pedido',
            'id_passageiro',
            'id_funcionario_resolve',
            'type',
            'request_date',
            //'resolution_date',
            //'status',
            //'description:ntext',
            //'response:ntext',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, PedidoAssistencia $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_pedido' => $model->id_pedido]);
                 }
            ],
        ],
    ]); ?>


</div>

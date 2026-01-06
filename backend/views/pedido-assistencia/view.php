<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\PedidoAssistencia $model */

$this->title = $model->id_pedido;

\yii\web\YiiAsset::register($this);
?>
<div class="pedido-assistencia-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_pedido' => $model->id_pedido], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_pedido' => $model->id_pedido], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_pedido',
            'id_passageiro',
            'id_funcionario_resolve',
            'type',
            'request_date',
            'resolution_date',
            'status',
            'description:ntext',
            'response:ntext',
        ],
    ]) ?>

    <hr>
    
    <div class="mt-3">
        <?= Html::a(
            '← Back to Assistance-Requests',
            ['index'],
            ['class' => 'btn btn-secondary']
        ) ?>
    </div>

</div>

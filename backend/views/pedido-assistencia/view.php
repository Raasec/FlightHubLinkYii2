<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\PedidoAssistencia */

$this->title = $model->id_pedido;
$this->params['breadcrumbs'][] = ['label' => 'Assistance Request', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
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
                        ],
                    ]) ?>
                </div>
                <!--.col-md-12-->
            </div>
            <!--.row-->
        </div>
        <!--.card-body-->
    </div>
    <!--.card-->
</div>
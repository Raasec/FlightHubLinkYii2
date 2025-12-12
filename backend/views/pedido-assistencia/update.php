<?php

/* @var $this yii\web\View */
/* @var $model common\models\PedidoAssistencia */

$this->title = 'Update Request Assistance: ' . $model->id_pedido;
$this->params['breadcrumbs'][] = ['label' => 'Request Assistance', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_pedido, 'url' => ['view', 'id_pedido' => $model->id_pedido]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <?=$this->render('_form', [
                        'model' => $model
                    ]) ?>
                </div>
            </div>
        </div>
        <!--.card-body-->
    </div>
    <!--.card-->
</div>
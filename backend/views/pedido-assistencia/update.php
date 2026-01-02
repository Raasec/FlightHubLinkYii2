<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\PedidoAssistencia $model */

$this->title = 'Update Pedido Assistencia: ' . $model->id_pedido;
$this->params['breadcrumbs'][] = ['label' => 'Pedido Assistencias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_pedido, 'url' => ['view', 'id_pedido' => $model->id_pedido]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pedido-assistencia-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

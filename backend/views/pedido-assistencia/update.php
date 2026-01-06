<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\PedidoAssistencia $model */

$this->title = 'Update Pedido Assistencia: ' . $model->id_pedido;

?>
<div class="pedido-assistencia-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

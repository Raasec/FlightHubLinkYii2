<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\PedidoAssistencia $model */

$this->title = 'Create Pedido Assistencia';
$this->params['breadcrumbs'][] = ['label' => 'Pedido Assistencias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pedido-assistencia-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

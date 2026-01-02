<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\PedidoAssistenciaSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="pedido-assistencia-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_pedido') ?>

    <?= $form->field($model, 'id_passageiro') ?>

    <?= $form->field($model, 'id_funcionario_resolve') ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'request_date') ?>

    <?php // echo $form->field($model, 'resolution_date') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'response') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

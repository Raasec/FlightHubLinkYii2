<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PedidoAssistencia */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="pedido-assistencia-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_passageiro')->textInput() ?>

    <?= $form->field($model, 'id_funcionario_resolve')->textInput() ?>

    <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'request_date')->input('date') ?>

    <?= $form->field($model, 'resolution_date')->input('date') ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 4]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

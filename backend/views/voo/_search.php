<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\VooSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row mt-2">
    <div class="col-md-12">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_voo') ?>

    <?= $form->field($model, 'id_companhia') ?>

    <?= $form->field($model, 'numero_voo') ?>

    <?= $form->field($model, 'origem') ?>

    <?= $form->field($model, 'destino') ?>

    <?php // echo $form->field($model, 'data_registo') ?>

    <?php // echo $form->field($model, 'porta_embarque') ?>

    <?php // echo $form->field($model, 'data_chegada') ?>

    <?php // echo $form->field($model, 'id_funcionario_responsavel') ?>

    <?php // echo $form->field($model, 'estado') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    </div>
    <!--.col-md-12-->
</div>

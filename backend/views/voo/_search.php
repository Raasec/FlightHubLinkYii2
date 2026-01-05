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

    <?= $form->field($model, 'airline_name')->label('Airline') ?>

    <?= $form->field($model, 'numero_voo') ?>

    <?= $form->field($model, 'origin') ?>

    <?= $form->field($model, 'destination') ?>

    <?= $form->field($model, 'tipo_voo') ?>

    <?php // echo $form->field($model, 'departure_date') ?>

    <?php // echo $form->field($model, 'arrival_date') ?>

    <?php // echo $form->field($model, 'gate') ?>

    <?php // echo $form->field($model, 'id_funcionario_responsavel') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    </div>
    <!--.col-md-12-->
</div>

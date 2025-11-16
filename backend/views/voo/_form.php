<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Voo */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="voo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_companhia')->textInput() ?>

    <?= $form->field($model, 'numero_voo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'origem')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'destino')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'data_registo')->textInput() ?>

    <?= $form->field($model, 'porta_embarque')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'data_chegada')->textInput() ?>

    <?= $form->field($model, 'id_funcionario_responsavel')->textInput() ?>

    <?= $form->field($model, 'estado')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

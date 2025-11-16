<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Bilhete */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="bilhete-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_passageiro')->textInput() ?>

    <?= $form->field($model, 'id_voo')->textInput() ?>

    <?= $form->field($model, 'porta_embarque')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'data_emissao')->textInput() ?>

    <?= $form->field($model, 'preco')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'classe')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'assento')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estado')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

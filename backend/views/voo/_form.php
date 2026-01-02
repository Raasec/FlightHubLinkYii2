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

    <?= $form->field($model, 'origin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'destination')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipo_voo')->dropDownList([
            'departure' => 'Departure',
            'arrival'   => 'Arrival'
        ], ['prompt' => 'Select flight type']) 
    ?>

    <?= $form->field($model, 'departure_date')->input('date') ?>

    <?= $form->field($model, 'gate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'arrival_date')->input('date') ?>

    <?php
    $funcionarios = \common\models\Funcionario::find()->joinWith('user')->all();
    $funcionarioList = \yii\helpers\ArrayHelper::map($funcionarios, 'id_funcionario', 'user.username');
    ?>

    <?= $form->field($model, 'id_funcionario_responsavel')->dropDownList($funcionarioList, ['prompt' => 'Select Responsible Employee']) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

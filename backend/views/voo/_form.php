<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Voo */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="voo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    $companhias = \common\models\CompanhiaAerea::find()    
        ->orderBy(['name' => SORT_ASC])
        ->all();
    $companhiaList = \yii\helpers\ArrayHelper::map(
    $companhias,
    'id_companhia',
    function ($model) {
        return "{$model->iata_code} — {$model->name}";
    }
);
    ?>

    <?= $form->field($model, 'id_companhia')->dropDownList($companhiaList, ['prompt' => '-- Selecionar Companhia --']) ?>

    <?= $form->field($model, 'numero_voo')->textInput(['maxlength' => true, 'placeholder' => 'Ex: TP123']) ?>

    <div class="row">
        <div class="col-md-6"><?= $form->field($model, 'origin')->textInput(['maxlength' => true]) ?></div>
        <div class="col-md-6"><?= $form->field($model, 'destination')->textInput(['maxlength' => true]) ?></div>
    </div>

    <div class="row">
        <div class="col-md-4"><?= $form->field($model, 'tipo_voo')->dropDownList($model::optsTipoVoo(), ['prompt' => '-- Tipo --']) ?></div>
        <div class="col-md-4"><?= $form->field($model, 'status')->dropDownList($model::optsStatus()) ?></div>
        <div class="col-md-4"><?= $form->field($model, 'gate')->dropDownList($model::optsGate(), ['prompt' => '-- Gate --']) ?></div>
    </div>

    <div class="row">
        <div class="col-md-6"><?= $form->field($model, 'departure_date')->input('datetime-local') ?></div>
        <div class="col-md-6"><?= $form->field($model, 'arrival_date')->input('datetime-local') ?></div>
    </div>

    <?php
    $funcionarios = \common\models\Funcionario::find()->joinWith('user')->all();
    $funcionarioList = \yii\helpers\ArrayHelper::map($funcionarios, 'id_funcionario', function($model) {
        return $model->user->username . ' (' . $model->user->email . ')';
    });
    ?>

    <?= $form->field($model, 'id_funcionario_responsavel')->dropDownList($funcionarioList, ['prompt' => 'Selecionar Funcionário Responsável']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <div class="mt-3">
        <?= Html::a(
            '← Back to Flights',
            ['index'],
            ['class' => 'btn btn-secondary']
        ) ?>
    </div>

</div>

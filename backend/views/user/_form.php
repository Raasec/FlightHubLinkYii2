<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\User $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <!-- Tipo utilizador dropdown -->
    <?= $form->field($model, 'tipo_utilizador')->dropDownList([
        'passageiro' => 'Passageiro',
        'funcionario' => 'Funcionário',
        'administrador' => 'Administrador',
    ], ['prompt' => 'Selecione...']) ?>

    <!-- Status dropdown -->
    <?= $form->field($model, 'status')->dropDownList([
        9 => 'Inativo',
        10 => 'Ativo',
    ]) ?>

    <!-- Campo para read only da data de registo -->
    <?= $form->field($model, 'data_registo')->textInput(['readonly' => true]) ?>

    
    <!-- Campo de password “virtual”: só mexe no hash se for preenchido -->
    <?= $form->field($model, 'new_password')
        ->passwordInput(['maxlength' => true])
        ->hint($model->isNewRecord
            ? 'Defina a password inicial do utilizador.'
            : 'Deixe em branco para manter a password atual.'
        ) ?>

    <!-- Butao de Salvar as ediçoes -->
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

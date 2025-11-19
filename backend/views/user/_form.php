<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\User $model */
/** @var yii\widgets\ActiveForm $form */


$isAdmin = Yii::$app->user->can('administrador');

?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- Username -->
    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <!-- Email -->
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <!-- Status dropdown onde apenas Administrador terá acessibilidade -->
    <?php if ($isAdmin): ?>
        <?= $form->field($model, 'status')->dropDownList([
            10 => 'Ativo',
            9  => 'Inativo',
        ]) ?>
    <?php else: ?>
        <?= $form->field($model, 'status')->hiddenInput()->label(false) ?>
    <?php endif; ?>
    
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

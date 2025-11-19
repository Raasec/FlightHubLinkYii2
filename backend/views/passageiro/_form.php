<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use common\models\Passageiro;

/* @var $this yii\web\View */
/* @var $model common\models\Passageiro */
/* @var $form yii\bootstrap4\ActiveForm */

/** @var $model common\models\Passageiro */

$user = $model->user; // relação com User
?>

<div class="passageiro-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- ID User em read only -->
    <?= $form->field($model, 'id_utilizador')->textInput(['readonly' => true]) ?>

    <!-- Username, Nome, Email que vem de User (readonly) -->
    <?php if ($model->user): ?>
        <div class="form-group">
            <label><strong>Username</strong></label>
            <input class="form-control" value="<?= $model->user->username ?>" readonly>
        </div>

        <div class="form-group">
            <label><strong>Email</strong></label>
            <input class="form-control" value="<?= $model->user->email ?>" readonly>
        </div>
    <?php endif; ?>

    <!-- NIF -->
    <?= $form->field($model, 'nif')->textInput(['maxlength' => true]) ?>

    <!-- Telefone -->
    <?= $form->field($model, 'telefone')->textInput(['maxlength' => true]) ?>

    <!-- Nacionalidade -->
    <?= $form->field($model, 'nacionalidade')->textInput(['maxlength' => true]) ?>

    <!-- Data Nascimento com Calendario (DATE PICKER) -->
    <?= $form->field($model, 'data_nascimento')->input('date') ?>

    <!-- Preferências -->
    <?= $form->field($model, 'preferencias')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

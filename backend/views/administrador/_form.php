<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use common\models\Administrador;

/* @var $this yii\web\View */
/* @var $model common\models\Administrador */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="administrador-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- ID User em readonly -->
    <?= $form->field($model, 'id_utilizador')->textInput(['readonly' => true]) ?>

    <!-- Username, Nome, Email que vem de User (readonly) -->
    <?php if ($model->user): ?>
        <div class="form-group">
            <label><strong>Username</strong></label>
            <input class="form-control" value="<?= $model->user->username ?>" readonly>
        </div>

        <div class="form-group">
            <label><strong>Nome</strong></label>
            <input class="form-control" value="<?= $model->user->nome ?>" readonly>
        </div>

        <div class="form-group">
            <label><strong>Email</strong></label>
            <input class="form-control" value="<?= $model->user->email ?>" readonly>
        </div>
    <?php endif; ?>

    <!-- Nivel de Acesso, um dropdown -->
    <?= $form->field($model, 'nivel_acesso')->dropDownList(Administrador::optsNiveisAcesso(),['prompt' => 'Selecione o nível de acesso']) ?>

    <!-- Responsavel pela Area, outro dropdown -->
    <?= $form->field($model, 'responsavel_area')->dropDownList(Administrador::optsResponsavelArea(),['prompt' => 'Selecione a área']) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

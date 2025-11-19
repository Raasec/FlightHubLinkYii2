<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\FuncionarioSearch */
/* @var $form yii\widgets\ActiveForm */

/** @var \common\models\User $user */  //buscar o User para conseguir identificar no tipo
$user = Yii::$app->user->identity;

// funçao para verificar se o utilizador atual é administrador via RBAC
$isAdmin = Yii::$app->user->can('administrador');


?>

<div class="row mt-2">
    <div class="col-md-12">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php if ($isAdmin): ?>

        <?= $form->field($model, 'id_funcionario') ?>

        <?= $form->field($model, 'id_utilizador') ?>

        <!-- username e email do User -->
        <?= $form->field($model, 'username')->textInput() ?>

        <?= $form->field($model, 'email')->textInput() ?>

        <!-- resto do atributos do funcionario -->
        <?= $form->field($model, 'departamento') ?>

        <?= $form->field($model, 'cargo') ?>

        <?= $form->field($model, 'turno') ?>

        <?php endif ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    </div>
    <!--.col-md-12-->
</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AdministradorSearch */
/* @var $form yii\widgets\ActiveForm */

/** @var \common\models\User $user */  //buscar o User para conseguir identificar no tipo
$user = Yii::$app->user->identity;
?>

<div class="row mt-2">
    <div class="col-md-12">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

        <!-- atributos do Administrador -->
        <?= $form->field($model, 'id_admin') ?>

        <?= $form->field($model, 'id_utilizador') ?>

        <!-- username,  e email do User -->
        <?= $form->field($model, 'username') ?>

        <?= $form->field($model, 'email') ?>

        <!-- resto do atributos do Administrador -->
        <?= $form->field($model, 'nivel_acesso') ?>

        <?= $form->field($model, 'responsavel_area') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    </div>
    <!--.col-md-12-->
</div>

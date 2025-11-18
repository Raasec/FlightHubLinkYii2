<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\UserSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'nome') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'tipo_utilizador')->dropDownList([
        '' => '--- Todos ---',
        'passageiro' => 'Passageiro',
        'funcionario' => 'Funcionário',
        'administrador' => 'Administrador',
    ]) ?>

    <?= $form->field($model, 'status')->dropDownList([
        ''  => '--- Todos ---',
        10  => 'Ativo',
        9   => 'Inativo',
        0   => 'Apagado',
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

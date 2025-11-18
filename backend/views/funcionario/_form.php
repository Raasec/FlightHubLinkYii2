<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use common\models\Funcionario;

/* @var $this yii\web\View */
/* @var $model common\models\Funcionario */
/* @var $form yii\bootstrap4\ActiveForm */

$user = $model->user; // relaçao User para dados 
?>

<div class="funcionario-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- FAzer que o ID do utilizador seja só read only -->
    <?= $form->field($model, 'id_utilizador')->textInput(['readonly' => true ]) ?>

    <!-- Mostra NOME do User, sendo este nao editavel -->
    <?= $form->field($model, 'nome')
        ->textInput(['readonly' => true, 'value' => $user->nome ?? '(sem nome)'])
        ->label('Nome do Utilizador'); ?>

    <!-- Mostra EMAIL do User, sendo este nao editavel mate -->
    <?= $form->field($model, 'email')
        ->textInput(['readonly' => true, 'value' => $user->email ?? '(sem email)'])
        ->label('Email'); ?>

    <!-- Departamentos -->
    <?= $form->field($model, 'departamento')->dropDownList(
        Funcionario::optsDepartamento(),
        ['prompt' => 'Selecione um departamento']
        ) 
    ?>

    <!-- Cargo -->
    <?= $form->field($model, 'cargo')->dropDownList(
        Funcionario::optsCargo(),
        ['prompt' => 'Selecione o cargo']
        )
    ?>

    <!-- Turno -->
    <?= $form->field($model, 'turno')->dropDownList( Funcionario::optsTurno(), ['prompt' => '']) ?>

    <!-- Data de contratacao - read only too :) *-* -->
    <?= $form->field($model, 'data_contratacao')->textInput(['readonly'=> true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

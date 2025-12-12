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
    <div class="form-group">
        <label><strong>Username</strong></label>
        <input class="form-control" value="<?= $user->username ?>" readonly>
    </div>

    <!-- Mostra EMAIL do User, sendo este nao editavel mate -->
    <div class="form-group">
        <label><strong>Email</strong></label>
        <input class="form-control" value="<?= $user->email ?>" readonly>
    </div>

    <!-- Departamentos -->
    <?= $form->field($model, 'department')->dropDownList(
        Funcionario::optsDepartamento(),
        ['prompt' => 'Choose a Department']
        ) 
    ?>

    <!-- Cargo -->
    <?= $form->field($model, 'job_position')->dropDownList(
        Funcionario::optsCargo(),
        ['prompt' => 'Choose a position']
        )
    ?>

    <!-- Turno -->
    <?= $form->field($model, 'shift')->dropDownList( Funcionario::shiftOptions(), ['prompt' => '']) ?>

    <!-- Data de contratacao - read only too :) *-* -->
    <?= $form->field($model, 'hire_date')->textInput(['readonly'=> true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

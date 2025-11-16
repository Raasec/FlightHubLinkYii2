<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Incidente */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="incidente-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_notificacao')->textInput() ?>

    <?= $form->field($model, 'id_funcionario')->textInput() ?>

    <?= $form->field($model, 'tipo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descricao')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'data_registo')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

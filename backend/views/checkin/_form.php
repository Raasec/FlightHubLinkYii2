<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Checkin */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="checkin-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_bilhete')->textInput() ?>

    <?= $form->field($model, 'id_funcionario')->textInput() ?>

    <?= $form->field($model, 'data_checkin')->textInput() ?>

    <?= $form->field($model, 'metodo')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

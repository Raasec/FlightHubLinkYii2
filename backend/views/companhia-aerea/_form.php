<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CompanhiaAerea */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="companhia-aerea-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'iata_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'country_origin')->textInput(['maxlength' => true]) ?>

    <!-- NEW: Image filename -->
    <?= $form->field($model, 'image')->textInput(['maxlength' => true])->label('Image Filename') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

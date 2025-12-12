<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Bilhete */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="bilhete-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_passageiro')->textInput() ?>

    <?= $form->field($model, 'id_voo')->textInput() ?>

    <?= $form->field($model, 'gate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'issue_date')->input('date') ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'travel_class')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'seat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

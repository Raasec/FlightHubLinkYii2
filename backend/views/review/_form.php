<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Review */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="review-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_passageiro')->textInput() ?>

    <?= $form->field($model, 'id_voo')->textInput() ?>

    <?= $form->field($model, 'rating')->input('number', ['min'=> 1, 'max' => 5]) ?>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'review_date')->input('date') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

        <div class="mt-3">
        <?= Html::a(
            '← Back to Incidents',
            ['index'],
            ['class' => 'btn btn-secondary']
        ) ?>
    </div>

</div>

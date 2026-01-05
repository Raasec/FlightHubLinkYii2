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

    <?= $form->field($model, 'iata_code')->textInput([
        'maxlength' => true,
        'style' => 'text-transform: uppercase;',
    ]) ?>

    <?= $form->field($model, 'country_origin')->textInput(['maxlength' => true]) ?>

    <!-- IMAGE (READ ONLY + PREVIEW) -->
    <div class="form-group">
        <label>Current Logo</label>
        <div class="mb-2">
            <?= Html::img(
                $model->imageUrl,
                [
                    'style' => 'max-width:180px; max-height:90px; object-fit:contain;',
                    'alt' => $model->name,
                ]
            ) ?>
        </div>

        <?= Html::activeTextInput(
            $model,
            'image',
            [
                'class' => 'form-control',
                'readonly' => true,
            ]
        ) ?>
        <small class="form-text text-muted">
            Logo filename is managed automatically by the system.
        </small>
    </div>

    <div class="form-group mt-3">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Cancel', ['index'], ['class' => 'btn btn-secondary ml-2']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Checkin */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $bilhetes array */
/* @var $funcionarios array */
?>

<div class="checkin-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- Ticket -->
    <?= $form->field($model, 'id_bilhete')->dropDownList(
        $bilhetes,
        ['prompt' => 'Select ticket']
    ) ?>

    <!-- Employee -->
    <?= $form->field($model, 'id_funcionario')->dropDownList(
        $funcionarios,
        ['prompt' => 'Select employee']
    ) ?>

    <!-- Check-in Date/Time (readonly, automático) -->
    <?= $form->field($model, 'checkin_datetime')->textInput([
        'readonly' => true,
        'value' => $model->checkin_datetime ?? date('Y-m-d H:i:s')
    ]) ?>

    <!-- Method -->
    <?= $form->field($model, 'method')->dropDownList(
        [
            'counter' => 'Counter',
            'online' => 'Online',
            'kiosk' => 'Self-service kiosk',
        ],
        ['prompt' => 'Select method']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Cancel', ['index'], ['class' => 'btn btn-secondary ml-2']) ?>
    </div>

    <?php ActiveForm::end(); ?>

        <div class="mt-3">
        <?= Html::a(
            '← Back to Checkin',
            ['index'],
            ['class' => 'btn btn-secondary']
        ) ?>
    </div>

</div>

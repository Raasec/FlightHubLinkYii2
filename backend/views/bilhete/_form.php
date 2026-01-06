<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Bilhete */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $passageiros array */
/* @var $voos array */
?>

<?php $form = ActiveForm::begin(); ?>

    <!-- Passageiro -->
    <?= $form->field($model, 'id_passageiro')->dropDownList(
        $passageiros,
        ['prompt' => 'Select passenger']
    ) ?>

    <!-- Voo -->
    <?= $form->field($model, 'id_voo')->dropDownList(
        $voos,
        ['prompt' => 'Select flight']
    ) ?>

    <!-- Gate -->
    <?= $form->field($model, 'gate')->dropDownList(
        [
            'A' => 'A',
            'B' => 'B',
            'C' => 'C',
            'D' => 'D',
        ],
        ['prompt' => 'Select gate']
    ) ?>

    <!-- Issue Date -->
    <?= $form->field($model, 'issue_date')->input('date') ?>

    <!-- Price -->
    <?= $form->field($model, 'price')->textInput([
        'type' => 'number',
        'step' => '0.01'
    ]) ?>

    <!-- Travel Class -->
    <?= $form->field($model, 'travel_class')->dropDownList(
        [
            'Economy' => 'Economy',
            'Business' => 'Business',
            'First' => 'First Class',
        ],
        ['prompt' => 'Select class']
    ) ?>

    <!-- Seat -->
    <?= $form->field($model, 'seat')->textInput(['maxlength' => true]) ?>

    <!-- Status -->
    <?= $form->field($model, 'status')->dropDownList(
        [
            'issued' => 'Issued',
            'checked_in' => 'Checked-in',
            'cancelled' => 'Cancelled',
        ],
        ['prompt' => 'Select status']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Cancel', ['index'], ['class' => 'btn btn-secondary ml-2']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <div class="mt-3">
        <?= Html::a(
            '← Back to Tickets',
            ['index'],
            ['class' => 'btn btn-secondary']
        ) ?>
    </div>

</div>

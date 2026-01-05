<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Incidente */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="incidente-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_funcionario')->dropDownList(
        \yii\helpers\ArrayHelper::map(\common\models\Funcionario::find()->all(), 'id_funcionario', 'nome'),
        ['prompt' => 'Select Responsible Employee (Optional)']
    ) ?>

    <?= $form->field($model, 'type')->dropDownList([
        'Security' => 'Security',
        'Maintenance' => 'Maintenance',
        'Staff' => 'Staff',
        'Weather' => 'Weather',
        'Other' => 'Other',
    ], ['prompt' => 'Select Type']) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
    
    <?= $form->field($model, 'created_at')->textInput(['type' => 'datetime-local', 'value' => $model->isNewRecord ? date('Y-m-d\TH:i') : date('Y-m-d\TH:i', strtotime($model->created_at))]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

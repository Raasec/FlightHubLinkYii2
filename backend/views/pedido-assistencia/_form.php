<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\PedidoAssistencia $model */
/** @var yii\widgets\ActiveForm $form */

$isNew = $model->isNewRecord;
?>

<div class="pedido-assistencia-form card shadow-sm p-4">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'id_passageiro')->textInput(['readonly' => !$isNew]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'type')->textInput(['maxlength' => true, 'readonly' => !$isNew]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'request_date')->textInput(['readonly' => !$isNew, 'value' => $isNew ? date('Y-m-d H:i:s') : $model->request_date]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'status')->dropDownList([
                'open' => 'Open',
                'in_progress' => 'In Progress',
                'resolved' => 'Resolved',
                'closed' => 'Closed',
            ], ['prompt' => 'Select Status']) ?>
        </div>
    </div>

    <?= $form->field($model, 'description')->textarea(['rows' => 4, 'readonly' => !$isNew]) ?>

    <hr>
    
    <div class="bg-light p-3 rounded">
        <h5>Employee Response</h5>
        <?= $form->field($model, 'response')->textarea(['rows' => 6, 'placeholder' => 'Write your response here...']) ?>
        
        <?php if (!$isNew): ?>
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'id_funcionario_resolve')->textInput(['readonly' => true, 'placeholder' => 'Automatically set on Save']) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'resolution_date')->textInput(['readonly' => true, 'placeholder' => 'Automatically set on Save']) ?>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <div class="form-group mt-3">
        <?= Html::submitButton($isNew ? 'Create Ticket' : 'Update & Respond', ['class' => $isNew ? 'btn btn-success px-4' : 'btn btn-primary px-4']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <div class="mt-3">
        <?= Html::a(
            '← Back to Assistance-Requests',
            ['index'],
            ['class' => 'btn btn-secondary']
        ) ?>
    </div>

</div>

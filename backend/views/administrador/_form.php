<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use common\models\Administrador;

/* @var $this yii\web\View */
/* @var $model common\models\Administrador */
/* @var $form yii\bootstrap4\ActiveForm */


$user = $model->user; // relação User

?>

<div class="administrador-form">

    <?php $form = ActiveForm::begin(); ?>



    <!-- ID User em readonly -->
    <?= $form->field($model, 'id_utilizador')->textInput(['readonly' => true]) ?>

    <!-- Username, Nome, Email que vem de User (readonly) -->
    <?php if ($model->user): ?>
        <div class="form-group">
            <label><strong>Username</strong></label>
            <input class="form-control" readonly value="<?= $user->username ?>" >
        </div>

        <div class="form-group">
            <label><strong>Email</strong></label>
            <input class="form-control" value="<?= $user->email ?>" readonly>
        </div>
    <?php endif; ?>

    <!-- Nivel de Acesso, um dropdown -->
    <?= $form->field($model, 'access_level')->dropDownList(Administrador::optsNiveisAcesso(),['prompt' => 'Select the Access level']) ?>

    <!-- Responsavel pela Area, outro dropdown -->
    <?= $form->field($model, 'area_responsible')->dropDownList(Administrador::optsResponsavelArea(),['prompt' => 'Select the area for the admin']) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <div class="mt-3">
        <?= Html::a(
            '← Back to Administrators',
            ['index'],
            ['class' => 'btn btn-secondary']
        ) ?>
    </div>

</div>

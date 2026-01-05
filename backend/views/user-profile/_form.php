<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\UserProfileAsset;

UserProfileAsset::register($this);


/** @var yii\web\View $this */
/** @var common\models\UserProfile $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-profile-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="mt-3">
        <?= Html::a(
            '← Back to User Profiles',
            ['index'],
            ['class' => 'btn btn-secondary']
        ) ?>
    </div>

    <hr>

    <!-- id invisivel, nao é necessario -->
    <?= $form->field($model, 'user_id')->hiddenInput(['readonly' => true])-> label (false) ?>

    <!-- img -->
    <?= $form->field($model, 'image')->hiddenInput()->label(false) ?>

    <div class="profile-image-selector" tabindex="0">
        <?php foreach (\common\models\UserProfile::profileImages() as $i => $img): ?>
            <label class="profile-avatar">
                <input type="radio"
                    name="UserProfile[image]"
                    value="<?= $img ?>"
                    <?= $model->image === $img ? 'checked' : '' ?>
                    data-index="<?= $i ?>"
                    hidden>

                <img src="<?= Yii::getAlias('@web/uploads/profile-img/' . $img) ?>"
                    class="avatar-img">
            </label>
        <?php endforeach; ?>
    </div>


    <?= $form->field($model, 'full_name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <label class="control-label">Email</label>
        <input type="email"
            class="form-control"
            value="<?= $model->user ? Html::encode($model->user->email) : '' ?>"
            readonly>
    </div>


    <?= $form->field($model, 'gender')->dropDownList([ 'male' => 'Male', 'female' => 'Female', 'other' => 'Other', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'date_of_birth')->input('date') ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => 9, 'placeholder' => '123456789']) ?>

    <?= $form->field($model, 'nif')->textInput(['maxlength' => 9]) ?>

    <?= $form->field($model, 'nationality')->dropDownList(
        \common\models\UserProfile::optsNationality(),
        ['prompt' => '']
    ) ?>

    <?= $form->field($model, 'country')->dropDownList(
        \common\models\UserProfile::optsCountry(),
        ['prompt' => '']
    ) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'postal_code')->textInput(['maxlength' => true, 'placeholder' => '0000-000']) ?>

    <!-- Role -->
    <?= $form->field($model, 'role_type')->hiddenInput()->label(false) ?>
    <!-- role em texto readonly -->
    <div class="form-group">
        <label class="control-label">Role</label>
        <input type="text"
            class="form-control"
            value="<?= ucfirst($model->role_type) ?>"
            readonly>
    </div>

    
    
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>


</div>

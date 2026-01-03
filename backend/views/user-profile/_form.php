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

    <?= $form->field($model, 'gender')->dropDownList([ 'male' => 'Male', 'female' => 'Female', 'other' => 'Other', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'date_of_birth')->input('date') ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => 20, 'placeholder' => '+351 ...']) ?>

    <?= $form->field($model, 'nif')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nationality')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'country')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'postal_code')->textInput(['maxlength' => true]) ?>

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

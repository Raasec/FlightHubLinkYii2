<?php

/** @var yii\web\View $this */
/** @var common\models\UserProfile $profile */

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use frontend\assets\UserProfileAsset;

UserProfileAsset::register($this);

$this->title = 'Update Profile';
?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                <div class="card-header border-0 py-4" style="background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);">
                    <h3 class="text-white fw-bold mb-0 text-center">Update Passenger Profile</h3>
                </div>
                <div class="card-body p-4 p-md-5 bg-white">
                    <?php $form = ActiveForm::begin([
                        'id' => 'profile-update-form',
                        'options' => ['class' => 'needs-validation'] 
                    ]); ?>

                    <!-- Profile image (hidden field) -->
                    <?= $form->field($profile, 'image')->hiddenInput()->label(false) ?>

                    <!-- Profile image selector -->
                    <div class="mb-5 text-center">
                        <label class="form-label fw-bold text-dark d-block mb-3">
                            Profile Picture
                        </label>

                        <div class="profile-image-selector d-flex justify-content-center flex-wrap gap-3">
                            <?php foreach (\common\models\UserProfile::profileImages() as $img): ?>
                                <label class="profile-avatar">
                                    <input type="radio"
                                        name="UserProfile[image]"
                                        value="<?= $img ?>"
                                        <?= $profile->image === $img ? 'checked' : '' ?>
                                        hidden>

                                    <img
                                        src="<?= Yii::getAlias('@web/uploads/profile-img/' . $img) ?>"
                                        class="rounded-circle shadow-sm avatar-img"
                                        style="width: 90px; height: 90px; object-fit: cover; cursor: pointer;"
                                    >
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark">Full Name</label>
                        <?= $form->field($profile, 'full_name')->textInput([
                            'placeholder' => 'Ex: John Doe',
                            'class' => 'form-control rounded-pill px-4 shadow-sm',
                            'maxlength' => 255
                        ])->label(false) ?>
                        <small class="text-muted">As it should appear on your boarding pass.</small>
                    </div>

                    <hr class="my-4 text-light">

                    <div class="row g-3">
                        <!-- Secção de Info Pessoal -->
                        <div class="col-md-4">
                            <?= $form->field($profile, 'gender')->dropDownList($profile::optsGender(), [
                                'prompt' => '-- Gender --',
                                'class' => 'form-select rounded-pill px-4 border-primary-subtle'
                            ]) ?>
                        </div>

                        <div class="col-md-4">
                            <?= $form->field($profile, 'date_of_birth')->textInput([
                                'type' => 'date', 
                                'class' => 'form-control rounded-pill px-4 border-primary-subtle'
                            ]) ?>
                        </div>

                        <div class="col-md-4">
                             <?= $form->field($profile, 'phone')->textInput([
                                'placeholder' => 'Ex: +351 912...',
                                'class' => 'form-control rounded-pill px-4',
                                'type' => 'tel',
                                'pattern' => '^\+?[0-9 ]+$'
                            ]) ?>
                        </div>

                        <div class="col-md-6 mt-4">
                            <?= $form->field($profile, 'nif')->textInput([
                                'placeholder' => '9 digits',
                                'class' => 'form-control rounded-pill px-4 bg-light border-0',
                                'pattern' => '[0-9]{9}',
                                'maxlength' => 9
                            ]) ?>
                        </div>
                        <div class="col-md-6 mt-4 pt-md-2">
                            <label class="form-label fw-bold d-block mb-2">Origin & Nationality</label>
                            <div class="d-flex gap-2">
                                <?= $form->field($profile, 'nationality')->dropDownList($profile::optsNationality(), [
                                    'prompt' => 'Nationality',
                                    'class' => 'form-select rounded-pill'
                                ])->label(false) ?>
                                
                                <?= $form->field($profile, 'country')->dropDownList($profile::optsCountry(), [
                                    'prompt' => 'Country',
                                    'class' => 'form-select rounded-pill'
                                ])->label(false) ?>
                            </div>
                        </div>

                        <div class="col-md-12 mt-4">
                            <div class="card bg-light border-0 rounded-4">
                                <div class="card-body p-4">
                                    <h6 class="fw-bold text-primary mb-3"><i class="fas fa-map-marker-alt me-1"></i> Residential Address</h6>
                                    <div class="row g-3">
                                        <div class="col-md-8">
                                            <?= $form->field($profile, 'address')->textInput([
                                                'placeholder' => 'Street, number, floor...',
                                                'class' => 'form-control rounded-pill px-4'
                                            ])->label(false) ?>
                                        </div>
                                        <div class="col-md-4">
                                            <?= $form->field($profile, 'postal_code')->textInput([
                                                'placeholder' => '0000-000',
                                                'class' => 'form-control rounded-pill px-4',
                                                'pattern' => '[0-9]{4}-[0-9]{3}'
                                            ])->label(false) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5 d-flex flex-wrap gap-2 justify-content-center">
                        <?= Html::submitButton('<i class="fas fa-save me-2"></i> Save Changes', ['class' => 'btn btn-primary btn-lg rounded-pill px-5']) ?>
                        <?= Html::a('Cancel', ['profile'], ['class' => 'btn btn-link text-decoration-none text-muted']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>


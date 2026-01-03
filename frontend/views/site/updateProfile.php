<?php

/** @var yii\web\View $this */
/** @var common\models\UserProfile $profile */

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Update Profile';
?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                <div class="card-header border-0 py-4" style="background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);">
                    <h3 class="text-white fw-bold mb-0 text-center">Atualizar Perfil de Passageiro</h3>
                </div>
                <div class="card-body p-4 p-md-5 bg-white">
                    <?php $form = ActiveForm::begin([
                        'id' => 'profile-update-form',
                        'options' => ['class' => 'needs-validation'] 
                    ]); ?>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark">Nome Completo</label>
                        <?= $form->field($profile, 'full_name')->textInput([
                            'placeholder' => 'Ex: João Silva',
                            'class' => 'form-control rounded-pill px-4 shadow-sm',
                            'maxlength' => 255
                        ])->label(false) ?>
                        <small class="text-muted">Como deve aparecer nos seus bilhetes.</small>
                    </div>

                    <hr class="my-4 text-light">

                    <div class="row g-3">
                        <!-- Secção de Info Pessoal -->
                        <div class="col-md-4">
                            <?= $form->field($profile, 'gender')->dropDownList($profile::optsGender(), [
                                'prompt' => '-- Género --',
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
                                'placeholder' => '9 dígitos',
                                'class' => 'form-control rounded-pill px-4 bg-light border-0',
                                'pattern' => '[0-9]{9}',
                                'maxlength' => 9
                            ]) ?>
                        </div>
                        <div></div>
                        <div class="col-md-6 mt-4 pt-md-2">
                            <label class="form-label fw-bold d-block mb-2">Origem & Nacionalidade</label>
                            <div class="d-flex gap-2">
                                <?= $form->field($profile, 'nationality')->dropDownList($profile::optsNationality(), [
                                    'prompt' => 'Nacionalidade',
                                    'class' => 'form-select rounded-pill'
                                ])->label(false) ?>
                                
                                <?= $form->field($profile, 'country')->dropDownList($profile::optsCountry(), [
                                    'prompt' => 'País',
                                    'class' => 'form-select rounded-pill'
                                ])->label(false) ?>
                            </div>
                        </div>

                        <div class="col-md-12 mt-4">
                            <div class="card bg-light border-0 rounded-4">
                                <div class="card-body p-4">
                                    <h6 class="fw-bold text-primary mb-3"><i class="fas fa-map-marker-alt me-1"></i> Morada do Passageiro</h6>
                                    <div class="row g-3">
                                        <div class="col-md-8">
                                            <?= $form->field($profile, 'address')->textInput([
                                                'placeholder' => 'Rua, nº, andar...',
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
                        <?= Html::submitButton('<i class="fas fa-save me-2"></i> Guardar Alterações', ['class' => 'btn btn-primary btn-lg rounded-pill px-5']) ?>
                        <?= Html::a('Cancelar', ['profile'], ['class' => 'btn btn-link text-decoration-none text-muted']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>


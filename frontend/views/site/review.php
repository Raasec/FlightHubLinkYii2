<?php

// Formulario de reviews para os voos
// User so chega aqui se o canReviewFlight deixar (segurança)

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Review Flight ' . $voo->numero_voo;
?>

<div class="site-review-page py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                
                <div class="review-box shadow rounded-4 overflow-hidden border-0 bg-white">
                    <div class="p-4 bg-warning text-dark text-center">
                        <h3 class="fw-bold mb-1">How was your trip?</h3>
                        <p class="mb-0 small">Flight: <?= Html::encode($voo->numero_voo) ?> (<?= Html::encode($voo->origin) ?> -> <?= Html::encode($voo->destination) ?>)</p>
                    </div>

                    <div class="p-4 p-md-5">
                        <?php $form = ActiveForm::begin(['action' => ['site/create-review'], 'method' => 'post']); ?>

                        <!-- flight id is hidden -->
                        <?= $form->field($model, 'id_voo')->hiddenInput()->label(false) ?>

                        <div class="mb-4 text-center">
                            <label class="form-label d-block fw-bold mb-3">Give a rating (1 to 5 stars)</label>
                            
                            <div class="stars-group d-flex justify-content-center gap-2 fs-3 text-warning">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <div class="star-item">
                                        <input class="btn-check" type="radio" name="Review[rating]" id="rating-<?= $i ?>" value="<?= $i ?>" <?= $i === 5 ? 'checked' : '' ?>>
                                        <label class="btn btn-outline-warning border-0 rounded-circle" for="rating-<?= $i ?>">
                                            <i class="fas fa-star"></i>
                                        </label>
                                    </div>
                                <?php endfor; ?>
                            </div>
                        </div>

                        <div class="mb-4">
                            <?= $form->field($model, 'comment')->textarea([
                                'rows' => 5, 
                                'placeholder' => 'Write here what you thought about the flight, the gate, the staff, etc...',
                                'class' => 'form-control border-0 bg-light p-3'
                            ])->label('Your comment', ['class' => 'fw-bold']) ?>
                        </div>

                        <div class="d-grid mt-4">
                            <?= Html::submitButton('Submit Review', ['class' => 'btn btn-warning btn-lg rounded-pill shadow-sm fw-bold']) ?>
                            
                            <div class="text-center mt-3">
                                <?= Html::a('Back to Profile', ['profile'], ['class' => 'text-muted small text-decoration-none']) ?>
                            </div>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

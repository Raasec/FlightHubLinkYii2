<?php

/** @var yii\web\View $this */
/** @var string|null $error */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Check-in Online';
?>

<div class="container pb-5">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="booking-content checkin-tab border-0 p-0" style="min-height: auto;">
                <div class="checkin-container shadow-lg rounded-4 w-100 py-5 px-4 px-md-5">
                    <div class="mb-4">
                        <i class="fa fa-ticket-alt fa-3x text-primary mb-3"></i>
                        <h2 class="fw-bold">Ready for your flight?</h2>
                        <h6 class="text-muted">Enter your details to check in and access your boarding pass.</h6>
                    </div>
                    
                    <?php if (isset($error) && $error): ?>
                        <div class="alert alert-danger rounded-3 mb-4">
                            <i class="fa fa-exclamation-circle me-2"></i><?= Html::encode($error) ?>
                        </div>
                    <?php endif; ?>

                    <?= Html::beginForm(['site/checkin'], 'post', ['class' => 'text-start']) ?>
                        <div class="mb-4">
                            <label class="form-label fw-bold small text-muted text-uppercase mb-2">Ticket ID</label>
                            <div class="input-group border rounded-3 overflow-hidden shadow-sm">
                                <span class="input-group-text bg-light border-0 text-primary"><i class="fa fa-hashtag"></i></span>
                                <input type="text" name="reference" placeholder="Ex: 12345" class="form-control border-0 py-3" required>
                            </div>
                            <div class="form-text small">Your unique ticket reference number.</div>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold small text-muted text-uppercase mb-2">Passenger's Name</label>
                            <div class="input-group border rounded-3 overflow-hidden shadow-sm">
                                <span class="input-group-text bg-light border-0 text-primary"><i class="fa fa-user"></i></span>
                                <input type="text" name="name" placeholder="Full Name as in booking" class="form-control border-0 py-3" required>
                            </div>
                            <div class="form-text small">Use the name exactly as it appears on your booking.</div>
                        </div>
                        
                        <div class="d-grid mt-5">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill py-3 shadow">
                                <i class="fa fa-search me-2"></i>Find My Ticket
                            </button>
                        </div>
                    <?= Html::endForm() ?>
                </div>
            </div>
        </div>
    </div>
</div>

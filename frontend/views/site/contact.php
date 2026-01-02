<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\TicketForm $model */
/** @var \common\models\PedidoAssistencia[] $tickets */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Support & Contact';
?>
<div class="site-contact">
    <div class="row mb-5 text-center">
        <div class="col-12">
            <h1 class="display-5 fw-bold text-primary"><?= Html::encode($this->title) ?></h1>
            <p class="lead text-muted">How can we help you today? Submit a ticket or track your requests.</p>
        </div>
    </div>

    <div class="row g-4 d-flex align-items-stretch">
        <!-- New Ticket Form -->
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100">
                <div class="card-header bg-primary text-white py-3">
                    <h4 class="mb-0"><i class="fa fa-pencil-alt me-2"></i>New Support Ticket</h4>
                </div>
                <div class="card-body p-4">
                    <p class="text-muted mb-4 small">Got a problem or a question? Fill out the form below and our team will get back to you as soon as possible.</p>

                    <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                    <!-- nao parece uma maneira muito inteligente de se fazer mas tenho pouco tempo -->
                    <?= $form->field($model, 'type', [
                        'options' => ['class' => 'form-group mb-3'],
                        'labelOptions' => ['class' => 'form-label fw-bold']
                    ])->dropDownList([
                        'General Inquiry' => 'General Inquiry',
                        'Bug Report' => 'Bug Report',
                        'Feedback' => 'Feedback',
                        'Technical Support' => 'Technical Support',
                        'Billing' => 'Billing',
                    ], ['prompt' => 'Select a topic...', 'class' => 'form-select py-2'])->label('What is this regarding?') ?>

                    <?= $form->field($model, 'description', [
                        'options' => ['class' => 'form-group mb-3'],
                        'labelOptions' => ['class' => 'form-label fw-bold']
                    ])->textarea(['rows' => 5, 'placeholder' => 'Describe your issue in detail...', 'class' => 'form-control'])->label('Description') ?>

                    <div class="form-group mt-4 d-grid">
                        <?= Html::submitButton('Submit Ticket', ['class' => 'btn btn-primary btn-lg rounded-pill px-5', 'name' => 'contact-button']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>

        <!-- Ticket History -->
        <div class="col-lg-6 mb-4">
            <div class="h-100 d-flex flex-column">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-bold mb-0">My Tickets</h3>
                </div>

                <?php if (empty($tickets)): ?>
                    <div class="text-center py-5 bg-white rounded-4 shadow-sm border border-dashed border-2 flex-grow-1 d-flex flex-column justify-content-center mt-2">
                        <div class="display-1 text-light mb-3"><i class="fa fa-ticket-alt"></i></div>
                        <h5>No tickets found</h5>
                        <p class="text-muted">You haven't submitted any support requests yet.</p>
                    </div>
                <?php else: ?>
                    <div class="ticket-history flex-grow-1 overflow-auto pe-2" style="max-height: 800px;">
                        <?php foreach ($tickets as $ticket): ?>
                            <div class="card mb-3 border-0 shadow-sm rounded-4 hover-shadow transition">
                                <div class="card-body p-4">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <div>
                                            <span class="badge bg-light text-primary border border-primary-subtle mb-2"><?= Html::encode($ticket->type) ?></span>
                                            <h5 class="card-title fw-bold mb-0">Ticket #<?= $ticket->id_pedido ?></h5>
                                            <small class="text-muted"><i class="fa fa-calendar-alt me-1"></i> <?= Yii::$app->formatter->asDate($ticket->request_date, 'medium') ?></small>
                                        </div>
                                        <?php
                                        $statusClass = match($ticket->status) {
                                            'open' => 'bg-info',
                                            'resolved' => 'bg-success',
                                            'in_progress' => 'bg-warning text-dark',
                                            'closed' => 'bg-secondary',
                                            default => 'bg-light text-dark'
                                        };
                                        ?>
                                        <span class="badge <?= $statusClass ?> px-3 py-2 rounded-pill"><?= ucfirst(Html::encode($ticket->status)) ?></span>
                                    </div>
                                    
                                    <p class="card-text text-dark-emphasis mb-3"><?= nl2br(Html::encode($ticket->description)) ?></p>

                                    <?php if ($ticket->response): ?>
                                        <div class="bg-primary-subtle p-3 rounded-3 border-start border-primary border-4 mt-3">
                                            <div class="d-flex align-items-center mb-2">
                                                <i class="fa fa-reply text-primary me-2"></i>
                                                <strong class="text-primary small">Staff Response</strong>
                                                <small class="ms-auto text-muted" style="font-size: 0.75rem;"><?= Yii::$app->formatter->asDatetime($ticket->resolution_date, 'short') ?></small>
                                            </div>
                                            <p class="mb-0 small text-primary-emphasis"><?= nl2br(Html::encode($ticket->response)) ?></p>
                                        </div>
                                    <?php elseif ($ticket->status === 'open'): ?>
                                        <div class="mt-3 text-muted small">
                                            <i class="fa fa-clock me-1"></i> Waiting for staff response...
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

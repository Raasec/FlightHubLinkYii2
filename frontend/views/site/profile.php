<?php

/** @var yii\web\View $this */
/** @var common\models\UserProfile $profile */

use yii\helpers\Html;

$this->title = 'My Profile';
?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="profile-card shadow-lg border-0 rounded-4 overflow-hidden">
                <!-- Header Background -->
                <div class="profile-card-header text-center py-5 position-relative"
                    style="background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);">

                    <!-- Avatar -->
                    <div class="profile-avatar mx-auto mb-3">
                        <img src="<?= $profile->imageUrl ?>"
                            alt="Profile image"
                            class="rounded-circle shadow"
                            style="width: 120px; height: 120px; object-fit: cover; border: 4px solid white;">
                    </div>

                    <h2 class="text-white fw-bold mb-1"><?= Html::encode($profile->full_name) ?></h2>
                    <p class="text-white-50 mb-0"><?= Html::encode($profile->user->email) ?></p>

                    <span class="badge bg-light text-primary mt-3 px-3 py-2 rounded-pill shadow-sm">
                        <i class="fas fa-user-tag me-1"></i> <?= ucfirst($profile->role_type) ?>
                    </span>
                </div>

                <div class="p-4 p-md-5 bg-white">
                    <h4 class="fw-bold mb-4 text-dark border-bottom pb-2">Account Settings</h4>
                    
                    <!-- Grid de Informação Principal -->
                    <div class="row g-3 mb-4">
                        <div class="col-sm-6">
                            <div class="h-100 p-3 bg-light rounded-4 border border-white">
                                <label class="text-muted small fw-bold text-uppercase d-block mb-1">Gender</label>
                                <span class="fw-semibold text-dark fs-6"><?= $profile->gender ? ucfirst($profile->displayGender()) : '---' ?></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="h-100 p-3 bg-light rounded-4 border border-white">
                                <label class="text-muted small fw-bold text-uppercase d-block mb-1">Date of Birth</label>
                                <span class="fw-semibold text-dark fs-6"><?= $profile->date_of_birth ? Yii::$app->formatter->asDate($profile->date_of_birth) : '---' ?></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="h-100 p-3 bg-light rounded-4 border border-white">
                                <label class="text-muted small fw-bold text-uppercase d-block mb-1">Phone Number</label>
                                <span class="fw-semibold text-dark fs-6"><?= Html::encode($profile->phone ?: 'Not defined') ?></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="h-100 p-3 bg-light rounded-4 border border-white">
                                <label class="text-muted small fw-bold text-uppercase d-block mb-1">Tax ID (NIF)</label>
                                <span class="fw-semibold text-dark fs-6"><?= Html::encode($profile->nif ?: '---') ?></span>
                            </div>
                        </div>
                    </div>

                    <!-- Secção de Localização -->
                    <div class="p-3 bg-light rounded-4 mb-4 border border-white">
                        <div class="row align-items-center">
                            <div class="col-md-4 mb-3 mb-md-0">
                                <label class="text-muted small fw-bold text-uppercase d-block mb-1">Nationality</label>
                                <span class="fw-semibold text-dark"><?= Html::encode($profile->nationality ?: 'Other') ?></span>
                            </div>
                            <div class="col-md-8">
                                <label class="text-muted small fw-bold text-uppercase d-block mb-1">Residential Address</label>
                                <span class="fw-semibold text-dark">
                                    <?= Html::encode($profile->address ?: '---') ?> 
                                    <?= $profile->postal_code ? " <span class='text-muted mx-1'>|</span> " . Html::encode($profile->postal_code) : '' ?>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Botões principais -->
                    <div class="mt-5 d-flex gap-2">
                        <?= Html::a('<i class="fas fa-user-edit me-2"></i> Update Profile', ['site/update-profile'], ['class' => 'btn btn-primary btn-lg rounded-pill px-4 shadow-sm']) ?>
                        <?= Html::a('<i class="fas fa-home me-2"></i> Home', ['index'], ['class' => 'btn btn-outline-secondary btn-lg rounded-pill px-4']) ?>
                    </div>
                </div>
            </div>

            <!-- TABELA DE BILHETES -->
            <div class="card shadow-lg border-0 rounded-4 mt-5 mb-5 overflow-hidden">
                <div class="card-header bg-dark py-3 px-4 border-0">
                    <h5 class="mb-0 fw-bold d-flex align-items-center text-white">
                        My Flights & Tickets
                    </h5>
                </div>
                <div class="card-body p-0">
                    <?php if (empty($tickets)): ?>
                        <div class="p-5 text-center">
                            <p class="text-muted italic mb-0">You have no active bookings yet.</p>
                        </div>
                    <?php else: ?>
                        <div class="accordion accordion-flush" id="ticketsAccordion">
                            <?php foreach ($tickets as $k => $ticket): ?>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="h-<?= $ticket->id_bilhete ?>">
                                        <button class="accordion-button collapsed py-4 px-4" type="button" data-bs-toggle="collapse" data-bs-target="#c-<?= $ticket->id_bilhete ?>">
                                            <div class="d-flex flex-wrap justify-content-between align-items-center w-100">
                                                <div class="me-3">
                                                    <span class="text-muted small">ID: <?= $ticket->id_bilhete ?></span>
                                                    <div class="fw-bold text-dark fs-5">
                                                        <?= Html::encode($ticket->voo ? $ticket->voo->origin : '---') ?> 
                                                        <i class="fas fa-plane text-primary mx-2 small"></i> 
                                                        <?= Html::encode($ticket->voo ? $ticket->voo->destination : '---') ?>
                                                    </div>
                                                </div>
                                                <div class="mt-2 mt-sm-0">
                                                    <?php if ($ticket->checkin): ?>
                                                        <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3">
                                                            Check-in Completed
                                                        </span>
                                                    <?php else: ?>
                                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-3">
                                                            Pending
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </button>
                                    </h2>
                                    <div id="c-<?= $ticket->id_bilhete ?>" class="accordion-collapse collapse" data-bs-parent="#ticketsAccordion">
                                        <div class="accordion-body px-4 py-4 bg-light">
                                            <div class="row">
                                                <div class="col-6 col-sm-3 mb-3">
                                                    <small class="text-muted d-block mb-1">Boarding Gate</small>
                                                    <span class="fw-bold fs-6"><?= Html::encode($ticket->gate ?: 'N/A') ?></span>
                                                </div>
                                                <div class="col-6 col-sm-3 mb-3">
                                                    <small class="text-muted d-block mb-1">Travel Class</small>
                                                    <span class="fw-bold fs-6"><?= Html::encode($ticket->travel_class) ?></span>
                                                </div>
                                                <div class="col-6 col-sm-3 mb-3">
                                                    <small class="text-muted d-block mb-1">Seat Assignment</small>
                                                    <span class="fw-bold fs-6 text-uppercase"><?= Html::encode($ticket->seat) ?></span>
                                                </div>
                                                <div class="col-6 col-sm-3 mb-3">
                                                    <small class="text-muted d-block mb-1">Issued On</small>
                                                    <span class="fw-bold fs-6"><?= date('d/m/Y', strtotime($ticket->issue_date)) ?></span>
                                                </div>
                                            </div>
                                            <div class="border-top mt-3 pt-3 d-flex justify-content-end">
                                                <?php if ($ticket->checkin): ?>
                                                    <?= Html::a('View Boarding Pass', ['boarding-pass', 'id' => $ticket->id_bilhete], ['class' => 'btn btn-info btn-sm text-white px-3']) ?>
                                                <?php else: ?>
                                                    <?= Html::a('Proceed to Check-in', ['checkin'], ['class' => 'btn btn-primary btn-sm px-3']) ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

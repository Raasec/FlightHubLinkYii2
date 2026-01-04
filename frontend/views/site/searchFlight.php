<?php

/** @var yii\web\View $this */
/** @var common\models\Voo[] $flights */
/** @var string $origin */
/** @var string $destination */
/** @var string $date */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Flight Search Results';
?>

<div class="site-search-results">
    <!-- Hero Section -->
    <div class="container-fluid bg-primary py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-3 text-white animated slideInDown">Search Results</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="container pb-5">
        <!-- Condensed Search Form -->
        <div class="row justify-content-center mb-5" style="margin-top: -100px; position: relative; z-index: 10;">
            <div class="col-lg-12">
                <div class="bg-white shadow-lg p-4 rounded-4">
                    <form method="get" action="<?= Url::to(['site/search-flight']) ?>" class="row g-3 align-items-end">
                        <div class="col-md-3">
                            <label class="form-label fw-bold small text-muted">Origin</label>
                            <div class="input-group border rounded-3 overflow-hidden">
                                <span class="input-group-text bg-white border-0 text-primary"><i class="fa fa-map-marker-alt"></i></span>
                                <input type="text" name="origin" class="form-control border-0 py-2" placeholder="Origin" value="<?= Html::encode($origin) ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold small text-muted">Destination</label>
                            <div class="input-group border rounded-3 overflow-hidden">
                                <span class="input-group-text bg-white border-0 text-primary"><i class="fa fa-location-arrow"></i></span>
                                <input type="text" name="destination" class="form-control border-0 py-2" placeholder="Destination" value="<?= Html::encode($destination) ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold small text-muted">Travel Date</label>
                            <div class="input-group border rounded-3 overflow-hidden">
                                <span class="input-group-text bg-white border-0 text-primary"><i class="fa fa-calendar-alt"></i></span>
                                <input type="text" name="date" class="form-control border-0 py-2" placeholder="dd/mm/yyyy" value="<?= Html::encode($date) ?>">
                            </div>
                        </div>
                        <div class="col-md-3 d-grid">
                            <button type="submit" class="btn btn-primary btn-lg rounded-3 py-2">
                                <i class="fa fa-search me-2"></i>Update Search
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Results List -->
        <div class="row">
            <div class="col-12">
                <h4 class="mb-4 text-dark"><i class="fa fa-plane-departure text-primary me-2"></i>Available Flights</h4>
                
                <?php if (empty($flights)): ?>
                    <div class="text-center py-5 bg-white rounded-4 shadow-sm border border-dashed border-2">
                        <div class="display-1 text-light mb-3"><i class="fa fa-search"></i></div>
                        <h4 class="text-muted">No flights found</h4>
                        <p class="text-muted mb-4">We couldn't find any flights matching your criteria. Try adjusting your filters or destination.</p>
                        <a href="<?= Url::home() ?>" class="btn btn-outline-primary rounded-pill px-4">Back to Home</a>
                    </div>
                <?php else: ?>
                    <?php foreach ($flights as $flight): ?>
                        <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden hover-shadow transition">
                            <div class="card-body p-0">
                                <div class="row g-0 align-items-stretch">
                                    <!-- Airline Info -->
                                    <div class="col-md-2 bg-light d-flex flex-column align-items-center justify-content-center p-4 border-end">
                                        <img src="<?= $flight->companhia ? $flight->companhia->getImageUrl() : Url::to('@web/img/airlines/default.png') ?>" 
                                             alt="Airline Logo" 
                                             class="img-fluid mb-2" 
                                             style="max-height: 60px;">
                                        <h6 class="mb-0 text-center small fw-bold text-muted"><?= $flight->companhia ? Html::encode($flight->companhia->name) : 'Airline' ?></h6>
                                        <span class="badge bg-white text-dark border mt-2 small"><?= Html::encode($flight->numero_voo) ?></span>
                                    </div>

                                    <!-- Flight Times & Route -->
                                    <div class="col-md-7 p-4">
                                        <div class="d-flex justify-content-between align-items-center position-relative">
                                            <div class="text-center" style="flex: 1;">
                                                <h3 class="mb-0 fw-bold"><?= date('H:i', strtotime($flight->departure_date)) ?></h3>
                                                <div class="text-primary fw-bold"><?= Html::encode($flight->origin) ?></div>
                                                <small class="text-muted"><?= date('D, d M', strtotime($flight->departure_date)) ?></small>
                                            </div>

                                            <div class="text-center px-4" style="flex: 1;">
                                                <div class="small text-muted mb-1">Direct</div>
                                                <div class="flight-path-line position-relative mb-2">
                                                    <i class="fa fa-plane text-primary"></i>
                                                </div>
                                                <div class="small text-muted"><?= Html::encode($flight->tipo_voo === 'arrival' ? 'Arrival' : 'Departure') ?></div>
                                            </div>

                                            <div class="text-center" style="flex: 1;">
                                                <h3 class="mb-0 fw-bold"><?= $flight->arrival_date ? date('H:i', strtotime($flight->arrival_date)) : '--:--' ?></h3>
                                                <div class="text-primary fw-bold"><?= Html::encode($flight->destination) ?></div>
                                                <small class="text-muted"><?= $flight->arrival_date ? date('D, d M', strtotime($flight->arrival_date)) : '--' ?></small>
                                            </div>
                                        </div>

                                        <div class="mt-4 pt-3 border-top d-flex gap-4">
                                            <div class="small"><i class="fa fa-door-open text-muted me-2"></i><strong>Gate:</strong> <?= $flight->gate ?: 'TBA' ?></div>
                                            <div class="small"><i class="fa fa-info-circle text-muted me-2"></i><strong>Status:</strong> 
                                                <?php
                                                    $status = strtolower($flight->status);

                                                    switch ($status) {
                                                        case 'on time':
                                                        case 'on-time':
                                                            $statusClass = 'text-success';
                                                            break;

                                                        case 'delayed':
                                                            $statusClass = 'text-warning';
                                                            break;

                                                        case 'cancelled':
                                                            $statusClass = 'text-danger';
                                                            break;

                                                        default:
                                                            $statusClass = 'text-info';
                                                            break;
                                                    };
                                                ?>
                                                <span class="<?= $statusClass ?> fw-bold"><?= ucfirst(Html::encode($flight->status)) ?></span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Price & Action -->
                                    <div class="col-md-3 p-4 bg-primary-subtle d-flex flex-column justify-content-center align-items-center text-center">
                                        <div class="text-muted small mb-1">Price starting from</div>
                                        <h2 class="mb-3 text-primary fw-bold">300€</h2>
                                        <?= Html::beginForm(Url::to(['site/buy-ticket']), 'post', ['class' => 'w-100']) ?>
                                            <?= Html::hiddenInput('id_voo', $flight->id_voo) ?>
                                            <button type="submit" class="btn btn-primary rounded-pill px-4 w-100">
                                                <i class="fa fa-shopping-cart me-2"></i>Book Now
                                            </button>
                                        <?= Html::endForm() ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>


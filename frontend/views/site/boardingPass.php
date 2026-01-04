<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $bilhete common\models\Bilhete */

$this->title = 'Boarding Pass';
$voo = $bilhete->voo;
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            
            <div class="alert alert-success text-center mb-5 rounded-4 shadow-sm">
                <h4 class="mb-1"><i class="fa fa-check-circle"></i> Check-in Successful!</h4>
                <p class="mb-0">You are ready to fly. Please save or print your boarding pass.</p>
            </div>

            <!-- Boarding Pass Widget -->
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden" style="border: 2px dashed #dee2e6 !important;">
                <div class="card-body p-0">
                    <div class="row g-0">
                        <!-- Left Side -->
                        <div class="col-md-8 p-4 px-md-5 border-end">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="text-uppercase text-primary fw-bold mb-0">
                                    <?= Html::encode($voo?->companhia?->name ?? 'FlightHub') ?>
                                </h5>
                                <span class="badge bg-primary rounded-pill px-3"><?= Html::encode($bilhete->travel_class ?? 'ECONOMY') ?></span>
                            </div>
                            
                            <div class="row mb-5 align-items-center">
                                <div class="col-sm-5 text-center text-sm-start">
                                    <h2 class="display-4 fw-bold mb-0 text-primary"><?= $voo?->origin ? Html::encode(substr($voo->origin, 0, 3)) : '---' ?></h2>
                                    <small class="text-uppercase text-muted fw-bold"><?= Html::encode($voo?->origin ?? 'Unknown Origin') ?></small>
                                </div>
                                <div class="col-sm-2 text-center my-3 my-sm-0">
                                    <i class="fa fa-plane fa-2x text-light-emphasis"></i>
                                </div>
                                <div class="col-sm-5 text-center text-sm-end">
                                    <h2 class="display-4 fw-bold mb-0 text-primary"><?= $voo?->destination ? Html::encode(substr($voo->destination, 0, 3)) : '---' ?></h2>
                                    <small class="text-uppercase text-muted fw-bold"><?= Html::encode($voo?->destination ?? 'Unknown Destination') ?></small>
                                </div>
                            </div>

                            <div class="row g-4">
                                <div class="col-sm-4">
                                    <small class="text-muted text-uppercase d-block mb-1">Passenger</small>
                                    <h6 class="fw-bold mb-0 text-dark"><?= Html::encode($bilhete->passageiro?->userProfile?->full_name ?? 'Passenger') ?></h6>
                                </div>
                                <div class="col-sm-4">
                                    <small class="text-muted text-uppercase d-block mb-1">Flight</small>
                                    <h6 class="fw-bold mb-0 text-dark"><?= Html::encode($voo?->numero_voo ?? '#' . $bilhete->id_voo) ?></h6>
                                </div>
                                <div class="col-sm-4">
                                    <small class="text-muted text-uppercase d-block mb-1">Date</small>
                                    <h6 class="fw-bold mb-0 text-dark"><?= $voo?->departure_date ? Yii::$app->formatter->asDate($voo->departure_date) : 'TBA' ?></h6>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Right Side (Stub) -->
                        <div class="col-md-4 p-4 bg-light d-flex flex-column justify-content-between border-start border-dash">
                            <div>
                                <div class="row g-3">
                                    <div class="col-6">
                                        <small class="text-muted text-uppercase d-block mb-1">Gate</small>
                                        <h4 class="fw-bold mb-0 text-primary"><?= Html::encode($bilhete->gate ?: ($voo?->gate ?: '--')) ?></h4>
                                    </div>
                                    <div class="col-6 text-end">
                                        <small class="text-muted text-uppercase d-block mb-1">Seat</small>
                                        <h4 class="fw-bold mb-0 text-primary"><?= Html::encode($bilhete->seat ?? 'ANY') ?></h4>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="text-center mt-auto pt-4">
                                <!-- Boarding Group / Time Info -->
                                <div class="mb-3">
                                    <small class="text-muted text-uppercase d-block mb-1">Boarding Time</small>
                                    <h5 class="fw-bold mb-0"><?= $voo?->departure_date ? date('H:i', strtotime($voo->departure_date . ' - 45 minutes')) : '--:--' ?></h5>
                                </div>
                                <!-- barcode -->
                                <div class="barcode-container mb-2">
                                    <div style="background: #222; height: 35px; width: 100%; border-radius: 4px; border-left: 10px solid #fff; border-right: 25px solid #fff;"></div>
                                </div>
                                <small class="text-muted fw-bold">#<?= str_pad($bilhete->id_bilhete, 8, '0', STR_PAD_LEFT) ?></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5 d-flex justify-content-center gap-3 no-print">
                <button onclick="window.print()" class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm">
                    <i class="fa fa-print me-2"></i>Print Boarding Pass
                </button>
                <a href="<?= Url::home() ?>" class="btn btn-outline-secondary btn-lg rounded-pill px-5 shadow-sm">
                    <i class="fa fa-home me-2"></i>Home
                </a>
            </div>

        </div>
    </div>
</div>

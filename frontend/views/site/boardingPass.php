<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $bilhete common\models\Bilhete */

$this->title = 'Boarding Pass';
?>

<head>
    <meta charset="utf-8">
    <title>FlightHubLink</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
</head>

    
<div class="container-fluid page-header">
    <div class="container">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 200px">
            <h3 class="display-4 text-white text-uppercase">Boarding Pass</h3>
        </div>
    </div>
</div>

<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                
                <div class="alert alert-success text-center mb-5">
                    <h4><i class="fa fa-check-circle"></i> Check-in Successful!</h4>
                    <p>You are ready to fly. Please save or print your boarding pass.</p>
                </div>

                <!-- Boarding Pass Widget -->
                <div class="card shadow-lg" style="border: 2px dashed #ccc;">
                    <div class="card-body">
                        <div class="row">
                            <!-- Left Side -->
                            <div class="col-md-8 border-right">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h5 class="text-uppercase text-primary font-weight-bold">
                                        <?= Html::encode($bilhete->voo->companhia->nome ?? 'FlightHub') ?>
                                    </h5>
                                    <span class="badge badge-primary">ECONOMY</span>
                                </div>
                                
                                <div class="row mb-4">
                                    <div class="col-sm-5">
                                        <h2 class="display-4 mb-0"><?= Html::encode(substr($bilhete->voo->origin, 0, 3)) ?></h2>
                                        <small class="text-uppercase"><?= Html::encode($bilhete->voo->origin) ?></small>
                                    </div>
                                    <div class="col-sm-2 text-center align-self-center">
                                        <i class="fa fa-plane fa-2x text-muted"></i>
                                    </div>
                                    <div class="col-sm-5 text-right">
                                        <h2 class="display-4 mb-0"><?= Html::encode(substr($bilhete->voo->destination, 0, 3)) ?></h2>
                                        <small class="text-uppercase"><?= Html::encode($bilhete->voo->destination) ?></small>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4">
                                        <small class="text-muted text-uppercase">Passenger</small>
                                        <h6 class="font-weight-bold"><?= Html::encode($bilhete->passageiro->userProfile->full_name) ?></h6>
                                    </div>
                                    <div class="col-sm-4">
                                        <small class="text-muted text-uppercase">Flight</small>
                                        <h6 class="font-weight-bold"><?= Html::encode($bilhete->id_voo) ?></h6>
                                    </div>
                                    <div class="col-sm-4">
                                        <small class="text-muted text-uppercase">Date</small>
                                        <h6 class="font-weight-bold"><?= Yii::$app->formatter->asDate($bilhete->voo->departure_date) ?></h6>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Right Side (Stub) -->
                            <div class="col-md-4 d-flex flex-column justify-content-between">
                                <div>
                                    <div class="row">
                                        <div class="col-6">
                                            <small class="text-muted text-uppercase">Gate</small>
                                            <h4 class="font-weight-bold"><?= $bilhete->gate ? Html::encode($bilhete->gate) : '--' ?></h4>
                                        </div>
                                        <div class="col-6 text-right">
                                            <small class="text-muted text-uppercase">Seat</small>
                                            <h4 class="font-weight-bold"><?= $bilhete->seat ? Html::encode($bilhete->seat) : 'ANY' ?></h4>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="text-center mt-4">
                                    <!-- Fake Barcode -->
                                    <div style="background: repeating-linear-gradient(90deg, #333 0, #333 1%, transparent 1%, transparent 2%); height: 50px; width: 100%;"></div>
                                    <small><?= $bilhete->id_bilhete ?></small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-5">
                    <button onclick="window.print()" class="btn btn-primary btn-lg"><i class="fa fa-print"></i> Print Boarding Pass</button>
                    <a href="<?= \yii\helpers\Url::to(['site/index']) ?>" class="btn btn-link">Back to Home</a>
                </div>

            </div>
        </div>
    </div>
</div>

<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $bilhete common\models\Bilhete */
/* @var $passengerName string */

$this->title = 'Confirm Check-in';
?>

<head>
    <meta charset="utf-8">
    <title>FlightHubLink</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
</head>

<div class="container-fluid page-header">
    <div class="container">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 200px">
            <h3 class="display-4 text-white text-uppercase">Check-in</h3>
        </div>
    </div>
</div>

<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="text-white mb-0">Confirm Your Flight</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h5>Passenger</h5>
                                <p class="lead"><?= Html::encode($passengerName) ?></p>
                            </div>
                            <div class="col-md-6 text-right">
                                <h5>Ticket #</h5>
                                <p class="lead"><?= $bilhete->id_bilhete ?></p>
                            </div>
                        </div>
                        
                        <div class="flight-details border-top pt-4">
                            <div class="row align-items-center">
                                <div class="col-md-5 text-center">
                                    <h3><?= Html::encode($bilhete->voo->origin) ?></h3>
                                    <small>Origin</small>
                                </div>
                                <div class="col-md-2 text-center text-primary">
                                    <i class="fa fa-plane fa-2x"></i>
                                </div>
                                <div class="col-md-5 text-center">
                                    <h3><?= Html::encode($bilhete->voo->destination) ?></h3>
                                    <small>Destination</small>
                                </div>
                            </div>
                            
                            <div class="row mt-4 text-center">
                                <div class="col-md-4">
                                    <strong>Flight No.</strong><br>
                                    <?= Html::encode($bilhete->voo->companhia->nome ?? 'FLIGHT') ?> 
                                    (<?= Html::encode($bilhete->voo->id_voo) ?>)
                                </div>
                                <div class="col-md-4">
                                    <strong>Date</strong><br>
                                    <?= Yii::$app->formatter->asDate($bilhete->voo->departure_date) // Using departure_date ?>
                                </div>
                                <div class="col-md-4">
                                    <strong>Seat</strong><br>
                                    <?= $bilhete->seat ? Html::encode($bilhete->seat) : '<span class="text-muted">Assigned at Gate</span>' ?>
                                </div>
                            </div>
                        </div>

                        <div class="mt-5 text-center">
                            <?= Html::beginForm(['site/confirm-checkin'], 'post') ?>
                                <?= Html::hiddenInput('id_bilhete', $bilhete->id_bilhete) ?>
                                <button type="submit" class="btn btn-primary btn-lg px-5">Confirm Check-in</button>
                                <a href="<?= \yii\helpers\Url::to(['site/checkin']) ?>" class="btn btn-outline-secondary btn-lg px-5 ml-2">Cancel</a>
                            <?= Html::endForm() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

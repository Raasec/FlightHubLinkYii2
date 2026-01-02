<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $bilhete common\models\Bilhete */
/* @var $passengerName string */

$this->title = 'Confirm Check-in';
?>


<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-primary py-3">
                    <h4 class="text-white mb-0 text-center fw-bold">Confirm Your Flight</h4>
                </div>
                <div class="card-body p-4 p-md-5">
                    <div class="row mb-5 text-center text-md-start">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <span class="text-muted small text-uppercase fw-bold d-block mb-1">Passenger</span>
                            <h5 class="fw-bold mb-0"><?= Html::encode($passengerName) ?></h5>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <span class="text-muted small text-uppercase fw-bold d-block mb-1">Ticket #</span>
                            <h5 class="fw-bold mb-0"><?= $bilhete->id_bilhete ?></h5>
                        </div>
                    </div>
                    
                    <div class="flight-details border-top border-bottom py-5 my-2">
                        <div class="row align-items-center g-4">
                            <div class="col-md-5 text-center">
                                <h2 class="fw-bold mb-0 text-primary display-6"><?= Html::encode($bilhete->voo?->origin ?? '---') ?></h2>
                                <span class="text-muted small text-uppercase fw-bold">Origin</span>
                            </div>
                            <div class="col-md-2 text-center py-3 py-md-0">
                                <div class="position-relative d-flex align-items-center justify-content-center">
                                    <div style="height: 2px; width: 100%; position: absolute; top: 50%; left: 0; background: #dee2e6; z-index: 1;"></div>
                                    <i class="fa fa-plane fa-2x text-primary position-relative" style="background: white; padding: 0 15px; z-index: 2;"></i>
                                </div>
                            </div>
                            <div class="col-md-5 text-center">
                                <h2 class="fw-bold mb-0 text-primary display-6"><?= Html::encode($bilhete->voo?->destination ?? '---') ?></h2>
                                <span class="text-muted small text-uppercase fw-bold">Destination</span>
                            </div>
                        </div>
                            
                            <div class="row mt-4 text-center">
                            <div class="col-md-4">
                                <strong class="text-muted small text-uppercase">Flight No.</strong><br>
                                <span class="fw-bold"><?= Html::encode($bilhete->voo?->companhia?->name ?? 'FLIGHT') ?> 
                                (<?= Html::encode($bilhete->voo?->numero_voo ?? '#' . $bilhete->id_voo) ?>)</span>
                            </div>
                            <div class="col-md-4">
                                <strong class="text-muted small text-uppercase">Date</strong><br>
                                <span class="fw-bold"><?= $bilhete->voo?->departure_date ? Yii::$app->formatter->asDate($bilhete->voo->departure_date) : 'TBA' ?></span>
                            </div>
                            <div class="col-md-4">
                                <strong class="text-muted small text-uppercase">Seat</strong><br>
                                <span class="fw-bold text-primary"><?= $bilhete->seat ? Html::encode($bilhete->seat) : '<span class="text-muted">Assigned at Gate</span>' ?></span>
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

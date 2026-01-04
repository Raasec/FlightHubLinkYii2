<?php
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var common\models\Voo[] $voos */
/** @var common\models\CompanhiaAerea[] $companhias */

$this->title = 'Purchase Tickets';
?>
    
<div class="site-ticket-purchase py-5">
    <div class="container">
        <!-- Header -->
        <div class="row mb-5">
            <div class="col-12 d-flex align-items-center">
                <a href="<?= Url::to(['site/index']) ?>" class="btn btn-link text-decoration-none ps-0">
                    <i class="fa fa-arrow-left me-2"></i>Back to Home
                </a>
                <h2 class="fw-bold mb-0 mx-auto">Available Flights</h2>
            </div>
        </div>

        <div class="row">
            <!-- Sidebar Filters -->
            <aside class="col-lg-3 mb-4">
                <div class="bg-white shadow-sm p-4 rounded-4 sticky-top" style="top: 100px;">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-bold mb-0">Filters</h5>
                        <a href="<?= Url::to(['site/ticket-purchase']) ?>" class="text-primary small text-decoration-none">
                            Clear all
                        </a>
                    </div>

                    <form method="get" class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-bold small text-muted text-uppercase">Origin</label>
                            <input type="text" name="origin" class="form-control rounded-3 border-light bg-light" 
                                   placeholder="City or Airport" value="<?= Html::encode(Yii::$app->request->get('origin')) ?>">
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold small text-muted text-uppercase">Destination</label>
                            <input type="text" name="destination" class="form-control rounded-3 border-light bg-light" 
                                   placeholder="City or Airport" value="<?= Html::encode(Yii::$app->request->get('destination')) ?>">
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold small text-muted text-uppercase">Airline</label>
                            <select name="id_companhia" class="form-select rounded-3 border-light bg-light">
                                <option value="">All Airlines</option>
                                <?php foreach ($companhias as $c): ?>
                                    <option value="<?= $c->id_companhia ?>"
                                        <?= Yii::$app->request->get('id_companhia') == $c->id_companhia ? 'selected' : '' ?>>
                                        <?= Html::encode($c->name) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold small text-muted text-uppercase">Flight Type</label>
                            <select name="tipo_voo" class="form-select rounded-3 border-light bg-light">
                                <option value="">All Types</option>
                                <option value="departure" <?= Yii::$app->request->get('tipo_voo') === 'departure' ? 'selected' : '' ?>>Departure</option>
                                <option value="arrival" <?= Yii::$app->request->get('tipo_voo') === 'arrival' ? 'selected' : '' ?>>Arrival</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold small text-muted text-uppercase">Date</label>
                            <input type="date" name="departure_date" class="form-control rounded-3 border-light bg-light" 
                                   value="<?= Html::encode(Yii::$app->request->get('departure_date')) ?>">
                        </div>

                        <div class="col-12 d-grid mt-4">
                            <button type="submit" class="btn btn-primary rounded-pill py-2 shadow-sm">
                                <i class="fa fa-filter me-2"></i>Apply Filters
                            </button>
                        </div>
                    </form>
                </div>
            </aside>

            <!-- Flight Results -->
            <section class="col-lg-9">
                <?php if (empty($voos)): ?>
                    <div class="text-center py-5 bg-white rounded-4 shadow-sm border border-dashed border-2">
                        <div class="display-1 text-light mb-3"><i class="fa fa-plane-slash"></i></div>
                        <h4 class="text-muted">No flights found</h4>
                        <p class="text-muted mb-0">Try adjusting your filters to find more flights.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($voos as $voo): ?>
                        <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden hover-shadow transition">
                            <div class="card-body p-0">
                                <div class="row g-0 align-items-stretch">
                                    <!-- Airline Info -->
                                    <div class="col-md-2 bg-light d-flex flex-column align-items-center justify-content-center p-4 border-end">
                                        <img src="<?= $voo->companhia ? $voo->companhia->getImageUrl() : Url::to('@web/img/airlines/default.png') ?>" 
                                             alt="Airline Logo" 
                                             class="img-fluid mb-2" 
                                             style="max-height: 60px;">
                                        <h6 class="mb-0 text-center small fw-bold text-muted"><?= $voo->companhia ? Html::encode($voo->companhia->name) : 'Airline' ?></h6>
                                        <span class="badge bg-white text-dark border mt-2 small"><?= Html::encode($voo->numero_voo) ?></span>
                                    </div>

                                    <!-- Flight Times & Route -->
                                    <div class="col-md-7 p-4">
                                        <div class="d-flex justify-content-between align-items-center position-relative">
                                            <div class="text-center" style="flex: 1;">
                                                <h3 class="mb-0 fw-bold"><?= date('H:i', strtotime($voo->departure_date)) ?></h3>
                                                <div class="text-primary fw-bold"><?= Html::encode($voo->origin) ?></div>
                                                <small class="text-muted"><?= date('D, d M', strtotime($voo->departure_date)) ?></small>
                                            </div>

                                            <div class="text-center px-4" style="flex: 1;">
                                                <div class="small text-muted mb-1">Direct</div>
                                                <div class="flight-path-line position-relative mb-2">
                                                    <i class="fa fa-plane text-primary"></i>
                                                </div>
                                                <div class="small text-muted"><?= Html::encode(ucfirst($voo->tipo_voo)) ?></div>
                                            </div>

                                            <div class="text-center" style="flex: 1;">
                                                <h3 class="mb-0 fw-bold"><?= $voo->arrival_date ? date('H:i', strtotime($voo->arrival_date)) : '--:--' ?></h3>
                                                <div class="text-primary fw-bold"><?= Html::encode($voo->destination) ?></div>
                                                <small class="text-muted"><?= $voo->arrival_date ? date('D, d M', strtotime($voo->arrival_date)) : '--' ?></small>
                                            </div>
                                        </div>

                                        <div class="mt-4 pt-3 border-top d-flex gap-4">
                                            <div class="small"><i class="fa fa-door-open text-muted me-2"></i><strong>Gate:</strong> <?= $voo->gate ?: 'TBA' ?></div>
                                            <div class="small"><i class="fa fa-info-circle text-muted me-2"></i><strong>Status:</strong> 
                                            
                                                <?php
                                                $status = strtolower($voo->status);

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
                                                <span class="<?= $statusClass ?> fw-bold"><?= ucfirst(Html::encode($voo->status)) ?></span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Price & Action -->
                                    <div class="col-md-3 p-4 bg-primary-subtle d-flex flex-column justify-content-center align-items-center text-center">
                                        <div class="text-muted small mb-1">Economy from</div>
                                        <h2 class="mb-3 text-primary fw-bold">300€</h2>
                                        <?= Html::beginForm(Url::to(['site/buy-ticket']), 'post', ['class' => 'w-100']) ?>
                                            <?= Html::hiddenInput('id_voo', $voo->id_voo) ?>
                                            <button type="submit" class="btn btn-primary rounded-pill px-4 w-100 py-2">
                                                <i class="fa fa-shopping-cart me-2"></i>Buy Ticket
                                            </button>
                                        <?= Html::endForm() ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </section>
        </div>
    </div>
</div>

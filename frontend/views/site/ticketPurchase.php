<?php
use yii\helpers\Html;
use yii\helpers\Url;

/** @var $voos \common\models\Voo[] */
/** @var $companhias \common\models\CompanhiaAerea[] */
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>TRAVELER - Free Travel Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="<?= Yii::getAlias('@web') ?>/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link rel="stylesheet" href="<?= Yii::getAlias('@web') ?>/css/style.css">

    <link href="css/style.css" rel="stylesheet">
</head>

<body>

<div class="ticket-page container-fluid py-4">

    <!-- HEADER -->
    <div class="d-flex align-items-center mb-4">
        <a href="<?= Url::to(['site/index']) ?>" class="text-decoration-none mr-3">
            ← Voltar
        </a>
        <h4 class="mb-0 mx-auto">Seach for flight</h4>
    </div>

    <div class="row">

        <!-- FILTROS -->
        <aside class="col-lg-3 col-md-4 mb-4">
            <div class="filter-box p-3">

                <div class="d-flex justify-content-between mb-3">
                    <strong>Filter</strong>
                    <a href="<?= Url::to(['site/ticket-purchase']) ?>" class="text-sm">
                        Clear
                    </a>
                </div>

                <form method="get">

                    <label class="small">Origin</label>
                    <input type="text"
                           name="origin"
                           class="form-control form-control-sm"
                           value="<?= Html::encode(Yii::$app->request->get('origin')) ?>">

                    <label class="small mt-2">Destino</label>
                    <input type="text"
                           name="destination"
                           class="form-control form-control-sm"
                           value="<?= Html::encode(Yii::$app->request->get('destination')) ?>">

                    <label class="small mt-2">Airline</label>
                    <select name="id_companhia" class="form-control form-control-sm">
                        <option value="">All</option>
                        <?php foreach ($companhias as $c): ?>
                            <option value="<?= $c->id_companhia ?>"
                                <?= Yii::$app->request->get('id_companhia') == $c->id_companhia ? 'selected' : '' ?>>
                                <?= Html::encode($c->name) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <label class="small mt-2">Flight type</label>
                    <select name="tipo_voo" class="form-control form-control-sm">
                        <option value="">All</option>
                        <option value="departure"
                            <?= Yii::$app->request->get('tipo_voo') === 'departure' ? 'selected' : '' ?>>
                            Departure
                        </option>
                        <option value="arrival"
                            <?= Yii::$app->request->get('tipo_voo') === 'arrival' ? 'selected' : '' ?>>
                            Arrival
                        </option>
                    </select>

                    <label class="small mt-2">Date</label>
                    <input type="date"
                           name="departure_date"
                           class="form-control form-control-sm"
                           value="<?= Html::encode(Yii::$app->request->get('departure_date')) ?>">

                    <button class="btn btn-primary btn-sm mt-3 w-100">
                        Filter
                    </button>

                </form>

            </div>
        </aside>

        <!-- LISTA DE VOOS -->
        <section class="col-lg-9 col-md-8">

            <h5 class="mb-3">Available Flights</h5>

            <?php if (empty($voos)): ?>
                <div class="alert alert-info">
                    No flights found with current filters
                </div>
            <?php endif; ?>

            <?php foreach ($voos as $voo): ?>
                <div class="flight-card mb-3 p-3">
                    <div class="row align-items-center">

                        <!-- ORIGEM -->
                        <div class="col-4 col-md-3">
                            <small class="text-muted">
                                <?= Html::encode($voo->companhia->nome ?? 'Airline') ?>
                            </small>
                            <div class="time">
                                <?= date('H:i', strtotime($voo->departure_date)) ?>
                            </div>
                            <small><?= Html::encode($voo->origin) ?></small>
                        </div>

                        <!-- DURAÇÃO (PLACEHOLDER)  muda aki-->
                        <div class="col-4 col-md-3 text-center">
                            <small class="text-muted">—</small>
                            <div class="duration">Direct Flight</div>
                        </div>

                        <!-- DESTINO -->
                        <div class="col-4 col-md-3 text-right">
                            <div class="time">
                                <?= date('H:i', strtotime($voo->arrival_date)) ?>
                            </div>
                            <small><?= Html::encode($voo->destination) ?></small>
                        </div>

                        <!-- PREÇO + COMPRAR -->
                        <div class="col-md-3 text-right mt-3 mt-md-0">
                            <div class="price">300€</div>

                            <?= Html::beginForm(
                                Url::to(['site/ticket-purchase']),
                                'post'
                            ) ?>
                                <?= Html::hiddenInput('id_voo', $voo->id_voo) ?>
                                <button class="btn btn-primary btn-sm mt-2 w-100">
                                    Comprar
                                </button>
                            <?= Html::endForm() ?>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>

        </section>

    </div>
</div>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="lib/tempusdominus/js/moment.min.js"></script>
<script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
<script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

<!-- Contact Javascript File -->
<script src="mail/jqBootstrapValidation.min.js"></script>
<script src="mail/contact.js"></script>

<!-- Template Javascript -->
<script src="<?= Yii::getAlias('@web') ?>/js/main.js"></script>

</body>
</html>

<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Html;
use yii\bootstrap5\Breadcrumbs;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= Yii::getAlias('@web') ?>/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<!-- Topbar Start -->
<div class="container-fluid bg-light pt-3 d-none d-lg-block">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 text-center text-lg-left mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center">
                    <p><i class="fa fa-envelope mr-2"></i>2241596@my.ipleiria.pt</p>
                    <p class="text-body px-3">|</p>
                    <p><i class="fa fa-phone-alt mr-2"></i>+351 910 869 735</p>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <a class="text-primary px-3" href="#"><i class="fab fa-facebook-f"></i></a>
                    <a class="text-primary px-3" href="#"><i class="fab fa-twitter"></i></a>
                    <a class="text-primary px-3" href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->

<!-- Navbar Start -->
<div class="container-fluid position-relative nav-bar p-0">
    <div class="container-lg position-relative p-0 px-lg-3" style="z-index: 9;">
        <nav class="navbar navbar-expand-lg bg-light navbar-light shadow-lg py-3 py-lg-0 pl-3 pl-lg-5">
            <a href="<?= Yii::$app->homeUrl ?>" class="navbar-brand">
                <img src="<?= Yii::getAlias('@web') ?>/img/logo_azul.png" alt="Logo" class="navbar-logo">
            </a>

            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between px-3" id="navbarCollapse">
                <div class="navbar-nav ml-auto py-0">
                    <a href="<?= Yii::$app->homeUrl ?>" class="nav-item nav-link <?= Yii::$app->controller->id == 'site' && Yii::$app->controller->action->id == 'index' ? 'active' : '' ?>">Voos</a>
                    <a href="<?= \yii\helpers\Url::to(['/site/servicos']) ?>" class="nav-item nav-link">Services</a>
                    <a href="<?= \yii\helpers\Url::to(['/site/checkin']) ?>" class="nav-item nav-link">Online Check-In</a>  
                    <a href="<?= \yii\helpers\Url::to(['/site/contact']) ?>" class="nav-item nav-link">Support</a>
                    <?php if (Yii::$app->user->isGuest): ?>
                        <a href="<?= \yii\helpers\Url::to(['/site/login']) ?>" class="nav-item nav-link">Login</a>
                        <a href="<?= \yii\helpers\Url::to(['/site/signup']) ?>" class="nav-item nav-link">Signup</a>
                    <?php else: ?>
                        <div class="nav-item">
                            <?= Html::beginForm(['/site/logout'], 'post') ?>
                            <?= Html::submitButton(
                                'Logout (' . Yii::$app->user->identity->username . ')',
                                ['class' => 'nav-link btn btn-link logout text-decoration-none p-0']
                            ) ?>
                            <?= Html::endForm() ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- Navbar End -->

<!-- Dynamic Content -->
<div class="container my-5">
    <?= Breadcrumbs::widget([
        'links' => $this->params['breadcrumbs'] ?? [],
    ]) ?>
    <?= Alert::widget() ?>
    <?= $content ?>
</div>

<div class="container-fluid bg-dark text-white-50 py-3 px-sm-3 px-lg-5">
    <div class="row pt-5">

        <div class="col-lg-3 col-md-6 mb-3">
            <a class="footer-brand">
                <img src="img/logo_branco.png" alt="Logo" class="footer-logo">
            </a>
            <h6 class="text-white text-uppercase mt-2 mb-2" style="letter-spacing: 3px;">Follow Us</h6>
            <div class="d-flex justify-content-start">
                <a class="btn btn-outline-primary btn-square mr-2 btn-sm" href="#"><i class="fab fa-twitter"></i></a>
                <a class="btn btn-outline-primary btn-square mr-2 btn-sm" href="#"><i class="fab fa-facebook-f"></i></a>
                <a class="btn btn-outline-primary btn-square mr-2 btn-sm" href="#"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <h5 class="text-white text-uppercase mb-2" style="letter-spacing: 3px;">Our Services</h5>
            <div class="d-flex flex-column justify-content-start">
                <a class="text-white-50 mb-1 medium" href="<?= \yii\helpers\Url::to(['/site/servicos']) ?>"><i class="fa fa-angle-right mr-1"></i>All Services</a>
                <a class="text-white-50 mb-1 medium" href="https://www.kfc.pt/"><i class="fa fa-angle-right mr-1"></i>KFC</a>
                <a class="text-white-50 mb-1 medium" href="https://www.mcdonalds.pt/"><i class="fa fa-angle-right mr-1"></i>McDonalds</a>
                <a class="text-white-50 mb-1 medium" href="https://www.burgerking.pt/pt/"><i class="fa fa-angle-right mr-1"></i>Burger King</a>
                <a class="text-white-50 mb-1 medium" href="https://wells.pt/"><i class="fa fa-angle-right mr-1"></i>Wells</a>
                <a class="text-white-50 mb-1 medium" href="#"><i class="fa fa-angle-right mr-1"></i>Pull&Bear</a>
                <a class="text-white-50 mb-1 medium" href="#"><i class="fa fa-angle-right mr-1"></i>Balvera</a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <h5 class="text-white text-uppercase mb-2" style="letter-spacing: 3px;">Useful Links</h5>
            <div class="d-flex flex-column justify-content-start">
                <a class="text-white-50 mb-1 medium" href="<?= \yii\helpers\Url::to(['/site/about']) ?>"><i class="fa fa-angle-right mr-1"></i>About</a>
                <a class="text-white-50 mb-1 medium" href="#"><i class="fa fa-angle-right mr-1"></i>Destinations</a>
                <a class="text-white-50 mb-1 medium" href="#"><i class="fa fa-angle-right mr-1"></i>Current Flights</a>
                <a class="text-white-50 mb-1 medium" href="#"><i class="fa fa-angle-right mr-1"></i>Search Flight</a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <h5 class="text-white text-uppercase mb-2" style="letter-spacing: 3px;">Contact Us</h5>
            <p class="small mb-1"><i class="fa fa-phone-alt mr-1"></i>+351 910 869 735</p>
            <p class="small mb-0"><i class="fa fa-envelope mr-1"></i>2241596@my.ipleiria.pt</p>
        </div>

    </div>

    <div class="container-fluid bg-dark text-white border-top py-2 px-sm-3 px-md-5" style="border-color: rgba(255, 255, 255, .1) !important;">
        <div class="row">
            <div class="col-lg-6 text-center text-md-left mb-2 mb-md-0">
                <p class="m-0 text-white-50 small">Copyright &copy; <a href="#">Domain</a>. All Rights Reserved.</p>
            </div>
            <div class="col-lg-6 text-center text-md-right">
                <p class="m-0 text-white-50 small">Designed by <a href="https://htmlcodex.com">HTML Codex</a></p>
            </div>
        </div>
    </div>

    <div class="row pt-2">
        <div class="col-lg-6 text-center text-md-right">
            <p class="m-0 text-white-50 small"><?= Yii::powered() ?></p>
        </div>
    </div>
</div>


<!-- JS Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="<?= Yii::getAlias('@web') ?>/js/main.js"></script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

<?php

use backend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Html;
use hail812\adminlte3\assets\AdminLteAsset;
use hail812\adminlte\widgets\Menu;
use yii\widgets\Breadcrumbs;



/** @var \yii\web\View $this */
/** @var string $content */

AppAsset::register($this);
AdminLteAsset::register($this);

$this->registerCssFile('@web/css/custom.css');
$menuItems = require Yii::getAlias('@backend/config/menu.php');

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- FontAwesome FIX -->
    <!--
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4RhisQG4R5Hn6iyHtjKy1lE+PEKx8rY3E6x0R2jVReE6eoV7P4F6Zm5Zr3CJoXlrnKg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    -->

    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<?php $this->beginBody() ?>

<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">

        <!-- Left navbar links -->
        <ul class="navbar-nav">

            <!-- Sidebar Toggle -->
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                    <i class="fas fa-bars"></i>
                </a>
            </li>
            
            <!-- Top Menu Buttons -->
            <li class="nav-item d-none d-sm-inline-block">
                <a class="nav-link" href="<?= \yii\helpers\Url::to(['/site/index']) ?>">
                    Dashboard
                </a>
            </li>

            <li class="nav-item d-none d-sm-inline-block">
                <a class="nav-link" href="<?= \yii\helpers\Url::to(['/site/recent-activity']) ?>">
                    Recent Activity
                </a>
            </li>

            <li class="nav-item d-none d-sm-inline-block">
                <a class="nav-link" href="<?= \yii\helpers\Url::to(['/site/system-resume']) ?>">
                    System Resume
                </a>
            </li>
        </ul>

        
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">

            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge">
                        5
                    </span> <!-- número fake por agora -->
                </a>

                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                    <span class="dropdown-item dropdown-header">5 Notifications</span>
                    <div class="dropdown-divider"></div>

                    <!-- Example notification items -->
                    <a href="<?= \yii\helpers\Url::to(['/notificacao/index']) ?>" class="dropdown-item">
                        <i class="fas fa-headset mr-2 text-warning"></i>
                        Pedido de Assistência
                        <span class="float-right text-muted text-sm">3 mins</span>
                    </a>

                    <div class="dropdown-divider"></div>

                    <a href="<?= \yii\helpers\Url::to(['/notificacao/index']) ?>" class="dropdown-item">
                        <i class="fas fa-plane-departure mr-2 text-info"></i>
                        Atualização de voo
                        <span class="float-right text-muted text-sm">12 mins</span>
                    </a>

                    <div class="dropdown-divider"></div>

                    <a href="<?= \yii\helpers\Url::to(['/notificacao/index']) ?>" class="dropdown-item">
                        <i class="fas fa-exclamation-circle mr-2 text-danger"></i>
                        Incidente reportado
                        <span class="float-right text-muted text-sm">1 hour</span>
                    </a>

                    <div class="dropdown-divider"></div>

                    <a href="<?= \yii\helpers\Url::to(['/notificacao/index']) ?>" class="dropdown-item dropdown-footer">
                        View All Notifications
                    </a>
                </div>
            </li>


            <!-- Fullscreen (opcional) -->
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>

            <?php
            use common\models\UserProfile;

            $profileId = null;

            if (!Yii::$app->user->isGuest) {
                $profile = UserProfile::find()
                    ->where(['user_id' => Yii::$app->user->id])
                    ->one();

                if ($profile) {
                    $profileId = $profile->id;
                }
            }
            ?>
            <?php if ($profileId): ?>
            <li class="nav-item">
                <a class="nav-link" 
                href="<?= \yii\helpers\Url::to(['/user-profile/view', 'id' => $profileId]) ?>"
                title="My Profile">
                    <i class="fas fa-user-circle"></i>
                </a>
            </li>
            <?php endif; ?>


            <!-- Logout -->
            <?php if (!Yii::$app->user->isGuest): ?>
                <li class="nav-item">
                    <div class="nav-item">
                        <?= Html::beginForm(['/site/logout'], 'post') ?>
                        <?= Html::submitButton(
                            'Logout (' . Yii::$app->user->identity->username . ')',
                            ['class' => 'nav-link btn btn-link logout text-decoration-none p-0']
                        ) ?>
                        <?= Html::endForm() ?>
                    </div>
                </li>   
            <?php endif; ?>
        </ul>
    </nav>
    <!-- /.navbar -->


    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">

        <!-- Brand Logo -->
        <!--<a href="<?= Yii::$app->homeUrl ?>" class="navbar-brand">
            <img src="<?= Yii::$app->assetManager->getPublishedUrl('@frontend/web') ?>/img/logo_azul.png" alt="Logo" class="navbar-logo">
        </a> -->
        <a href="<?= Yii::$app->homeUrl ?>" class="brand-link">
            <span class="brand-text font-weight-light">FlightHubLink</span>
        </a>


        <!-- Sidebar -->
        <div class="sidebar">

            <!-- User panel -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="info">
                    <?php if ($profileId): ?>
                        <a href="<?= \yii\helpers\Url::to(['/user-profile/view', 'id' => $profileId]) ?>" class="d-block">
                        <?php else: ?>
                        <a href="#" class="d-block">
                        <?php endif; ?>
                        <?php if (!Yii::$app->user->isGuest): ?>
                        <?= Html::encode(Yii::$app->user->identity->username) ?>
                        <?php else: ?>
                        Guest
                        <?php endif; ?>
                    </a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <!-- vai buscar os itens no config/menu.php -->
                <?= Menu::widget([
                    'items' => $menuItems,
                ]) ?>
            </nav>
        </div>
    </aside>


    <!-- Content Wrapper -->
    <div class="content-wrapper">

        <!-- Content Header -->
        <div class="content-header">
            <div class="container-fluid">
                <h1 class="m-0"><?= Html::encode($this->title) ?></h1>

                <?= Breadcrumbs::widget([
                    'links' => $this->params['breadcrumbs'] ?? [],
                    'options' => ['class' => 'breadcrumb float-sm-right']
                ]) ?>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <?= Alert::widget() ?>
                <?= $content ?>

            </div>
        </section>
    </div>


    <!-- Main Footer -->
    <footer class="main-footer text-center">
        <strong>&copy; <?= date('Y') ?> FlightHubLink.</strong> All rights reserved.
    </footer>

</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>





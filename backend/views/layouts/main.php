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
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#">
                    <i class="fas fa-bars"></i>
                </a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">

            <!-- Logout -->
            <?php if (!Yii::$app->user->isGuest): ?>
                <li class="nav-item">
                    <?= Html::beginForm(['/site/logout'], 'post')
                        . Html::submitButton(
                            'Logout',
                            ['class' => 'nav-link btn btn-link logout text-dark']
                        )
                        . Html::endForm()
                    ?>
                </li>   
            <?php endif; ?>
        </ul>
    </nav>
    <!-- /.navbar -->


    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">

        <!-- Brand Logo -->
        <a href="/" class="brand-link">
            <span class="brand-text font-weight-light">FlightHubLink</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">

            <!-- User panel -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="info">
                    <a href="#" class="d-block">
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

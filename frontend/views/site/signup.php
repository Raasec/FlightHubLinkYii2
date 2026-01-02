<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Signup';
?>

<head>
    <meta charset="utf-8">
    <title>FlightHubLink</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
</head>

<body>
<div class="auth-container">

    <!-- Left Banner -->
    <div class="auth-left">
        <div>
            <img src="<?= Yii::getAlias('@web') ?>/img/IconBig.png" class="icon" alt="Icon">
            <h2>Welcome to FlightHubLink!</h2> 
            <p>Make an account to make sure you can manage your flights</p>
        </div>
    </div>

    <!-- Right Form -->
    <div class="auth-right">
        <div class="auth-form-wrapper">
            <h3 class="text-center mb-4"><?= Html::encode($this->title) ?></h3>

            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>

                <div class="form-group mt-3">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary w-100', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
</body>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="lib/tempusdominus/js/moment.min.js"></script>
<script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
<script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

<script src="mail/jqBootstrapValidation.min.js"></script>
<script src="mail/contact.js"></script>

<script src="<?= Yii::getAlias('@web') ?>/js/main.js"></script>

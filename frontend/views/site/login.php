<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Login';
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
            <h2>Welcome to  FlightHubLink!</h2>
            <p>Acess your account to make sure you can manage all your information and flights</p>
        </div>
    </div>

    <!-- Right Form -->
    <div class="auth-right">
        <div class="auth-form-wrapper">
            <h3 class="text-center mb-4"><?= Html::encode($this->title) ?></h3>

            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <div class="my-1 mx-0" style="color:#999;">
                    If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
                    <br>
                    Need new verification email? <?= Html::a('Resend', ['site/resend-verification-email']) ?>
                </div>

                <div class="form-group mt-3">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary w-100', 'name' => 'login-button']) ?>
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

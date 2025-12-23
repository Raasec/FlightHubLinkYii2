<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\ContactForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Ticket ';
?>

<head>
    <meta charset="utf-8">
    <title>TRAVELER - Free Travel Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

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

<div class="site-contact">
    <div class="contact-form-wrapper">
        <h1><?= Html::encode($this->title) ?></h1>
        <p>Submit a Ticket for our support team to handle your issue.</p>

        <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

        <?= $form->field($model, 'type')->textInput(['autofocus' => true]) ?>
        <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

        <div class="form-group">
            <?= Html::submitButton('Submit Ticket', ['class' => 'btn btn-primary']) ?>
        </div>

    <?php ActiveForm::end(); ?>

    </div>
</div>

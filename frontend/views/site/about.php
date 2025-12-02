<?php
/** @var yii\web\View $this */
$this->title = 'About Us';
?>
<head>
    <meta charset="utf-8">
    <title>About - Airport Management Project</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="<?= Yii::getAlias('@web') ?>/img/favicon.ico" rel="icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="<?= Yii::getAlias('@web') ?>/css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container py-5">
        <h1 class="mb-4 text-center">About Our Project</h1>

        <div class="row align-items-center">
            <div class="col-lg-6 mb-4">
                <h4>We are a small team composed of 3 Students.</h4>
                <p style="margin-top: 25px;">
                    Our project focused on managing a modern airport environment.
                    Our system aim to simplify operations, make traveler experience easy,
                    and make the workflow simple for staff and administrators.
                </p>
                <p>
                    From flight managing to passenger services, our goal is to bring
                    some clarity to something usually very complicated.
                </p>
            </div>

            <div class="col-lg-6 text-center">
                <div style="width: 400px; height: 400px; border-radius: 8px; margin: 0 auto; display: flex; align-items: center; justify-content: center;">
                    <img src="../img/IconBig.png" alt="Logo" class="footer-logo">
                </div>
            </div>
        </div>
    </div>
</body>

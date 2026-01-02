<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>FlightHubLink</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
</head>

    <body>

    <div class="booking-content checkin-tab">
        <div class="checkin-container">
            <h1>Check-in Online</h1>
            <h6>Check in and choose your seat in advance.</h6>
            
            <?php if (isset($error) && $error): ?>
                <div class="alert alert-danger">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <?= \yii\helpers\Html::beginForm(['site/checkin'], 'post') ?>
                <p>Ticket ID</p> 
                <input type="text" name="reference" placeholder="Ex: 12345" class="form-control mb-3" required>
                
                <p>Passanger's Name</p> 
                <input type="text" name="name" placeholder="Full Name used in booking" class="form-control mb-3" required>
                
                <button type="submit" class="btn-primary" style="border:none; padding: 10px 20px; cursor: pointer;">Search</button>
            <?= \yii\helpers\Html::endForm() ?>
        </div>
    </div>
    
        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>


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
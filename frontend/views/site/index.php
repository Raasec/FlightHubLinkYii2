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
    
    <!-- Carousel Start -->
    <div class="container-fluid p-0">
        <div id="header-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="img/carousel-1.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase mb-md-3">Travel and Discover</h4>
                            <h1 class="display-3 text-white mb-md-4">Welcome to FlightHubLink</h1>
                            <a href="<?= \yii\helpers\Url::to(['/site/ticket-purchase']) ?>" class="btn btn-primary py-md-3 px-md-5 mt-2">Book Now</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="img/carousel-2.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase mb-md-3">Tours & Travel</h4>
                            <h1 class="display-3 text-white mb-md-4">Discover Amazing Places With Us</h1>
                            <a href="" class="btn btn-primary py-md-3 px-md-5 mt-2">Book Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                <div class="btn btn-dark" style="width: 45px; height: 45px;">
                    <span class="carousel-control-prev-icon mb-n2"></span>
                </div>
            </a>
            <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                <div class="btn btn-dark" style="width: 45px; height: 45px;">
                    <span class="carousel-control-next-icon mb-n2"></span>
                </div>
            </a>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- Search Flight Start -->
    <div class="container-fluid d-flex justify-content-center mt-5 pb-5">
        <div class="booking-wrapper shadow">

            <div class="booking-tabs d-flex">
                <button class="booking-tab active">Search Flights</button>
            </div>

            <!-- Form -->
            <div class="booking-content">

                <form method="get" action="<?= \yii\helpers\Url::to(['site/search-flight']) ?>">

                    <div class="row g-3">

                        <!-- Origem -->
                        <div class="col-md-4 col-12">
                            <div class="booking-input">
                                <i class="fa fa-map-marker-alt"></i>
                                <input type="text" name="origin" placeholder="Origin" required>
                            </div>
                        </div>

                        <!-- Destino -->
                        <div class="col-md-4 col-12">
                            <div class="booking-input">
                                <i class="fa fa-location-arrow"></i>
                                <input type="text" name="destination" placeholder="Destination" required>
                            </div>
                        </div>

                        <!-- Data -->
                        <div class="col-md-4 col-12">
                            <div class="booking-input">
                                <i class="fa fa-calendar"></i>
                                <input type="text" name="date" placeholder="dd/mm/yyyy" required>
                            </div>
                        </div>

                        <!-- Botão -->
                        <div class="col-12">
                            <button type="submit" class="booking-btn">
                                <i class="fa fa-search"></i>
                                <span>Search flights</span>
                            </button>
                        </div>

                    </div>
                </form>
            </div>

        </div>
    </div>
    <!-- search End -->



    <!-- Flight Table Start -->
    <div class="container-fluid d-flex justify-content-center mt-4 pb-5">
        <div class="flight-table-wrapper shadow">

            <!-- Tabs -->
            <div class="flight-tabs d-flex">
                <button class="flight-tab active" data-type="partidas">Departures</button>
                <button class="flight-tab" data-type="chegadas">Arrivals</button>
            </div>

            <!-- Table -->
            <div class="flight-table-content p-3">

                <table class="flight-table">
                    <thead>
                        <tr>
                            <th>Flight</th>
                            <th>Origin</th>
                            <th>Destination</th>
                            <th>Leaves at</th>
                            <th>Status</th>
                            <th>Gate</th>
                        </tr>
                    </thead>

                    <tbody>
                        <!-- este foreach ta mal whatever n dei update porque vamos mudar a table --> 
                        <?php foreach ($partidas as $voo): ?>
                            <tr>
                                <td><?= $voo->numero_voo ?></td>
                                <td><?= $voo->origin ?></td>
                                <td><?= $voo->destination ?></td>
                                <td><?= $voo->departure_date ?></td>
                                <td><?= $voo->status ?></td>
                                <td><?= $voo->gate ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>

            </div>

        </div>
    </div>
    <!-- Flight Table End -->


    <!-- Servicos Start -->
    <div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <div class="text-center mb-3 pb-3">
                <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Everything for your comfort</h6>
                <h1>Services and commodities</h1>
            </div>
            <div class="row">
                <!-- so vai ficar realmente funcional quando fizeremos a migration-->
                <?php foreach ($servicos as $servico): ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="destination-item position-relative overflow-hidden mb-2">
                            <img class="img-fluid" src="<?= $servico->getImagemUrl() ?>" alt="">
                            <a class="destination-overlay text-white text-decoration-none" href="">
                                <h5 class="text-white"><?= $servico->name ?></h5>
                                <span><?= $servico->estado ?></span>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>


            </div>
        </div>
    </div>
    <!-- Servicos Start -->

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
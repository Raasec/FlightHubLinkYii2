<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <title>FlightHubLink</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
</head>


<body>
    
    <!-- Carousel Start -->
    <div class="container-fluid p-0">
        <div id="header-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="<?= Yii::getAlias('@web') ?>/img/carousel-1.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase mb-md-3">Travel and Discover</h4>
                            <h1 class="display-3 text-white mb-md-4">Welcome to FlightHubLink</h1>
                            <a href="<?= \yii\helpers\Url::to(['/site/ticket-purchase']) ?>" class="btn btn-primary py-md-3 px-md-5 mt-2">Book Now</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="<?= Yii::getAlias('@web') ?>/img/carousel-2.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase mb-md-3">Tours & Travel</h4>
                            <h1 class="display-3 text-white mb-md-4">Discover Amazing Places With Us</h1>
                            <a href="<?= \yii\helpers\Url::to(['/site/ticket-purchase']) ?>" class="btn btn-primary py-md-3 px-md-5 mt-2">Book Now</a>
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
                                <input type="text" name="origin" placeholder="Origin">
                            </div>
                        </div>

                        <!-- Destino -->
                        <div class="col-md-4 col-12">
                            <div class="booking-input">
                                <i class="fa fa-location-arrow"></i>
                                <input type="text" name="destination" placeholder="Destination">
                            </div>
                        </div>

                        <!-- Data -->
                        <div class="col-md-4 col-12">
                            <div class="booking-input">
                                <i class="fa fa-calendar"></i>
                                <input type="text" name="date" placeholder="dd/mm/yyyy">
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
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody id="partidas-body">
                        <?php foreach ($partidas as $voo): ?>
                            <tr>
                                <td><?= $voo->numero_voo ?></td>
                                <td><?= $voo->origin ?></td>
                                <td><?= $voo->destination ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($voo->departure_date)) ?></td>
                                <td><?= $voo->status ?></td>
                                <td><?= $voo->gate ?></td>
                                <td>
                                    <button class="btn btn-sm btn-primary"
                                        data-bs-toggle="modal"
                                        data-bs-target="#flightModal"
                                        data-flight="<?= $voo->numero_voo ?>"
                                        data-origin="<?= $voo->origin ?>"
                                        data-destination="<?= $voo->destination ?>"
                                        data-date="<?= date('d/m/Y H:i', strtotime($voo->departure_date)) ?>"
                                        data-status="<?= $voo->status ?>"
                                        data-gate="<?= $voo->gate ?>"
                                        data-airline="<?= $voo->companhia ? $voo->companhia->name : 'N/A' ?>"
                                        data-airline-image="<?= $voo->companhia ? $voo->companhia->getImageUrl() : '' ?>">
                                        Inspect
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($partidas)): ?>
                            <tr><td colspan="6" class="text-center">No departures found</td></tr>
                        <?php endif; ?>
                    </tbody>

                    <tbody id="chegadas-body" style="display: none;">
                        <?php foreach ($chegadas as $voo): ?>
                            <tr>
                                <td><?= $voo->numero_voo ?></td>
                                <td><?= $voo->origin ?></td>
                                <td><?= $voo->destination ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($voo->arrival_date)) ?></td>
                                <td><?= $voo->status ?></td>
                                <td><?= $voo->gate ?></td>
                                <td>
                                    <button class="btn btn-sm btn-primary"
                                        data-bs-toggle="modal"
                                        data-bs-target="#flightModal"
                                        data-flight="<?= $voo->numero_voo ?>"
                                        data-origin="<?= $voo->origin ?>"
                                        data-destination="<?= $voo->destination ?>"
                                        data-date="<?= date('d/m/Y H:i', strtotime($voo->arrival_date)) ?>"
                                        data-status="<?= $voo->status ?>"
                                        data-gate="<?= $voo->gate ?>"
                                        data-airline="<?= $voo->companhia ? $voo->companhia->name : 'N/A' ?>"
                                        data-airline-image="<?= $voo->companhia ? $voo->companhia->getImageUrl() : '' ?>">
                                        Inspect
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($chegadas)): ?>
                            <tr><td colspan="6" class="text-center">No arrivals found</td></tr>
                        <?php endif; ?>
                    </tbody>

                </table>

            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const tabs = document.querySelectorAll('.flight-tab');
                    const bodies = {
                        'partidas': document.getElementById('partidas-body'),
                        'chegadas': document.getElementById('chegadas-body')
                    };

                    tabs.forEach(tab => {
                        tab.addEventListener('click', function() {
                            // Remove active class from all tabs
                            tabs.forEach(t => t.classList.remove('active'));
                            // Add active class to clicked tab
                            this.classList.add('active');

                            // Hide all bodies
                            Object.values(bodies).forEach(body => body.style.display = 'none');
                            
                            // Show selected body
                            const type = this.getAttribute('data-type');
                            if (bodies[type]) {
                                bodies[type].style.display = 'table-row-group';
                            }
                        });
                    });
                });
            </script>

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
                            <a class="destination-overlay text-white text-decoration-none" href="<?= $servico->url ?>" target="_blank">
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
<?php
/* @var $this yii\web\View */
/* @var $partidas common\models\Voo[] */
/* @var $chegadas common\models\Voo[] */
/* @var $servicos common\models\ServicoAeroporto[] */

use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'FlightHubLink';
?>
    
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


    <!-- Flight Details Modal -->
    <div class="modal fade" id="flightModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title text-white">Flight Details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4 text-center d-flex align-items-center justify-content-center border-right">
                            <img id="modal-airline-image" src="" alt="Airline Logo" class="img-fluid" style="max-height: 100px;">
                        </div>
                        <div class="col-md-8">
                            <div class="row mb-2">
                                <div class="col-6"><strong>Origin:</strong> <span id="modal-flight-origin"></span></div>
                                <div class="col-6"><strong>Destination:</strong> <span id="modal-flight-destination"></span></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-6"><strong>Date/Time:</strong> <span id="modal-flight-date"></span></div>
                                <div class="col-6"><strong>Gate:</strong> <span id="modal-flight-gate"></span></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12"><strong>Status:</strong> <span id="modal-flight-status" class="badge bg-info"></span></div>
                            </div>
                            <div class="text-right">
                                <a href="<?= Url::to(['/site/ticket-purchase']) ?>" class="btn btn-success">Buy Ticket</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <!-- <script src="<?= Yii::getAlias('@web') ?>/js/main.js"></script> -->
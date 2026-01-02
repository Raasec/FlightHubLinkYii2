<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>FlightHubLink</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
</head>

<body>
    <div class="container-fluid page-header">
        <div class="container">
            <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 285px">
                <h3 class="display-4 text-white text-uppercase">Our Services</h3>
            </div>
        </div>
    </div>

    <div class="container-fluid py-5">
        <div class="container pt-5 pb-3">

            <div class="row">
                <?php foreach ($servicos as $servico): ?>

                    <?php
                        $img = $servico->getImagemUrl();
                        $estado = $servico->getEstado();
                    ?>


                    <div class="col-lg-4 col-md-6 mb-4">

                        <div class="destination-item position-relative overflow-hidden mb-2 service-item"
                            data-name="<?= $servico->name ?>"
                            data-type="<?= $servico->type ?>"
                            data-location="<?= $servico->location ?>"
                            data-hours="<?= $servico->opening_hours ?>"
                            data-status="<?= $estado ?>"
                            data-image="<?= $img ?>">

                            <img class="img-fluid" src="<?= $img ?>" alt="">
                            <a class="destination-overlay text-white text-decoration-none" href="#">
                                <h5 class="text-white"><?= $servico->name ?></h5>
                                <span><?= $estado ?></span>
                            </a>

                        </div>

                    </div>

                <?php endforeach; ?>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="serviceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

        <div class="modal-header">
            <h5 class="modal-title" id="serviceModalTitle"></h5>
            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>

        <div class="modal-body">
            <img id="serviceModalImage" src="" class="img-fluid mb-3">
            <p><strong>Type:</strong> <span id="serviceModalType"></span></p>
            <p><strong>Location:</strong> <span id="serviceModalLocation"></span></p>
            <p><strong>Hours:</strong> <span id="serviceModalHours"></span></p>
            <p><strong>Status:</strong> <span id="serviceModalStatus"></span></p>
        </div>

        </div>
    </div>
    </div>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- talvez meter isto no .js -->
    <script>
    $(".service-item").on("click", function () {

        $("#serviceModalTitle").text($(this).data("name"));
        $("#serviceModalType").text($(this).data("type"));
        $("#serviceModalLocation").text($(this).data("location"));
        $("#serviceModalHours").text($(this).data("hours"));
        $("#serviceModalStatus").text($(this).data("status"));
        $("#serviceModalImage").attr("src", $(this).data("image"));

        $("#serviceModal").modal("show");
    });
    </script>


</body>

</html>
<h2>Search results</h2>

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

<?php if (empty($flights)): ?>
    <p>No flights found.</p>
<?php else: ?>
<table class="table">
    <thead>
        <tr>
            <th>Flight</th>
            <th>Origin</th>
            <th>Destination</th>
            <th>Date</th>
            <th>Gate</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($flights as $flight): ?>
        <tr>
            <td><?= $flight->numero_voo ?></td>
            <td><?= $flight->origin ?></td>
            <td><?= $flight->destination ?></td>
            <td><?= $flight->departure_date ?></td>
            <td><?= $flight->gate ?></td>
            <td><?= $flight->status ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>

<h2>Search results</h2>

<head>
    <meta charset="utf-8">
    <title>FlightHubLink</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
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

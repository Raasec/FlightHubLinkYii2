<h2>Search results</h2>

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
            <td><?= $flight->origem ?></td>
            <td><?= $flight->destino ?></td>
            <td><?= $flight->data_registo ?></td>
            <td><?= $flight->porta_embarque ?></td>
            <td><?= $flight->estado ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>

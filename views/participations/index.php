<?php

include '../../config/Database.php';
include '../../models/Participation.php';

$database = new Database();
$db = $database->connect();

$participation = new Participation($db);

$result = $participation->readAll();

?>

<!DOCTYPE html>
<html>

<head>

<title>Participations</title>

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

</head>

<body class="bg-dark text-white">

<div class="container mt-5">

<h1 class="mb-4">
Participations List
</h1>

<table class="table table-dark table-bordered table-hover">

<thead>

<tr>

<th>ID</th>
<th>Team ID</th>
<th>Tournament ID</th>

</tr>

</thead>

<tbody>

<?php while($row = $result->fetch(PDO::FETCH_ASSOC)) : ?>

<tr>

<td>
<?= $row['id']; ?>
</td>

<td>
<?= $row['team_id']; ?>
</td>

<td>
<?= $row['tournament_id']; ?>
</td>

</tr>

<?php endwhile; ?>

</tbody>

</table>

</div>

</body>
</html>
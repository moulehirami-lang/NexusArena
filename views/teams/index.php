<?php

include '../../config/Database.php';
include '../../models/Team.php';

$database = new Database();
$db = $database->connect();

$team = new Team($db);

$result = $team->readAll();

?>

<!DOCTYPE html>
<html>

<head>

<title>Teams</title>

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

</head>

<body class="bg-dark text-white">

<div class="container mt-5">

<h1 class="mb-4">
Teams List
</h1>

<table class="table table-dark table-bordered table-hover">

<thead>

<tr>

<th>ID</th>
<th>Name</th>
<th>Logo</th>
<th>Actions</th>

</tr>

</thead>

<tbody>

<?php while($row = $result->fetch(PDO::FETCH_ASSOC)) : ?>

<tr>

<td>
<?= $row['id']; ?>
</td>

<td>
<?= $row['name']; ?>
</td>

<td>

<img src="/nexusArena/uploads/<?= $row['logo']; ?>"
     width="100">

</td>

<td>

<a href="edit.php?id=<?= $row['id']; ?>"
   class="btn btn-warning me-2">

Edit

</a>

<a href="delete.php?id=<?= $row['id']; ?>"
   class="btn btn-danger"
   onclick="return confirm('Delete this team ?')">

Delete

</a>

</td>

</tr>

<?php endwhile; ?>

</tbody>

</table>

</div>

</body>
</html>

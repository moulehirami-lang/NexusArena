<?php

include '../../config/Database.php';
include '../../models/Participation.php';

$database = new Database();
$db = $database->connect();

$participation = new Participation($db);

$message = "";

if($_POST) {

    $participation->team_id = $_POST['team_id'];

    $participation->tournament_id = $_POST['tournament_id'];

    if($participation->joinTournament()) {

        $message = "
        <div class='alert alert-success'>
            Team joined tournament successfully
        </div>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Join Tournament</title>

<link rel='stylesheet'
href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css'>

</head>

<body class='bg-dark text-white'>

<div class='container mt-5'>

<div class='card bg-secondary p-4'>

<h2 class='mb-4'>
Join Tournament
</h2>

<?= $message; ?>

<form method='POST'>

<div class='mb-3'>

<label class='form-label'>
Team ID
</label>

<input type='number'
       name='team_id'
       class='form-control'
       required>

</div>

<div class='mb-3'>

<label class='form-label'>
Tournament ID
</label>

<input type='number'
       name='tournament_id'
       class='form-control'
       required>

</div>

<button type='submit'
        class='btn btn-success w-100'>

Join Tournament

</button>

</form>

</div>

</div>

</body>
</html>
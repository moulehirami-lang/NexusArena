<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../../config/Database.php';
include '../../models/Team.php';

$database = new Database();
$db = $database->connect();

$team = new Team($db);

$message = "";

if($_POST) {

    $team->name = $_POST['name'];

    $team->captain_id = 1;

    // Upload logo
    $logoName = time() . "_" . $_FILES['logo']['name'];

    $tmpName = $_FILES['logo']['tmp_name'];

    move_uploaded_file(
        $tmpName,
        '../../uploads/' . $logoName
    );

    $team->logo = $logoName;

    if($team->create()) {

        $message = "
        <div class='alert alert-success'>
            Team created successfully
        </div>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Create Team</title>

<link rel='stylesheet'
href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css'>

</head>

<body class='bg-dark text-white'>

<div class='container mt-5'>

<div class='card bg-secondary p-4'>

<h2>Create Team</h2>

<?= $message; ?>

<form method='POST'
      enctype='multipart/form-data'>

<input type='text'
       name='name'
       class='form-control mb-3'
       placeholder='Team Name'
       required>

<input type='file'
       name='logo'
       class='form-control mb-3'
       required>

<button class='btn btn-primary w-100'>
Create Team
</button>

</form>

</div>

</div>

</body>
</html>

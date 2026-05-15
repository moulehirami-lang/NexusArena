<?php

include '../../config/Database.php';
include '../../models/Team.php';

$database = new Database();
$db = $database->connect();

$team = new Team($db);

// Vérifier ID
if(isset($_GET['id'])) {

    $team->id = $_GET['id'];

    // Charger données équipe
    $team->readOne();
}

// Modifier équipe
if($_POST) {

    $team->id = $_POST['id'];

    $team->name = $_POST['name'];

    // Vérifier nouveau logo
    if(!empty($_FILES['logo']['name'])) {

        $logoName = time() . "_" . $_FILES['logo']['name'];

        $tmpName = $_FILES['logo']['tmp_name'];

        move_uploaded_file(
            $tmpName,
            '../../uploads/' . $logoName
        );

        $team->logo = $logoName;
    }
    else {

        // garder ancien logo
        $team->logo = $_POST['old_logo'];
    }

    // Update
    if($team->update()) {

        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Edit Team</title>

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

</head>

<body class="bg-dark text-white">

<div class="container mt-5">

<div class="card bg-secondary p-4">

<h2 class="mb-4">
Edit Team
</h2>

<form method="POST"
      enctype="multipart/form-data">

<input type="hidden"
       name="id"
       value="<?= $team->id; ?>">

<input type="hidden"
       name="old_logo"
       value="<?= $team->logo; ?>">

<!-- Team Name -->

<div class="mb-3">

<label class="form-label">
Team Name
</label>

<input type="text"
       name="name"
       class="form-control"
       value="<?= $team->name; ?>"
       required>

</div>

<!-- Current Logo -->

<div class="mb-3">

<label class="form-label">
Current Logo
</label>

<br>

<img src="/nexusArena/uploads/<?= $team->logo; ?>"
     width="120">

</div>

<!-- New Logo -->

<div class="mb-3">

<label class="form-label">
New Logo
</label>

<input type="file"
       name="logo"
       class="form-control">

</div>

<button class="btn btn-warning w-100">

Update Team

</button>

</form>

</div>

</div>

</body>
</html>
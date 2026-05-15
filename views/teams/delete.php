<?php

include '../../config/Database.php';
include '../../models/Team.php';

$database = new Database();
$db = $database->connect();

$team = new Team($db);

// Vérifier si id existe
if(isset($_GET['id'])) {

    $team->id = $_GET['id'];

    // Supprimer équipe
    if($team->delete()) {

        header("Location: index.php");
        exit();
    }
}
?>
<?php
require '../DATABASE/bd.php';

if (isset($_GET['identifiant'])) {
    $id = $_GET['identifiant'];
    $sql = "SELECT*FROM client WHERE Num_cli=$id";
    $exec = mysqli_query($connexion, $sql);
    $row = mysqli_fetch_array($exec);
    echo json_encode($row);
}

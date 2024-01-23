<?php
include '../DATABASE/bd.php';

if (isset($_POST['data'])) {
    $id = $_POST['data'];
    $sql = "SELECT*FROM utilisateur WHERE Id_user=$id";
    $exec = mysqli_query($connexion, $sql);
    $row = mysqli_fetch_array($exec);
    echo json_encode($row);
}

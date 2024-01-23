<?php
include '../DATABASE/bd.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT*FROM materiel WHERE Id_mat='$id'";
    $exec = mysqli_query($connexion, $sql);
    $row = mysqli_fetch_array($exec);
    echo json_encode($row);
}

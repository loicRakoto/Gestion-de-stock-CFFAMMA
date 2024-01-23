<?php

require '../DATABASE/bd.php';
if (isset($_GET['alefa'])) {
    $id = $_GET['alefa'];
    $sql = "DELETE FROM client WHERE Num_cli=$id";
    $exec = mysqli_query($connexion, $sql);
    header('Location:client.php');
}

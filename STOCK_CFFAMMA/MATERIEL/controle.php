<?php
require '../DATABASE/bd.php';


if (isset($_GET['input'])) {
    $designation = $_GET['input'];
    $sql = "SELECT*FROM materiel WHERE Des_mat='$designation' ORDER BY Id_mat DESC LIMIT 1 ";
    $exec = mysqli_query($connexion, $sql);
    $out = NULL;
    $prefix = substr($designation, 0, 3); //recupere les 3 premier caractere du designation
    if (mysqli_num_rows($exec) == 0) {
        $out = $prefix . '1';
    } else {
        $row = mysqli_fetch_assoc($exec);
        $desBd = $row['Des_mat'];

        $lastID = $row['Id_mat'];
        if ($desBd == '') {
        } else {
            if ($desBd = $designation) {
                //si l'element existe dans la BD
                $idNow = substr($lastID, 3);
                $idNow = intval($idNow);
                $out = $prefix . ($idNow + 1);
            }
        }
    }

    echo ($out);
}

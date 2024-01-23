<?php
require "../../DATABASE/bd.php";

if (isset($_GET['del_id'])) {
    $numCom = $_GET['del_id'];

    //Affiche le N°Materiel correspondant au commande
    $sql1 = "SELECT Id_mat FROM commande WHERE Num_com=$numCom";
    $exec1 = mysqli_query($connexion, $sql1);
    $row1 = mysqli_fetch_assoc($exec1);
    $numMat = $row1['Id_mat'];

    //Suppression du cmd
    $sqlDel = "DELETE FROM commande WHERE Num_com=$numCom";
    $execDel = mysqli_query($connexion, $sqlDel);


    //Recuperation du materiel 
    $sqlRecovery = "UPDATE info SET Type_mat='ENTREE',Num_speciale='NULL',Validation_mat='NON VALIDER' WHERE Id_mat='$numMat'";
    $execRecovery = mysqli_query($connexion, $sqlRecovery);
    header('location:gererIndex.php');
}

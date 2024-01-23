<?php
require '../../DATABASE/bd.php';

$numCmd = mysqli_real_escape_string($connexion, $_POST['numCom']);
$numCli = mysqli_real_escape_string($connexion, $_POST['numCli']);
$numMat = mysqli_real_escape_string($connexion, $_POST['idMat']);
$dateCom = mysqli_real_escape_string($connexion, $_POST['date']);
$payement = mysqli_real_escape_string($connexion, $_POST['payement']);
$numSpe = mysqli_real_escape_string($connexion, $_POST['numSpeci']);
$icon = NULL;




$sqlUpdateCom = "UPDATE commande SET Id_mat='$numMat',Num_cli=$numCli,Date_com='$dateCom' WHERE Num_Com=$numCmd";
$execUpdateCom = mysqli_query($connexion, $sqlUpdateCom);

if ($payement == 'Oui') {
    $icon = 1;
    $sqlUpdateInfo = "UPDATE info SET Type_mat='SORTIE',Num_speciale='$numSpe',Validation_mat='VALIDER' WHERE Id_mat='$numMat'";
    $execUpdateInfo = mysqli_query($connexion, $sqlUpdateInfo);
} else {
    $icon = 2;
    $sqlUpdateInfo = "UPDATE info SET Type_mat='EN COURS',Num_speciale='$numSpe',Validation_mat='ATTENTE' WHERE Id_mat='$numMat'";
    $execUpdateInfo = mysqli_query($connexion, $sqlUpdateInfo);
}

echo ($icon);

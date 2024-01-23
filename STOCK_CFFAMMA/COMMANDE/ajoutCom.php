<?php
require '../DATABASE/bd.php';

$icon = NULL;
$typedecmd = mysqli_real_escape_string($connexion, $_POST['typeCmd']);
$numCli = mysqli_real_escape_string($connexion, $_POST['numCli']);
$idMat = mysqli_real_escape_string($connexion, $_POST['idMat']);
$paye = mysqli_real_escape_string($connexion, $_POST['payement']);
$numSpec = mysqli_real_escape_string($connexion, $_POST['numSpeci']);
$dateNow = date('Y-m-d h:i');

if ($typedecmd == 'ACHETER') {
    $icon = 1;
    $sqlAjout = "INSERT INTO commande(Id_mat,Num_cli,Date_com) VALUES('$idMat',$numCli,'$dateNow')";
    $execAjout = mysqli_query($connexion, $sqlAjout);

    $sqlInfo = "UPDATE info SET Type_mat='SORTIE',Num_Speciale='$numSpec',Validation_mat='VALIDER' WHERE Id_mat='$idMat'";
    $execInfo = mysqli_query($connexion, $sqlInfo);
} else {
    $icon = 2;
    $sqlCmd = "INSERT INTO commande(Id_mat,Num_cli,Date_com) VALUES('$idMat',$numCli,'$dateNow')";
    $execCmd = mysqli_query($connexion, $sqlCmd);

    $sqlInf = "UPDATE info SET Type_mat='EN COURS',Num_Speciale='$numSpec',Validation_mat='ATTENTE' WHERE Id_mat='$idMat' ";
    $execInf = mysqli_query($connexion, $sqlInf);
}

echo ($icon);

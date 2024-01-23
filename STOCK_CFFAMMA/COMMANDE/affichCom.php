<?php
require '../DATABASE/bd.php';

if (isset($_GET['envoyer'])) {

    $numCli = $_GET['envoyer'];

    $sqlCli = "SELECT*FROM client WHERE client.Num_cli=$numCli";
    $execCli = mysqli_query($connexion, $sqlCli);
    $rowCli = mysqli_fetch_assoc($execCli);

    $nom = $rowCli['Nom_cli'];
    $prenom = $rowCli['Prenom_cli'];
    $cin = $rowCli['CIN_cli'];
    $tel = $rowCli['Tel_cli'];
    $afficher = "    
    <div>
        <h5>CLIENT</h5>
        <p>Nom du client :  " . $nom . " </p>
        <p>CIN du client :  " . $cin . " </p>
        <p>Télephone :  " . $tel . " </p>
    </div>";

    echo ($afficher);
}

if (isset($_GET['send'])) {
    $Idmat = $_GET['send'];
    $sqlMateriel = "SELECT*FROM materiel INNER JOIN info ON materiel.Id_mat=info.Id_mat WHERE materiel.Id_mat='$Idmat'";
    $execMat = mysqli_query($connexion, $sqlMateriel);
    $rowMat = mysqli_fetch_assoc($execMat);

    $Design = $rowMat['Des_mat'];
    $Prix = $rowMat['Prix_mat'];
    $Valid = $rowMat['Validation_mat'];
    $sortie = "    
    <div>
        <h5>MATERIEL</h5>
        <p>Désignation :  " . $Design . " </p>
        <p>Prix :  " . $Prix . " Ar</p>
        <p>Validation :  " . $Valid . " </p>
    </div>";

    echo ($sortie);
}

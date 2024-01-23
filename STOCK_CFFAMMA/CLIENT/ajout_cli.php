<?php
require '../DATABASE/bd.php';
if (isset($_POST['enregistrer'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $CIN = $_POST['cin'];
    $tel = $_POST['tel'];


    $sql = "INSERT INTO client(Nom_cli,Prenom_cli,CIN_cli,Tel_cli) VALUES('$nom','$prenom','$CIN','$tel')";
    $exec = mysqli_query($connexion, $sql);

    header('Location:client.php');
}

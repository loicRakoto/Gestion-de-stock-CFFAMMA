<?php
$server = "127.0.0.1";
$user = "root";
$password = "";
$bd = "cffamma";

$cnx = new mysqli($server, $user, $password, $bd);


require '../DATABASE/bd.php';

$id = mysqli_real_escape_string($cnx, $_POST["num_modal"]);
$nom = mysqli_real_escape_string($cnx, $_POST["nom_modal"]);
$prenom = mysqli_real_escape_string($cnx, $_POST["prenom_modal"]);
$cin = mysqli_real_escape_string($cnx, $_POST["cin_modal"]);
$tel = mysqli_real_escape_string($cnx, $_POST["tel_modal"]);

$sql = "UPDATE client SET Nom_cli='$nom',Prenom_cli='$prenom',CIN_cli='$cin',Tel_cli='$tel' WHERE Num_cli=$id";
$exec = mysqli_query($connexion, $sql);
header("location:client.php");

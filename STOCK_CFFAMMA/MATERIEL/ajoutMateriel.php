<?php
require '../DATABASE/bd.php';
$server = "127.0.0.1";
$user = "root";
$password = "";
$bd = "cffamma";
$cnx = new mysqli($server, $user, $password, $bd);


$id = mysqli_real_escape_string($connexion, $_POST['IdMateriel']);
$design = mysqli_real_escape_string($connexion, $_POST['DesignMateriel']);
$prix = mysqli_real_escape_string($connexion, $_POST['PrixMateriel']);




$sqlAjout = "INSERT INTO materiel(Id_mat,Des_mat,Prix_mat) VALUES('$id','$design',$prix)";
mysqli_query($connexion, $sqlAjout);

//AJOUT DANS LA TABLE INFO (information concernant le materiel)

$sql1 = "INSERT INTO info(Id_mat,Type_mat,Num_speciale,Validation_mat) VALUES('$id','ENTREE','NULL','NON VALIDER')";
$exec = mysqli_query($connexion, $sql1);

header('Location:materiel.php');

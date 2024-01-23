<?php
$server="127.0.0.1";
$user="root";
$password="";
$bd="cffamma";

$connexion=new mysqli($server,$user,$password,$bd);
if ($connexion->connect_errno) {
    echo "echec de connection mysql:(" . $connexion->connect_errno . ")" . $mysqli->connect_error;
}

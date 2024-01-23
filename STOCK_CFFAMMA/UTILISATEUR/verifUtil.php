<?php
require '../DATABASE/bd.php';
require '../DATABASE/cnxVerif.php';
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sqlVerif = "SELECT*FROM utilisateur WHERE Username='$username' AND Pass='$password'";
    $execVerif = mysqli_query($connexion, $sqlVerif);
    $rowVerif = mysqli_fetch_assoc($execVerif);
    $usernameBD = $rowVerif['Username'];
    $passwordBD = $rowVerif['Pass'];



    if ($username == $usernameBD and $password == $passwordBD) {

        session_start();
        $_SESSION['connecte'] = 1;
        $_SESSION['utilisateur'] = $usernameBD;
        header('Location:../DASHBOARD/dashboard.php');
    } else {
        echo ('Veuillez verifier les donnees saisie');
        header('Location:../index.php?acces=0');
    }
}

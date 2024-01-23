<?php

function est_connecter()
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    return !empty($_SESSION['connecte']);
}

function obligation_connect()
{

    if (!est_connecter()) {
        header("Location:../index.php");
        exit();
    }
}

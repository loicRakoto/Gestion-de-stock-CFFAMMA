<?php
session_start();
unset($_SESSION['connecte']);
unset($_SESSION['utilisateur']);
header('Location:../index.php');

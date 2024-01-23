<?php
$modalAff = '';
if (isset($_GET['acces'])) {

    $accesVal = $_GET['acces'];
    if ($accesVal == 0) {
        $modalAff = 'REFUSER';
    }
}
require 'DATABASE/cnxVerif.php';
if (est_connecter()) {
    header('Location:DASHBOARD/dashboard.php');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="STYLE/fontawesome-free-6.1.1-web/fontawesome-free-6.1.1-web/css/all.css">
    <link rel="stylesheet" href="STYLE/css/bootstrap.min.css">
    <script type="text/Javascript" src="STYLE/JQuery.js"></script>
    <script type="text/Javascript" src="STYLE/js/bootstrap.min.js"></script>
    <script type="text/Javascript" src="style.js"></script>
    <title>CFFAMA</title>
</head>

<body>
    <div class="loadere">
        <div class="contenee">
            <div class="iconee">
                <i class="fa-solid fa-arrows-spin fa-spin"></i>
            </div>
            <div class="textee">
                <span class="textChar">Chargement</span>
            </div>
        </div>
    </div>
    <header id="header">

        <div class="logo"><span>C</span>FFAMMA</div>
        <ul class="navbar">
            <li><a href="#">Accueil</a></li>
            <li><a href="#foot">A propos</a></li>
            <li>
                <div class="boutton">
                    <button class="login" data-bs-toggle="modal" data-bs-target="#modalogin" id="btnAkisaka"> <a href="#">J'ai déja un
                            compte</a>
                    </button>

                </div>
            </li>
        </ul>
    </header>

    <section class="bood">
        <div class="contenu">
            <p>Centre de Fabrication, de Formation et D'Application du Machinisme et de la Mecanisation Agricole
            </p>
        </div>
    </section>

    <section class="apropos">

    </section>

    <footer>
        <div class="foot" id="foot">
            <div class="copyright">
                <h4>Copyright 2022</h4>
            </div>
            <div class="information">
                <ul class="footInfo">
                    <li>
                        <a>
                            <span class="icon"><i class="fa-solid fa-phone"></i></span>
                            <span class="title">034 02 378 92</span>
                        </a>
                    </li>
                    <li>
                        <a>
                            <span class="icon"><i class="fa-solid fa-paper-plane"></i></span>
                            <span class="title">cfama_abe@yahoo.fr</span>
                        </a>
                    </li>
                    <li>
                        <a>
                            <span class="icon"><i class="fa-brands fa-facebook"></i></span>
                            <span class="title">Cffamma</span>
                        </a>
                    </li>
                    <li>
                        <a>
                            <span class="icon"><i class="fa-solid fa-location-dot"></i></span>
                            <span class="title">IVORY,Antsirabe,Madagascar</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </footer>

    <!-- ===================================== MODAL DE LOGIN ========================================== -->
    <div class="modale">
        <div class="modal" tabindex="-1" id="modalogin">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header headir">
                        <div class="user">
                            <i class="fa-solid fa-circle-user"></i>
                        </div>
                        <div class="modal-title">
                            <h4>
                                User Login
                            </h4>
                        </div>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="UTILISATEUR/verifUtil.php" id="lolog">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Username" name="username" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Password" name="password" required>
                            </div>
                            <div class="form-group boto">
                                <input type="submit" id="btn" class="btn btn-primary" value="Se connecter" name="login" required>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- ===================================== ================================================ -->

    <input id="verification" value="<?= $modalAff ?>" hidden>

    <!-- ===================================== MODAL D' ERREUR ========================================== -->
    <div class="modal" tabindex="-1" id="modalError">
        <div class="modal-dialog">
            <div class="modal-content refus">

                <div class="modal-body refus">

                    <div class="iconRefus"><i class="fa-solid fa-circle-xmark"></i></div>
                    <div class="texte">
                        <div class="txtRefus">
                            ACCES REFUSER
                        </div>
                        <div>
                            Votre Nom/mot de passe est incorrect
                        </div>
                        <br>
                        <div class="btnOK">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>


    <!-- =========================================================== ========================================== -->



    <style>
        #btnAkisaka {
            margin-right: 20px;
        }

        .modal-content {
            margin-top: 100px;
            padding: 20px 25px;
            border: none;
            width: 86%;
            border-radius: 20px;
        }

        .modal-header {
            display: block;
            border-bottom: none;
            position: relative;
            justify-content: center;
        }

        .modal-header h4 {
            font-size: 25px;
            text-align: center;
            margin: 30 0 -15px;
            font-family: monospace;
        }

        .user {
            text-align: center;
            margin-bottom: 20px;
        }

        .user i {
            font-size: 80px;
        }

        .form-group input {
            margin-bottom: 20px;
        }

        .boto {
            margin-top: 31px;
        }

        input#btn {
            width: 100%;
            height: 44px;
        }

        .modal-content.refus {
            width: 495px;
        }

        .modal-body.refus {
            align-items: center;
            display: flex;
            text-align: center;
            justify-content: space-between;
        }

        .iconRefus i {
            font-size: 70px;
            color: #d32222;
        }

        .txtRefus {
            color: #d32222;
            font-size: 30px;
            border-bottom: 2px solid;
            margin-bottom: 15px;
        }

        .btnOK button {
            width: 100%;
            background-color: #235260;

            border: none;
        }

        .loadere {
            position: absolute;
            z-index: 9999;
            background-color: #fbfbfb;
            top: 0px;
            height: 100%;
            width: 100%;
            cursor: wait;
        }

        .contenee {
            margin-top: 100px;
        }

        .loadere .iconee {
            text-align: center;
        }

        .iconee i {
            font-size: 270px;
        }

        .loadere .textee {
            text-align: center;
            margin-top: 36px;
        }

        .textChar {
            font-size: 80px;
        }
    </style>
    <script>
        $(document).ready(function() {
            $('.loadere').fadeOut("1000");
            var refus = $('#verification').val();
            if (refus == 'REFUSER') {
                $('#modalError').modal('show');
            }

            $('button#btnAkisaka.login').click(function() {
                $('#lolog').reset();
            });
        });
    </script>

</body>

</html>
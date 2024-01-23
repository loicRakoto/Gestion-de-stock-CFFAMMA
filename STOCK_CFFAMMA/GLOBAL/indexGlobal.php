<?php
require '../DATABASE/cnxVerif.php';

obligation_connect();
$utilisateur = $_SESSION['utilisateur'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../STYLE/css/bootstrap.min.css">
    <link rel="stylesheet" href="../MENU/bootstrapStyle.css">
    <link rel="stylesheet" href="../STYLE/fontawesome-free-6.1.1-web/fontawesome-free-6.1.1-web/css/all.css">
    <script type="text/javascript" src="../STYLE/js/bootstrap.min.js">
    </script>
    <script type="text/javascript" src="../STYLE/JQuery.js"></script>
    <title>VUE DE STOCK</title>
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
    <div class="container1">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon"><i class="fa-solid fa-user"></i></span>
                        <span class="title"><?= $utilisateur ?></span>
                        <i class="fa-solid fa-circle"></i>
                    </a>
                </li>
                <li>
                    <a href="../DASHBOARD/dashboard.php">
                        <span class="icon"><i class="fa-brands fa-dashcube"></i></span>
                        <span class="title">DASHBOARD</span>
                    </a>
                </li>
                <li>
                    <a href="../EXPIRATION/expiration.php">
                        <span class="icon"><i class="fa-solid fa-bell"></i></span>
                        <span class="title">NOTIFICATION</span>
                    </a>
                </li>
                <li>
                    <a href="../CLIENT/client.php">
                        <span class="icon"><i class="fa-solid fa-id-card"></i></span>
                        <span class="title">CLIENT</span>
                    </a>
                </li>
                <li>
                    <a href="../MATERIEL/materiel.php">
                        <span class="icon"><i class="fa-solid fa-cubes"></i></span>
                        <span class="title">MATERIEL</span>
                    </a>
                </li>
                <li>
                    <a href="../COMMANDE/commande.php">
                        <span class="icon"><i class="fa-solid fa-cart-shopping"></i></span>
                        <span class="title">VENTE</span>
                    </a>
                </li>
                <li>
                    <a href="../COMMANDE/GERER/gererIndex.php">
                        <span class="icon"><i class="fa-brands fa-shopify"></i></span>
                        <span class="title">GESTION COMMANDE</span>
                    </a>
                </li>
                <li class="hovered">
                    <a href="indexGlobal.php">
                        <span class="icon"><i class="fa-solid fa-arrow-trend-up"></i></span>
                        <span class="title">VUE DE STOCK</span>
                    </a>
                </li>
                <li>
                    <a href="../UTILISATEUR/inscription.php">
                        <span class="icon"><i class="fa-solid fa-user-plus"></i></span>
                        <span class="title">S'ENREGISTRER</span>
                    </a>
                </li>
                <li>
                    <a href="../UTILISATEUR/deconnexion.php">
                        <span class="icon"><i class="fa-solid fa-arrow-right-from-bracket"></i></span>
                        <span class="title">SE DECONNECTER</span>
                    </a>
                </li>
            </ul>

        </div>

        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <i class="fa-solid fa-caret-right"></i>
                </div>
                <div class="info">
                    <label>
                        <h3>VUE GLOBAL DES STOCK</h3>
                    </label>
                </div>
            </div>
            <div class="contenu">
                <div class="contTop">
                    <div class="search">
                        <label>
                            <input type="text" placeholder="Rechercher" id="recherche">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </label>
                    </div>
                    <div class="bton">
                        <form action="totalite.php">
                            <button type="submit" class="btn btn-secondary"> BILAN </button>
                        </form>

                    </div>
                </div>
                <div class="affich">
                    <div id="content"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- ========================================== S T Y L E ==============================================-->
    <style>
        .search {
            width: 400px;
            position: relative;
            margin: 10px 10px;

        }

        .search label {
            width: 100%;
            position: relative;
        }

        .search label input {
            width: 80%;
            height: 40px;
            border-radius: 40px;
            padding: 5px 40px;
            outline: none;
            border: 1px solid black;
            font-size: 15px;
            text-align: center;
        }

        .search label .fa-solid {
            position: absolute;
            top: 0;
            left: 10px;
            font-size: 22px;
            margin-top: 9px;
            margin-left: 8px;
        }

        .contTop {
            justify-content: space-between;
            display: flex;
            padding: 20px;
        }

        .contenu {
            margin-left: 40px;
            margin-right: 40px;
        }

        .bton {
            padding: 10px;
        }

        .bton .btn {
            width: 120px;
            color: white;
            background-color: #154a39;
        }
    </style>

    <!-- ===========================================================================================-->

    <script>
        $(document).ready(function() {
            $('.loadere').fadeOut("1000");
            $.ajax({
                url: "selectGlobal.php",
                success: function(dataabc) {
                    //console.log(dataabc);
                    $("#content").html(dataabc);
                }
            });

            $('#recherche').keyup(function() {
                var valeur = $(this).val();
                $.ajax({
                    url: 'rechGlobal.php',
                    method: 'GET',
                    data: 'rech=' + valeur,
                    success: function(affich) {
                        $("#content").html(affich);
                    }
                });
            });

        });

        //Toggle menu
        let togle = document.querySelector('.toggle');
        let navigation = document.querySelector('.navigation');
        let main = document.querySelector('.main');

        togle.onclick = function() {
            navigation.classList.toggle('active');
            main.classList.toggle('active');

        }

        //Add hovered in selected item
        let list = document.querySelectorAll('.navigation li');

        function activeLink() {
            list.forEach((item) => {
                item.classList.remove('hovered');
                this.classList.add('hovered');
            });
        }
        list.forEach((item) => {
            item.addEventListener('click', activeLink);
        });
    </script>

</body>

</html>
<?php
require '../../DATABASE/bd.php';

require '../../DATABASE/cnxVerif.php';

obligation_connect();
$utilisateur = $_SESSION['utilisateur'];

$sql = 'SELECT DISTINCT Num_cli FROM commande';
$exec = mysqli_query($connexion, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../STYLE/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../STYLE/fontawesome-free-6.1.1-web/fontawesome-free-6.1.1-web/css/all.css">
    <link rel="stylesheet" href="../../MENU/bootstrapStyle.css">
    <script type="text/javascript" src="../../STYLE/js/bootstrap.min.js">
    </script>
    <script type="text/javascript" src="../../STYLE/JQuery.js"></script>
    <title>GESTION DES COMMANDES</title>
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
                    <a href="../../DASHBOARD/dashboard.php">
                        <span class="icon"><i class="fa-brands fa-dashcube"></i></span>
                        <span class="title">DASHBOARD</span>
                    </a>
                </li>
                <li>
                    <a href="../../EXPIRATION/expiration.php">
                        <span class="icon"><i class="fa-solid fa-bell"></i></span>
                        <span class="title">NOTIFICATION</span>
                    </a>
                </li>
                <li>
                    <a href="../../CLIENT/client.php">
                        <span class="icon"><i class="fa-solid fa-id-card"></i></span>
                        <span class="title">CLIENT</span>
                    </a>
                </li>
                <li>
                    <a href="../../MATERIEL/materiel.php">
                        <span class="icon"><i class="fa-solid fa-cubes"></i></span>
                        <span class="title">MATERIEL</span>
                    </a>
                </li>
                <li>
                    <a href="../commande.php">
                        <span class="icon"><i class="fa-solid fa-cart-shopping"></i></span>
                        <span class="title">VENTE</span>
                    </a>
                </li>
                <li class="hovered">
                    <a href="gererIndex.php">
                        <span class="icon"><i class="fa-brands fa-shopify"></i></span>
                        <span class="title">GESTION COMMANDE</span>
                    </a>
                </li>
                <li>
                    <a href="../../GLOBAL/indexGlobal.php">
                        <span class="icon"><i class="fa-solid fa-arrow-trend-up"></i></span>
                        <span class="title">VUE DE STOCK</span>
                    </a>
                </li>
                <li>
                    <a href="../../UTILISATEUR/inscription.php">
                        <span class="icon"><i class="fa-solid fa-user-plus"></i></span>
                        <span class="title">S'ENREGISTRER</span>
                    </a>
                </li>
                <li>
                    <a href="../../UTILISATEUR/deconnexion.php">
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
                        <h3>GESTION DES COMMANDES</h3>
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
                        <i class="fas fa-file-invoice" value="facture" id="fact" data-bs-toggle='modal' data-bs-target='#dataModal'></i>
                    </div>
                </div>
                <div class="contContent">
                    <div id="content">

                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- ======================================        S T Y L E   ===============================================  -->
    <style>
        .contenu {
            margin-left: 36px;
            margin-right: 36px;
        }

        .contTop {
            padding: 20px;
            display: flex;
            justify-content: space-between;
        }

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

        .bton {
            width: 100px;
        }

        .bton .fas {
            width: 100px;
            padding: 15px;
            display: block;
            font-size: 35px;
            margin-left: 45px;
            cursor: pointer;
            color: #a72a47;
        }

        tbody th {
            color: #ed4227;
        }

        button#generer {
            width: 100%;
        }
    </style>
    <!-- ======================================================================================================================  -->


    <!-- ======================================        M O D A L     ===============================================  -->

    <div class="modal" tabindex="-1" id="dataModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="materielDetail">GENERATION FACTURE</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="formu" action="gererFacture.php">

                        <div class="form-group">
                            Numero client
                            <select class="form-select form-select-sm" name="numCli" id="numCli">
                                <option selected value="x">ouvrir</option>
                                <?php while ($row = mysqli_fetch_assoc($exec)) { ?>
                                    <option value="<?= $row['Num_cli'] ?>"><?= $row['Num_cli'] ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group dateComan">
                        </div>



                        <br>
                        <button type="submit" class="btn btn-success" id="generer" name="generer">GENERER</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- ======================================================================================================================  -->



    <script>
        $(document).ready(function() {
            $('.loadere').fadeOut("1000");
            $.ajax({
                url: "gererSelect.php",
                success: function(dataabc) {
                    //console.log(dataabc);
                    $("#content").html(dataabc);
                }
            });

            $('#recherche').keyup(function() {
                var valeur = $(this).val();
                $.ajax({
                    url: 'gererRech.php',
                    method: 'GET',
                    data: 'rech=' + valeur,
                    success: function(affich) {
                        $("#content").html(affich);
                    }
                });
            });

            $('.modif').click(function() {
                alert('reussie');
            });

            $('select#numCli').change(function() {
                var nbr = $(this).val();
                $.ajax({
                    method: 'GET',
                    data: 'envoi=' + nbr,
                    url: 'gererDate.php',
                    success: function(affichage) {

                        $('.dateComan').html(affichage);
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
<?php
require '../DATABASE/bd.php';
require '../DATABASE/cnxVerif.php';

obligation_connect();


$utilisateur = $_SESSION['utilisateur'];

//TOTAL DES UTILISATEUR
$sqlUtil = "SELECT COUNT(*) FROM utilisateur";
$execUtil = mysqli_query($connexion, $sqlUtil);
$row = mysqli_fetch_assoc($execUtil);
$util = implode($row);

//TOTAL DES CLIENT
$sqlCli = "SELECT COUNT(*) FROM client";
$execCli = mysqli_query($connexion, $sqlCli);
$rowCli = mysqli_fetch_assoc($execCli);
$cli = implode($rowCli);

//TOTAL STOCK
$sqlTotal = "SELECT COUNT(*) FROM materiel";
$execTotal = mysqli_query($connexion, $sqlTotal);
$rowTotal = mysqli_fetch_assoc($execTotal);
$totalMat = implode($rowTotal);

//Stock entree
$sqlEntre = "SELECT COUNT(*) FROM info WHERE Type_mat='ENTREE'";
$execEntre = mysqli_query($connexion, $sqlEntre);
$rowEntre = mysqli_fetch_assoc($execEntre);
$entree = implode($rowEntre);

//Stock sortie
$sqlSortie = "SELECT COUNT(*) FROM info WHERE Type_mat='SORTIE'";
$execSortie = mysqli_query($connexion, $sqlSortie);
$rowSortie = mysqli_fetch_assoc($execSortie);
$sortie = implode($rowSortie);

//Stock en attente
$sqlAttente = "SELECT COUNT(*) FROM info WHERE Type_mat='EN COURS'";
$execAttente = mysqli_query($connexion, $sqlAttente);
$rowAttente = mysqli_fetch_assoc($execAttente);
$Attente = implode($rowAttente);


//$date = date("y-m-d h:i");
// echo ($date);
// $prefix = substr($date, 0, 3);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../STYLE/css/bootstrap.min.css">
    <link rel="stylesheet" href="../STYLE/fontawesome-free-6.1.1-web/fontawesome-free-6.1.1-web/css/all.css">
    <link rel="stylesheet" href="../MENU/bootstrapStyle.css">
    <script type="text/javascript" src="../STYLE/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../STYLE/JQuery.js"></script>
    <script src="../STYLE/Chart.js-3.8.0/Chart.js-3.8.0/Chart.js"></script>
    <title>DASHBOARD</title>



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
                <li class="hovered">
                    <a href="dashboard.php">
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
                <li>
                    <a href="../GLOBAL/indexGlobal.php">
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
                        <h3>DASHBOARD</h3>
                    </label>
                </div>
            </div>
            <div class="contenu">
                <div class="cardBox">
                    <div class="carde">
                        <div>
                            <div class="Number"><?= $util ?></div>
                            <div class="cardName">Utilisateur</div>
                            <input type="hidden" id="utilisateur" value="<?= $util ?>">
                        </div>
                        <div class="iconBx">
                            <i class="fa-solid fa-eye"></i>
                        </div>
                    </div>
                    <div class="carde">
                        <div>
                            <div class="Number"><?= $cli ?></div>
                            <div class="cardName">Client</div>
                            <input type="hidden" id="client" value="<?= $cli ?>">
                        </div>
                        <div class="iconBx">
                            <i class="fa-solid fa-people-group"></i>
                        </div>
                    </div>
                    <div class="carde">
                        <div>
                            <div class="Number"> <?= $totalMat ?></div>
                            <div class="cardName">Stock total</div>
                            <input type="hidden" id="total" value="<?= $totalMat ?>">
                        </div>
                        <div class="iconBx">
                            <i class="fa-solid fa-layer-group"></i>
                        </div>
                    </div>
                    <div class="carde">
                        <div>
                            <div class="Number"> <?= $entree ?></div>
                            <div class="cardName">Stock disponible</div>
                            <input type="hidden" id="disponible" value="<?= $entree ?>">
                        </div>
                        <div class="iconBx">
                            <i class="fa-solid fa-basket-shopping"></i>
                        </div>
                    </div>
                    <div class="carde">
                        <div>
                            <div class="Number"> <?= $sortie ?></div>
                            <div class="cardName">Stock vendu</div>
                            <input type="hidden" id="vendu" value="<?= $sortie ?>">
                        </div>
                        <div class="iconBx">
                            <i class="fa-solid fa-hand-holding-dollar"></i>
                        </div>
                    </div>
                    <div class="carde">
                        <div>
                            <div class="Number"> <?= $Attente ?></div>
                            <div class="cardName">Stock en attente</div>
                            <input type="hidden" id="attente" value="<?= $Attente ?>">
                        </div>
                        <div class="iconBx">
                            <i class="fa-solid fa-clock-rotate-left"></i>
                        </div>
                    </div>
                </div>
                <div class="graphe">
                    <div class="soratra">
                        <h3>GRAPHIQUE DES STOCK</h3>
                    </div>
                    <div class="controler">
                        <canvas id="myChart" width="10px" height="10px"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .graphe {
            display: flex;
            align-items: center;
            margin-left: 20px;
            margin-right: 20px;
            justify-content: space-evenly;
            margin-bottom: 110px;
        }

        .controler {
            width: 420px;

        }

        .cardBox {
            position: relative;
            width: 100%;
            padding: 20px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-gap: 30px;
            margin-bottom: 120px;
        }

        .cardBox .carde {
            position: relative;
            background: #ffffff;
            color: #2e2b2b;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 4px 10px #e7dfdf;
            display: flex;
            justify-content: space-between;
            cursor: pointer;
        }

        .cardBox .carde .Number {
            font-weight: 500;
            font-size: 2.5em;
            color: var(--red2);
        }

        .cardBox .carde .cardName {
            font-size: 16px;
            margin-top: 29px;
        }

        .cardBox .carde .iconBx {
            font-size: 3.5em;
        }

        .cardBox .carde .iconBx i {
            font-size: 38px;
        }

        .cardBox .carde:hover {
            background: var(--red2);
        }

        .cardBox .carde:hover .Number,
        .cardBox .carde:hover .cardName,
        .cardBox .carde:hover .iconBx,
        .cardBox .carde:hover .iconBx i {
            color: white;

        }
    </style>
    <script>
        $(document).ready(function() {
            $('.loadere').fadeOut("1000");
            vendu = $('#vendu').val();
            attente = $('#attente').val();
            disponible = $('#disponible').val();
            const ctx = $('#myChart');
            var xvalue = ["Stock vendu", "Stock en attente", "Stock disponible"];
            var yvalue = [vendu, attente, disponible];

            const myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: xvalue,
                    datasets: [{
                        data: yvalue,
                        backgroundColor: ['rgb(8, 112, 77)', 'rgb(196, 14, 69)', 'rgb(9, 113, 199)'],
                        // borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)'],
                        borderWidth: 2
                    }]
                },
                options: {
                    title: {
                        display: true,
                        text: "GRAPHE DE STOCK",
                    }
                }
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
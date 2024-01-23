<?php
require '../DATABASE/bd.php';

require '../DATABASE/cnxVerif.php';

obligation_connect();

$utilisateur = $_SESSION['utilisateur'];


$sqlCli = 'SELECT*FROM client';
$execCli = mysqli_query($connexion, $sqlCli);

$sqlMat = "SELECT*FROM materiel INNER JOIN info ON materiel.Id_mat=info.Id_mat WHERE Num_speciale='NULL' AND Type_mat='ENTREE'";
$execMat = mysqli_query($connexion, $sqlMat);

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
    <title>VENTE</title>
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
                <li class="hovered">
                    <a href="commande.php">
                        <span class="icon"><i class="fa-solid fa-cart-shopping"></i></span>
                        <span class="title">VENTE</span>
                    </a>
                </li>
                <li>
                    <a href="GERER/gererIndex.php">
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
                        <h3>VENTES</h3>
                    </label>
                </div>
            </div>
            <div class="contenu">

                <section class="formu">
                    <div class="formulaire">

                        <form id="forme">
                            <div class="form-group">
                                <label for="numCli" id="cli"> CLIENT </label>
                                <select class="form-select form-select-sm" name="numCli" id="numCli">
                                    <option selected value="x">N°client</option>
                                    <?php while ($row = mysqli_fetch_assoc($execCli)) { ?>
                                        <option value="<?= $row['Num_cli'] ?>">
                                            <?= $row['Num_cli'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <br>
                            </div>
                            <div class="form-group">
                                <label for="id_mat" id="mat"> MATERIEL </label>
                                <select class="form-select form-select-sm" name="idMat" id="idMat">
                                    <option selected value="x">Id matériel</option>
                                    <?php while ($row = mysqli_fetch_assoc($execMat)) { ?>
                                        <option value="<?= $row['Id_mat'] ?>">
                                            <?= $row['Id_mat'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <br>
                            </div>
                            <div class="form-group" id="bay">
                                <div for="paye" id="paypay">PAYEMENT</div>

                                Oui <input type="radio" id="paye" name="payement" value="Oui" onclick="ouvrir();" required />
                                Non <input type="radio" id="nonPaye" name="payement" value="Non" onclick="ouvrir();" required />
                            </div>
                            <div class="form-group">
                                <input type="text" name="typeCmd" id="typeCmd" hidden />
                            </div>
                            <br>
                            <div class="form-group cont" id="cont">
                                <label for="numSpeciale">Numéro spécifique</label>
                                <input type="text" name="numSpeci" id="numSpeciale" />
                            </div>
                            <div class="form-group" id="erg">
                                <input type="submit" value="ENREGISTRER" name="enreg" id="enreg">
                            </div>
                        </form>
                    </div>
                    <div class="affichage">
                        <div class="affCli" style="display: none;">
                            <div id="affichageClient"></div>
                        </div>
                        <div class="affMat" style="display: none;">
                            <div id="affichageMateriel"></div>
                        </div>
                    </div>
                </section>

                <section>
                    <form action="GERER/gererIndex.php" method="POST">
                        <input type="submit" value="GERER LES COMMANDES" name="gerer" id="Btn_gerer">
                    </form>
                </section>

            </div>
        </div>
    </div>

    <!-- ==============================================MODAL DE PAYEMENT=================================================-->


    <div class="modal" tabindex="-1" id="modalPaye">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="top">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="corp">
                        <div class="iconn">
                            <i class="fa-regular fa-circle-check"></i>
                        </div>
                        <div class="texte">
                            <h3>Paiement réussi</h3>
                            Veuillez le verifier dans le gestionnaire des commandes
                        </div>
                        <div>
                            <button type="button" class="btn btn-secondary bout" data-bs-dismiss="modal">OK</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <style>
        .top {
            justify-items: end;
            display: grid;
        }

        .texte {
            padding: 9px 0px;
        }

        .corp {
            text-align: center;
        }

        .corp .iconn i {
            font-size: 60px;
            color: #34cd63;
        }

        button.bout {
            color: white;
            border: none;
            background-color: #31a354
        }
    </style>




    <!-- ==============================================XXXXXXXXXXXXXXXXXXXXXXXXXXXX=================================================-->

    <!-- ========================================== S T Y L E  ==============================================-->
    <style>
        .formulaire {
            border-width: 1px;
            border-style: solid;
            border-radius: 15px;
            background-color: rgb(251 251 251);
            padding: 15px;
            width: 450px;
            height: 369px;
            box-shadow: 0px 0px 5px #666b;
            border: none;
        }

        #enreg {
            color: white;
            border-radius: 10px;
            border-width: 1px;
            width: 415px;
            height: 40px;
            margin-top: 20px;
            background-color: #5c2436;
            border: none;
        }

        .formu {
            display: flex;
        }

        .affichage {
            width: 100%;
            margin-left: 110px;
        }

        .affCli {
            border: 1px solid black;
            border-top-left-radius: 23px;
            border-bottom-left-radius: 60px;
            border-top-right-radius: 60px;
            border-bottom-right-radius: 23px;
            padding: 10px;
            margin-bottom: 15px;
            text-align: center;
            background-color: #ecfff2;
        }

        .affMat {
            border: 1px solid black;
            border-top-left-radius: 60px;
            border-bottom-left-radius: 23px;
            border-top-right-radius: 23px;
            border-bottom-right-radius: 60px;
            padding: 10px;
            text-align: center;
            background-color: #fff1d7;
        }

        .contenu {
            margin-left: 25px;
            margin-right: 25px;
        }

        #Btn_gerer {
            margin-top: 40px;
            width: 330px;
            height: 35px;
            background-color: #17171e;
            color: white;
            border-radius: 30px;
            border: none;
        }
    </style>
    <!-- ========================================== XXXXXXX ==============================================-->



    <script type="text/javascript" src="scriptCom.js"></script>
</body>

</html>
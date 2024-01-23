<?php
require '../DATABASE/bd.php';
require '../DATABASE/cnxVerif.php';

obligation_connect();


$utilisateur = $_SESSION['utilisateur'];

$sql = "SELECT*FROM client";
$exec = mysqli_query($connexion, $sql);

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
    <title>CLIENT</title>
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
                <li class="hovered">
                    <a href="client.php">
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

                        <h3>INFORMATION CLIENTS</h3>


                    </label>
                </div>
            </div>
            <div class="contenu">
                <section>
                    <div class="">
                        <div class="formulaire">
                            <form method="POST" action="ajout_cli.php">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Nom</span>
                                    <input type="text" class="form-control" id="nom" name="nom" required>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Prenom</span>
                                    <input type="text" class="form-control" id="prenom" name="prenom" required>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">CIN</span>
                                    <input type="text" class="form-control" id="cin" name="cin" size="12" maxlength="12" required>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Telephone</span>
                                    <input type="text" class="form-control" id="tel" name="tel" size="10" maxlength="10" required>
                                </div>

                                <button type="submit" class="btn btn-secondary" name="enregistrer">ENREGISTRER</button>
                            </form>
                        </div>
                        <div class="search">
                            <input type="text" placeholder="Rechercher" id="recherche">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </div>
                        <div class="tableau">
                            <table class='table'>
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Nom</th>
                                        <th>Prenom</th>
                                        <th>CIN</th>
                                        <th>Telephone</th>
                                        <th colspan="2">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php while ($out = mysqli_fetch_assoc($exec)) { ?>
                                        <tr>
                                            <td> <?= $out['Num_cli'] ?> </td>
                                            <td> <?= $out['Nom_cli'] ?> </td>
                                            <td> <?= $out['Prenom_cli'] ?> </td>
                                            <td> <?= $out['CIN_cli'] ?> </td>
                                            <td> <?= $out['Tel_cli'] ?> </td>
                                            <td>
                                                <a class="fa-solid fa-edit fa-1x modif" style="color: rgb(6, 131, 131); cursor: pointer;" id="<?php echo ($out['Num_cli']) ?>"></a>
                                            </td>
                                            <td>
                                                <a class="fa-solid fa-trash fa-1x suppr" style="color: rgb(190, 31, 31); cursor: pointer;" href="delCli.php?alefa=<?php echo ($out['Num_cli']) ?>"></a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- ========================================== STYLES ==============================================-->

    <style>
        .formulaire {
            border: none;
            border-radius: 30px;
            margin-left: 40px;
            background-color: white;
            width: 550px;
            box-shadow: 0px 0px 5px #666b;
            padding: 25px;

        }

        .formulaire .btn {
            color: white;
            background-color: #d71340;
            border: none;
            width: 500px;
            border-radius: 40px;
        }

        .tableau {

            margin-top: 25px;
            color: var(--red2);
            margin-left: 40px;
            margin-right: 40px;
        }

        .search {
            margin-left: 40px;
            display: flex;
            width: 89%;
            justify-content: end;
            padding-top: 20px;
        }

        .search i {
            font-size: 23px;
            align-items: center;
            bottom: 3px;
            display: grid;
            position: absolute;
            margin-right: 192px;
            color: #4e5858;
        }

        .search input {
            border: 1px solid #d0d0d0;
            border-radius: 9px;
            height: 30px;
            width: 230px;
            text-align: center;
        }

        #bton {
            width: 100%;
            height: 40px;
            color: white;
            background-color: #21bdc5;
            border: none;
        }
    </style>
    <!-- ====================================================================================================-->



    <!-- Modal pour modification --------------------------------------------------------------------------------->
    <div class="modal" tabindex="-1" id="exampleModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Modification Client</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                    <?php

                    ?>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="POST" id='insertForm' action="modifSave.php">
                                <div class="input-group mb-3">
                                    <input type="hidden" class="form-control" id="id_modal" name="num_modal">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Nom</span>
                                    <input type="text" class="form-control" id="nom_modal" name="nom_modal">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Prenom</span>
                                    <input type="text" class="form-control" id="prenom_modal" name="prenom_modal">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">CIN</span>
                                    <input type="text" class="form-control" id="cin_modal" name="cin_modal">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Telephone</span>
                                    <input type="text" class="form-control" id="tel_modal" name="tel_modal">
                                </div>

                                <div id="affichage"></div>

                                <p align='center'>
                                    <button type="submit" class="btn btn-warning modifSave" id="bton" name="enregistrer">MODIFIER</button>
                                </p>
                            </form>
                        </div>
                    </div>

                </div>



            </div>
        </div>
    </div>
    <!-- ----------------------------------------------------------------------------------------------------------- -->

    <script>
        $(document).ready(function() {
            $('.loadere').fadeOut("1000");


            $('#tel').keyup(function() {

                var valeur = $(this).val();
                var long = valeur.length;

                if (isNaN(valeur)) {
                    $('#tel').val('');
                }



            });


            $(document).on('click', '.modif', function() {
                var id = $(this).attr('id');
                $.ajax({
                    type: "GET",
                    url: 'modifCli.php',
                    data: {
                        identifiant: id
                    },
                    dataType: 'json',
                    success: function(resultat) {
                        $('#id_modal').val(resultat.Num_cli);
                        $('#nom_modal').val(resultat.Nom_cli);
                        $('#prenom_modal').val(resultat.Prenom_cli);
                        $('#cin_modal').val(resultat.CIN_cli);
                        $('#tel_modal').val(resultat.Tel_cli);
                        $('#exampleModal').modal('show');
                    }
                });
            });



            $('#insertForm').submit(function(e) {
                // e.preventDefault();

                $.ajax({
                    method: 'POST',
                    url: 'modifSave.php',
                    data: $('#insertForm').serialize(),
                    success: function(data) {
                        $('#insertForm')[0].reset();
                        $('#exampleModal').modal('hide');
                    }

                })
            });

            $('#recherche').keyup(function() {
                var valeur = $(this).val();
                $.ajax({
                    url: 'recherche.php',
                    method: 'GET',
                    data: 'rech=' + valeur,
                    success: function(affich) {
                        $(".tableau").html(affich);
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

        window.onload = function() {

            /* On écoute l'évènement onkeypress, la variable e contiendra un
             * objet keyboard event */
            document.getElementById('cin').onkeypress = function(e) {

                /* e.keyCode contient le numéro de la touche pressée,
                 * après quelques tests (alert(e.keyCode);), les chiffres
                 * correspondent aux touches numérotées de 48 à 57. */
                return (e.keyCode >= 48 && e.keyCode <= 57);

            }


        }
    </script>
</body>

</html>
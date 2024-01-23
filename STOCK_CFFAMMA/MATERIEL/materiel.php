<?php
require '../DATABASE/bd.php';

require '../DATABASE/cnxVerif.php';

obligation_connect();
$utilisateur = $_SESSION['utilisateur'];


$sql = "SELECT*FROM materiel";
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
    <script type="text/javascript" src="../STYLE/JQuery.js"> </script>
    <script type="text/javascript" src="../STYLE/js/bootstrap.min.js"> </script>

    <title>MATERIEL</title>
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
                <li class="hovered">
                    <a href="materiel.php">
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
                        <h3>AJOUT MATERIAUX</h3>
                    </label>
                </div>
            </div>
            <div class="contenu">

                <!-- ======================================        TABLEAU D'AFFICHAGE     ===============================================  -->
                <div class="container2">
                    <div class="ambony">
                        <div class="btnajout" align='right'>
                            <i class="fa-solid fa-circle-plus fa-beat fa-2x" id="add" data-bs-toggle="modal" data-bs-target="#dataModal" style=" color: rgb(44, 94, 160); cursor: pointer;"></i>
                        </div>
                        <div class="search">
                            <label>
                                <input type="text" placeholder="Rechercher" id="recherche">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </label>
                        </div>
                    </div>
                    <div class="tableau">

                        <div id="materielTable">
                            <table class="table table-bordered">
                                <tr>
                                    <td align="center" style="font-weight: bold;">ID</td>
                                    <td align="center" style="font-weight: bold;">Designation</td>
                                    <td align="center" style="font-weight: bold;">Prix</td>
                                    <td align="center" style="font-weight: bold;">Action</td>
                                </tr>
                                <?php while ($row = mysqli_fetch_assoc($exec)) { ?>
                                    <tr>
                                        <td align="center"> <?= $row['Id_mat'] ?> </td>
                                        <td align="center"> <?= $row['Des_mat'] ?> </td>
                                        <td align="center"> <?= $row['Prix_mat'] ?> </td>
                                        <td align="center" width="20%">
                                            <i class="fa-solid fa-edit fa-2x modif" style="color: rgb(6, 131, 131); cursor: pointer;" id="<?php echo ($row['Id_mat']) ?>"></i>
                                            <i class="fa-solid fa-trash fa-2x suppri" style="color: rgb(190, 31, 31); cursor: pointer;" id="<?php echo ($row['Id_mat']) ?>"></i>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- ====================================================================================================================  -->

            </div>
        </div>
        <style>
            .tableau {

                margin-top: 35px;
                color: var(--red2);
            }

            .container2 {
                margin-left: 36px;
                margin-right: 36px;
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
        </style>


        <!-- ======================================        M O D A L     ===============================================  -->

        <div class="modal" tabindex="-1" id="dataModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="materielDetail">Materiel detail</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" id="formu">

                            <div class="form-group">
                                <label for="IdMateriel">Identifiant du Materiel </label>
                                <input type="text" name=" IdMateriel" class="form-control form-control-sm" id="identifiant" readonly>
                            </div>

                            <div class="form-group">
                                <label for="DesignMateriel">Designation du materiel</label>
                                <input type="text" name="DesignMateriel" class="form-control form-control-sm" id="designation">
                            </div>

                            <div class="form-group">
                                <label for="PrixMateriel">Prix du materiel</label>
                                <input type="text" name="PrixMateriel" class="form-control form-control-sm" id="prix">
                            </div>

                            <div class="form-group">
                                <input type="text" name="modify" class="form-control form-control-sm" id="modify" style="display: none;">
                            </div>

                            <br>
                            <input type="submit" class="btn btn-success" id="modifier" name="modifier" value="MODIFIER">
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <!-- ======================================================================================================================  -->
        <script>
            $(document).ready(function() {
                $('.loadere').fadeOut("1000");
                $(document).on('click', '#add', function() {
                    $('#formu')[0].reset();
                    $('#materielDetail').html("AJOUT D'UN MATERIEL");
                    $('#modifier').val('AJOUTER');
                    $('#insert').show();
                });

                $(document).on('click', '.suppri', function() {
                    var recup = $(this).attr('id');

                    $.ajax({
                        url: 'delMat.php',
                        method: 'GET',
                        data: 'id=' + recup,
                        success: function(ex) {
                            $('#materielTable').html(ex);
                        }
                    })
                });

                $(document).on('click', '.modif', function() {

                    var ident = $(this).attr('id');
                    $('#modifier').val('MODIFIER');
                    $('#modifier').show();
                    $('#insert').hide();


                    $.ajax({
                        url: 'modifMateriel.php',
                        data: {
                            id: ident
                        },
                        dataType: 'JSON',
                        method: 'GET',
                        success: function(recup) {
                            $('#identifiant').val(recup.Id_mat);
                            $('#designation').val(recup.Des_mat);
                            $('#prix').val(recup.Prix_mat);
                            $('#modify').val(recup.Id_mat);
                            //    $('#formu').attr("action", 'saveMaterielmodif.php');
                            $('#materielDetail').html('MODIFICATION DU MATERIEL');
                            $('#dataModal').modal('show');
                        }
                    });
                });

                $('#formu').submit(function(e) {
                    e.preventDefault();
                    $.ajax({
                        method: 'POST',
                        url: 'saveMaterielmodif.php',
                        data: $('#formu').serialize(),
                        beforeSend: function() {
                            $('#modifier').val('Inserting');
                        },
                        success: function(data) {
                            $('#formu')[0].reset();
                            $('#dataModal').modal('hide');
                            $('#materielTable').html(data);

                        }

                    })
                });
                //RECHERCHE
                $('#recherche').keyup(function() {
                    var valeur = $(this).val();
                    $.ajax({
                        url: 'rechMat.php',
                        method: 'GET',
                        data: 'rech=' + valeur,
                        success: function(affich) {
                            $("#materielTable").html(affich);
                        }
                    });
                });
                ////////////////////////////////////////////////////////////////////////////////////////////////////////////
                ////////////////////////////////////////////////////////////////////////////////////////////////////////////
                // Recup caractere saisie
                var ident;
                var saisie;
                $('#designation').keyup(function() {
                    saisie = $(this).val();
                    $.ajax({
                        url: 'controle.php',
                        method: 'GET',
                        data: 'input=' + saisie,
                        success: function(show) {
                            $('#identifiant').val(show);
                        },
                    });
                });
            });
            ////////////////////////////////////////////////////////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
                document.getElementById('prix').onkeypress = function(e) {

                    /* e.keyCode contient le numéro de la touche pressée,
                     * après quelques tests (alert(e.keyCode);), les chiffres
                     * correspondent aux touches numérotées de 48 à 57. */
                    return (e.keyCode >= 48 && e.keyCode <= 57);

                }
            }
        </script>

        <style>
            input#modifier {
                width: 100%;
            }
        </style>

</body>

</html>
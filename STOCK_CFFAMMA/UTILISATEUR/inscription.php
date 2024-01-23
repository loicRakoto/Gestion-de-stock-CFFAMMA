<?php
require '../DATABASE/bd.php';
require '../DATABASE/cnxVerif.php';

obligation_connect();
$utilisateur = $_SESSION['utilisateur'];

$sql = "SELECT*FROM utilisateur";
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
    <title>INSCRIPTION</title>
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
                <li>
                    <a href="../GLOBAL/indexGlobal.php">
                        <span class="icon"><i class="fa-solid fa-arrow-trend-up"></i></span>
                        <span class="title">VUE DE STOCK</span>
                    </a>
                </li>
                <li class="hovered">
                    <a href="inscription.php">
                        <span class="icon"><i class="fa-solid fa-user-plus"></i></span>
                        <span class="title">S'ENREGISTRER</span>
                    </a>
                </li>
                <li>
                    <a href="deconnexion.php">
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
                        <h3> UTILISATEUR </h3>
                    </label>
                </div>
            </div>
            <div class="contenu">
                <div class="top">

                </div>
                <div class="formTab">
                    <div class="formulaire">
                        <form id="formu">
                            <div class="form-group">
                                <div class="" id="afff"></div>
                            </div>
                            <div class="form-group">
                                <input type="text" name="id" id="id" hidden>
                            </div>
                            <div class="form-group">
                                <label for="username">User</label>
                                <input type="text" name="username" id="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" required>
                            </div>
                            <div class="form-group">
                                <label for="confirmpassword">Confirm Password</label>
                                <input type="password" name="confirmpassword" id="confirmpassword" required>
                            </div>
                            <br>
                            <div class="form-group">
                                <input type="submit" value="INSCRIRE" name="inscrire" id="inscrire">
                            </div>
                        </form>
                    </div>
                    <div class="tableau">
                        <table class='table'>
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Username</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php while ($out = mysqli_fetch_assoc($exec)) { ?>
                                    <tr>
                                        <td> <?= $out['Id_user'] ?> </td>
                                        <td> <?= $out['Username'] ?> </td>
                                        <td>
                                            <a class="fa-solid fa-edit fa-1x modif" style="color: rgb(6, 131, 131); cursor: pointer;" id="<?php echo ($out['Id_user']) ?>"></a>
                                        </td>
                                        <td>
                                            <a class="fa-solid fa-trash fa-1x suppr" style="color: rgb(190, 31, 31); cursor: pointer;" id="<?php echo ($out['Id_user']) ?>"></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .formTab {
            display: flex;
            justify-content: space-between;
        }

        .contenu {
            margin-left: 25px;
            margin-right: 25px;
        }

        .form-group {
            display: grid;
            margin-bottom: 10px;
        }

        .form-group input {
            width: 341px;
        }

        input#inscrire {
            color: white;
            background: #0c6270;
            border: none;
            border-radius: 4px;
            height: 31px;
        }

        .tableau {
            width: 100%;
            padding-left: 100px;
        }
    </style>
    <script>
        $(document).ready(function() {

            $('.loadere').fadeOut("1000");

            $('#formu').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    url: 'ajoutModif.php',
                    method: 'POST',
                    data: $('#formu').serialize(),
                    success: function(affichage) {
                        if (affichage == 1) {

                            $('#afff').html('LES MOTS DE PASSE SAISIS NE CORRESPONDENT PAS');
                            $('#afff').addClass('alert alert-danger');

                        } else if (affichage == 2) {
                            $('#afff').html('CE NOM EXISTE DEJA UTILISER , CHOISISSEZ UN AUTRE');
                            $('#afff').addClass('alert alert-dark');
                        } else {
                            $('#formu')[0].reset();
                            $('#afff').html('');
                            $('#afff').removeClass();
                            $('.tableau').html(affichage);
                            $('#inscrire').val('INSCRIRE');
                        }


                    }
                });
            });



            $(document).on('click', '.modif', function() {
                var id = $(this).attr('id');
                $.ajax({
                    url: 'editUtil.php',
                    data: {
                        data: id
                    },
                    dataType: 'JSON',
                    method: 'POST',
                    success: function(edit) {
                        $('#inscrire').val('MODIFIER');
                        $('input#id').val(edit.Id_user);
                        $('#username').val(edit.Username);
                        $('#password').val(edit.Pass);
                        $('#confirmpassword').val(edit.Pass);

                    }
                })
            });

            $(document).on('click', '.suppr', function() {
                var id = $(this).attr('id');
                $.ajax({
                    url: 'delUtil.php',
                    method: 'POST',
                    data: 'data=' + id,
                    success: function(affichage) {
                        $('.tableau').html(affichage);
                    }

                })
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
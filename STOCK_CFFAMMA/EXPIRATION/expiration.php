<?php
require '../DATABASE/bd.php';
require '../DATABASE/cnxVerif.php';

obligation_connect();


$utilisateur = $_SESSION['utilisateur'];
$sql = "SELECT*FROM client INNER JOIN commande ON client.Num_cli=commande.Num_cli INNER JOIN materiel on commande.Id_mat=materiel.Id_mat INNER JOIN info ON materiel.Id_mat=info.Id_mat WHERE Validation_mat='ATTENTE'";
$exec = mysqli_query($connexion, $sql);
$date = date('Y-m-d h:i');

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
    <title>ATTENTE</title>
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
                <li class="hovered">
                    <a href="expiration.php">
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
                        <h3>COMMANDE EN ATTENTE</h3>
                    </label>
                </div>
            </div>
            <div class="contenu">
                <div id="tableau">
                    <table class="table">
                        <tr style="text-align: center;">
                            <th>N°commande</th>
                            <th>Designation</th>
                            <th>Prix</th>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Date de commande</th>
                            <th>Expiration</th>
                            <th>Evaluation</th>
                            <th>Supprimer</th>
                        </tr>
                        <?php while ($row = mysqli_fetch_assoc($exec)) {
                            $dateCom = $row['Date_com'];
                            $dateExp = date('Y-m-d h:i:s', strtotime($dateCom . '+30 days'));
                            $evaluation = '';
                            if ($date >= $dateExp) {
                                $evaluation = '<i class="fa-solid fa-circle-exclamation fa-beat" style="color: #d50b0b;"></i>';
                            } else {
                                $evaluation = '<i class="fa-solid fa-sync fa-spin"></i> ';
                            }
                        ?>
                            <tr style="text-align: center;">
                                <td> <?= $row['Num_com'] ?> </td>
                                <td> <?= $row['Des_mat'] ?> </td>
                                <td> <?= $row['Prix_mat'] ?> </td>
                                <td> <?= $row['Nom_cli'] ?> </td>
                                <td> <?= $row['Prenom_cli'] ?> </td>
                                <td> <?= $row['Date_com'] ?> </td>
                                <td> <?= $dateExp ?> </td>
                                <td> <?= $evaluation ?> </td>
                                <td>
                                    <i class="fa-solid fa-trash fa-1x suppri" style="color: rgb(190, 31, 31); cursor: pointer;" id="<?php echo ($row['Num_com']) ?>"></i>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <style>
        .contenu {
            margin-left: 25px;
            margin-right: 25px;

        }
    </style>

    <script>
        $(document).ready(function() {
            $('.loadere').fadeOut("1000");
        });
        $(document).on('click', '.suppri', function() {
            var recup = $(this).attr('id');

            $.ajax({
                url: 'delCmd.php',
                method: 'GET',
                data: 'id=' + recup,
                success: function(ex) {
                    $('#tableau').html(ex);
                }
            })
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
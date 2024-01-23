<?php


require '../../DATABASE/bd.php';
if (isset($_POST['generer'])) {
    $num = $_POST['numCli'];
    $date = $_POST['dateCom'];
    $dateModif = substr($date, 0, 17);
    $sql = "SELECT*FROM client INNER JOIN commande ON client.Num_cli=commande.Num_cli INNER JOIN materiel on commande.Id_mat=materiel.Id_mat INNER JOIN info ON materiel.Id_mat=info.Id_mat WHERE client.Num_cli=$num AND Date_com='$date' AND Validation_mat='VALIDER' ";
    $execu = mysqli_query($connexion, $sql);

    $sql5 = "SELECT*FROM client INNER JOIN commande ON client.Num_cli=commande.Num_cli INNER JOIN materiel on commande.Id_mat=materiel.Id_mat INNER JOIN info ON materiel.Id_mat=info.Id_mat WHERE client.Num_cli=$num AND Date_com='$date' AND Validation_mat='VALIDER' ";
    $execu5 = mysqli_query($connexion, $sql5);

    $aff = mysqli_fetch_assoc($execu5);
    $nom = $aff['Nom_cli'];
    $prenom = $aff['Prenom_cli'];
    $cin = $aff['CIN_cli'];
    $tel = $aff['Tel_cli'];
    $des1 = $aff['Des_mat'];
    $Prix1 = $aff['Prix_mat'];
    $total = 0;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FACTURE</title>
</head>

<body>
    <div class="contenu">
        <div class="top">
            <div class="ambony">
                <div class="icon" id="icon" onclick="imprimer()">
                    <img src="../../STYLE/icon/CFFAMMA/Logo1.png">
                </div>
                <div class="date">
                    <?= $dateModif ?>
                </div>
            </div>
            <div class="infoCli">
                <p> N°: <?= $num ?> </p>
                <p> Nom : <?= $nom ?> </p>
                <p> Prenom : <?= $prenom ?> </p>
                <p> CIN : <?= $cin ?> </p>
                <p> Telephone : <?= $tel ?> </p>

            </div>
        </div>
        <div class="body">
            <table>
                <tr>
                    <th>Designation</th>
                    <th>Quantité</th>
                    <th>Prix unitaire</th>
                    <th>Montant</th>
                </tr>

                <?php $desIni = NULL;
                while ($row = mysqli_fetch_assoc($execu)) {

                    $designation = $row['Des_mat'];

                    if ($desIni == $designation) {

                        continue;
                    } else {

                        $desIni = $designation;
                        $numCli = $row['Num_cli'];
                        $idMat = $row['Id_mat'];
                        $prefix = substr($idMat, 0, 3);
                        $prix = $row['Prix_mat'];

                        $sqlMatAcht = "SELECT COUNT(*) FROM commande WHERE Num_cli=$numCli AND Date_com='$date' AND Id_mat LIKE '$prefix%'";
                        $excMatAcht = mysqli_query($connexion, $sqlMatAcht);
                        $rowMatAcht = mysqli_fetch_assoc($excMatAcht);
                        $qteAcht = implode($rowMatAcht);


                        $montant = $prix * $qteAcht;
                        $total += $montant;
                    }
                    /////////////////////////////////////
                ?>
                    <tr>
                        <td> <?= $row['Des_mat'] ?> </td>
                        <td> <?= $qteAcht ?> </td>
                        <td> <?= $prix ?> </td>
                        <td> <?= $montant ?> </td>
                    </tr>
                <?php
                }
                ?>

                <tr>
                    <th colspan="3">TOTAL</th>
                    <th> <?= $total ?> </th>
                </tr>
            </table>
        </div>
        <div class="footer" style="text-align: center ;">
            <h2> ARRETEE A LA SOMME DE <?= $total ?> Ar</h2>
        </div>
    </div>

    <style>
        body {
            font-family: system-ui;
        }

        th,
        td {
            border: 1px solid black;
            text-align: center;
        }

        table {
            border-collapse: collapse;
            height: 200px;
            width: 700px;
        }

        .icon img {
            width: 210px;
        }

        #icon {
            cursor: pointer;
        }

        .contenu {
            width: 700px;
            padding: 45px;
            margin-left: 220px;
        }

        .ambony {
            display: flex;
            justify-content: space-between;
        }

        .date {
            align-items: center;
            display: flex;
            font-size: 20px;
        }
    </style>
    <script>
        function imprimer() {

            javascript: print();
        }
    </script>

</body>


</html>
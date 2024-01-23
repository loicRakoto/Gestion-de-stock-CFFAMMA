<?php
require '../DATABASE/bd.php';
$sqlCountTotal = "SELECT COUNT(*) FROM materiel";
$execCountTotal = mysqli_query($connexion, $sqlCountTotal);
$rowCountTotal = mysqli_fetch_assoc($execCountTotal);
$totalStock = implode($rowCountTotal);

$sqlMateriel = "SELECT DISTINCT Des_mat FROM materiel";
$execMateriel = mysqli_query($connexion, $sqlMateriel);

$sqlMat = "SELECT DISTINCT Des_mat FROM materiel";
$execMat = mysqli_query($connexion, $sqlMat);
$compteur = 0;
$compteurAff = 0;
$totalMate = NULL;
$totDispo = NULL;
$totVen = NULL;
$totATT = NULL;
while ($rowMat = mysqli_fetch_assoc($execMat)) {
    //TOTAL
    $des = $rowMat['Des_mat'];
    $sqlTotalMateriel = "SELECT COUNT(*) FROM materiel WHERE Des_mat='$des'";
    $execTotal = mysqli_query($connexion, $sqlTotalMateriel);
    $rowTotal = mysqli_fetch_assoc($execTotal);
    $total = implode($rowTotal);
    $totalMate[$compteur] = $total;

    //Compte le nombre de chaque materiel

    //Disponible
    $sqlDispo = "SELECT COUNT(*) FROM materiel INNER JOIN info ON materiel.Id_mat=info.Id_mat WHERE Des_mat='$des' AND Type_mat='ENTREE'";
    $execDispo = mysqli_query($connexion, $sqlDispo);
    $rowDispo = mysqli_fetch_assoc($execDispo);
    $Dispo = implode($rowDispo);
    $totDispo[$compteur] = $Dispo;

    //vendu
    $sqlVendu = "SELECT COUNT(*) FROM materiel INNER JOIN info ON materiel.Id_mat=info.Id_mat WHERE Des_mat='$des' AND Type_mat='SORTIE' ";
    $execVendu = mysqli_query($connexion, $sqlVendu);
    $rowVendu = mysqli_fetch_assoc($execVendu);
    $Vendu = implode($rowVendu);
    $totVen[$compteur] = $Vendu;

    //Attente
    $sqlATT = "SELECT COUNT(*) FROM materiel INNER JOIN info ON materiel.Id_mat=info.Id_mat WHERE Des_mat='$des' AND Type_mat='EN COURS'";
    $execATT = mysqli_query($connexion, $sqlATT);
    $rowATT = mysqli_fetch_assoc($execATT);
    $ATT = implode($rowATT);
    $totATT[$compteur] = $ATT;

    $compteur++;
}

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

//Stock






?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../STYLE/fontawesome-free-6.1.1-web/fontawesome-free-6.1.1-web/css/all.css">
    <title>BILAN</title>
</head>

<body>
    <div class="conta">

        <div class="icon" onclick="imprimer()" id="print"><img style="cursor: pointer ;" src="../STYLE/icon/CFFAMMA/Logo1.png" ;> </div>

        <table>
            <tr>
                <th rowspan="2">DESIGNATION DU MATERIEL</th>
                <th colspan="4"> NOMBRE DU MATERIEL </th>
            </tr>
            <tr>
                <th>Disponible</th>
                <th>Vendu</th>
                <th>Attente</th>
                <th>Total</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($execMateriel)) { ?>
                <tr>
                    <td align='center'> <?= $row['Des_mat'] ?> </td>
                    <td align='center'> <?= $totDispo[$compteurAff] ?> </td>
                    <td align='center'> <?= $totVen[$compteurAff] ?> </td>
                    <td align='center'> <?= $totATT[$compteurAff] ?> </td>
                    <td align='center'> <?= $totalMate[$compteurAff] ?> </td>
                </tr>
            <?php $compteurAff++;
            } ?>

            <tr>
                <th>TOTAL DES MATERIAUX</th>
                <th colspan="4"><?= $totalStock ?></th>
            </tr>
        </table>

        <table>
            <tr>
                <th colspan="3">DETAILS DES MATERIAUX</th>
            </tr>

            <tr>
                <th align='center'>Stock disponible</th>
                <th align='center'>Stock vendu</th>
                <th align='center'>Stock en attente du payement</th>
            </tr>

            <tr>
                <th align='center'><?= $entree ?></th>
                <th align='center'><?= $sortie ?></th>
                <th align='center'><?= $Attente ?></th>
            </tr>

        </table>

        <div id="bilan">BILAN DE STOCK LE <?php echo (date('Y-m-d')); ?> </div>
    </div>

    <style>
        table {
            border: 1px solid black;
            border-collapse: collapse;
            width: 60%;
            height: 60%;
            margin-left: 18%;
            margin-bottom: 35px;
            margin-top: 25px;

        }

        td,
        th {
            border: 1px solid black;
        }

        body {
            font-family: Courier New, monospace;
            font-size: 20px;
        }

        #bilan {
            text-align: center;
            color: black;
            margin-top: 3%;
            font-size: 30px;
            font-weight: bolder;
        }

        .icon img {
            margin-top: 25px;
            background-repeat: no-repeat;
            width: 250px;
            margin-left: 18%;
        }
    </style>

    <script>
        function imprimer() {
            javascript: print();
        }
    </script>
</body>

</html>
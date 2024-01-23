<?php
require '../DATABASE/bd.php';
$tableau = '';
$execution = NULL;

if (isset($_GET['id'])) {
    $execution = 1;
    $numCom = $_GET['id'];

    //Affiche le N°Materiel correspondant au commande
    $sql1 = "SELECT Id_mat FROM commande WHERE Num_com=$numCom";
    $exec1 = mysqli_query($connexion, $sql1);
    $row1 = mysqli_fetch_assoc($exec1);
    $numMat = $row1['Id_mat'];

    //Suppression du cmd
    $sqlDel = "DELETE FROM commande WHERE Num_com=$numCom";
    $execDel = mysqli_query($connexion, $sqlDel);


    //Recuperation du materiel 
    $sqlRecovery = "UPDATE info SET Type_mat='ENTREE',Num_speciale='NULL',Validation_mat='NON VALIDER' WHERE Id_mat='$numMat'";
    $execRecovery = mysqli_query($connexion, $sqlRecovery);
}

if ($execution == 1) {
    //Affiche tableau
    $sql = "SELECT*FROM client INNER JOIN commande ON client.Num_cli=commande.Num_cli INNER JOIN materiel on commande.Id_mat=materiel.Id_mat INNER JOIN info ON materiel.Id_mat=info.Id_mat WHERE Validation_mat='ATTENTE'";
    $result = mysqli_query($connexion, $sql);
    $date = date('Y-m-d');
    $tableau .= '
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
    ';
    while ($row = mysqli_fetch_array($result)) {


        $dateCom = $row['Date_com'];
        $dateExp = date('Y-m-d', strtotime($dateCom . '+5 days'));


        $evaluation = NULL;
        if ($date >= $dateExp) {
            $evaluation = '<i class="fa-solid fa-circle-exclamation fa-beat" style="color: #d50b0b;"></i>';
        } else {
            $evaluation = '<i class="fa-solid fa-sync fa-spin"></i> ';
        }

        $tableau .= '
        <tr style="text-align: center;">
                    <td> ' . $row['Num_com'] . ' </td>
                    <td> ' . $row['Des_mat'] . ' </td>
                    <td> ' . $row['Prix_mat'] . ' </td>
                    <td> ' . $row['Nom_cli'] . ' </td>
                    <td> ' . $row['Prenom_cli'] . ' </td>
                    <td> ' . $row['Date_com'] . ' </td>
                    <td> ' . $dateExp . ' </td>
                    <td> ' . $evaluation . '  </td>
                    <td>
                        <i class="fa-solid fa-trash fa-1x suppri" style="color: rgb(190, 31, 31); cursor: pointer;" id="' . $row['Num_com'] . '"></i>
                    </td>
         </tr>
        
        ';
    }

    $tableau .= ' </table>';

    echo ($tableau);
}

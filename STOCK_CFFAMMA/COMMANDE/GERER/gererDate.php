<?php
require '../../DATABASE/bd.php';
$out = '';
if (isset($_GET['envoi'])) {
    $nCli = $_GET['envoi'];
    $sql = "SELECT DISTINCT Date_com FROM commande INNER JOIN materiel ON commande.Id_mat=materiel.Id_mat INNER JOIN info ON materiel.Id_mat=info.Id_mat WHERE Num_cli=$nCli AND Validation_mat='VALIDER'";
    $exec = mysqli_query($connexion, $sql);


    $out .= '
    Date de commande
        <select class="form-select form-select-sm" name="dateCom" id="dateCom" required>
    ';

    while ($row = mysqli_fetch_assoc($exec)) {

        $out .= '
        <option value=" ' . $row['Date_com'] . '"> ' . $row['Date_com'] . ' </option>
    ';
    }

    $out .= '
        </select>
    ';

    echo ($out);
}

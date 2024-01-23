<?php
include("../../DATABASE/bd.php");

if (isset($_GET['rech'])) {
    $valeur = $_GET['rech'];
    $sql = "SELECT*FROM client INNER JOIN commande ON client.Num_cli=commande.Num_cli INNER JOIN materiel on commande.Id_mat=materiel.Id_mat INNER JOIN info ON materiel.Id_mat=info.Id_mat
    WHERE Nom_cli LIKE '%$valeur%' OR client.Num_cli LIKE '%$valeur%' OR client.Prenom_cli LIKE'%$valeur%' ";
    $result = mysqli_query($connexion, $sql);

    echo '
    
    <table class="table table-striped">
    <tr style="text-align: center;">
        <th style="color: #2e6c5b;">N°client</th>
        <th style="color: #2e6c5b;">Nom</th>
        <th style="color: #2e6c5b;">Prenom</th>
        <th style="color: #2e6c5b;">N°materiel</th>
        <th style="color: #2e6c5b;">Designation</th>
        <th style="color: #2e6c5b;">Date</th>
        <th style="color: #2e6c5b;">BL</th>
        <th style="color: #2e6c5b;">Validation</th>
        <th style="color: #2e6c5b;">EDIT</th>
        <th style="color: #2e6c5b;">DELETE</th>

	 </tr>';

    $i = 1;
    while ($data = mysqli_fetch_array($result)) {
        $validation = NULL;
        $valid = $data['Validation_mat'];
        if ($valid == 'ATTENTE') {
            $validation = '<i class="fa-solid fa-hourglass fa-spin fa-1x" style="color: slategray"></i>';
        } elseif ($valid == 'NON VALIDER') {
            $validation = '<i class="fa-solid fa-circle-xmark fa-1x" style="color: rgb(190, 31, 31);"></i>';
        } else {
            $validation = '<i class="fa-solid fa-check fa-1x" style="color: rgb(48, 160, 93);"></i>';
        }
        echo '	
	 <tr style="text-align: center;">
            <td>' . $data['Num_cli'] . '</td>
            <td>' . $data['Nom_cli'] . '</td>
            <td>' . $data['Prenom_cli'] . '</td>
            <td>' . $data['Id_mat'] . '</td>
            <td>' . $data['Des_mat'] . '</td>
            <td>' . $data['Date_com'] . '</td>
            <td>' . $data['Num_speciale'] . '</td>
            <td>' . $validation . '</td> 
            <td> <a class="fa-solid fa-edit fa-1x modif" style="color: rgb(6, 131, 131); cursor: pointer;" href="gererEdit.php?edit_id=' . $data['Num_com'] . '"></a> </td>
            <td> <a class="fa-solid fa-trash fa-1x del" style="color: rgb(190, 31, 31); cursor: pointer;" href="gererDelete.php?del_id=' . $data['Num_com'] . '"></a> </td>

      </tr>';

        $i++;
    }

    echo '</table>';
}

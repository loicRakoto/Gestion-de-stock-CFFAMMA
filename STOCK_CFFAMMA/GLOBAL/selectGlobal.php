<?php
include("../DATABASE/bd.php");

$sql = "SELECT*FROM materiel INNER JOIN info ON materiel.Id_mat=info.Id_mat";

$result = mysqli_query($connexion, $sql);


echo '
    

    <table class="table">
    <tr>
 
        <td align="center" style="font-weight: bold; color: #147195;">ID materiel</td>
        <td align="center" style="font-weight: bold; color: #147195;">Designation</td>
        <td align="center" style="font-weight: bold; color: #147195;">Prix</td>
        <td align="center" style="font-weight: bold; color: #147195;">Type</td>
        <td align="center" style="font-weight: bold; color: #147195;">N°Specifique</td>
        <td align="center" style="font-weight: bold; color: #147195;">Validation</td>

	 </tr>';

while ($data = mysqli_fetch_array($result)) {
    $validation = NULL;
    $valid = $data['Validation_mat'];
    if ($valid == 'ATTENTE') {
        $validation = '<i class="fa-solid fa-hourglass fa-spin fa-1x" style="color:slategray;"></i>';
    } elseif ($valid == 'NON VALIDER') {
        $validation = '<i class="fa-solid fa-circle-xmark fa-1x" style="color: rgb(190, 31, 31);"></i>';
    } else {
        $validation = '<i class="fa-solid fa-check fa-1x" style="color: rgb(48, 160, 93);"></i>';
    }

    echo '

	
	 <tr>
            <td align="center">' . $data['Id_mat'] . '</td>
            <td align="center">' . $data['Des_mat'] . '</td>
            <td align="center">' . $data['Prix_mat'] . 'Ar</td>
            <td align="center">' . $data['Type_mat'] . '</td>
            <td align="center">' . $data['Num_speciale'] . '</td> 
            <td align="center">' . $validation . '</td>
      </tr>';
}

echo '</table>';

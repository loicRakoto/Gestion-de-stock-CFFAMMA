<?php
require '../DATABASE/bd.php';

$id = mysqli_real_escape_string($connexion, $_POST['IdMateriel']);
$design = mysqli_real_escape_string($connexion, $_POST['DesignMateriel']);
$prix = mysqli_real_escape_string($connexion, $_POST['PrixMateriel']);
$acces = NULL;
$output = '';

if ($_POST['modify'] != '') {
    $modify = $_POST['modify'];
    $sqlModif = "UPDATE materiel SET Id_mat='$id',Des_mat='$design',Prix_mat=$prix WHERE Id_mat='$modify'";
    $excModif = mysqli_query($connexion, $sqlModif);
    $message = 'Modification réussie';
    $acces = 1;
} else {

    $sqlAjout = "INSERT INTO materiel(Id_mat,Des_mat,Prix_mat) VALUES('$id','$design',$prix)";
    mysqli_query($connexion, $sqlAjout);

    //AJOUT DANS LA TABLE INFO (information concernant le materiel)

    $sql1 = "INSERT INTO info(Id_mat,Type_mat,Num_speciale,Validation_mat) VALUES('$id','ENTREE','NULL','NON VALIDER')";
    mysqli_query($connexion, $sql1);
    $message = 'Insertion réussie';

    $acces = 1;
}

if ($acces == 1) {
    $sql = "SELECT*FROM materiel";
    $exec = mysqli_query($connexion, $sql);
    $output .= '
    <label class="text-success">' . $message . '</label>
                <table class="table table-bordered">
                <tr>
                        <td align="center" style="font-weight: bold;">ID</td>
                        <td align="center" style="font-weight: bold;">Designation</td>
                        <td align="center" style="font-weight: bold;">Prix</td>
                        <td align="center" style="font-weight: bold;">Action</td>
                </tr>
';

    while ($row = mysqli_fetch_array($exec)) {
        $output .= '
    <tr>
            <td align="center">' . $row['Id_mat'] . '  </td>
            <td align="center"> ' . $row['Des_mat'] . ' </td>
            <td align="center"> ' . $row['Prix_mat'] . ' </td>
            <td align="center" width="20%">
            

                 <i class="fa-solid fa-edit fa-2x modif" style="color: rgb(6, 131, 131); cursor: pointer;" id="' . $row['Id_mat'] . '"></i>
                 <i class="fa-solid fa-trash fa-2x suppri" style="color: rgb(190, 31, 31); cursor: pointer;" id="' . $row['Id_mat'] . '"></i>
                 
            </td>
    </tr>


    ';
    }

    $output .= ' </table>';
}

echo ($output);

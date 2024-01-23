<?php
require '../DATABASE/bd.php';
$output = '';
if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $sql = "DELETE FROM materiel WHERE Id_mat='$id'";
    mysqli_query($connexion, $sql);


    $sql1 = "SELECT*FROM materiel";
    $exec1 = mysqli_query($connexion, $sql1);
    $message = 'Element supprimer';
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

    while ($row = mysqli_fetch_array($exec1)) {
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

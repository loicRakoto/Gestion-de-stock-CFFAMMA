<?php
include("../DATABASE/bd.php");

if (isset($_GET['rech'])) {
    $valeur = $_GET['rech'];
    $sql = "SELECT*FROM materiel WHERE Id_mat LIKE '%$valeur%' OR Des_mat LIKE '%$valeur%' OR Prix_mat LIKE'%$valeur%'";
    $result = mysqli_query($connexion, $sql);

    echo '
    <table class="table table-bordered">
                                <tr>
                                    <td align="center" style="font-weight: bold;">ID</td>
                                    <td align="center" style="font-weight: bold;">Designation</td>
                                    <td align="center" style="font-weight: bold;">Prix</td>
                                    <td align="center" style="font-weight: bold;">Action</td>
                                </tr>
    ';

    while ($row = mysqli_fetch_assoc($result)) {

        echo '
        <tr>
                                        <td align="center">' . $row['Id_mat'] . ' </td>
                                        <td align="center"> ' . $row['Des_mat'] . ' </td>
                                        <td align="center"> ' . $row['Prix_mat'] . ' </td>
                                        <td align="center" width="20%">
                                            <i class="fa-solid fa-edit fa-2x modif" style="color: rgb(6, 131, 131); cursor: pointer;" id="' . $row['Id_mat'] . '"></i>
                                            <i class="fa-solid fa-trash fa-2x suppri" style="color: rgb(190, 31, 31); cursor: pointer;" id="' . $row['Id_mat'] . '"></i>
                                        </td>
                                    </tr>
        ';
    }

    echo '</table>';
}

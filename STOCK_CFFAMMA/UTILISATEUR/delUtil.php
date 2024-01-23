<?php
require '../DATABASE/bd.php';
if (isset($_POST['data'])) {
    $tableau = '';
    $id = $_POST['data'];
    $sql = "DELETE FROM utilisateur WHERE Id_user=$id";
    $exec = mysqli_query($connexion, $sql);

    $sql = "SELECT*FROM utilisateur";
    $exec = mysqli_query($connexion, $sql);


    $tableau .= '
            <table class="table">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Username</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>

            <tbody>
        ';

    while ($out = mysqli_fetch_assoc($exec)) {

        $tableau .= '
                <tr>
                    <td> ' . $out['Id_user'] . ' </td>
                        <td> ' . $out['Username'] . ' </td>
                        <td>
                            <a class="fa-solid fa-edit fa-1x modif" style="color: rgb(6, 131, 131); cursor: pointer;" id="' . $out['Id_user'] . '"></a>
                        </td>
                        <td>
                            <a class="fa-solid fa-trash fa-1x suppr" style="color: rgb(190, 31, 31); cursor: pointer;" id="' . $out['Id_user'] . '"></a>
                        </td>
                </tr>
            ';
    }
    $tableau .= '</tbody>

        </table>';

    echo ($tableau);
}

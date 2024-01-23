<?php
require '../DATABASE/bd.php';
$tableau = '';

$obs = NULL;

$idUser = mysqli_real_escape_string($connexion, $_POST['id']);
$username = mysqli_real_escape_string($connexion, $_POST['username']);
$password = mysqli_real_escape_string($connexion, $_POST['password']);
$confirmpassword = mysqli_real_escape_string($connexion, $_POST['confirmpassword']);
$acces = NULL;

$sqlVerifUser = "SELECT*FROM utilisateur WHERE Username='$username'";
$execVerifUser = mysqli_query($connexion, $sqlVerifUser);


if ($password === $confirmpassword) {
    if ($idUser != '') {
        $sqlModif = "UPDATE utilisateur SET Username='$username',Pass='$password' WHERE Id_user=$idUser";
        $excModif = mysqli_query($connexion, $sqlModif);
        $acces = 1;
    } else {
        if (mysqli_num_rows($execVerifUser) == 0) {
            $sqlAjout = "INSERT INTO utilisateur(Username,Pass) VALUES('$username','$password')";
            mysqli_query($connexion, $sqlAjout);
            $acces = 1;
        } else {
            $obs = 2;
        }
    }

    if ($acces == 1) {
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
    }
} else {
    $obs = 1;
}
echo ($tableau);
echo ($obs);

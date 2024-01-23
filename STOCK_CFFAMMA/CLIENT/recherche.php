<?php
require '../DATABASE/bd.php';
if (isset($_GET['rech'])) {
    $rech = $_GET['rech'];
    $sql = "SELECT*FROM client WHERE Nom_cli LIKE '%$rech%' OR Num_cli LIKE '%$rech%' OR Prenom_cli LIKE '%$rech%' OR CIN_cli LIKE '%$rech%' OR Tel_cli LIKE '%$rech%'";
    $exec = mysqli_query($connexion, $sql);

    echo '
    
    <table class="table">
                        <thead>
                             <tr>
                                <th>N°</th>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>CIN</th>
                                <th>Telephone</th>
                                <th colspan="2">Action</th>
                            </tr>
                        </thead>

                        <tbody>
    ';

    while ($out = mysqli_fetch_assoc($exec)) {

        echo '
                            <tr>
                                <td> ' . $out['Num_cli'] . '  </td>
                                <td> ' . $out['Nom_cli'] . ' </td>
                                <td> ' . $out['Prenom_cli'] . ' </td>
                                <td> ' . $out['CIN_cli'] . ' </td>
                                <td> ' . $out['Tel_cli'] . ' </td>
                                <td>
                                    <a class="fa-solid fa-edit fa-1x modif" style="color: rgb(6, 131, 131); cursor: pointer;" id=" ' . $out['Num_cli'] . '"></a>
                                </td>
                                <td>
                                    <a class="fa-solid fa-trash fa-1x suppr" style="color: rgb(190, 31, 31); cursor: pointer;" href="delCli.php?alefa=' . $out['Num_cli'] . '"></a>
                                    </td>
                            </tr>

    ';
    }

    echo '               </tbody>
    </table>';
}

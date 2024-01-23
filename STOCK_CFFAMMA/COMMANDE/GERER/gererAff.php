<?php
require '../../DATABASE/bd.php';
if (isset($_GET['data'])) {
    $valeur = $_GET['data'];
    $sql = "SELECT*FROM client WHERE Num_cli=$valeur";
    $exec = mysqli_query($connexion, $sql);
    $row = mysqli_fetch_assoc($exec);
    $nom = $row['Nom_cli'];
    $prenom = $row['Prenom_cli'];
    $Numtel = $row['Tel_cli'];

    $tableCli = '
    <table style="width: 430px; height:150px">
    <tr>
        <th colspan="2" style="border-top: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;
         text-align: center; background-color: #9f2020; color: white;">CLIENT</th>
    </tr>
    <tr style="background-color:white;">
        <td style="border: 1px solid black; text-align:center;">
           Nom
        </td>
        <td style="border: 1px solid black; text-align:center;">
            ' . $nom . '
        </td>
    </tr>
    <tr style="background-color:white;">
        <td style="border: 1px solid black; text-align:center;">
            Prénom
        </td>       
        <td style="border: 1px solid black; text-align:center;">
        ' . $prenom . '
        </td>
    </tr>
    <tr style="background-color:white;">
        <td style="border: 1px solid black; text-align:center;">
            Télephone
        </td>       
        <td style="border: 1px solid black; text-align:center;">
        ' . $Numtel . '
        </td>
    </tr>
    </table>
    ';
    echo ($tableCli);
}

if (isset($_GET['donnee'])) {
    $don = $_GET['donnee'];
    $sql1 = "SELECT*FROM materiel WHERE Id_mat='$don'";
    $exec1 = mysqli_query($connexion, $sql1);
    $row1 = mysqli_fetch_assoc($exec1);
    $design = $row1['Des_mat'];
    $prix = $row1['Prix_mat'];

    $tableMat = '
    <table style="width: 430px; height:150px">
    <tr>
        <th colspan="2" style="border-top: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;
         text-align: center; background-color: #186e6a;
         color: white;">MATERIEL</th>
    </tr>
    <tr style="background-color:white;">
        <td style="border: 1px solid black; text-align:center;">
           ID
        </td>
        <td style="border: 1px solid black; text-align:center;">
            ' . $don . '
        </td>
    </tr>
    <tr style="background-color:white;">
        <td style="border: 1px solid black; text-align:center;">
            Designation
        </td>       
        <td style="border: 1px solid black; text-align:center;">
        ' . $design . '
        </td>
    </tr>
    <tr style="background-color:white;">
        <td style="border: 1px solid black; text-align:center;">
            Prix
        </td>       
        <td style="border: 1px solid black; text-align:center;">
        ' . $prix . '
        </td>
    </tr>
    </table>
    ';
    echo ($tableMat);
}

<?php
require '../../DATABASE/bd.php';
if (isset($_GET['edit_id'])) {
    $numCmd = $_GET['edit_id'];
    $sql = "SELECT*FROM commande WHERE Num_com=$numCmd";
    $exec = mysqli_query($connexion, $sql);
    $row = mysqli_fetch_assoc($exec);

    $idMat = $row['Id_mat'];

    //Affiche les materiel dsiponible
    $sqlMat = "SELECT*FROM materiel INNER JOIN info ON materiel.Id_mat=info.Id_mat WHERE Num_speciale='NULL'";
    $execMat = mysqli_query($connexion, $sqlMat);

    //Affiche les clients
    $sqlCli = "SELECT*FROM client";
    $execCli = mysqli_query($connexion, $sqlCli);

    //Affiche le Num Speciale
    $sqlAff = "SELECT*FROM commande INNER JOIN materiel ON commande.Id_mat=materiel.Id_mat INNER JOIN info ON materiel.Id_mat=info.Id_mat WHERE Num_com=$numCmd";
    $execAff = mysqli_query($connexion, $sqlAff);
    $row3 = mysqli_fetch_assoc($execAff);

    $numCliCmd = $row3['Num_cli'];
    $idMatCmd = $row3['Id_mat'];

    //Verifie et check radio button 
    $sqlVerif = "SELECT*FROM info WHERE Id_mat='$idMat'";
    $execVerif = mysqli_query($connexion, $sqlVerif);
    $rowVerif = mysqli_fetch_assoc($execVerif);
    $detailType = $rowVerif['Type_mat'];

    //Affiche client selectionner
    $sqlCli1 = "SELECT*FROM client WHERE Num_cli=$numCliCmd";
    $execCli1 = mysqli_query($connexion, $sqlCli1);
    $rowCli1 = mysqli_fetch_assoc($execCli1);
    $nom1 = $rowCli1['Nom_cli'];
    $prenom1 = $rowCli1['Prenom_cli'];
    $tel1 = $rowCli1['Tel_cli'];

    //Affiche materiel selectionner
    $sqlMat1 = "SELECT*FROM materiel WHERE Id_mat='$idMatCmd'";
    $execMat1 = mysqli_query($connexion, $sqlMat1);
    $rowMat1 = mysqli_fetch_assoc($execMat1);
    $design = $rowMat1['Des_mat'];
    $prix = $rowMat1['Prix_mat'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../STYLE/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../STYLE/fontawesome-free-6.1.1-web/fontawesome-free-6.1.1-web/css/all.css">
    <script type="text/javascript" src="../../STYLE/js/bootstrap.min.js">
    </script>
    <script type="text/javascript" src="../../STYLE/JQuery.js"></script>
    <title>MODIFICATION</title>
</head>

<body>
    <div class="top">
        <i class="fa-solid fa-xmark" id="exite" style="font-size: 34px ; cursor: pointer;"></i>
        <h3>Modification des commandes</h3>
    </div>
    <div class="contenu">
        <div class="formulaire">
            <!-- method="POST" action="gererUpdate.php" -->
            <form id="forme">
                <div class="form-group">
                    <input type="hidden" name="numCom" value="<?= $row['Num_com'] ?>">
                </div>
                <div class="form-group">
                    <label for="numCli" id="cli"> CLIENT </label>
                    <select class="form-select form-select-sm" name="numCli" id="numCli">
                        <option selected value="<?= $row['Num_cli'] ?>"><?= $row['Num_cli'] ?></option>
                        <?php while ($row2 = mysqli_fetch_assoc($execCli)) { ?>
                            <option value="<?= $row2['Num_cli'] ?>">
                                <?= $row2['Num_cli'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="id_mat" id="mat"> MATERIEL </label>
                    <select class="form-select form-select-sm" name="idMat" id="idMat">
                        <option selected value="<?= $row['Id_mat'] ?>"><?= $row['Id_mat'] ?></option>
                        <?php while ($row1 = mysqli_fetch_assoc($execMat)) { ?>
                            <option value="<?= $row1['Id_mat'] ?>">
                                <?= $row1['Id_mat'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="date">DATE DE COMMANDE</label>
                    <input type="datetime" name="date" value="<?= $row['Date_com'] ?>" class="form-control form-control-sm">
                </div>
                <div class="form-group" id="bay">
                    <div for="paye" id="paypay">PAYEMENT</div>
                    Oui <input type="radio" id="paye" name="payement" value="Oui" onclick="ouvrir();" <?php if ($detailType == 'SORTIE') : ?> checked="checked" <?php endif ?> required />
                    Non <input type="radio" id="nonPaye" name="payement" value="Non" onclick="ouvrir();" <?php if ($detailType == 'EN COURS') : ?> checked="checked" <?php endif ?> required />
                </div>
                <div class="form-group cont" id="cont">
                    <label for="numSpeciale">N°SPECIFIQUE</label>
                    <input type="text" name="numSpeci" id="numSpeciale" value="<?= $row3['Num_speciale'] ?>" />
                </div>
                <div class="form-group">
                    <button type="submit" id="btnUpdate" class="btn btn-primary modifSave" name="update">UPDATE</button>
                </div>
            </form>
        </div>
        <div class="affichage">
            <div class="affichageCli">
                <div class="affCli">

                    <table style="width: 430px; height:150px">
                        <tr>
                            <th colspan="2" style="border-top: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;text-align: center; background-color: #9f2020; color: white;">CLIENT</th>
                        </tr>
                        <tr style="background-color: white;">
                            <td style="border: 1px solid black; text-align:center;">
                                Nom
                            </td>
                            <td style="border: 1px solid black; text-align:center;">
                                <?= $nom1 ?>
                            </td>
                        </tr>
                        <tr style="background-color:white;">
                            <td style="border: 1px solid black; text-align:center;">
                                Prénom
                            </td>
                            <td style="border: 1px solid black; text-align:center;">
                                <?= $prenom1 ?>
                            </td>
                        </tr>
                        <tr style="background-color: white;">
                            <td style="border: 1px solid black; text-align:center;">
                                Télephone
                            </td>
                            <td style="border: 1px solid black; text-align:center;">
                                <?= $tel1 ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="affichageMat">
                <div class="affMat">
                    <table style="width: 430px; height:150px">
                        <tr>
                            <th colspan="2" style="border-top: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;text-align: center; background-color: #186e6a;color: white;">MATERIEL</th>
                        </tr>
                        <tr style="background-color: white;">
                            <td style="border: 1px solid black; text-align:center;">
                                ID
                            </td>
                            <td style="border: 1px solid black; text-align:center;">
                                <?= $idMatCmd ?>
                            </td>
                        </tr>
                        <tr style="background-color:white;">
                            <td style="border: 1px solid black; text-align:center;">
                                Designation
                            </td>
                            <td style="border: 1px solid black; text-align:center;">
                                <?= $design ?>
                            </td>
                        </tr>
                        <tr style="background-color: white;">
                            <td style="border: 1px solid black; text-align:center;">
                                Prix
                            </td>
                            <td style="border: 1px solid black; text-align:center;">
                                <?= $prix ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- ==============================================MODAL DE PAYEMENT=================================================-->


    <div class="modal" tabindex="-1" id="modalPaye">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="top1">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="corp1">
                        <div class="iconn">
                            <i class="fa-regular fa-circle-check"></i>
                        </div>
                        <div class="texte1">
                            <h3></h3>
                            Veuillez le verifier dans le gestionnaire des commandes
                        </div>
                        <div>
                            <button type="button" class="btn btn-secondary bout" data-bs-dismiss="modal">OK</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <style>
        .top1 {
            justify-items: end;
            display: grid;
        }

        .texte1 {
            padding: 9px 0px;
        }

        .corp1 {
            text-align: center;
        }

        .corp1 .iconn i {
            font-size: 60px;
            color: #34cd63;
        }

        button.bout {
            color: white;
            border: none;
            background-color: #31a354
        }
    </style>




    <!-- ==============================================XXXXXXXXXXXXXXXXXXXXXXXXXXXX=================================================-->

    <style>
        body {
            font-family: monospace;
            background-color: #fbfbfb;
        }

        .contenu {
            width: 100%;
            margin-top: 60px;
            display: flex;
            padding: 0px 70px;
        }

        .formulaire {
            width: 400px;
            border-radius: 150px 0px 150px 0px;
            padding: 50px;
            border: none;
            background-color: #ffffff;
            ;
            box-shadow: 0px 2px 3px #4c3e3e;
            margin-left: 45px;

        }

        form .form-group {
            margin-bottom: 15px;
        }

        .form-group label {

            display: block;
            margin-bottom: 5px;
        }

        button#btnUpdate {
            width: 100%;
            background-color: #076636;
            border: none;
            border-radius: 15px;
        }

        #numSpeciale {
            border-radius: 10px;
            text-align: center;
            border: 1px solid #d3cece;
            position: relative;
            color: #ff0000;
            background-color: #f9f9f9;
            width: 100%;
            margin-bottom: 20px;
        }

        .affichage {
            display: block;
            margin-left: 70px;
        }

        .affichageCli {
            padding: 45px;
        }

        .affichageMat {
            padding: 45px;
        }

        .top h3 {
            text-align: right;
            padding-right: 40px;
        }

        .top {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            margin-left: 50px;
            margin-right: 50px;
        }
    </style>


    <script>
        $(document).ready(function() {
            $('#exite').click(function() {
                document.location.href = 'gererIndex.php';
            });
            $('#forme').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    url: 'gererUpdate.php',
                    method: 'POST',
                    data: $('#forme').serialize(),
                    success: function(e) {

                        if (e == 1) {

                            $('.texte1 h3').html('Paiement réussi');
                            $('.iconn i').addClass('fa-regular fa-circle-check');

                            $('#modalPaye').modal('show');
                            $('#modalPaye').on('hide.bs.modal', function() {
                                document.location.href = 'gererIndex.php';
                            });
                        } else {

                            $('.texte1 h3').html('Reservation réussi');
                            $('.iconn i').addClass('fa-solid fa-hourglass');

                            $('#modalPaye').modal('show');
                            $('#modalPaye').on('hide.bs.modal', function() {
                                document.location.href = 'gererIndex.php';
                            });
                        }

                    }
                });

            });



            $('#paye').click(function() {
                $('#numSpeciale').val('BL-');
                $('input#numSpeciale').attr('readonly', false);


            });
            $('#nonPaye').click(function() {
                $('#numSpeciale').val('NULL');
                $('input#numSpeciale').attr('readonly', true);

            });

            $('select#numCli').change(function() {
                var a = $(this).val();
                $.ajax({
                    url: 'gererAff.php',
                    method: 'GET',
                    data: 'data=' + a,
                    success: function(affi) {
                        $('.affCli').html(affi);

                    }
                });
            });

            $('select#idMat').change(function() {
                var a = $(this).val();
                $.ajax({
                    url: 'gererAff.php',
                    method: 'GET',
                    data: 'donnee=' + a,
                    success: function(affi) {
                        $('.affMat').html(affi);

                    }
                });
            });
        });
    </script>
</body>

</html>
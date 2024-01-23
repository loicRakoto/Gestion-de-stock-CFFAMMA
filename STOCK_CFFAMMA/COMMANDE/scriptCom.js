$(document).ready(function () {

    $('.loadere').fadeOut("1000");

    $('select#numCli').change(function () {
        var id = $(this).val();

        if (id == 'x') {
            alert("Veuillez choisir le bon numero");
            $('#affichageClient').html('');
            $('.affCli').css('display', 'none');
        } else {
            $.ajax({
                url: 'affichCom.php',
                method: 'GET',
                data: 'envoyer=' + id,
                success: function (affichage) {
                    $('#affichageClient').html(affichage);
                    $('.affCli').css('display', 'block');
                }
            });
        }
    });


    $('select#idMat').change(function () {
        var id = $(this).val();

        if (id == 'x') {
            alert("Veuillez choisir le bon numero");
            $('#affichageMateriel').html('');
            $('.affMat').css('display', 'none');
        } else {
            $.ajax({
                url: 'affichCom.php',
                method: 'GET',
                data: 'send=' + id,
                success: function (affichage) {
                    $('#affichageMateriel').html(affichage);
                    $('.affMat').css('display', 'block');
                }
            });
        }
    });


    $('#forme').submit(function (e) {
        e.preventDefault();

        $.ajax({
            url: 'ajoutCom.php',
            method: 'POST',
            data: $('#forme').serialize(),
            success: function (e) {
                if (e == 1) {
                    $('.texte h3').html('Paiement réussi');
                    $('.iconn i').addClass('fa-regular fa-circle-check');
                    $('#forme')[0].reset();
                    $('#modalPaye').modal('show');
                    $('#modalPaye').on('hide.bs.modal', function () {
                        location.reload(true);
                    });
                }
                else {
                    $('.texte h3').html('Reservation réussi');
                    $('.iconn i').addClass('fa-solid fa-hourglass');
                    $('#forme')[0].reset();
                    $('#modalPaye').modal('show');
                    $('#modalPaye').on('hide.bs.modal', function () {
                        location.reload(true);
                    });
                }

            }
        });

    });



    $('#paye').click(function () {
        $('input#numSpeciale').attr('readonly', false);
        $('#numSpeciale').val('BL-');
        $('#enreg').val('ACHETER');
        $('#typeCmd').val('ACHETER')

    });
    $('#nonPaye').click(function () {
        $('#numSpeciale').val('NULL');
        $('input#numSpeciale').attr('readonly', true);
        $('#enreg').val('RESERVER');
        $('#typeCmd').val('RESERVER');

    });
});

//Toggle menu
let togle = document.querySelector('.toggle');
let navigation = document.querySelector('.navigation');
let main = document.querySelector('.main');

togle.onclick = function () {
    navigation.classList.toggle('active');
    main.classList.toggle('active');

}

//Add hovered in selected item
let list = document.querySelectorAll('.navigation li');

function activeLink() {
    list.forEach((item) => {
        item.classList.remove('hovered');
        this.classList.add('hovered');
    });
}
list.forEach((item) => {
    item.addEventListener('click', activeLink);
});

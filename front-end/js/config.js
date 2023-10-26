// configurações gerais

var urlBackEnd = 'http://localhost:8001/'; // URL base para as chamadas no Ajax

function alerta(icon, title, msg, redirect) {
    Swal.fire({
        title: title,
        html: msg,
        allowOutsideClick: false,
        icon: icon
    }).then((result) => {
        if (redirect != "") {
            location.href = redirect
        }
    });

    return false;
}

$(document).ready(function() {

    $('.percentual').maskMoney({
        prefix: '',
        suffix: '',
        allowZero: true,
        decimal: '.',
        precision: 2
    });

    $('.percentual').on('blur', function() {
        let valor = parseFloat($(this).maskMoney('unmasked')[0]);

        if (valor < 0) {
            valor = 0;
        } else if (valor > 100) {
            valor = 100;
        }

        $(this).maskMoney({ allowZero: true }).maskMoney('mask', valor);
    });

});
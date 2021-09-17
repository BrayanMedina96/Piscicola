document.write('<script src="../jsConfig.js"></script>');


function consultarAjax(tipo, parametro) {
    var dat = "";
    if (tipo == "POST" || tipo == "PUT" || tipo == "DELETE") {
        dat = parametro;
    }

    return $.ajax({
        type: tipo,
        url: sw + "/" + proyecto + "/" + api + "/" + dat,
        data: parametro,
        contentType: "application/json; charset=utf-8",
        dataType: 'json',
        async: false,
        beforeSend: function () {
            $('#load').modal();
        },
        complete: function () {
            $('#load').modal('hide');
        },
        success: function (response) {
            return response;
        },
        failure: function (response) {
            return response;
        }

    });

}



function functionAjax(tipo, parametro, funcion) {
    var dat = "";
    if (tipo == "POST" || tipo == "PUT" || tipo == "DELETE") {
        dat = parametro;
    }

    $.ajax({
        type: tipo,
        url: sw + "/" + proyecto + "/" + api + "/" + dat,
        data: parametro,
        contentType: "application/json; charset=utf-8",
        dataType: 'json',
        async: true,
        beforeSend: function () {
            $('#load').modal();
        },
        complete: function () {
            $('#load').modal('hide');
        },
        success: funcion,
        failure: function (response) {
            funcion(response);
        }

    });

}
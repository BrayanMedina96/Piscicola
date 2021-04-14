$(function () {

    $("#txtDescripcionSolicitud").val(" ");

    $("#btnEnviarSolicitud").click(function () {

        var obj = new Correo();
        obj.tipo = $("#ddlOpcionSolicitud option:selected").text();
        obj.descripcion = $("#txtDescripcionSolicitud").val();
        obj.token = $("#txtVarUrl").val();

        if ($("#ddlOpcionSolicitud").val() == "") {
            badge("#pnMensaje", "Debe seleccionar un tipo de solicitud.","success");
        } else {
            var result=   obj.enviarSolicitud();
            console.log(result)
        }


    })


})
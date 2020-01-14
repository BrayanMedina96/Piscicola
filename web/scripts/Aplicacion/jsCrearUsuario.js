$(function () {

    cargarTipoDocumento();
})

function crearUsuario() {

    if (!validarCampos("[required]")) {
        $("#pnMensaje").html("");
        $("#pnMensaje").html(modal("Alerta", "Debe diligenciar todos los campos.", "modal-sm"));
        $("#myModal").modal();
        return;
    }

    const objpersona = new PersonaUsuario();
    objpersona.nombre = $("#txtNombre").val();
    objpersona.apellido = $("#txtApelldio").val();
    objpersona.usuario = $("#txtUsuario").val();
    objpersona.tipoDocumento = $("#ddlTipoDocumento").val();
    objpersona.numeroDocumento = $("#txtNumeroDocumento").val();
    objpersona.usuarioPadre=$("#txtUserPadre").val();

    var result = objpersona.crearUsuario();

    $("#pnMensaje").html("");
    $("#pnMensaje").html(modal("Alerta",result.responseJSON["mensaje"], "modal-sm"));
    $("#myModal").modal();
    return;


}
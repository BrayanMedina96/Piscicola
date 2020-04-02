$(function () {

    cargarTipoDocumento();
    cargarPerfil();
})

function crearUsuario() {

    if (!validarCampos("[required]")) {
        $("#pnMensaje").html("");
        $("#pnMensaje").html(modal("Alerta", "Debe llenar todos los campos.", "modal-sm"));
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
    objpersona.token=$("#txtVarUrl").val();
    objpersona.perfil=$("#ddlPerfil").val();

    var result = objpersona.crearUsuario();

    $("#pnMensaje").html("");
    $("#pnMensaje").html(modal("Alerta",result.responseJSON["mensaje"], "modal-sm"));
    $("#myModal").modal();
    


}

function cargarPerfil()
{
    var obj=new Seguridad();
    obj.token=$("#txtVarUrl").val();
    obj.cargarddl("ddlPerfil",obj.consultarPerfil().responseJSON,"perfilid","perfilnombre" );
}
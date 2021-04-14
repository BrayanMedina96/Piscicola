class Correo {

    entidad = "SendEmail";
    tipo=""
    descripcion=""



    enviarSolicitud() {
        var parametro =
            "?entidad=" + this.entidad +
            "&tipo=" + this.tipo.trim() +
            "&descripcion=" + this.descripcion.trim() +
            "&token=" + this.token +
            "&do=";

        return consultarAjax('POST', parametro).responseJSON;
    }

}
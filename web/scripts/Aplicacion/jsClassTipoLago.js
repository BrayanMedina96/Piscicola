class TipoLago
{

entidad="TipoLago";
id;
nombre;
token;
descripcion;

guardar()
{
    var parametro =
            "?entidad=" + this.entidad +
            "&nombre=" + this.nombre.trim() +
            "&descripcion=" + this.descripcion.trim() +
            "&token=" + this.token +
            "&do=";

        return consultarAjax('POST', parametro);

}

actualizar()
{
    var parametro =
            "?entidad=" + this.entidad +
            "&nombre=" + this.nombre.trim() +
            "&descripcion=" + this.descripcion.trim() +
            "&id=" + this.id.trim() +
            "&token=" + this.token +
            "&do=";

        return consultarAjax('PUT', parametro);

}

consultar() {
    var parametro = {
        entidad: this.entidad,
        token: this.token,
        do: ""
    }

    return consultarAjax('GET', parametro);
}

eliminar()
{
    var parametro =
    "?entidad=" + this.entidad +
    "&id=" + this.id +
    "&token=" + this.token +
    "&do=";
    return consultarAjax('DELETE', parametro);
}







}
class Usuario
{
    entidad="Usuario";
    usuario;
    contrasenia;
    token;
    id;
    fechaExpiracion;
    perfil;
    estado;
    cambioPassword;

    constructor(usuario,contrasenia,token,id,fechaExpiracion,perfil,estado)
    {
       this.usuario=usuario;
       this.contrasenia=contrasenia;
       this.token=token;
       this.id=id;
       this.fechaExpiracion=fechaExpiracion;
       this.perfil=perfil;
       this.estado=estado;
    }

    actualizar()
    {
        var parametro =
            "?entidad=" + this.entidad +
            "&usuario=" + this.nombre +
            "&contrasenia=" + this.contrasenia +
            "&fecha=" + this.fechaExpiracion +
            "&estado=" + this.estado +
            "&perfil=" + this.perfil +
            "&token=" + this.token +
            "&id=" + this.id +
            "&cambioPassword=" + this.cambioPassword +
            "&do=" +"";

        return consultarAjax('PUT',parametro) ;
    }

    seguridad()
    {
        var parametro={
            entidad:this.entidad,
            token:this.token,
            do:"seguridad"
        }
       
        var result = consultarAjax('GET', parametro).responseJSON;
        for (const key in result) {

            $("."+result[key][0]).attr(result[key][1],result[key][1]);

        }
    }

    cargarPerfil(elemento) {

        var parametro = {
            entidad: this.entidad,
            do: "perfil"
        }

        var result= consultarAjax('GET', parametro).responseJSON;

        $("#" + elemento).html("");
        var option = "";
        for (var indice in result) {
            option += "<option value=" + result[indice]["perfilid"] + ">" + result[indice]["perfilnombre"] + "</option>";
        }
        $("#" + elemento).append(option);
    }

    consultar()
    {
        var parametro={
            entidad:this.entidad,
            token:this.token,
            id:this.id,
            do:"consultarUN"
        }

      return consultarAjax('GET',parametro) ;
    }


    importar()
    {
        var parametro =
            "?entidad=" + this.entidad.trim() +
            "&importarText=" + this.importarText.trim() +
            "&token=" + this.token +
            "&do=importar";

        return consultarAjax('POST', parametro);
    }

}
class Cultivo{

    entidad = "Cultivo";
    id;
    lago;
    especie;
    fechaInicio;
    fechaFinal;
    token;

    guardar() {

        var parametro =
            "?entidad=" + this.entidad +
            "&lago=" + this.lago.trim() +
            "&especie=" + this.especie.trim() +
            "&fechaInicio=" + this.fechaInicio.trim() +
            "&fechaFinal=" + this.fechaFinal +
            "&token=" + this.token +
            "&do=";

        return consultarAjax('POST', parametro).responseJSON;

    }

    actualizar() {
        
        var parametro =
        "?entidad=" + this.entidad +
        "&id=" + this.id.trim() +
        "&lago=" + this.lago.trim() +
        "&especie=" + this.especie.trim() +
        "&fechaInicio=" + this.fechaInicio.trim() +
        "&fechaFinal=" + this.fechaFinal +
        "&token=" + this.token +
        "&do=";

        return consultarAjax('PUT', parametro).responseJSON;
    }

    consultar() {
        var parametro = {
            entidad: this.entidad,
            token: this.token,
            do: ""
        }

        return consultarAjax('GET', parametro).responseJSON;
    }

    consultarSonda() {
        var parametro = {
            entidad: this.entidad,
            token: this.token,
            do: "Sonda"
        }

        return consultarAjax('GET', parametro).responseJSON;
    }

    eliminar() {
        var parametro =
            "?entidad=" + this.entidad +
            "&id=" + this.id +
            "&token=" + this.token +
            "&do=";
        return consultarAjax('DELETE', parametro).responseJSON;
    }

    cargarddl(elemento,result,value,displayValue)
    {
        $("#"+elemento).html("");
        var option="";
        for (var indice in result) 
        {
            option+="<option value="+result[indice][value]+">"+result[indice][displayValue]+"</option>";
        }
        $("#"+elemento).append("<option value=''>Seleccionar</option>"+option);

        
    }

    cargarddl2(elemento,result,value,display)
    {
        $("#"+elemento).html("");
        var option="";
        for (var indice in result) 
        {
            option+="<option value="+result[indice][value]+">"+result[indice][display]+"</option>";
        }
        $("#"+elemento).append("<option value=''>Seleccionar</option>"+option);
    }

}
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

        return consultarAjax('POST', parametro);

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

    eliminar() {
        var parametro =
            "?entidad=" + this.entidad +
            "&id=" + this.id +
            "&token=" + this.token +
            "&do=";
        return consultarAjax('DELETE', parametro);
    }

    cargarddl(elemento,result,value,displayValue)
    {
        $("#"+elemento).html("");
        var option="";
        for (var indice in result) 
        {
            option+="<option value="+result[indice][value]+">"+result[indice][displayValue]+"</option>";
        }
        $("#"+elemento).append(option);
    }

}
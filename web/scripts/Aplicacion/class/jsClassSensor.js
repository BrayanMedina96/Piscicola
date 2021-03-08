class Sensor {
    entidad = "Sensor";
    id;
    nombre;
    codigo;
    descripcion;
    marca;
    fechaMantenimiento;
    repetir;
    token;
    estado;

    guardar() {

        var parametro =
            "?entidad=" + this.entidad.trim() +
            "&nombre=" + this.nombre.trim() +
            "&descripcion=" + this.descripcion.trim() +
            "&marca=" + this.marca.trim() +
            "&fechaMantenimiento=" + this.fechaMantenimiento.trim() +
            "&repetir=" + this.repetir.trim() +
            "&codigo=" + this.codigo.trim() +
            "&estado=" + this.estado +
            "&token=" + this.token +
            "&do=";

        return consultarAjax('POST', parametro).responseJSON;


    }

    consultar()
    {
        var parametro = {
            entidad: this.entidad,
            token: this.token,
            do: ""
        }

        return consultarAjax('GET', parametro).responseJSON;
    }

    actualizar()
    {
        var parametro =
            "?entidad=" + this.entidad +
            "&id=" + this.id +
            "&nombre=" + this.nombre +
            "&descripcion=" + this.descripcion +
            "&marca=" + this.marca +
            "&fechaMantenimiento=" + this.fechaMantenimiento +
            "&repetir=" + this.repetir +
            "&codigo=" + this.codigo +
            "&estado=" + this.estado +
            "&token=" + this.token +
            "&do=";

        return consultarAjax('PUT', parametro).responseJSON;
    }

    eliminar() {
        var parametro =
            "?entidad=" + this.entidad +
            "&id=" + this.id +
            "&token=" + this.token +
            "&do=";
        return consultarAjax('DELETE', parametro).responseJSON;
    }

    cargarddl(elemento,result)
    {
        
        $("#"+elemento).html("");
        var option="";
        for (var indice in result) 
        {
            option+="<option value="+result[indice]["sensorid"]+">"+result[indice]["sensornombre"]+"</option>";
        }
        $("#"+elemento).append(option);
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
class Lago {

    id = null;
    entidad = "Lago";
    nombre;
    descripcion;
    geolocalizacion;
    area;
    altitud;
    catidadPeces;
    profundidad;
    token;
    tipolago;

    guardar() {

        var parametro =
            "?entidad=" + this.entidad.trim() +
            "&nombre=" + this.nombre.trim() +
            "&descripcion=" + this.descripcion.trim() +
            "&geolocalizacion=" + this.geolocalizacion.trim() +
            "&area=" + this.area.trim() +
            "&altitud=" + this.altitud.trim() +
            "&catidadPeces=" + this.catidadPeces.trim() +
            "&profundidad=" + this.profundidad.trim() +
            "&token=" + this.token +
            "&tipolago="+this.tipolago+
            "&do=";

        return consultarAjax('POST', parametro).responseJSON;


    }

    actualizar() {
        var parametro =
            "?entidad=" + this.entidad +
            "&id=" + this.id +
            "&nombre=" + this.nombre +
            "&descripcion=" + this.descripcion +
            "&geolocalizacion=" + this.geolocalizacion +
            "&area=" + this.area +
            "&altitud=" + this.altitud +
            "&catidadPeces=" + this.catidadPeces +
            "&profundidad=" + this.profundidad +
            "&token=" + this.token +
            "&tipolago="+this.tipolago+
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

    eliminar()
    {
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
            option+="<option value="+result[indice]["lagoid"]+">"+result[indice]["lagonombre"]+"</option>";
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
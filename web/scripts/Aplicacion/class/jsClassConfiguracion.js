class LagoSensor {
    entidad = "LagoSensor";
    id;
    lago;
    sensor;
    instalacion;
    estado;
    token;

    guardar() {

        var parametro =
            "?entidad=" + this.entidad +
            "&lago=" + this.lago.trim() +
            "&sensor=" + this.sensor.trim() +
            "&instalacion=" + this.instalacion.trim() +
            "&estado=" + this.estado +
            "&token=" + this.token +
            "&do=";

        return consultarAjax('POST', parametro).responseJSON;


    }

    actualizar() {
        var parametro =
            "?entidad=" + this.entidad +
            "&id=" + this.id +
            "&lago=" + this.lago.trim() +
            "&sensor=" + this.sensor.trim() +
            "&instalacion=" + this.instalacion.trim() +
            "&estado=" + this.estado +
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

    eliminar() {
        var parametro =
            "?entidad=" + this.entidad +
            "&id=" + this.id +
            "&token=" + this.token +
            "&do=";
            
        return consultarAjax('DELETE', parametro).responseJSON;
    }

   



}
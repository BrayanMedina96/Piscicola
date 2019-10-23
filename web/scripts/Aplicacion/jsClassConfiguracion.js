class LagoSensor {
    entidad = "LagoSensor";
    id;
    lago;
    sensor;
    instalacion;
    estado;
    especie;
    fechaInicio;
    fechaFinal;
    token;

    guardar() {

        var parametro =
            "?entidad=" + this.entidad +
            "&lago=" + this.lago.trim() +
            "&sensor=" + this.sensor.trim() +
            "&instalacion=" + this.instalacion.trim() +
            "&estado=" + this.estado +
            "&especie=" + this.especie.trim() +
            "&fechaInicio=" + this.fechaInicio.trim() +
            "&fechaFinal=" + this.fechaFinal.trim() +
            "&token=" + this.token +
            "&do=";

        return consultarAjax('POST', parametro);


    }

    actualizar() {
        var parametro =
            "?entidad=" + this.entidad +
            "&id=" + this.id +
            "&lago=" + this.lago.trim() +
            "&sensor=" + this.sensor.trim() +
            "&instalacion=" + this.instalacion.trim() +
            "&estado=" + this.estado +
            "&especie=" + this.especie.trim() +
            "&fechaInicio=" + this.fechaInicio.trim() +
            "&fechaFinal=" + this.fechaFinal.trim() +
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

   



}
class Sonda {
    entidad = "Sonda";
    id;
    fecharegistro;
    oxigenodisuelto;
    ph;
    cultivoid; 
    horaregistro;
    temperaturaambiente;
    temperaturaestanque;
    conductividadelectrica; 
    amonionh3;
    amonionh4;
    nitrito;
    alcalinidad;
    descripcion;
    pecesmuertos;
    importarText;
    token; 

    guardar() {

        // var parametro =
        //     "?entidad=" + this.entidad.trim() +
        //     "&nombre=" + this.nombre.trim() +
        //     "&descripcion=" + this.descripcion.trim() +
        //     "&marca=" + this.marca.trim() +
        //     "&fechaMantenimiento=" + this.fechaMantenimiento.trim() +
        //     "&repetir=" + this.repetir.trim() +
        //     "&codigo=" + this.codigo.trim() +
        //     "&estado=" + this.estado +
        //     "&token=" + this.token +
        //     "&do=";

        // return consultarAjax('POST', parametro);


    }

    consultar()
    {
        // var parametro = {
        //     entidad: this.entidad,
        //     token: this.token,
        //     do: ""
        // }

        // return consultarAjax('GET', parametro);
    }

    actualizar()
    {
        // var parametro =
        //     "?entidad=" + this.entidad +
        //     "&id=" + this.id +
        //     "&nombre=" + this.nombre +
        //     "&descripcion=" + this.descripcion +
        //     "&marca=" + this.marca +
        //     "&fechaMantenimiento=" + this.fechaMantenimiento +
        //     "&repetir=" + this.repetir +
        //     "&codigo=" + this.codigo +
        //     "&estado=" + this.estado +
        //     "&token=" + this.token +
        //     "&do=";

        // return consultarAjax('PUT', parametro);
    }

    eliminar() {
// var parametro =
//     "?entidad=" + this.entidad +
//     "&id=" + this.id +
//     "&token=" + this.token +
//     "&do=";
// return consultarAjax('DELETE', parametro);
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
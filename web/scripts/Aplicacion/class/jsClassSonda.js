class Sonda {
    entidad = "Sonda";
    id;
    fecharegistro;
    oxigenodisuelto;
    ph;
    cultivo;
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
    sensorid;
    funcion=null;

    guardar() {

        var parametro =
            "?entidad=" + this.entidad +
            "&fecharegistro=" + this.fecharegistro +
            "&horaregistro=" + this.horaregistro +
            "&temperaturaambiente=" + this.temperaturaambiente +
            "&temperaturaestanque=" + this.temperaturaestanque +
            "&oxigenodisuelto=" + this.oxigenodisuelto +
            "&ph=" + this.ph +
            "&conductividadelectrica=" + this.conductividadelectrica +
            "&amonionh3=" + this.amonionh3 +
            "&amonionh4=" + this.amonionh4 +
            "&nitrito=" + this.nitrito +
            "&alcalinidad=" + this.alcalinidad +
            "&pecesmuertos=" + this.pecesmuertos +
            "&descripcion=" + this.descripcion +
            "&cultivo=" + this.cultivo +
            "&sensorid=" + this.sensorid +
            "&token=" + this.token +
            "&do=";

        return functionAjax('POST', parametro,this.funcion);

    }

    consultar() {
        var parametro = {
            entidad: this.entidad,
            cultivo: this.cultivo,
            fecharegistro: this.fecharegistro,
            horaregistro: this.horaregistro,
            token: this.token,
            do: ""
        }

        return consultarAjax('GET', parametro).responseJSON;
    }

    parametros() {
        
        var parametro = {
            entidad: this.entidad,
            sensorid: this.sensorid,
            token: this.token,
            do: "getParametros"
        }

        return consultarAjax('GET', parametro).responseJSON;
    }

    parametrosLago() {
        
        var parametro = {
            entidad: this.entidad,
            cultivoid: this.sensorid,
            token: this.token,
            do: "getParametrosLago"
        }

        return consultarAjax('GET', parametro).responseJSON;
    }

    getSondaCultivo(){

        var parametro = {
            entidad: this.entidad,
            cultivo: this.cultivo,
            token: this.token,
            do: "getSondaCultivo"
        }

        return consultarAjax('GET', parametro).responseJSON;
    }

    parametrosInfo() {
        
        var parametro = {
            entidad: this.entidad,
            token: this.token,
            do: "getParametrosInfo"
        }

        return consultarAjax('GET', parametro).responseJSON;
    }


    actualizar() {
        var parametro =
            "?entidad=" + this.entidad +
            "&id=" + this.id +
            "&fecharegistro=" + this.fecharegistro +
            "&horaregistro=" + this.horaregistro +
            "&temperaturaambiente=" + this.temperaturaambiente +
            "&temperaturaestanque=" + this.temperaturaestanque +
            "&oxigenodisuelto=" + this.oxigenodisuelto +
            "&ph=" + this.ph +
            "&conductividadelectrica=" + this.conductividadelectrica +
            "&amonionh3=" + this.amonionh3 +
            "&amonionh4=" + this.amonionh4 +
            "&nitrito=" + this.nitrito +
            "&alcalinidad=" + this.alcalinidad +
            "&pecesmuertos=" + this.pecesmuertos +
            "&descripcion=" + this.descripcion +
            "&cultivo=" + this.cultivo +
            "&token=" + this.token +
            "&sensorid=" + this.sensorid +
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

    importar() {
        var parametro =
            "?entidad=" + this.entidad.trim() +
            "&importarText=" + this.importarText.trim() +
            "&token=" + this.token +
            "&do=importar";

        return consultarAjax('POST', parametro);
    }

    cargarddl(elemento, result, value, displayValue) {
        $("#" + elemento).html("");
        var option = "";
        for (var indice in result) {
            option += "<option value=" + result[indice][value] + ">" + result[indice][displayValue] + "</option>";
        }
        $("#" + elemento).append(option);
    }



}
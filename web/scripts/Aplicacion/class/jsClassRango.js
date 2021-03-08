class Rango {

    entidad = "Rango"
    token = ""
    temperaturaambiente_max = null
    temperaturaestanque_max = null
    oxigeno_max = null
    ph_max = null
    conductividad_max = null
    amonionh3_max = null
    amonionh4_max = null
    nitrito_max = null
    alcalinidad_max = null
    temperaturaambiente_min = null
    temperaturaestanque_min = null
    oxigeno_min = null
    ph_min = null
    conductividad_min = null
    amonionh3_min = null
    amonionh4_min = null
    nitrito_min = null
    alcalinidad_min = null
    descripcion = ""
    id=null
    sondaID=null

    consultarRecomendado() {
        var parametro = {
            entidad: this.entidad,
            token: this.token,
            do: "getRecomendado"
        }

        return consultarAjax('GET', parametro).responseJSON;
    }

    guardar() {
        var parametro =
            "?entidad=" + this.entidad +
            "&temperaturaambiente_max=" + this.temperaturaambiente_max.trim() +
            "&temperaturaestanque_max=" + this.temperaturaestanque_max.trim() +
            "&oxigeno_max=" + this.oxigeno_max.trim() +
            "&ph_max=" + this.ph_max +
            "&conductividad_max=" + this.conductividad_max +
            "&amonionh3_max=" + this.amonionh3_max +
            "&amonionh4_max=" + this.amonionh4_max +
            "&nitrito_max=" + this.nitrito_max +
            "&alcalinidad_max=" + this.alcalinidad_max +
            "&temperaturaambiente_min=" + this.temperaturaambiente_min.trim() +
            "&temperaturaestanque_min=" + this.temperaturaestanque_min.trim() +
            "&oxigeno_min=" + this.oxigeno_min.trim() +
            "&ph_min=" + this.ph_min +
            "&conductividad_min=" + this.conductividad_min +
            "&amonionh3_min=" + this.amonionh3_min +
            "&amonionh4_min=" + this.amonionh4_min +
            "&nitrito_min=" + this.nitrito_min +
            "&alcalinidad_min=" + this.alcalinidad_min +
            "&descripcion=" + this.descripcion +
            "&token=" + this.token +
            "&do=";

        return consultarAjax('POST', parametro).responseJSON;
    }

    actualizar() {
        
        var parametro =
            "?entidad=" + this.entidad +
            "&temperaturaambiente_max=" + this.temperaturaambiente_max.trim() +
            "&temperaturaestanque_max=" + this.temperaturaestanque_max.trim() +
            "&oxigeno_max=" + this.oxigeno_max.trim() +
            "&ph_max=" + this.ph_max +
            "&conductividad_max=" + this.conductividad_max +
            "&amonionh3_max=" + this.amonionh3_max +
            "&amonionh4_max=" + this.amonionh4_max +
            "&nitrito_max=" + this.nitrito_max +
            "&alcalinidad_max=" + this.alcalinidad_max +
            "&temperaturaambiente_min=" + this.temperaturaambiente_min.trim() +
            "&temperaturaestanque_min=" + this.temperaturaestanque_min.trim() +
            "&oxigeno_min=" + this.oxigeno_min.trim() +
            "&ph_min=" + this.ph_min +
            "&conductividad_min=" + this.conductividad_min +
            "&amonionh3_min=" + this.amonionh3_min +
            "&amonionh4_min=" + this.amonionh4_min +
            "&nitrito_min=" + this.nitrito_min +
            "&alcalinidad_min=" + this.alcalinidad_min +
            "&descripcion=" + this.descripcion +
            "&id=" + this.id +
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

    eliminar()
    {
        var parametro =
        "?entidad=" + this.entidad +
        "&id=" + this.id +
        "&token=" + this.token +
        "&do=";

        return consultarAjax('DELETE', parametro).responseJSON;
    }

    eliminarSondaRango()
    {
        var parametro =
        "?entidad=" + this.entidad +
        "&id=" + this.id +
        "&token=" + this.token +
        "&do=eliminarSondaRango";

        return consultarAjax('DELETE', parametro).responseJSON;
    }


    rangoSensor(){

        var parametro =
            "?entidad=" + this.entidad +
            "&rangoID=" + this.id +
            "&sondaID=" + this.sondaID +
            "&token=" + this.token +
            "&do=rangoSensor";

        return consultarAjax('POST', parametro).responseJSON;
    }

    getRangoSensor(){

        var parametro = {
            entidad: this.entidad,
            token: this.token,
            do: "getRangoSensor"
        }

        return consultarAjax('GET', parametro).responseJSON;
    }

    cargarddl(elemento,result)
    {
        $("#"+elemento).html("");
        var option="";
        for (var indice in result) 
        {
            option+="<option value="+result[indice]["id"]+">"+result[indice]["descripcion"]+"</option>";
        }
        
        $("#"+elemento).append(option);
    }

    

}
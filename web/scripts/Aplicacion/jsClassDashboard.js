class Dashboard {
    entidad = "Dashboard";
    x;
    y;
    nombre;
    token;
    id;
    filtro;
    tipografica;

    guardar() {

        var parametro =
            "?entidad=" + this.entidad +
            "&x=" + this.x.trim() +
            "&y=" + this.y.trim() +
            "&filtro=" + this.filtro.trim() +
            "&nombre=" + this.nombre.trim() +
            "&tipografica=" + this.tipografica.trim() +
            "&token=" + this.token +
            "&do=";

        return consultarAjax('POST', parametro);


    }

    actualizar() {
        // var parametro =
        //     "?entidad=" + this.entidad +
        //     "&id=" + this.id +
        //     "&lago=" + this.lago.trim() +
        //     "&sensor=" + this.sensor.trim() +
        //     "&instalacion=" + this.instalacion.trim() +
        //     "&estado=" + this.estado +
        //     "&especie=" + this.especie.trim() +
        //     "&fechaInicio=" + this.fechaInicio.trim() +
        //     "&fechaFinal=" + this.fechaFinal.trim() +
        //     "&token=" + this.token +
        //     "&do=";

        // return consultarAjax('PUT', parametro);
    }

    consultar() {
        var parametro = {
            entidad: this.entidad,
            token: this.token,
            do: ""
        }

        return consultarAjax('GET', parametro);
    }

    consultarSonda() {
        var parametro = {
            entidad: this.entidad,
            token: this.token,
            do: "consultarSonda"
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

    variable() {

        var parametro = {
            entidad: this.entidad ,
            token: this.token ,
            do:'variable'
        }
        
        return consultarAjax('GET', parametro);
    }

    cargarddl(elemento,result)
    {
           $("#"+elemento).html("");
           var option="";
           for (var indice in result) 
           {
               option+="<option value="+result[indice]["campotabla"]+">"+result[indice]["nombre"]+"</option>";
           }
           $("#"+elemento).append(option);
    }
   



}
class Marca {

    entidad = "Marca";
    token;
    id;

    consultar() {

        var parametro = {
            entidad: this.entidad,
            token: this.token,
            do: ""
        }

        return consultarAjax('GET', parametro);

    }


    cargarMarca(elemento, result) {
        $("#" + elemento).html("");
        var option = "";
        for (var indice in result) {
            option += "<option value=" + result[indice]["marcaid"] + ">" + result[indice]["marcanombre"] + "</option>";
        }
        $("#" + elemento).append(option);
    }

    guardar() {
        var parametro =
            "?entidad=" + this.entidad +
            "&nombre=" + this.nombre.trim() +
            "&descripcion=" + this.descripcion.trim() +
            "&token=" + this.token +
            "&do=";

        return consultarAjax('POST', parametro);

    }

    actualizar() {
        var parametro =
            "?entidad=" + this.entidad +
            "&nombre=" + this.nombre.trim() +
            "&descripcion=" + this.descripcion.trim() +
            "&marcaid=" + this.id +
            "&token=" + this.token +
            "&do=";

        return consultarAjax('PUT', parametro);

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
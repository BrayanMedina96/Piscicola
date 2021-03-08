class Seguridad {

    entidad="Seguridad";
    token;
    nombre;
    descripcion;
    formulario;
    campo;
    perfilid;
    accion;
    id;

    consultar() {

        var parametro = {
            entidad: this.entidad,
            token: this.token,
            do: ""
        }

        return consultarAjax('GET', parametro);
       
    }

    gurdar() {

        var parametro =
        "?entidad=" + this.entidad +
        "&nombre=" + this.nombre.trim() +
        "&descripcion=" + this.descripcion.trim() +
        "&token=" + this.token +
        "&do=";

     return consultarAjax('POST', parametro);

    }

    gurdarRestriccion() {

        var parametro =
        "?entidad=" + this.entidad +
        "&campo=" + this.campo.trim() +
        "&formulario=" + this.formulario.trim() +
        "&perfilid=" + this.perfilid.trim() +
        "&accion=" + this.accion.trim() +
        "&token=" + this.token +
        "&do=gurdarRestriccion";

     return consultarAjax('POST', parametro);

    }

    actualizar() {

    }

    eliminar() {

        var parametro =
        "?entidad=" + this.entidad +
        "&id=" + this.id +
        "&token=" + this.token +
        "&do=";
        return consultarAjax('DELETE', parametro);

    }

    consultarPerfil()
    {
        var parametro={
            entidad:this.entidad,
            token:this.token,
            do:"getPerfil"
         }
        
          return consultarAjax('GET',parametro) ;
    }

    consultarFormulario()
    {
        var parametro={
            entidad:this.entidad,
            token:this.token,
            do:"getFormulario"
         }
        
          return consultarAjax('GET',parametro) ;
    }

    consultarCampo()
    {
        var parametro={
            entidad:this.entidad,
            token:this.token,
            formulario:this.formulario,
            do:"getCampo"
         }
        
          return consultarAjax('GET',parametro) ;
    }

    consultarAccion()
    {
        var parametro={
            entidad:this.entidad,
            token:this.token,
            formulario:this.formulario,
            do:"getAccion"
         }
        
          return consultarAjax('GET',parametro) ;
    }
    

    cargarddl(elemento,result,value,text)
    {
           $("#"+elemento).html("");
           var option="";
           for (var indice in result) 
           {
               option+="<option value="+result[indice][value]+">"+result[indice][text]+"</option>";
           }
           $("#"+elemento).append(option);
    }



}
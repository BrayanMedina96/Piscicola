class Persona
{
    entidad = "Persona";
    nombre;
    apellido;
    documento;
    tipodocumento;
    telefono;
    telefonoOpcional;
    correo;
    token;
    notificacorreo;
    notificamensaje;

    
    constructor(nombre,apellido,documento,tipodocumento,telefono,telefonoOpcional,correo,token,id)
    {
       this.nombre=nombre;
       this.apellido=apellido;
       this.documento=documento;
       this.tipodocumento=tipodocumento;
       this.telefono=telefono;
       this.telefonoOpcional=telefonoOpcional;
       this.correo=correo;
       this.token=token;
       this.id=id;
    }

    guardar()
    {
        
        var parametro =
            "?entidad=" + this.entidad +
            "&nombre=" + this.nombre +
            "&apellido=" + this.apellido +
            "&numeroDocumento=" + this.documento +
            "&telefono=" + this.telefono +
            "&usuario=" + this.usuario +
            "&telefonoOpcional=" + this.telefonoOpcional +
            "&correo=" + this.correo +
            "&do=";
   
     return consultarAjax('POST',parametro) ;

    }

    consultar()
    {
       
         var parametro={
            entidad:this.entidad,
            token:this.token,
            id:this.id,
            do:"consultarUN"
        }

      return consultarAjax('GET',parametro) ;
    }

    actualiar()
    {
        var parametro =
            "?entidad=" + this.entidad +
            "&nombre=" + this.nombre +
            "&apellido=" + this.apellido +
            "&numeroDocumento=" + this.documento +
            "&telefono=" + this.telefono +
            "&telefonoOpcional=" + this.telefonoOpcional +
            "&correo=" + this.correo +
            "&token=" + this.token +
            "&tipodocumento=" +this.tipodocumento+
            "&id=" +this.id+
            "&notificacorreo=" + this.notificacorreo +
            "&notificamensaje=" + this.notificamensaje +
            "&do=" +"";

        return consultarAjax('PUT',parametro) ;
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
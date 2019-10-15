class PersonaUsuario{

    entidad="PersonaUsuario";

    constructor (nombre, apellido,numeroDocumento,tipoDocumento,usuario,contrasenia) {
        this.nombre = nombre;
        this.apellido = apellido;
        this.numeroDocumento=numeroDocumento;
        this.tipoDocumento=tipoDocumento;
        this.usuario=usuario;
        this.contrasenia=contrasenia;

      }

    guardar()
    {
         
         var parametro=
         "?entidad="+this.entidad+
         "&nombre="+this.nombre+
         "&apellido="+this.apellido+
         "&numeroDocumento="+this.numeroDocumento+
         "&tipoDocumento="+this.tipoDocumento+
         "&usuario="+this.usuario+
         "&contrasenia="+this.contrasenia+
         "&do="
         ;
    

      return consultarAjax('POST',parametro) ;
   }


   consultar()
   {

      var parametro={
         entidad:this.entidad,
         token:this.token,
         do:""
     }
    
      return consultarAjax('GET',parametro) ;

   }



}
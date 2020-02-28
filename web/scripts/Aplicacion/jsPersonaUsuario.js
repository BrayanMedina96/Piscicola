class PersonaUsuario{

    entidad="PersonaUsuario";
    nombre;
    apellido;
    numeroDocumento;
    tipoDocumento;
    usuario;
    contrasenia;
    nombreComercial;
    usuarioPadre;

    constructor (nombre, apellido,numeroDocumento,tipoDocumento,usuario,contrasenia,nombreComercial) {
        this.nombre = nombre;
        this.apellido = apellido;
        this.numeroDocumento=numeroDocumento;
        this.tipoDocumento=tipoDocumento;
        this.usuario=usuario;
        this.contrasenia=contrasenia;
        this.nombreComercial=nombreComercial;
        
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
         "&nombreComercial="+this.nombreComercial+
         "&token=null&do="
         ;
    

      return consultarAjax('POST',parametro) ;
   }

   crearUsuario() {

      var parametro =
         "?entidad=" + this.entidad +
         "&nombre=" + this.nombre +
         "&apellido=" + this.apellido +
         "&numeroDocumento=" + this.numeroDocumento +
         "&tipoDocumento=" + this.tipoDocumento +
         "&usuario=" + this.usuario + 
         "&usuarioPadre=" + this.usuarioPadre + 
         "&do=CrearUsuario";


      return consultarAjax('POST', parametro);
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

   consultarMiUsuario()
   {

      var parametro={
         entidad:this.entidad,
         token:this.token,
         usuarioPadre:this.usuarioPadre,
         do:"consultarMiUsuario"
     }
    
      return consultarAjax('GET',parametro) ;

   }



}
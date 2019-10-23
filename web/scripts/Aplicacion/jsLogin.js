$(function(){

    $("#btnEnviar").click(function()
    {
        if($("#btnEnviar").text()=="Crear cuenta")
        {
            guardar();
        }
        else{
            ingresar();
        }
    
    })

    $(".registrar").attr("hidden","hidden");
    
    $("#btnCerrar").click(function()
    {
        window.location.href="../index.html";
    })

    $("#btnCrearCuenta").click(function(){
           
        $("#txtTitulo").text("Crear una cuenta");
        $("#btnLogin").removeAttr("hidden");
        $("#btnCrearCuenta").attr("hidden","hidden");
        $(".registrar").removeAttr("hidden");
        $("#btnEnviar").text("Crear cuenta");
        $("#txtPassword").attr("required","required");
        $(".was-validated").removeClass("was-validated");
        $("#ajustar").html("");
        cargarTipoDocumento();
        
    })

    $("#btnLogin").click(function(){

        $("#txtTitulo").text("Inicia sesión");
        $("#btnCrearCuenta").removeAttr("hidden");
        $("#btnLogin").attr("hidden","hidden");
        $(".registrar").attr("hidden","hidden");
        $("#txtPassword").removeAttr("required");
        $("#btnEnviar").text("Inicia sesión");
        $("#ajustar").html("<br> <br> <br> <br>");
        $(".was-validated").removeClass("was-validated");


    })

    function cargarTipoDocumento()
    {
        const obj=new tipodocumento();
        var result = obj.tipoDocumento().responseJSON;
        obj.cargarTipoDocumento("ddlTipoDocumento",result);
        
    }

    function guardar()
    {
        if(!validarCampos("[required]"))
        {
            $("#pnMensaje").html("");
            $("#pnMensaje").html(modal("Alerta","Debe diligenciar todos los campos.","modal-sm"));
            $("#myModal").modal();
            return;
        }

        const objpersona = new persona ($("#txtNombre").val(),$("#txtApelldio").val(),$("#txtNumeroDocumento").val(),$("#ddlTipoDocumento").val(),$("#txtUsuario").val(),$("#txtPassword").val());
        if(objpersona.guardar().responseJSON=="ok")
        {
            $("#pnMensaje").html("");
            $("#pnMensaje").html(modal("Mensaje","Usuario se ha creado correctamente, póngase en contacto con el administrador para darlo de alta.",""));
            $("#myModal").modal();
        }
        
        

    }

    function ingresar()
    {
        var intento= parseInt( $("#txtIntento").val() );

        if(!validarCampos(".login"))
        {
            $("#pnMensaje").html("");
            $("#pnMensaje").html(modal("Alerta","Ingresar usuario y/o contraseña.","modal-sm"));
            $("#myModal").modal();
            return;
        }

        const obj = new usuario ($("#txtUsuario").val(),$("#txtPassword").val());
         
        var resul=obj.login();

        
   
        
        if(resul.responseJSON["data"].length>0)
        {
            obj.in(Object.values( resul.responseJSON ));

        }
        else{
            $("#pnMensaje").html("");
            $("#pnMensaje").html(modal("Alerta","Usuario y/o contraseña incorrecta. <br> Intentos:"+intento,""));
            $("#myModal").modal();
        }
        
        intento++;
        $("#txtIntento").val(intento) ;

    }
    
    

});

function deshabilitaRetroceso(){
    window.location.hash="no-back-button";
    window.location.hash="Again-No-back-button" //chrome
    window.onhashchange=function(){window.location.hash="no-back-button";}
}

class usuario{

    constructor (usuario, contrasenia) {
        this.usuario = usuario;
        this.contrasenia = contrasenia;
    
      }

    login()
    {
         var entidad="Usuario";
         var parametro={
            entidad:entidad,
            usuario:this.usuario,
            contrasenia:this.contrasenia,
            do:"login"
        }

      return consultarAjax('GET',parametro) ;
    }

    in(parametro)
    {
        $("[required]").removeAttr("required");
        $("#txtUsuariohd").val(parametro[0]);
        $("#btnEnviar2").click();
    }

}
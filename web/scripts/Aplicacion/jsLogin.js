var totalTime;

$(function () {

    $(document).keydown(function (e) {
        var code = (e.keyCode ? e.keyCode : e.which);
        if (code == 116 ) {
            e.preventDefault();
        }
    });

    if( parseInt( $("#txtIntento").val() )>3)
    {
            $("#btnEnviar").attr("hidden", "hidden");
    }

    $("#hdCambioPass").val("0");
    
    $("#txtPassword").keyup(function () {
        
        if( $("#txtTitulo").text()=="Crear una cuenta" ||  $("#hdCambioPass").val()=="1")
        {

           var obj= validarPassword( document.getElementById("txtPassword") );
            $("#pnSeguridad").attr("class",obj.color);
            $("#pnSeguridad").attr("style","width:"+obj.porcentaje+"%");
            $("#lblSeguridad").text(obj.porcentaje+"%");

        }

    })

    $("#btnOjo").click(function () {
        
        checkPassword("btnOjo","txtPassword");

    })

    $("#btnEnviar").click(function () {

        if ($("#btnEnviar").text() == "Crear cuenta") {
            guardar();
            return;
        }

        if ($("#btnEnviar").text() == "Crear usuario") {
            crearUsuario();
            return;
        }


        if ($("#btnEnviar").text() == "Actualizar") {
            actulizar();
        } else {
            ingresar();
        }

       

    })

    $(".registrar").attr("hidden", "hidden");

    $("#btnCerrar").click(function () {
        window.location.href = "../index.html";
    })

    $("#btnCrearCuenta").click(function () {

        $("#txtTitulo").text("Crear una cuenta");
        $("#btnLogin").removeAttr("hidden");
        $("#btnCrearCuenta").attr("hidden", "hidden");
        $(".registrar").removeAttr("hidden");
        $("#btnEnviar").text("Crear cuenta");
        $("#btnEnviar").attr("type","button");
        $("#txtPassword").attr("required", "required");
        $(".was-validated").removeClass("was-validated");
        $("#ajustar").html("<br><br>");
       
        
        $("#txtPassword").attr("data-toggle","tooltip");
        $("#txtPassword").attr("title","Para crear un password seguro utilice (Mayúscula, Minúscula, Números y algún símbolos: ! # $ % & = ? * . @")
        $('[data-toggle="tooltip"]').tooltip();

        cargarTipoDocumento();

    })

    $("#btnLogin").click(function () {

        $("#txtTitulo").text("Inicia sesión");
        $("#btnCrearCuenta").removeAttr("hidden");
        $("#btnLogin").attr("hidden", "hidden");
        $(".registrar").attr("hidden", "hidden");
        $("#txtPassword").removeAttr("required");
        $("#btnEnviar").text("Inicia sesión");
        $("#btnEnviar").attr("type","Submit");
        $("#ajustar").html("<br> <br> <br> <br>");
        $(".was-validated").removeClass("was-validated");
        

    })

    $("#txtUsuario").focus(function () {
        
        if($("#txtTitulo").text()=="Crear una cuenta")
        {
            var nombre=$("#txtNombre").val().split(" ");
            var apellido=$("#txtApelldio").val().split(" ");
            $("#txtUsuario").val(nombre[0]+"."+apellido[0]);
        }
       
    })

    

    function guardar() {

        if (!validarCampos("[required]")) {
            $("#pnMensaje").html("");
            $("#pnMensaje").html(modal("Alerta", "Debe llenar todos los campos.", "modal-sm"));
            $("#myModal").modal();
            return;
        }

        if(!compararTxt($("#txtPassword").val(),$("#txtPasswordConfirmar").val()))
        {
            $("#pnMensaje").html("");
            $("#pnMensaje").html(modal("Alerta", "Las contraseñas no son iguales.", "modal-sm"));
            $("#myModal").modal();
            return;
        }

        const objpersona = new PersonaUsuario($("#txtNombre").val(), $("#txtApelldio").val(), $("#txtNumeroDocumento").val(), $("#ddlTipoDocumento").val(), $("#txtUsuario").val(), $("#txtPassword").val(),$("#txtNombreComercial").val());
        var result=objpersona.guardar();
        
        if (result.responseJSON["response"] == "ok") {

            var msg="";
            if(result.responseJSON["tipo"]=="user")
            {
                var intentoUser=parseInt( $("#txtUser").val() ) + 1;

                $("#txtUser").val( intentoUser );
                var usuario=encontrarUser( intentoUser );
                msg=" Podria intentar con : "+usuario;
                $("#txtUsuario").val(usuario);
            }

            $("#pnMensaje").html("");
            $("#pnMensaje").html(modal("Mensaje", result.responseJSON["mensaje"] + msg, ""));
            $("#myModal").modal();
            

        }

    }

    function ingresar() {

        try {
           
            var intento = parseInt($("#txtIntento").val());

        if (!validarCampos(".login")) {
            $("#pnMensaje").html("");
            $("#pnMensaje").html(modal("Alerta", "Ingresar usuario y/o contraseña.", "modal-sm"));
            $("#myModal").modal();
            return;
        }

        const obj = new usuario($("#txtUsuario").val(), $("#txtPassword").val());
      
        var resul = obj.login();


        if(resul.responseJSON["cambioPass"])
        {
            $("#pnPassword").removeAttr("hidden") ;
            $("#hdCambioPass").val("1");
            $("#btnEnviar").text("Actualizar");
            $("#pnMensaje").html("");
            $("#pnMensaje").html(modal("Alerta", "En hora buena, Cambio de contraseña.", "modal-sm"));
            $("#myModal").modal();
            $("#txtPassword").val("");
            $("#txtToken").val( resul.responseJSON["data"] );
            //resul.responseJSON["dataCambioPass"]["token"]

            return;
        }


        if (resul.responseJSON["data"].length > 0)
        {
            if(!resul.responseJSON["estado"])
            {
                    $("#pnMensaje").html("");
                    $("#pnMensaje").html(modal("Alerta", "Usuario inactivo, Póngase en contacto con el administrador."));
                    $("#myModal").modal();
                    return;
            }

            obj.in(Object.values(resul.responseJSON));

        } else {
            $("#pnMensaje").html("");
            $("#pnMensaje").html(modal("Alerta", "Usuario y/o contraseña incorrecta. <br> Intentos:" + intento, ""));
            $("#myModal").modal();
        }

        intento++;
        $("#txtIntento").val(intento);

        if(intento>3)
        {
            $("#btnEnviar").attr("hidden", "hidden");
            $("#lblTiempo").removeAttr("hidden");
            totalTime=60;
            updateClock();
        }
            
        } catch (error) {
            badge("#pnMensaje", error, "danger");
        }
        


    }

    function actulizar() {

        if (!compararTxt($("#txtPassword").val(), $("#txtPasswordConfirmar").val())) {
            $("#pnMensaje").html("");
            $("#pnMensaje").html(modal("Alerta", "Las contraseñas no son iguales.", "modal-sm"));
            $("#myModal").modal();
            return;
        }

        var obj = new usuario();
        obj.usuario = $("#txtUsuario").val();
        obj.contrasenia = $("#txtPassword").val();
        obj.token=$("#txtToken").val();
        obj.actualizar();

        ingresar();
    }

    function encontrarUser(params) {
        console.log(params);
        var usuario="";
        switch (params) {
            case 1:
                usuario = $("#txtUsuario").val() + "_" + Math.floor((Math.random() * 1000) + 1);

                break;
            case 2:
                var nombre = $("#txtNombre").val().split(" ");
                var apellido = $("#txtApelldio").val().split(" ");
                usuario = nombre.length > 1 ? nombre[1] : nombre[0];
                usuario += apellido.length > 1 ? "." + apellido[1] : "." + apellido[0];

                break;
            default:

                var nombre = $("#txtNombre").val().split(" ");
                var apellido = $("#txtApelldio").val().split(" ");
                usuario = nombre.length > 1 ? nombre[1] : nombre[0];
                usuario += apellido.length > 1 ? "." + apellido[1] : "." + apellido[0];
                usuario += "_" + Math.floor((Math.random() * 1000) + 1);

                break;


        }

        return usuario;

    }

  

});



function updateClock() {
    document.getElementById('lblTiempo').innerHTML = totalTime;
    if (totalTime == 0) {
        $("#btnEnviar").removeAttr("hidden");
        $("#lblTiempo").attr("hidden", "hidden");
        $("#txtIntento").val("0");
    } else {
        totalTime -= 1;
        setTimeout("updateClock()", 1000);
    }
}

function cargarTipoDocumento() {
    const obj = new tipodocumento();
    var result = obj.tipoDocumento().responseJSON;
    obj.cargarTipoDocumento("ddlTipoDocumento", result);

}

function deshabilitaRetroceso() {
    window.location.hash = "no-back-button";
    window.location.hash = "Again-No-back-button" //chrome
    window.onhashchange = function () {
        window.location.hash = "no-back-button";
    }
}

class usuario {

     entidad = "Usuario";
     token;

    constructor(usuario, contrasenia) {
        this.usuario = usuario;
        this.contrasenia = contrasenia;

    }

    login() {
            
            var parametro = {
                entidad: this.entidad,
                usuario: this.usuario,
                contrasenia: this.contrasenia,
                token:"null",
                do: "login"
            }

            return consultarAjax('GET', parametro);
        }

        actualizar()
        {
            var parametro =
            "?entidad=" + this.entidad +
            "&usuario=" + this.usuario +
            "&contrasenia=" + this.contrasenia +
            "&token=" + this.token +
            "&do=actualizarPassword";

             return consultarAjax('PUT',parametro) ;
        }

    in (parametro) {
            $("[required]").removeAttr("required");
            $("#txtUsuariohd").val(parametro[0]);
            $("#btnEnviar2").click();
        }

}
$(function(){

    cargarTipoDocumento();
    cargarID();
    buscarPersona();
    cargarPerfil();
    $("#lblTitulo").text("Editar mi cuenta");

    $(".usuario").attr("hidden","hidden");
    
   
    $("#myInput").on("keyup", function() 
    {
          var value = $(this).val().toLowerCase();

          $("#tdResultado tr").filter(function() 
           {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)   
           });

           var numOfVisibleRows = $('#tdResultado tr').filter(function() {
              return $(this).css('display') !== 'none';
           }).length;
           
    });

    $("#txtFechaExpiracion").datepicker({
        onSelect: function (fd, d, calendar) {
            calendar.hide()
        }
    })

    $("#btnLimpiar").click(function () {
        
        $("#mCuenta").click();

    })

    $("#btnOjo").click(function () {
        
        checkPassword("btnOjo","txtContrasenia");

    })
    
   function  cargarID() 
   {
     $("#txtidUsuario").val($("#txtUsuarioidMenu").val());
     $("#txtidPersona").val($("#txtPersonaidMenu").val());
   }

    function cargarTipoDocumento()
    {
            const obj=new tipodocumento();
            var result = obj.tipoDocumento().responseJSON;
            obj.cargarTipoDocumento("ddlTipoDocumento",result);
    }

    function iniciarPersona() {

        const objPersona = new Persona(
            $("#txtNombre").val(),
            $("#txtApellido").val(),
            $("#txtNumeroDocumento").val(),
            $("#ddlTipoDocumento").val(),
            $("#txtTelefono").val(),
            $("#txtTelefonoOpcional").val(),
            $("#txtEmail").val(),
            $("#txtVarUrl").val(),
            $("#txtidPersona").val(),
        );

        objPersona.notificacorreo = $("#chekNotificacionCorreo").prop('checked');
        objPersona.notificamensaje = $("#chekNotificacionMensaje").prop('checked');

        return objPersona;
    }

    
    function buscarPersona()
    {
    
             var result=iniciarPersona().consultar().responseJSON;
             
             for (const key in result) 
             {
                 
                $("#txtNombre").val(result[key]["perosnanombre"]);
                $("#txtApellido").val(result[key]["personaapellido"]);
                $("#txtNumeroDocumento").val(result[key]["personanumerodocumento"]);
                $("#txtEmail").val(result[key]["personacorreo"]);
                $("#txtTelefono").val(result[key]["personatelefono"]);
                $("#txtTelefonoOpcional").val(result[key]["personatelefonoopcional"]);
                $("#ddlTipoDocumento").val(result[key]["tipodocumentoid"]);
                $("#txtidPersona").val(result[key][0]);
                $("#chekNotificacionCorreo").prop("checked", result[key]["notificacioncorreo"] );
                $("#chekNotificacionMensaje").prop("checked", result[key]["notificacionmensaje"] );
                $("#chkEstado").prop("checked", result[key]["usuarioestado"] );
                $("#btnEnviar").text("Actualizar");
                if(result[key]["perfilid"]==3)
                {
                  $("#btnUsuario").removeAttr("hidden");
                }
                
             }


    }

    

    function actualizarPersona() {

        var result=iniciarPersona().actualiar().responseJSON;
        if(result)
        {
            $("#pnMensaje").html("");
            $("#pnMensaje").html(modal("Mensaje","Registros actualizados.",""));
            $("#myModal").modal();
        }
        
        
    }


    function actualizarUsuario()
    {
        if ($("#txtFechaExpiracion").text()=="") {
            errorCampos("txtFechaExpiracion");
            return;
        }

          var obj=new Usuario();
          obj.token=$("#txtVarUrl").val();
          obj.nombre=$("#txtUsuario").val();
          obj.contrasenia=$("#txtContrasenia").val();
          obj.perfil=$("#ddlPerfil").val();
          obj.fechaExpiracion=$("#txtFechaExpiracion").val();
          obj.estado=$("#chkEstado").prop('checked');
          obj.id=$("#txtidUsuario").val();
          obj.cambioPassword = $("#chkCambioPassword").prop('checked');
          if(obj.actualizar())
          {
            $("#pnMensaje").html("");
            $("#pnMensaje").html(modal("Mensaje","Usuario actualizado.",""));
            $("#myModal").modal();
          }
          

    }


    function consultarUsuario() {

        var objUsuario = new Usuario();
        objUsuario.id = $("#txtidUsuario").val();
        objUsuario.token = $("#txtVarUrl").val();
        var result = objUsuario.consultar().responseJSON;

        for (const key in result) {

            $("#txtUsuario").val(result[key]["usuarionombre"]);
            $("#ddlPerfil").val(result[key]["perfilid"]);
            $("#txtFechaExpiracion").val(result[key]["usuariofechaexpira"]);
            $("#chkEstado").prop("checked", result[key]["usuarioestado"] );
            $("#txtContrasenia").val(result[key]["usuariocontrasenia"]);
            $("#txtContraseniaConfirmar").val(result[key]["usuariocontrasenia"]);
            $("#btnEnviar").text("Actualizar");

        }

    }
    
    function cargarPerfil()
    {
        var obj=new Seguridad();
        obj.token=$("#txtVarUrl").val();
        obj.cargarddl("ddlPerfil",obj.consultarPerfil().responseJSON,"perfilid","perfilnombre" );
    }
    

    $("#btnInfoPersonal").click(function(){

          
          $("#lblTitulo").text("Editar mi cuenta");
          $(".usuario").attr("hidden","hidden");
          $(".personal").removeAttr("hidden");
          
          

    })

    $("#btnSeguridad").click(function(){

        
        $("#lblTitulo").text("Seguridad");
        $(".personal").attr("hidden","hidden");
        $(".usuario").removeAttr("hidden");
        $("#txtUsuario").val($("#txtUsuarioMenu").val());
        consultarUsuario();
        

    })

    $("#btnEnviar").click(function(){

       
        if( $("#txtEmail").val()!="")
        {
           if( validarEmail( $("#txtEmail").val() ) )
           {
              $("#pnMensaje").html("");
              $("#pnMensaje").html(modal("Alerta","La dirección del email es incorrecta.",""));
              $("#myModal").modal();
              return;
           }
            
        }
     
        if($("#btnEnviar").text()=="Actualizar" && $("#lblTitulo").text()=="Editar mi cuenta")
        {
            
            actualizarPersona();
        }

        if($("#btnEnviar").text()=="Actualizar" && $("#lblTitulo").text()=="Seguridad")
        {
            actualizarUsuario();
        }

    });
    

    $('#Tabla tbody').on('click', 'tr', function () 
    {
        var table = $('#Tabla').DataTable();
        var data = table.row( this ).data();
        $("#txtidPersona").val(data.personaid);
        $("#txtidUsuario").val(data.usuarioid);

        consultarUsuario();
        buscarPersona();

        $("#pnPassword").hide();

        $("#pnCambioPassword").removeClass("d-none");

        $("#modalPersona").modal('hide');
        
    
    } );

    $("#btnUsuario").click(function () {

        var obj = new PersonaUsuario();
        obj.token=$("#txtVarUrl").val();
        var result = obj.consultar().responseJSON;
        
        var columna = [
            {
                "data": "perfilnombre"
            },
            {
                "data": "personanumerodocumento"
            },
            {
                "data": "usuarionombre"
            },
            {
                "data": "perosnanombre"
            },
            {
                "data": "personaapellido"
            },
            {
                "data": "usuarioestado"
            }
        ]

        tabla("Tabla", result, columna,{});

    })

    $("#btnMiUsuario").click(function () {
        
        var obj = new PersonaUsuario();
        obj.token=$("#txtVarUrl").val();
        obj.usuarioPadre=$("#txtUserPadre").val();
        var result = obj.consultarMiUsuario().responseJSON;
        
        var columna = [
            {
                "data": "perfilnombre"
            },
            {
                "data": "personanumerodocumento"
            },
            {
                "data": "usuarionombre"
            },
            {
                "data": "perosnanombre"
            },
            {
                "data": "personaapellido"
            },
            {
                "data": "usuarioestado"
            }
        ]

        tabla("Tabla", result, columna,{});

    })
    


})





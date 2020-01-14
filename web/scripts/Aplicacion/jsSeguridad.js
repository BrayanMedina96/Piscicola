$(function () {

    $("#lblEstado").text(" > Perfiles");
    ddlPerfil();
    ddlFormulario();
    ddlAccion();
    $('[data-toggle="tooltip"]').tooltip();
    

    $("#btnPerfil").click(function () {

        $("#pnCrearPermiso").addClass("d-none");
        $("#pnCrearPerfil").removeClass("d-none");
        $("#lblEstado").text(" > Perfiles");

    })

    $("#btnPermisos").click(function () {

        $("#pnCrearPerfil").addClass("d-none");
        $("#pnCrearPermiso").removeClass("d-none");
        $("#lblEstado").text(" > Permisos");

    })

    $("#btnEnviar").click(function () {

        var obj = new Seguridad();
        obj.token = $("#txtVarUrl").val();
        obj.nombre = $("#txtNombre").val();
        obj.descripcion = $("#txtDescripcion").val();

        if ($("#lblEstado").text() == " > Perfiles") {

            if (!validarCampos(".perfil")) {
                $("#pnMensaje").html("");
                $("#pnMensaje").html(modal("Alerta", "Debe diligenciar todos los campos.", "modal-sm"));
                $("#myModal").modal();
                return;
            }

            obj.gurdar();
          
        }else{

            obj.campo=$("#ddlCampo").val();
            obj.formulario=$("#ddlFormulario").val();
            obj.perfilid=$("#ddlPerfil").val();
            obj.accion=$("#ddlAccion").val();
            obj.gurdarRestriccion();

        }


    })

    $("#ddlFormulario").change(function() {
        
    
       var obj=new Seguridad();
       obj.token=$("#txtVarUrl").val();
       obj.formulario=$(this).val();
       var result=obj.consultarCampo().responseJSON;
       obj.cargarddl("ddlCampo",result,"campo","campo");


    })

    $("#btnConfiguracion").click(function () {
        
        $("#modal").modal();
        tablaRestriccion();
    })

    $('#Tabla tbody').on('click', 'tr .eliminar', function () {
        var table = $('#Tabla').DataTable();
        var data = table.row( $(this).parents("tr") ).data();
        var si=confirm("Está seguro de eliminar esta restricción.");
        if(si)
        {
            
            var obj=new Seguridad();
            obj.id=data.restriccionid;
            obj.token = $("#txtVarUrl").val();
            obj.eliminar();
            tablaRestriccion();

        }

    })

    $("#btnOcultar").click(function() {
        
        if($("#ddlFormulario").val()=="")
        {
            $("#pnMensaje").html("");
            $("#pnMensaje").html(modal("Alerta", "Debe seleccionar un formulario.", "modal-sm"));
            $("#myModal").modal();
            return;
        }

          var obj = new Seguridad();
          obj.token = $("#txtVarUrl").val();
          obj.formulario = $("#ddlFormulario").val();
          obj.perfilid = $("#ddlPerfil").val();
          obj.campo=$("#ddlFormulario").val();
          obj.accion = "hidden";
          obj.gurdarRestriccion();


    })


    function  tablaRestriccion() {
        
        var obj=new Seguridad();
        obj.token=$("#txtVarUrl").val();
        var result=obj.consultar().responseJSON;

        var columna = [
            {
                "data": "perfilnombre"
            },
            {
                "data": "formularionombre"
            },
            {
                "data": "campo"
            },
            {
                "data": "acciondescripcion"
            },
            {
                "targets": -1,
                "data": null,
                "defaultContent": "<img class='eliminar' src='../svg/delete.png'></img>"
            }
        ]

        tabla("Tabla", result, columna,{});

    }

    function  ddlPerfil() {
        
        var obj=new Seguridad();
        obj.token=$("#txtVarUrl").val();
        var result=obj.consultarPerfil().responseJSON;
        obj.cargarddl("ddlPerfil",result,"perfilid","perfilnombre");
         

    }

    function  ddlFormulario() {
        
        var obj=new Seguridad();
        obj.token=$("#txtVarUrl").val();
        var result=obj.consultarFormulario().responseJSON;
        obj.cargarddl("ddlFormulario",result,"formularioid","formularionombre");
         

    }

    function ddlAccion() {
        

        var obj=new Seguridad();
        obj.token=$("#txtVarUrl").val();
        var result=obj.consultarAccion().responseJSON;
        obj.cargarddl("ddlAccion",result,"accionid","acciondescripcion");

    }



})
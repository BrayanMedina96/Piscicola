$(function () {
    
    lago();
    especie();

    $("#txtFechaInicio").datepicker({
        onSelect: function (fd, d, calendar) {
            calendar.hide()
        }
    })

    $("#txtFechaFinaliza").datepicker({
        onSelect: function (fd, d, calendar) {
            calendar.hide()
        }
    })

    $("#btnEnviar").click(function () {
        
        var obj=new Cultivo();
        obj.lago=$("#ddlLago").val();
        obj.especie=$("#ddlEspecie").val();
        obj.fechaInicio=$("#txtFechaInicio").val();
        obj.fechaFinal=$("#txtFechaFinaliza").val();
        obj.token=$("#txtVarUrl").val();

        if($("#btnEnviar").text()=="Guardar")
        {
            obj.guardar();
            badge("#pnMensaje", "Registro guardado.","success");

        }else{

            obj.id=$("#txtID").val();
            obj.actualizar();
            badge("#pnMensaje", "Registro actualizado.","success");

        }

        $("#btnLimpiar").click();

    })

    $("#btnLimpiar").click(function () {

        limpiar(".limpiar");
        $("#btnEnviar").text("Guardar");
        $("#btnEnviar").attr("class", "btn btn-primary");

    })

    $("#btnConfiguracion").click(function () {
        
        $("#modal").modal("show");
        consultar();

    })

    $('#Tabla tbody').on('click', 'tr .seleccionarFila', function () {
        var table = $('#Tabla').DataTable();
        var data = table.row( $(this).parents("tr") ).data();

        $("#ddlLago").val(data.lagoid);
        $("#ddlEspecie").val(data.pezid);
        $("#ddlSensor").val(data.sensorid);
        $("#txtFechaInicio").val(data.fechainicio);
        $("#txtFechaFinaliza").val(data.fechafinalizacion);
        $("#txtID").val(data.cultivoid);
        $("#btnCerrarModal").click();
        $("#btnEnviar").text("Actualizar");
        $("#btnEnviar").attr("class", "btn btn-success");

    });

    $('#Tabla tbody').on('click', 'tr .eliminar', function () {
        var table = $('#Tabla').DataTable();
        var data = table.row( $(this).parents("tr") ).data();
        var si=confirm("Está seguro de eliminar.");
        if(si)
        {
            
            var obj=new Cultivo();
            obj.id=data.cultivoid;
            obj.token = $("#txtVarUrl").val();
            obj.eliminar();
            consultar();

        }

    });

    function lago() {

        var obj = new Lago();
        obj.token = $("#txtVarUrl").val();
        obj.cargarddl("ddlLago",obj.consultar().responseJSON);
    }

    function especie()
    {
        var obj=new Especie();
        obj.token=$("#txtVarUrl").val();
        obj.cargarddl("ddlEspecie",obj.consultar().responseJSON);
    }

    function consultar() {

        var obj = new Cultivo();
        obj.token = $("#txtVarUrl").val();
        var result = obj.consultar().responseJSON;

        

        var columna = [
            {
                "targets": -1,
                "data": null,
                "defaultContent": "<img class='seleccionarFila' src='../svg/selection-option.png'></img>"
            },
            {
                "data": "lagonombre"
            },
            {
                "data": "especiepez"
            },
            {
                "data": "fechainicio"
            },
            {
                "data": "fechafinalizacion"
            },
            {
                "targets": -1,
                "data": null,
                "defaultContent": "<img class='eliminar' src='../svg/delete.png'></img>"
            }
        ]


        tabla("Tabla", result, columna,"");

    }




})
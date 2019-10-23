$(function () {

    especie();
    sensor(); 
    lago();

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

    $("#txtFechaInstala").datepicker({
        onSelect: function (fd, d, calendar) {
            calendar.hide()
        }
    })
    

    function especie()
    {
        var obj=new Especie();
        obj.cargarddl("ddlEspecie",obj.consultar().responseJSON);
    }

    function sensor() 
    {
        var obj=new Sensor();
        obj.token = $("#txtVarUrl").val();
        obj.cargarddl("ddlSensor",obj.consultar().responseJSON);
    }

    function lago() {

        var obj = new Lago();
        obj.token = $("#txtVarUrl").val();
        obj.cargarddl("ddlLago",obj.consultar().responseJSON);
    }

    $("#btnLimpiar").click(function () {
  
        limpiar(".limpiar");
        $("#btnEnviar").text("Guardar");
        $("#btnEnviar").attr("class", "btn btn-primary");
    
     })

     $("#btnEnviar").click(function () {


        if (!validarCampos("[required]")) {
            $("#pnMensaje").html("");
            $("#pnMensaje").html(modal("Alerta", "Debe diligenciar los campos.", "modal-sm"));
            $("#myModal").modal();
            return;
        }

        var obj = new LagoSensor();
        obj.lago = $("#ddlLago").val();
        obj.sensor = $("#ddlSensor").val();
        obj.instalacion = $("#txtFechaInstala").val();
        obj.estado = $("#chkEstado").prop('checked');
        obj.especie = $("#ddlEspecie").val();
        obj.fechaInicio = $("#txtFechaInicio").val();
        obj.fechaFinal = $("#txtFechaFinaliza").val();
        obj.token = $("#txtVarUrl").val();

        if ($("#btnEnviar").text() == "Guardar") {
            obj.guardar();
        } else {

            obj.id = $("#textLagoSensorID").val();
            obj.actualizar();
        }


        $("#btnLimpiar").click();
    })


    $("#btnConfiguracion").click(function () {
        
        $("#modal").modal("show");
        consultar();

    })

    function consultar() {

        var obj = new LagoSensor();
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
                "data": "sensornombre"
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

        fucion = {
            render: function (data, type, full, meta) {
                var da = data.substr(0, 20);
                if (data.length > da.length) {
                    da = da + "...";
                }
                return da;;
            },
            targets: 2
        }

        tabla("Tabla", result, columna,fucion);

    }


    $('#Tabla tbody').on('click', 'tr .seleccionarFila', function () {
        var table = $('#Tabla').DataTable();
        var data = table.row( $(this).parents("tr") ).data();

        $("#textLagoSensorID").val(data.lagosensorid);
        $("#ddlLago").val(data.lagoid);
        $("#ddlSensor").val(data.sensorid);
        $("#txtFechaInstala").val(data.lagosensorfechainstalacion);
        $("#chkEstado").prop("checked",data.lagosensorestado);
        $("#ddlEspecie").val(data.pezid);
        $("#txtFechaInicio").val(data.fechainicio);
        $("#txtFechaFinaliza").val(data.fechafinalizacion);
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
            
            var obj=new LagoSensor();
            obj.id=data.lagosensorid;
            obj.token = $("#txtVarUrl").val();
            obj.eliminar();
            consultar();

        }

    });

})
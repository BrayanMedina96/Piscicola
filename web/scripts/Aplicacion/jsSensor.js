$(function () {

    marca();

    $("#txtFecha").datepicker({
        onSelect: function (fd, d, calendar) {
            calendar.hide()
        }
    })

    function marca() {

        var obj = new Marca();
        obj.token=$("#txtVarUrl").val();
        obj.cargarMarca("ddlMarca", obj.consultar().responseJSON);
    }

    $("#btnEnviar").click(function () {

        if (!validarCampos("[required]")) {
            $("#pnMensaje").html("");
            $("#pnMensaje").html(modal("Alerta", "Debe llenar los campos.", "modal-sm"));
            $("#myModal").modal();
            return;
        }


        var obj = new Sensor();
        obj.nombre = $("#txtNombre").val();
        obj.descripcion = $("#txtDescripcion").val();
        obj.codigo = $("#txtCodigo").val();
        obj.marca = $("#ddlMarca").val();
        obj.fechaMantenimiento = $("#txtFecha").val();
        obj.repetir = $("#txtRepetir").val();
        obj.token=$("#txtVarUrl").val();
        obj.estado=$("#chkEstado").prop('checked');

        if ($("#btnEnviar").text() == "Guardar") {
            obj.guardar();
            badge("#pnMensaje", "Registro guardado.", "success");

        } else {

            obj.id = $("#txtSensorID").val();
            obj.actualizar();
            badge("#pnMensaje", "Registro guardado.", "success");
        }


        $("#btnLimpiar").click();

    })


    $("#btnSensor").click(function () {
        $("#modalSensor").modal("show");
        consultarSensor();
    })


    function consultarSensor() {

        var obj = new Sensor();
        obj.token = $("#txtVarUrl").val();
        var result = obj.consultar().responseJSON;

        
        var columna = [
            {
                "targets": -1,
                "data": null,
                "defaultContent": "<img class='seleccionarFila' src='../svg/selection-option.png'></img>"
            },
            {
                "data": "sensornombre"
            },
            {
                "data": "sensordescripcion"
            },
            {
                "data": "sensorcodigo"
            },
            {
                "data": "sensorfechamantenimiento"
            },
            {
                "data": "sensorperiodicidadmantenimiento"
            },
            {
                "data": "sensorestado"
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

        $("#txtSensorID").val(data.sensorid);
        $("#txtNombre").val(data.sensornombre);
        $("#txtDescripcion").val(data.sensordescripcion);
        $("#txtCodigo").val(data.sensorcodigo);
        $("#ddlMarca").val(data.marcaid);
        $("#txtFecha").val(data.sensorfechamantenimiento);
        $("#txtRepetir").val(data.sensorperiodicidadmantenimiento);
        $("#chkEstado").prop('checked',data.sensorestado);
        $("#btnCerrarModal").click();
        $("#btnEnviar").text("Actualizar");
        $("#btnEnviar").attr("class", "btn btn-success");

    });

    $('#Tabla tbody').on('click', 'tr .eliminar', function () {
        var table = $('#Tabla').DataTable();
        var data = table.row( $(this).parents("tr") ).data();
        var si=confirm("Está seguro de eliminar: "+data.sensornombre);
        if(si)
        {
            
            var obj=new Sensor();
            obj.id=data.sensorid;
            obj.token = $("#txtVarUrl").val();
            obj.eliminar();
            consultarSensor();

        }

    });

    
    $("#btnLimpiar").click(function () {
  
        limpiar(".limpiar");
        $("#btnEnviar").text("Guardar");
        $("#btnEnviar").attr("class", "btn btn-primary");
 
        
     });




})
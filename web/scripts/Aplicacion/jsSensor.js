$(function () {

    marca();

    $("#myInput").on("keyup", function () {
        var value = $(this).val().toLowerCase();

        $("#tdResultado tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);

        });
    });

    $("#txtFecha").datepicker({
        onSelect: function (fd, d, calendar) {
            calendar.hide()
        }
    })

    function marca() {

        var obj = new Marca();
        obj.token=$("#txtVarUrl").val();
        obj.cargarMarca("ddlMarca", obj.consultar()['data']);
    }

    $("#btnEnviar").click(function () {

        if (!validarCampos("[required]")) {
            $("#pnMensaje").html("");
            badge("#pnMensaje","Debe llenar los campos.","danger");
            return;
        }

        UtlCargando();

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
            var result=obj.guardar();
            validarRespuesta(result)

        } else {

            obj.id = $("#txtSensorID").val();
            var result=obj.actualizar();
            validarRespuesta(result)
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
        var result = obj.consultar();

        validarRespuesta(result)

        if(result['estado'])
        {
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
    
            tabla("Tabla", result['data'], columna,fucion);
        }

        
    
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
            var result= obj.eliminar();
            if(result['estado'])
            {
                $(this).parents("tr").remove()
            }

            validarRespuesta(result)

        }

    });

    
    $("#btnLimpiar").click(function () {
  
        
        $("#btnEnviar").text("Guardar");
        $("#btnEnviar").attr("class", "btn btn-primary");
        $(":text").removeAttr('required');
        $(".was-validated").removeClass('was-validated');
        $(":text").val('');
        $(".limpiar").val("")
        $("#txtDescripcion").val("")

        
     });

     function validarRespuesta(respuesta) {
        if (respuesta['estado']) {
            if (respuesta['mensaje'] != "") {
                badge("#pnMensaje", respuesta['mensaje'], "success");
                $("#btnLimpiar").click();
            }

        } else {
            badge("#pnMensaje", respuesta['mensaje'], "danger");
            console.log("ERROR:", respuesta)
        }
    }



})
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


    function especie() {
        var obj = new Especie();
        obj.token = $("#txtVarUrl").val();
        obj.cargarddl("ddlEspecie", obj.consultar()['data']);
    }

    function sensor() {
        var obj = new Sensor();
        obj.token = $("#txtVarUrl").val();
        var result = obj.consultar()
        if (result['estado']) {
            obj.cargarddl("ddlSensor", result["data"]);
        }
        validarRespuesta(result)
    }

    function lago() {

        var obj = new Lago();
        obj.token = $("#txtVarUrl").val();
        var result = obj.consultar()
        if (result['estado']) {
            obj.cargarddl("ddlLago", result['data']);
        }

        validarRespuesta(result)

    }

    $("#btnLimpiar").click(function () {

        $("#btnEnviar").text("Guardar");
        $("#btnEnviar").attr("class", "btn btn-primary");

        $(".was-validated").removeClass('was-validated');
        $(":text").removeAttr('required');
        $(":text").val('');

    })

    $("#btnEnviar").click(function () {


        if (!validarCampos("[required]")) {
            $("#pnMensaje").html("");
            badge("#pnMensaje", "Debe llenar los campos.", "danger");
            return;
        }

        UtlCargando();

        var obj = new LagoSensor();
        obj.lago = $("#ddlLago").val();
        obj.sensor = $("#ddlSensor").val();
        obj.instalacion = $("#txtFechaInstala").val();
        obj.estado = $("#chkEstado").prop('checked');
        obj.token = $("#txtVarUrl").val();

        var result = null
        if ($("#btnEnviar").text() == "Guardar") {
            result = obj.guardar();

        } else {

            obj.id = $("#textLagoSensorID").val();
            result = obj.actualizar();

        }

        validarRespuesta(result)

    })


    $("#btnConfiguracion").click(function () {

        $("#modal").modal("show");
        consultar();

    })

    function consultar() {

        var obj = new LagoSensor();
        obj.token = $("#txtVarUrl").val();
        var result = obj.consultar();

        if (result['estado']) {



            var columna = [{
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

            tabla("Tabla", result['data'], columna, fucion);
        }

        validarRespuesta(result)

    }


    $('#Tabla tbody').on('click', 'tr .seleccionarFila', function () {
        var table = $('#Tabla').DataTable();
        var data = table.row($(this).parents("tr")).data();

        $("#textLagoSensorID").val(data.lagosensorid);
        $("#ddlLago").val(data.lagoid);
        $("#ddlSensor").val(data.sensorid);
        $("#txtFechaInstala").val(data.lagosensorfechainstalacion);
        $("#chkEstado").prop("checked", data.lagosensorestado);
        $("#btnCerrarModal").click();
        $("#btnEnviar").text("Actualizar");
        $("#btnEnviar").attr("class", "btn btn-success");

    });

    $('#Tabla tbody').on('click', 'tr .eliminar', function () {
        var table = $('#Tabla').DataTable();
        var data = table.row($(this).parents("tr")).data();
        var si = confirm("Está seguro de eliminar.");
        if (si) {

            var obj = new LagoSensor();
            obj.id = data.lagosensorid;
            obj.token = $("#txtVarUrl").val();
            var result=obj.eliminar();
            if (result['estado']) {
                $(this).parents("tr").remove()
            }
            validarRespuesta(result)

        }

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
$(function () {

    var error = false;
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
            validarFecha()
        }
    })

    function validarFecha() {
        if ($("#txtFechaFinaliza").val() < $("#txtFechaInicio").val()) {
            error = true;
            errorFecha(["txtFechaFinaliza"], true)
        } else {
            error = false;
            errorFecha(["txtFechaFinaliza"], false)
        }
    }

    $("#btnEnviar").click(function () {


        if (error) {
            return;
        }

        if (!validarCampos("[required]")) {
            $("#pnMensaje").html("");
            badge("#pnMensaje", "Debe llenar los campos.", "danger");
            return;
        }

        UtlCargando();

        var obj = new Cultivo();
        obj.lago = $("#ddlLago").val();
        obj.especie = $("#ddlEspecie").val();
        obj.fechaInicio = $("#txtFechaInicio").val();
        obj.fechaFinal = $("#txtFechaFinaliza").val();
        obj.token = $("#txtVarUrl").val();

        var result=null
        if ($("#btnEnviar").text() == "Guardar") {
            result=obj.guardar();
            

        } else {

            obj.id = $("#txtID").val();
            result=obj.actualizar();
            
        }

        validarRespuesta(result)
        
    })

    $("#btnLimpiar").click(function () {


        $("#btnEnviar").text("Guardar");
        $("#btnEnviar").attr("class", "btn btn-primary");

        $(".was-validated").removeClass('was-validated');
        $(":text").removeAttr('required');
        $(":text").val('');
        errorFecha(["txtFechaFinaliza"], false)

    })

    $("#btnConfiguracion").click(function () {

        $("#modal").modal("show");
        consultar();

    })

    $('#Tabla tbody').on('click', 'tr .seleccionarFila', function () {
        var table = $('#Tabla').DataTable();
        var data = table.row($(this).parents("tr")).data();

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
        var data = table.row($(this).parents("tr")).data();
        var si = confirm("Está seguro de eliminar.");
        if (si) {

            var obj = new Cultivo();
            obj.id = data.cultivoid;
            obj.token = $("#txtVarUrl").val();
            var result=obj.eliminar();
            if(result['estado'])
            {
                $(this).parents("tr").remove()
            }
            
            validarRespuesta(result)

        }

    });

    $("#btnAgregarLago").click(function(){

        $("#pnVistaModal").modal({
            backdrop: 'static'
          });

        $("#ifVistaModal").attr('src', `../view/lago.php?menu=1`).show();

    })

    $("#pnVistaModal").on('hidden.bs.modal', function () {
        
        lago();

    });

    function lago() {

        var obj = new Lago();
        obj.token = $("#txtVarUrl").val();
        var result = obj.consultar()
        if (result['estado']) {
            obj.cargarddl("ddlLago", result['data']);
        }

        validarRespuesta(result)

    }

    function especie() {
        var obj = new Especie();
        obj.token = $("#txtVarUrl").val();
        obj.cargarddl("ddlEspecie", obj.consultar().responseJSON);
    }

    function consultar() {

        var obj = new Cultivo();
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


            tabla("Tabla", result['data'], columna, "");
        }
        validarRespuesta(result)

    }

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
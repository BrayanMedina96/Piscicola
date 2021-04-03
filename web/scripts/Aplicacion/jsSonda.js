var error=""

$(function () {

    consultar();
    

    $("#modalCultivo").click();

    $("#btnLimpiar").click();

    $("#txtFecha").datepicker({
        onSelect: function (fd, d, calendar) {
            calendar.hide()
        }
    })

    $("#txtFecha").click(function () {

        var fecha = $("#txtFecha").val().split("-");
        if (fecha.length > 1) {
            $("#txtFecha").val("");
        }

    })

    $("#txtHora").datepicker({
        dateFormat: ' ',
        timepicker: true,
        classes: 'only-timepicker',
        onSelect: function (fd, d, calendar) {
            calendar.hide()
        }
    })

    $("#btnEnviar").click(function () {

        $(".limpiar").attr("required", "required");

        if (!validarCampos("[required]")) {
            $("#pnMensaje").html("");
            badge("#pnMensaje", "Debe llenar los campos.", "danger");
            return;
        }

        if($("#ddlSonda").val()=="")
        {
            badge("#pnMensaje", "Debe seleccionar una sonda.", "danger");
            return;
        }

        UtlCargando();

        var obj = new Sonda();
        obj.fecharegistro = $("#txtFecha").val().trim();
        obj.oxigenodisuelto = $("#txtOxigeno").val().trim();
        obj.ph = $("#txtPh").val().trim();
        obj.cultivo = $("#ddlCultivo").val().trim();
        obj.horaregistro = $("#txtHora").val().trim();
        obj.temperaturaambiente = $("#txtTempAmbiente").val().trim();
        obj.temperaturaestanque = $("#txtTempEstanque").val().trim();
        obj.conductividadelectrica = $("#txtCondElectrica").val().trim();
        obj.amonionh3 = $("#txtAmonioNH3").val().trim();
        obj.amonionh4 = $("#txtAmonioNH4").val().trim();
        obj.nitrito = $("#txtNitrito").val().trim();
        obj.alcalinidad = $("#txtAlcalinidad").val().trim();
        obj.descripcion = $("#txtObservacion").val().trim();
        obj.pecesmuertos = $("#txtPecesMuertos").val().trim();
        obj.sensorid=$("#ddlSondaM").val()
        obj.token = $("#txtVarUrl").val().trim();

        if ($("#btnEnviar").text() == "Guardar") {
            var result = obj.guardar();
            validarRespuesta(result)

        } else {
            obj.id = $("#txtID").val().trim();
            var result = obj.actualizar();
            validarRespuesta(result)

        }
    })

    $("#btnConfiguracion").click(function () {

        $("#modal").modal();
        consultarRegistro();

    })


    $("#btnLimpiar").click(function () {

        $("#btnEnviar").addClass("btn-primary");
        $("#btnEnviar").text("Guardar");
        $("#btnEnviar").removeClass("btn-success");
        $(":text").val("");
        $(".limpiar").val("0");
        $("#txtDescripcion").val("");

        $(".was-validated").removeClass('was-validated');
        $(":text").removeAttr('required');
        $(".limpiar").removeAttr("required");

    })

    $('#Tabla tbody').on('click', 'tr .seleccionarFila', function () {
        var table = $('#Tabla').DataTable();
        var data = table.row($(this).parents("tr")).data();

        $("#txtID").val(data.estadofisicoquimicoid);
        $("#ddlCultivo").val(data.cultivoid);
        $("#txtFecha").val(data.fecharegistro);
        $("#txtOxigeno").val(data.oxigenodisuelto);
        $("#txtPh").val(data.ph);
        $("#txtHora").val(data.horaregistro);
        $("#txtTempAmbiente").val(data.temperaturaambiente);
        $("#txtTempEstanque").val(data.temperaturaestanque);
        $("#txtCondElectrica").val(data.conductividadelectrica);
        $("#txtAmonioNH3").val(data.amonionh3);
        $("#txtAmonioNH4").val(data.amonionh4);
        $("#txtNitrito").val(data.nitrito);
        $("#txtAlcalinidad").val(data.alcalinidad);
        $("#txtObservacion").val(data.descripcion);
        $("#txtPecesMuertos").val(data.pecesmuertos);
        $("#btnCerrarModal").click();
        $("#btnEnviar").text("Actualizar");
        $("#btnEnviar").attr("class", "btn btn-success");

    });

    $('#Tabla tbody').on('click', 'tr .eliminar', function () {
        var table = $('#Tabla').DataTable();
        var data = table.row($(this).parents("tr")).data();
        var si = confirm("Está seguro de eliminar el registro del: " + data.fecharegistro + " - " + data.horaregistro);
        if (si) {

            var obj = new Sonda();
            obj.id = data.estadofisicoquimicoid;
            obj.token = $("#txtVarUrl").val();
            var result = obj.eliminar();
            validarRespuesta(result)
            if (result['estado']) {
                $(this).parents("tr").remove()
            }


        }

    });


    $("#ddlCultivoLoad").change(function () {

         $("#ddlSondaLoad").empty()
         $("#ddlSondaM").empty()
         

        if ($(this).val().toString() != "") {
            var obj = new Sonda();
            obj.cultivo = $(this).val()
            obj.token = $("#txtVarUrl").val();
            var result = obj.getSondaCultivo();

            if (result['estado']) {
            
                   cargarSonda(result['data'])
               
            }

            validarRespuesta(result)
        }


    })

    $("#ddlSondaLoad").change(function () {

        
       if ($(this).val().toString() != "") {
           var obj = new Sonda();
           obj.sensorid = $(this).val()
           obj.token = $("#txtVarUrl").val();
           var result = obj.parametros();

           if (result['estado']) {

               if (result['data'].length == 0) {
                   error="Debe asociar un rango a esta sonda."
                   badge("#pnMensaje",error, "warning");
                   $("#btnRango").removeClass("d-none")
                   
               } else {
                   error=""
                   cargarTree(result['data'][0])
                   configurarCampos(result['data'][0])
               }


           }

           validarRespuesta(result)
       }


    })

    $("#btnRango").click(function(){
        $("#btnWizard").click()
        $("[data-nodeid=5]").click()
        $("#btnSonda").click()
        $("#ddlSonda").val(    $("#ddlSondaLoad").val(  )   )  
        $("#ddlSondaLoad").val("")
    })

    $("#btnSeleccionar").click(function () {

        if(error!="")
        {
            badge("#pnMensaje",error, "warning");
            return
        }

        if($("#ddlCultivoLoad").val()=="")
        {
            badge("#pnMensaje", "Debe seleccionar un cultivo.", "danger");
            return;
        }

        if($("#ddlSondaLoad").val()=="")
        {
            badge("#pnMensaje", "Debe seleccionar una sonda.", "danger");
            return;
        }

        $("#ddlCultivo").val( $("#ddlCultivoLoad").val() )

        $("#ddlSondaM").val( $("#ddlSondaLoad").val() )

        $("#pnRegistro").removeClass("d-none")
        $("#pnSeleccion").addClass("d-none")
        $("#pnCambiar").removeClass("d-none")


    })

    $("#btnCambiar").click(function () {

        $(".d-none").removeClass("d-none")
        $(".oculto").addClass("limpiar").removeClass("oculto")
        $("#pnRegistro").addClass("d-none")
        $("#pnSeleccion").removeClass("d-none")
        $("#pnCambiar").addClass("d-none")

    })

    function cargarTree(result) {


        var myTree = [{
            text: `Lago: ${result.lagonombre}`,
            nodes: [{
                    text: `Sonda`,
                    nodes: [{
                        text: result.sensornombre.toLowerCase(),

                    }]
                },
                {
                    text: `Configuración`,
                    nodes: [{
                        text: result.configuracion.toLowerCase(),

                    }]
                },
                {
                    text: `Tipo`,
                    nodes: [{
                        text: result.tipolagonombre.toLowerCase()
                    }]
                },
                {
                    text: `Fecha cultivo`,
                    nodes: [{
                        text: result.fechainicio
                    }, {
                        text: result.fechafinalizacion
                    }]
                },
            ]
        }, ];

        $('#default-tree').treeview({
            showBorder: false,
            showTags: true,
            highlightSelected: true,
            expandIcon: "icon-star-empty",
            collapseIcon: "icon-star-full",
            data: myTree
        });

    }

    function configurarCampos(result) {


        if (result.temperaturaambiente == null) {
            $("#pnTempAmbiente").addClass("d-none")
            $("#txtTempAmbiente").addClass("oculto").removeClass("limpiar")

        }else{
            $("#pnTempAmbiente").removeClass("d-none")
            $("#txtTempAmbiente").removeClass("oculto").addClass("limpiar")
        }

        if (result.temperaturaestanque == null) {
            $("#pnTempEstanque").addClass("d-none")
            $("#txtTempEstanque").addClass("oculto").removeClass("limpiar")
        }else{
            $("#pnTempEstanque").removeClass("d-none")
            $("#txtTempEstanque").removeClass("oculto").addClass("limpiar")
        }

        if (result.oxigeno == null) {
            $("#pnOxigeno").addClass("d-none")
            $("#txtOxigeno").addClass("oculto").removeClass("limpiar")
        }else{
            $("#pnOxigeno").removeClass("d-none")
            $("#txtOxigeno").removeClass("oculto").addClass("limpiar")
        }


        if (result.ph == null) {
            $("#pnPH").addClass("d-none")
            $("#txtPh").addClass("oculto").removeClass("limpiar")
        }else{
            $("#pnPH").removeClass("d-none")
            $("#txtPh").removeClass("oculto").addClass("limpiar")
        }

        if (result.conductividad == null) {
            $("#pnConductividad").addClass("d-none")
            $("#txtCondElectrica").addClass("oculto").removeClass("limpiar")
        }else{
            $("#pnConductividad").removeClass("d-none")
            $("#txtCondElectrica").removeClass("oculto").addClass("limpiar")
        }

        if (result.amonionh3 == null) {
            $("#pnAmonioNH3").addClass("d-none")
            $("#txtAmonioNH3").addClass("oculto").removeClass("limpiar")
        }else{
            $("#pnAmonioNH3").removeClass("d-none")
            $("#txtAmonioNH3").removeClass("oculto").addClass("limpiar")
        }

        if (result.amonionh4 == null) {
            $("#pnAmonioNH4").addClass("d-none")
            $("#txtAmonioNH4").addClass("oculto").removeClass("limpiar")
        }else{
            $("#pnAmonioNH4").removeClass("d-none")
            $("#txtAmonioNH4").removeClass("oculto").addClass("limpiar")
        }

        if (result.nitrito == null) {
            $("#pnNitrito").addClass("d-none")
            $("#txtNitrito").addClass("oculto").removeClass("limpiar")
        }else{
            $("#pnNitrito").removeClass("d-none")
            $("#txtNitrito").removeClass("oculto").addClass("limpiar")
        }

        if (result.alcalinidad == null) {
            $("#pnAlcalinidad").addClass("d-none")
            $("#txtAlcalinidad").addClass("oculto").removeClass("limpiar")
        }else{
            $("#pnAlcalinidad").removeClass("d-none")
            $("#txtAlcalinidad").removeClass("oculto").addClass("limpiar")
        }


    }

    function cargarSonda(result)
    {
        var obj = new Cultivo();
        obj.cargarddl("ddlSondaLoad", result, "sensorid", "sensornombre");
        obj.cargarddl("ddlSondaM", result, "sensorid", "sensornombre");

    }

    function consultar() {

        var obj = new Cultivo();
        obj.token = $("#txtVarUrl").val();
        var result = obj.consultar();

        if (result['estado']) {
            obj.cargarddl("ddlCultivo", result['data'], "cultivoid", "nombre");
            obj.cargarddl("ddlCultivoLoad", result['data'], "cultivoid", "nombre");
        }

        validarRespuesta(result)

    }

    function consultarRegistro() {

        var obj = new Sonda();
        obj.cultivo = $("#ddlCultivo").val().trim();
        obj.fecharegistro = $("#txtFecha").val().trim();
        obj.horaregistro = $("#txtHora").val().trim();
        obj.token = $("#txtVarUrl").val().trim();
        var result = obj.consultar();

        validarRespuesta(result)

        if (result['estado']) {

            var columna = [{
                    "targets": -1,
                    "data": null,
                    "defaultContent": "<img class='seleccionarFila' src='../svg/selection-option.png'></img>"
                },
                {
                    "data": "nombre"
                },
                {
                    "data": "fecharegistro"
                },
                {
                    "data": "horaregistro"
                },
                {
                    "data": "temperaturaambiente"
                },
                {
                    "data": "temperaturaestanque"
                },
                {
                    "data": "oxigenodisuelto"
                },
                {
                    "data": "ph"
                },
                {
                    "data": "conductividadelectrica"
                },
                {
                    "data": "amonionh3"
                },
                {
                    "data": "amonionh4"
                },
                {
                    "data": "nitrito"
                },
                {
                    "data": "alcalinidad"
                },
                {
                    "data": "pecesmuertos"
                },
                {
                    "data": "descripcion"
                },
                {
                    "targets": -1,
                    "data": null,
                    "defaultContent": "<img class='eliminar' src='../svg/delete.png'></img>"
                }
            ]

        }

        tabla("Tabla", result['data'], columna, "");


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
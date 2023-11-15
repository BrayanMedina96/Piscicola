$(function () {

    material();

    $("#myInput").on("keyup", function () {
        var value = $(this).val().toLowerCase();

        $("#tdResultado tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);

        });
    });

    $("#btnEnviar").click(function () {

        if (!validarCampos("[required]")) {
            $("#pnMensaje").html("");
            badge("#pnMensaje", "Debe llenar los campos.", "danger");
            return;
        }

        UtlCargando();

        var objLago = new Lago();
        objLago.nombre = $("#txtNombreLago").val();
        objLago.descripcion = $("#txtDescripcionLago").val();
        objLago.geolocalizacion = $("#txtGeolocalizacion").val();
        objLago.area = $("#txtArea").val();
        objLago.altitud = $("#txtAltitud").val();
        objLago.profundidad = $("#txtProfundidad").val();
        objLago.catidadPeces = $("#txtCantidadPeces").val();
        objLago.token = $("#txtVarUrl").val();
        objLago.tipolago = $("#ddlTipoLago").val();

        var result=null
        if ($("#btnEnviar").text() == "Guardar") {
            result=objLago.guardar();
        
        } else {

            objLago.id = $("#txtLagoID").val();
            result= objLago.actualizar();
        }

        validarRespuesta(result)

    })


    $("#btnLago").click(function () {
        $("#modalLago").modal("show");
        consultarLago();
    })


    function consultarLago() {

        var obj = new Lago();
        obj.token = $("#txtVarUrl").val();
        var result = obj.consultar();

        var columna = [{
                "targets": -1,
                "data": null,
                "defaultContent": "<img class='seleccionarFila' src='../svg/selection-option.png'></img>"
            },
            {
                "data": "lagonombre"
            },
            {
                "data": "lagodescripcion"
            },
            {
                "data": "lagogeolocalizacion"
            },
            {
                "data": "lagoarea"
            },
            {
                "data": "lagoaltitud"
            },
            {
                "data": "lagocantidadpeces"
            },
            {
                "data": "lagoprofundidad",

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

    $('#Tabla tbody').on('click', 'tr .seleccionarFila', function () {
        var table = $('#Tabla').DataTable();
        var data = table.row($(this).parents("tr")).data();
        $("#txtLagoID").val(data.lagoid);
        $("#txtNombreLago").val(data.lagonombre);
        $("#txtDescripcionLago").val(data.lagodescripcion);
        $("#txtGeolocalizacion").val(data.lagogeolocalizacion);
        $("#txtArea").val(data.lagoarea);
        $("#txtAltitud").val(data.lagoaltitud);
        $("#txtProfundidad").val(data.lagoprofundidad);
        $("#txtCantidadPeces").val(data.lagocantidadpeces);
        $("#ddlTipoLago").val(data.tipolagoid);
        $("#btnCerrarModal").click();
        $("#btnEnviar").text("Actualizar");
        $("#btnEnviar").attr("class", "btn btn-success");


    });

    $('#Tabla tbody').on('click', 'tr .eliminar', function () {
        var table = $('#Tabla').DataTable();
        var data = table.row($(this).parents("tr")).data();
        var si = confirm("Está seguro de eliminar: " + data.lagonombre);
        if (si) {

            var obj = new Lago();
            obj.id = data.lagoid;
            obj.token = $("#txtVarUrl").val();
            var result = obj.eliminar();
            if (result['estado']) {
                $(this).parents("tr").remove()
            }

            validarRespuesta(result)

        }

    });


    $("#btnLimpiar").click(function () {

        $("#btnEnviar").text("Guardar");
        $("#btnEnviar").attr("class", "btn btn-primary");

        $(".was-validated").removeClass('was-validated');
        $(".limpiar").removeAttr('required');
        $(".limpiar").val(' ');


    });

    $("#btnAgregarTipoLAgo").click(function(){
       
        $("#pnVistaModal").modal({
            backdrop: 'static'
          });
        $("#ifVistaModal").attr('src', `../view/tipoLago.php?menu=1`).show();

    });

    $("#pnVistaModal").on('hidden.bs.modal', function () {
        
        material();

    });

    function material() {
        var obj = new Material();
        obj.token = $("#txtVarUrl").val();
        obj.cargarddl("ddlTipoLago", obj.consultar().responseJSON);
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

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}

function showPosition(position) {
    $("#txtGeolocalizacion").val(position.coords.latitude + ";" + position.coords.longitude);

}
$(function () {

    $("#btnEnviar").click(function () {


        if (!validarCampos("[required]")) {
            $("#pnMensaje").html("");
            $("#pnMensaje").html(modal("Alerta", "Debe diligenciar los campos.", "modal-sm"));
            $("#myModal").modal();
            return;
        }

        var objLago = new Lago();
        objLago.nombre = $("#txtNombreLago").val();
        objLago.descripcion = $("#txtDescripcionLago").val();
        objLago.geolocalizacion = $("#txtGeolocalizacion").val();
        objLago.area = $("#txtArea").val();
        objLago.altitud = $("#txtAltitud").val();
        objLago.profundidad = $("#txtProfundidad").val();
        objLago.catidadPeces = $("#txtCantidadPeces").val();
        objLago.token = $("#txtVarUrl").val();

        if ($("#btnEnviar").text() == "Guardar") {
            objLago.guardar();
        } else {

            objLago.id = $("#txtLagoID").val();

            objLago.actualizar();
        }


    })


    $("#btnLago").click(function () {
        $("#modalLago").modal("show");
        consultarLago();
    })


    function consultarLago() {

        var obj = new Lago();
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

        tabla("Tabla", result, columna,fucion);

    }

    $('#Tabla tbody').on('click', 'tr .seleccionarFila', function () {
        var table = $('#Tabla').DataTable();
        var data = table.row( $(this).parents("tr") ).data();
        $("#txtLagoID").val(data.lagoid);
        $("#txtNombreLago").val(data.lagonombre);
        $("#txtDescripcionLago").val(data.lagodescripcion);
        $("#txtGeolocalizacion").val(data.lagogeolocalizacion);
        $("#txtArea").val(data.lagoarea);
        $("#txtAltitud").val(data.lagoaltitud);
        $("#txtProfundidad").val(data.lagoprofundidad);
        $("#txtCantidadPeces").val(data.lagocantidadpeces);
        $("#btnCerrarModal").click();
        $("#btnEnviar").text("Actualizar");
        $("#btnEnviar").attr("class", "btn btn-success");

    });

    $('#Tabla tbody').on('click', 'tr .eliminar', function () {
        var table = $('#Tabla').DataTable();
        var data = table.row( $(this).parents("tr") ).data();
        var si=confirm("Está seguro de eliminar: "+data.lagonombre);
        if(si)
        {
            
            var obj=new Lago();
            obj.id=data.lagoid;
            obj.token = $("#txtVarUrl").val();
            obj.eliminar();
            consultarLago();

        }

    });


    $("#btnLimpiar").click(function () {
  
       limpiar(".limpiar");
       $("#btnEnviar").text("Guardar");
       $("#btnEnviar").attr("class", "btn btn-primary");

       
    });


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



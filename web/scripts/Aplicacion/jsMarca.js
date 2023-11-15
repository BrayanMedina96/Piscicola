$(function () {

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
        
        var obj = new Marca();
        obj.nombre = $("#txtNombre").val();
        obj.descripcion = $("#txtDescripcion").val();
        obj.token = $("#txtVarUrl").val();

        var result=null
        if ($("#btnEnviar").text() == "Guardar") {
            result= obj.guardar();
            

        } else {

            obj.id = $("#txtID").val();
            result= obj.actualizar();
           

        }

        validarRespuesta(result)

    })

    $("#btnLimpiar").click(function () {

        $("#btnEnviar").addClass("btn-primary");
        $("#btnEnviar").text("Guardar");
        $("#btnEnviar").removeClass("btn-success");
        $("#txtDescripcion").val("");

        $(".was-validated").removeClass('was-validated');
        $(":text").removeAttr('required');
        $(":text").val('');
        
    })

    $("#btnConfiguracion").click(function () {

        $("#modal").modal();
        consultar();

    })

    function  consultar() {
    
        var obj = new Marca();
        obj.token = $("#txtVarUrl").val();
        var result = obj.consultar();
    
        var columna = [
            {
                "targets": -1,
                "data": null,
                "defaultContent": "<img class='seleccionarFila' src='../svg/selection-option.png'></img>"
            },
            {
                "data": "marcanombre"
            },
            {
                "data": "marcadescripcion"
            },
            {
                "targets": -1,
                "data": null,
                "defaultContent": "<img class='eliminar'  src='../svg/delete.png'></img>"
            }
        ]
    
        tabla("Tabla", result['data'], columna,"");
    
    }

    $('#Tabla tbody').on('click', 'tr .seleccionarFila', function () {

        var table = $('#Tabla').DataTable();
        var data = table.row($(this).parents("tr")).data();
        $("#txtID").val(data.marcaid);
        $("#txtNombre").val(data.marcanombre);
        $("#txtDescripcion").val(data.marcadescripcion);
        $("#btnEnviar").text("Actualizar");
        $("#btnEnviar").removeClass("btn-primary");
        $("#btnEnviar").addClass("btn-success");
        $("#modal").modal("hide");


    });

    $('#Tabla tbody').on('click', 'tr .eliminar', function () {
        var table = $('#Tabla').DataTable();
        var data = table.row($(this).parents("tr")).data();
        var si = confirm("Está seguro de eliminar: " + data.marcanombre);
        if (si) {

            var obj = new Marca();
            obj.id = data.marcaid;
            obj.token = $("#txtVarUrl").val();
            var result = obj.eliminar();
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

});
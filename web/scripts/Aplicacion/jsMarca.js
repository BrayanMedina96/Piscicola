$(function () {


    $("#btnEnviar").click(function () {


        if (!validarCampos("[required]")) {
            $("#pnMensaje").html("");
            $("#pnMensaje").html(modal("Alerta", "Debe llenar los campos.", "modal-sm"));
            $("#myModal").modal();
            return;
        }

        var obj = new Marca();
        obj.nombre = $("#txtNombre").val();
        obj.descripcion = $("#txtDescripcion").val();
        obj.token = $("#txtVarUrl").val();

        if ($("#btnEnviar").text() == "Guardar") {
            obj.guardar();
            badge("#pnMensaje", "Registro guardado.", "success");

        } else {

            obj.id = $("#txtID").val();
            obj.actualizar();
            badge("#pnMensaje", "Registro actualizado.", "success");

        }

        $("#btnLimpiar").click();

    })

    $("#btnLimpiar").click(function () {

        $("#btnEnviar").addClass("btn-primary");
        $("#btnEnviar").text("Guardar");
        $("#btnEnviar").removeClass("btn-success");
        $(":text").val(" ");
        $(".was-validated").removeClass("was-validated");
        


    })

    $("#btnConfiguracion").click(function () {

        $("#modal").modal();
        consultar();


    })

    function  consultar() {
    
        var obj = new Marca();
        obj.token = $("#txtVarUrl").val();
        var result = obj.consultar().responseJSON;
    
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
    
        tabla("Tabla", result, columna,"");
    
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
            obj.eliminar();
            consultar();

        }

    });

});
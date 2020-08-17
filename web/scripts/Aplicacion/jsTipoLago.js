$(function () {

    $("#myInput").on("keyup", function () {
        var value = $(this).val().toLowerCase();

        $("#tdResultado tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);

        });
    });

$("#btnEnviar").click(function() {
    
    $(":text").attr('required','required');

    if (!validarCampos("[required]")) {
        $("#pnMensaje").html("");
        badge("#pnMensaje", "Debe llenar todos los campos.","danger");
        return;
    }

    UtlCargando();

    var obj=new TipoLago();
    obj.nombre=$("#txtNombre").val();
    obj.descripcion=$("#txtDescripcion").val();
    obj.token=$("#txtVarUrl").val();

    if($("#btnEnviar").text()=="Guardar")
    {
        obj.guardar();
        badge("#pnMensaje", "Registro guardado.","success");

    }else{

        obj.id=$("#txtID").val();
        obj.actualizar();
        badge("#pnMensaje", "Registro actualizado.","success");

    }
 
    $("#btnLimpiar").click();

})

$("#btnLimpiar").click(function () {
    
    $("#btnEnviar").addClass("btn-primary");
    $("#btnEnviar").text("Guardar");
    $("#btnEnviar").removeClass("btn-success");
    $(":text").val("");
    $("#txtDescripcion").val("");
    
    $(".was-validated").removeClass('was-validated');
    $(":text").removeAttr('required');
    $(":text").val('');
  

})

$("#btnConfiguracion").click(function () {
    
    $("#modal").modal();
    consultar();
    

})

$('#Tabla tbody').on('click', 'tr .seleccionarFila', function () {

    var table = $('#Tabla').DataTable();
    var data = table.row( $(this).parents("tr") ).data();
    $("#txtID").val(data.tipolagoid);
    $("#txtNombre").val(data.tipolagonombre);
    $("#txtDescripcion").val(data.tipolagodescripcion);
    $("#btnEnviar").text("Actualizar");
    $("#btnEnviar").removeClass("btn-primary");
    $("#btnEnviar").addClass("btn-success");
    $("#modal").modal("hide");
    

});

$('#Tabla tbody').on('click', 'tr .eliminar', function () {
    var table = $('#Tabla').DataTable();
    var data = table.row($(this).parents("tr")).data();
    if (data.usuariocrea == null) {
        alert("Este elemento no se puede eliminar");
    } else {
        var si = confirm("Está seguro de eliminar: " + data.tipolagonombre);
        if (si) {
            var obj = new TipoLago();
            obj.id = data.tipolagoid;
            obj.token = $("#txtVarUrl").val();
            obj.eliminar();
            consultar();

        }
    }
});


function  consultar() {
    
    var obj = new TipoLago();
    obj.token = $("#txtVarUrl").val();
    var result = obj.consultar().responseJSON;

    var columna = [
        {
            "targets": -1,
            "data": null,
            "defaultContent": "<img class='seleccionarFila' src='../svg/selection-option.png'></img>"
        },
        {
            "data": "tipolagonombre"
        },
        {
            "data": "tipolagodescripcion"
        },
        {
            "targets": -1,
            "data": null,
            "defaultContent": "<img class='eliminar'  src='../svg/delete.png'></img>"
        }
    ]

    tabla("Tabla", result, columna,"");

}




})
$(function(){

    $(":checkbox").prop("checked",true);
    limpiar();
    loadRango();

    $("#myInputSonda").on("keyup", function() 
    {
          var value = $(this).val().toLowerCase();

          $("#tdResultado tr").filter(function() 
           {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);

           });
    });

    $("#myInputLago").on("keyup", function() 
    {
          var value = $(this).val().toLowerCase();

          $("#tdResultadoLago tr").filter(function() 
           {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);

           });
    });


    $("#btnRecomendado").click(function(){
        var obj = new Rango();
        obj.token = $("#txtVarUrl").val();
        var result=  obj.consultarRecomendado()
        loadData(result[0])
        
    })

    $("#btnEnviar").click(function () {

        if (!validarCampos("[required]")) {
            $("#pnMensaje").html("");
            badge("#pnMensaje", "Debe llenar los campos.", "danger");
            return;
        }

        var obj = new Rango();
        obj.token = $("#txtVarUrl").val();
        obj.temperaturaambiente_min = $("#txtTempAmbienteMin").val()
        obj.temperaturaambiente_max = $("#txtTempAmbienteMax").val()
        obj.temperaturaestanque_min = $("#txtTempEstanqueMin").val()
        obj.temperaturaestanque_max = $("#txtTempEstanqueMax").val()
        obj.oxigeno_min = $("#txtOxigenoMin").val()
        obj.oxigeno_max = $("#txtOxigenoMax").val()
        obj.ph_min = $("#txtPhMin").val()
        obj.ph_max = $("#txtPhMax").val()
        obj.conductividad_min = $("#txtConductividadMin").val()
        obj.conductividad_max = $("#txtConductividadMax").val()
        obj.amonionh3_min = $("#txtNH3Min").val()
        obj.amonionh3_max = $("#txtNH3Max").val()
        obj.amonionh4_min = $("#txtNH4Min").val()
        obj.amonionh4_max = $("#txtNH4Max").val()
        obj.nitrito_min = $("#txtNitritoMin").val()
        obj.nitrito_max = $("#txtNitritoMax").val()
        obj.alcalinidad_min = $("#txtAlcalinidadMin").val()
        obj.alcalinidad_max = $("#txtAlcalinidadMax").val()
        obj.descripcion=$("#txtDescripcion").val() 

        var result=null
        if($("#btnEnviar").text()=="Guardar")
        {
             result= obj.guardar()
        }else{

             obj.id=$("#txtID").val()
             result= obj.actualizar()
        }

        
        validarRespuesta(result)
       
    })

    $("#btnEnviarSondaRago").click(function(){

        var obj = new Rango();
        obj.id=$("#ddlRango").val()
        obj.sondaID=$("#ddlSonda").val()
        obj.token = $("#txtVarUrl").val()
        var result=obj.rangoSensor()

        validarRespuesta(result)

        if(result['estado'])
        {
            $("#btnSonda").click()
        }

    })

    $("#btnEnviarLagoRago").click(function(){

        var obj = new Rango();
        obj.id=$("#ddlRangoLago").val();
        obj.sondaID=$("#ddlLago").val();
        obj.token = $("#txtVarUrl").val();
        var result=obj.rangoLago();

        validarRespuesta(result);

        if(result['estado'])
        {
            loadRangoLago();
        }

    })

    $("#btnConfiguracion").click(function () {

        $("#modal").modal();


        var obj = new Rango();
        obj.token = $("#txtVarUrl").val();
        var result = obj.consultar();

        if (result['estado']) {
            var columna = [{
                    "targets": -1,
                    "data": null,
                    "defaultContent": "<img class='seleccionarFila' src='../svg/selection-option.png'></img>"
                },
                {
                    "data": "descripcion"
                },
                {
                    "data": "temperaturaambiente_min"
                },
                {
                    "data": "temperaturaambiente_max"
                },
                {
                    "data": "temperaturaestanque_min"
                },
                {
                    "data": "temperaturaestanque_max"
                },
                {
                    "data": "oxigeno_min"
                },
                {
                    "data": "oxigeno_max"
                },
                {
                    "data": "ph_min"
                },
                {
                    "data": "ph_max"
                },
                {
                    "data": "conductividad_min"
                },
                {
                    "data": "conductividad_max"
                },
                {
                    "data": "amonionh3_min"
                },
                {
                    "data": "amonionh3_max"
                },
                {
                    "data": "amonionh4_min"
                },
                {
                    "data": "amonionh4_max"
                },
                {
                    "data": "nitrito_min"
                },
                {
                    "data": "nitrito_max"
                },
                {
                    "data": "alcalinidad_min"
                },
                {
                    "data": "alcalinidad_max"
                },
                {
                    "targets": -1,
                    "data": null,
                    "defaultContent": "<img class='eliminar'  src='../svg/delete.png'></img>"
                }
            ]

            tabla("Tabla", result['data'], columna, "");
        }else{

        }
        
    })

    $("#btnSonda").click(function(){

        var obj = new Rango();
        obj.token = $("#txtVarUrl").val();
        var result = obj.getRangoSensor();

        validarRespuesta(result)

        if(result['estado'])
        {
            
            var columna = [{
                "targets": -1,
                "data": null,
                "defaultContent": ""
            },
            {
                "data":"sensornombre"
            },
            {
                "data": "descripcion"
            },
            {
                "data": "temperaturaambiente_min"
            },
            {
                "data": "temperaturaambiente_max"
            },
            {
                "data": "temperaturaestanque_min"
            },
            {
                "data": "temperaturaestanque_max"
            },
            {
                "data": "oxigeno_min"
            },
            {
                "data": "oxigeno_max"
            },
            {
                "data": "ph_min"
            },
            {
                "data": "ph_max"
            },
            {
                "data": "conductividad_min"
            },
            {
                "data": "conductividad_max"
            },
            {
                "data": "amonionh3_min"
            },
            {
                "data": "amonionh3_max"
            },
            {
                "data": "amonionh4_min"
            },
            {
                "data": "amonionh4_max"
            },
            {
                "data": "nitrito_min"
            },
            {
                "data": "nitrito_max"
            },
            {
                "data": "alcalinidad_min"
            },
            {
                "data": "alcalinidad_max"
            },
            {
                "targets": -1,
                "data": null,
                "defaultContent": "<img class='eliminar'  src='../svg/delete.png'></img>"
            }
        ]

          tabla("TablaSonda", result['data'], columna, "");
            

        }

    })

    $('#Tabla tbody').on('click', 'tr .seleccionarFila', function () {

        $("#btnLimpiar").click()

        var table = $('#Tabla').DataTable();
        var data = table.row($(this).parents("tr")).data()
        

        loadCheck(data)

        $("#txtDescripcion").val(data.descripcion)
      
        $("#txtTempAmbienteMin").val(data.temperaturaambiente_min)
        $("#txtTempAmbienteMax").val(data.temperaturaambiente_max)

        $("#txtTempEstanqueMin").val(data.temperaturaestanque_min)
        $("#txtTempEstanqueMax").val(data.temperaturaestanque_max)

        $("#txtOxigenoMin").val(data.oxigeno_min)
        $("#txtOxigenoMax").val(data.oxigeno_max)

        $("#txtPhMin").val(data.ph_min)
        $("#txtPhMax").val(data.ph_max)

        $("#txtConductividadMin").val(data.conductividad_min)
        $("#txtConductividadMax").val(data.conductividad_max)

        $("#txtNH3Min").val(data.amonionh3_min)
        $("#txtNH3Max").val(data.amonionh3_max)

        $("#txtNH4Min").val(data.amonionh4_min)
        $("#txtNH4Max").val(data.amonionh4_max)

        $("#txtNitritoMin").val(data.nitrito_min)
        $("#txtNitritoMax").val(data.nitrito_max)

        $("#txtAlcalinidadMin").val(data.alcalinidad_min)
        $("#txtAlcalinidadMax").val(data.alcalinidad_max)

        $("#txtID").val(data.id);
        $("#btnEnviar").text("Actualizar");
        $("#btnEnviar").removeClass("btn-primary");
        $("#btnEnviar").addClass("btn-success");

        $("#modal").modal("hide");


    });

    $('#Tabla tbody').on('click', 'tr .eliminar', function () {

        var table = $('#Tabla').DataTable();
        var data = table.row($(this).parents("tr")).data();
        var si = confirm("Está seguro de eliminar: " + data.descripcion);
        if (si) {

            var obj = new Rango();
            obj.id = data.id;
            obj.token = $("#txtVarUrl").val();
            var result=  obj.eliminar();
            if(result['estado'])
            {
                $(this).parents("tr").remove()
            }
         
            validarRespuesta(result)

        }

    });

    $('#TablaSonda tbody').on('click', 'tr .eliminar', function () {

        var table = $('#TablaSonda').DataTable();
        var data = table.row($(this).parents("tr")).data();
        var si = confirm("Está seguro de eliminar el registro");
        if (si) {

            var obj = new Rango();
            obj.id = data.id;
            obj.token = $("#txtVarUrl").val();
            var result=  obj.eliminarSondaRango();
            if(result['estado'])
            {
                $(this).parents("tr").remove()
            }
         
            validarRespuesta(result)

        }

    });

    $('#TablaLago tbody').on('click', 'tr .eliminar', function () {

        var table = $('#TablaLago').DataTable();
        var data = table.row($(this).parents("tr")).data();
        var si = confirm("Está seguro de eliminar el registro");
        if (si) {

            var obj = new Rango();
            obj.id = data.id;
            obj.token = $("#txtVarUrl").val();
            var result=  obj.eliminarSondaRango();
            if(result['estado'])
            {
                $(this).parents("tr").remove()
            }
         
            validarRespuesta(result)

        }

    });

    function loadCheck(data)
    {
        if(data.temperaturaambiente_min==null && data.temperaturaambiente_max==null)
        {
           $("#swTemperaturaAmbiente").prop("checked",false)
           estado(document.getElementById("swTemperaturaAmbiente"),"txtTempAmbiente")
        }
      
        if(data.temperaturaestanque_min==null && data.temperaturaestanque_max==null)
        {
           $("#swTemperaturaEstanque").prop("checked",false)
           estado(document.getElementById("swTemperaturaEstanque"),"txtTempEstanque")
        }

        if(data.oxigeno_min==null && data.oxigeno_max==null)
        {
           $("#swOxigeno").prop("checked",false)
           estado(document.getElementById("swOxigeno"),"txtOxigeno")
        }

        if(data.ph_min==null && data.ph_max==null)
        {
           $("#swPH").prop("checked",false)
           estado(document.getElementById("swPH"),"txtPh")
        }

        if(data.conductividad_min==null && data.conductividad_max==null)
        {
           $("#swConductividad").prop("checked",false)
           estado(document.getElementById("swConductividad"),"txtConductividad")
        }

        if(data.amonionh3_min==null && data.amonionh3_max==null)
        {
           $("#swNH3").prop("checked",false)
           estado(document.getElementById("swNH3"),"txtNH3")
        }

        if(data.amonionh4_min==null && data.amonionh4_max==null)
        {
           $("#swNH4").prop("checked",false)
           estado(document.getElementById("swNH4"),"txtNH4")
        }

        if(data.nitrito_min==null && data.nitrito_max==null)
        {
           $("#swNitrito").prop("checked",false)
           estado(document.getElementById("swNitrito"),"txtNitrito")
        }

        if(data.alcalinidad_min==null && data.alcalinidad_max==null)
        {
           $("#swAlcalinidad").prop("checked",false)
           estado(document.getElementById("swAlcalinidad"),"txtAlcalinidad")
        }


    }

    function loadData(result){

        $(":checkbox").prop('checked',true)

        $("#txtTempAmbienteMin").val(result.temperaturaambiente_min)
        $("#txtTempAmbienteMax").val(result.temperaturaambiente_max)
        $("#txtTempEstanqueMin").val(result.temperaturaestanque_min)
        $("#txtTempEstanqueMax").val(result.temperaturaestanque_max)
        $("#txtOxigenoMin").val(result.oxigeno_min)
        $("#txtOxigenoMax").val(result.oxigeno_max)
        $("#txtPhMin").val(result.ph_min)
        $("#txtPhMax").val(result.ph_max)
        $("#txtConductividadMin").val(result.conductividad_min)
        $("#txtConductividadMax").val(result.conductividad_max)
        $("#txtNH3Min").val(result.amonionh3_min)
        $("#txtNH3Max").val(result.amonionh3_max)
        $("#txtNH4Min").val(result.amonionh4_min)
        $("#txtNH4Max").val(result.amonionh4_max)
        $("#txtNitritoMin").val(result.nitrito_min)
        $("#txtNitritoMax").val(result.nitrito_max)
        $("#txtAlcalinidadMin").val(result.alcalinidad_max)
        $("#txtAlcalinidadMax").val(result.alcalinidad_min)
        
    
    }

    $("#btnLimpiar").click(function () {

       limpiar()
        
    })

    $("#btnSonda").click(function(){
        $("#modalSonda").modal();
        loadSensor();
        //loadRango();
    })

    $("#btnLago").click(function(){
        $("#modalLago").modal();
         loadLago();
         loadRangoLago();
    })

    $("#btnCerrarModalSonda").click(function(){
        $("#modalSonda").modal("hide");
    })

    $("#btnCerrarModalLago").click(function(){
        $("#modalLago").modal("hide");
    })

    function loadSensor()
    {
        var obj = new Sensor();
        obj.token = $("#txtVarUrl").val()
        var result = obj.consultar()
        if(result['estado'])
        {
            obj.cargarddl("ddlSonda",result['data'])
        }
        
    }

    function loadRango()
    {
        var obj = new Rango();
        obj.token = $("#txtVarUrl").val();
        var result = obj.consultar();
         
        if(result['estado'])
        {
            obj.cargarddl("ddlRango",result["data"]);
            obj.cargarddl("ddlRangoLago",result["data"]);
        }
        
    }

    function loadLago()
    {
        var obj = new Lago();
        obj.token = $("#txtVarUrl").val();
        var result = obj.consultar()
        if (result['estado']) {
            obj.cargarddl("ddlLago", result['data']);
        }

        validarRespuesta(result)
    }

    function loadRangoLago()
    {
        var obj = new Rango();
        obj.token = $("#txtVarUrl").val();
        var result = obj.consultarLago();

        validarRespuesta(result)

        if(result['estado'])
        {
            
            var columna = [{
                "targets": -1,
                "data": null,
                "defaultContent": ""
            },
            {
                "data":"sensornombre"
            },
            {
                "data": "descripcion"
            },
            {
                "data": "temperaturaambiente_min"
            },
            {
                "data": "temperaturaambiente_max"
            },
            {
                "data": "temperaturaestanque_min"
            },
            {
                "data": "temperaturaestanque_max"
            },
            {
                "data": "oxigeno_min"
            },
            {
                "data": "oxigeno_max"
            },
            {
                "data": "ph_min"
            },
            {
                "data": "ph_max"
            },
            {
                "data": "conductividad_min"
            },
            {
                "data": "conductividad_max"
            },
            {
                "data": "amonionh3_min"
            },
            {
                "data": "amonionh3_max"
            },
            {
                "data": "amonionh4_min"
            },
            {
                "data": "amonionh4_max"
            },
            {
                "data": "nitrito_min"
            },
            {
                "data": "nitrito_max"
            },
            {
                "data": "alcalinidad_min"
            },
            {
                "data": "alcalinidad_max"
            },
            {
                "targets": -1,
                "data": null,
                "defaultContent": "<img class='eliminar'  src='../svg/delete.png'></img>"
            }
        ]

          tabla("TablaLago", result['data'], columna, "");
            

        }
         
        
        
    }

    function limpiar(){
        $("#btnEnviar").addClass("btn-primary");
        $("#btnEnviar").text("Guardar");
        $("#btnEnviar").removeClass("btn-success");
        $("#txtDescripcion").val("");
        $(":text").removeAttr('required');
        $(".was-validated").removeClass('was-validated');
        $(".required").removeAttr('required');
        $(".number").removeAttr('disabled');
        $(":checkbox").prop("checked",true)
        $(".limpiar").val("")
        $(".number").addClass("required")
    }

})

function estado(item, element) {

    if ($(`#${item.id}`).prop('checked')) {

        $(`#${element}Min`).prop("disabled", false);
        $(`#${element}Max`).prop("disabled", false);
        $(`#${element}Min`).attr("required","required")
        $(`#${element}Max`).attr("required","required")
        $(`#${element}Min`).addClass("required")
        $(`#${element}Max`).addClass("required")
        

    } else {
        $(`#${element}Min`).val("")
        $(`#${element}Max`).val("")
        $(`#${element}Min`).prop("disabled", true);
        $(`#${element}Max`).prop("disabled", true);
        $(`#${element}Min`).removeAttr("required")
        $(`#${element}Max`).removeAttr("required")
        $(`#${element}Min`).removeClass("required")
        $(`#${element}Max`).removeClass("required")
    }

}

function validarRespuesta(respuesta)
{
    if(respuesta['estado'])
    {
        if(respuesta['mensaje']!="")
        {
            badge("#pnMensaje", respuesta['mensaje'], "success");
            $("#btnLimpiar").click();
        }
       
    }else{
        badge("#pnMensaje",respuesta['mensaje'], "danger");
        console.log("ERROR:",respuesta)
    }
}
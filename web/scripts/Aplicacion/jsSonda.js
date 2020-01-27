$(function () {
    
    consultar();

    $("#btnLimpiar").click();

    $("#txtFecha").datepicker({
        onSelect: function (fd, d, calendar) {
            calendar.hide()
        }
    })

    $("#txtFecha").click(function(){

       var fecha= $("#txtFecha").val().split("-");
       if(fecha.length>1)
       {
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


    $("#btnEnviar").click(function() {
        
       var obj=new Sonda();
       obj.fecharegistro=$("#txtFecha").val().trim();
       obj.oxigenodisuelto=$("#txtOxigeno").val().trim();
       obj.ph=$("#txtPh").val().trim();
       obj.cultivo=$("#ddlCultivo").val().trim(); 
       obj.horaregistro=$("#txtHora").val().trim();
       obj.temperaturaambiente=$("#txtTempAmbiente").val().trim();
       obj.temperaturaestanque=$("#txtTempEstanque").val().trim();
       obj.conductividadelectrica=$("#txtCondElectrica").val().trim(); 
       obj.amonionh3=$("#txtAmonioNH3").val().trim();
       obj.amonionh4=$("#txtAmonioNH4").val().trim();
       obj.nitrito=$("#txtNitrito").val().trim();
       obj.alcalinidad=$("#txtAlcalinidad").val().trim();
       obj.descripcion=$("#txtObservacion").val().trim();
       obj.pecesmuertos=$("#txtPecesMuertos").val().trim();
       obj.token=$("#txtVarUrl").val().trim();

       if($("#btnEnviar").text()=="Guardar")
       {
           obj.guardar();
           badge("#pnMensaje", "Registro guardado.", "success");
       }else{
           obj.id=$("#txtID").val().trim();
           obj.actualizar();
           badge("#pnMensaje", "Registro guardado.", "success");
       }
       
       $("#btnLimpiar").click();

    })

    $("#btnConfiguracion").click(function () {
        
        $("#modal").modal();
        consultarRegistro();

    })

    $("#btnLimpiar").click(function () {
    
        $("#btnEnviar").addClass("btn-primary");
        $("#btnEnviar").text("Guardar");
        $("#btnEnviar").removeClass("btn-success");
        $(":text").val(" ");
        $(".limpiar").val("0");
        $("#txtDescripcion").val(" ");
    
    
    })

    $('#Tabla tbody').on('click', 'tr .seleccionarFila', function () {
        var table = $('#Tabla').DataTable();
        var data = table.row( $(this).parents("tr") ).data();

        $("#txtID").val(data.estadofisicoquimicoid);
        $("#ddlCultivo").val(data.cultivoid);
        $("#txtFecha").val(data.fecharegistro);
        $("#txtOxigeno").val(data.oxigenodisuelto);
        $("#txtPh").val(data.ph);
        $("#txtHora").val(data.horaregistro);
        $("#txtTempAmbiente").val(data.temperaturaambiente);
        $("#txtTempEstanque").val(data.temperaturaestanque);
        $("#txtCondElectrica").val(data.conductividadelectrica); 
        $("#txtAmonioNH3").val(  data.amonionh3);
        $("#txtAmonioNH4").val( data.amonionh4);
        $("#txtNitrito").val(data.nitrito);
        $("#txtAlcalinidad").val(data.alcalinidad);
        $("#txtObservacion").val( data.descripcion);
        $("#txtPecesMuertos").val(data.pecesmuertos);
        $("#btnCerrarModal").click();
        $("#btnEnviar").text("Actualizar");
        $("#btnEnviar").attr("class", "btn btn-success");

    });

    $('#Tabla tbody').on('click', 'tr .eliminar', function () {
        var table = $('#Tabla').DataTable();
        var data = table.row( $(this).parents("tr") ).data();
        var si=confirm("Está seguro de eliminar el registro del: "+ data.fecharegistro +" - "+data.horaregistro);
        if(si)
        {
            
            var obj=new Sonda();
            obj.id=data.estadofisicoquimicoid;
            obj.token = $("#txtVarUrl").val();
            obj.eliminar();
            consultarRegistro();

        }

    });

    function consultar() {

        var obj = new Cultivo();
        obj.token = $("#txtVarUrl").val();
        var result = obj.consultar().responseJSON;
        obj.cargarddl("ddlCultivo",result,"cultivoid","nombre");

    }

    function consultarRegistro() {
        
        var obj = new Sonda();
        obj.cultivo=$("#ddlCultivo").val().trim();
        obj.fecharegistro=$("#txtFecha").val().trim();
        obj.horaregistro=$("#txtHora").val().trim();
        obj.token = $("#txtVarUrl").val().trim();
        var result = obj.consultar().responseJSON;
    
        var columna = [
            {
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
    
        tabla("Tabla", result, columna,"");


    }











})
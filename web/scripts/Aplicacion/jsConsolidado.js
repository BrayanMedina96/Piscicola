
$(document).ready(function(){

    $("#myInput").on("keyup", function() 
    {
          var value = $(this).val().toLowerCase();

          $("#tdResultado tr").filter(function() 
           {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);

           });
    });

    
   
    $('#txtFechaInicial').datepicker();
  
    $('#txtFechaFinal').datepicker();
  

    $("#btnBuscar").click(function(){
         
        parametro = {
            'fechaInicial': $("#txtFechaInicial").val(),
            'fechaFinal': $("#txtFechaFinal").val()
        };

        $.ajax({

            type: "POST",
            url: "../Controller/Consolidado.php",
            data: parametro,
            async: false,
            success: dibujar,
            failure: function (response) {
                alert(response.d);
            }
        })


    });


    function dibujar(response)
    {

        $("#Tabla").dataTable().fnDestroy();

        var objJson= JSON.parse(response);
        $('#Tabla').DataTable( {
            data: objJson,
            "columns": [
                { "data": "displayName" },
                { "data": "ENEROSOLICITUD" },
                { "data": "ENERORESUELTO" },
                { "data": "ENERORESUELTON" },
                { "data": "FEBREROSOLICITUD" },
                { "data": "FEBRERORESUELTO" },
                { "data": "FEBRERORESUELTON" },
                { "data": "MARZOSOLICITUD" },
                { "data": "MARZORESUELTO" },
                { "data": "MARZORESUELTON" },
                { "data": "ABRILSOLICITUD" },
                { "data": "ABRILRESUELTO" },
                { "data": "ABRILRESUELTON" },
                { "data": "MAYOSOLICITUD" },
                { "data": "MAYORESUELTO" },
                { "data": "MAYORESUELTON" },
                { "data": "JUNIOSOLICITUD" },
                { "data": "JUNIORESUELTO" },
                { "data": "JUNIORESUELTON" },
                { "data": "JULIOSOLICITUD" },
                { "data": "JULIORESUELTO" },
                { "data": "JULIORESUELTON" },
                { "data": "AGOSTOSOLICITUD" },
                { "data": "AGOSTORESUELTO" },
                { "data": "AGOSTORESUELTON" },
                { "data": "SEPTIEMBRESOLICITUD" },
                { "data": "SEPTIEMBRERESUELTO" },
                { "data": "SEPTIEMBRERESUELTON" },
                { "data": "OCTUBRESOLICITUD" },
                { "data": "OCTUBRERESUELTO" },
                { "data": "OCTUBRERESUELTON" },
                { "data": "NOVIEMBRESOLICITUD" },
                { "data": "NOVIEMBRERESUELTO" },
                { "data": "NOVIEMBRERESUELTON" },
                { "data": "DICIEMBRESOLICITUD" },
                { "data": "DICIEMBRERESUELTO" },
                { "data": "DICIEMBRERESUELTON" },

            ],
             "paging":   false,
             "info":     false            
        });

        $('#Tabla').attr("class","table table-bordered table-striped");
     
    }

  });
  
  
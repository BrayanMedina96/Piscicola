
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
            url: "../Controller/Incidencia.php",
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
                { "data": "soltic" },
                { "data": "fechaCreacion" },
                { "data": "fechaAsignado" },
                { "data": "fechaSolucion" },
                { "data": "estado" }
            /*    { "data": "anioSolicitud" },
                { "data": "mesSolicitud" },
                { "data": "anioSolucion" },
                { "data": "mesSolucion" }*/
            ],
             "paging":   false,
             "info":     false            
        });

        $('#Tabla').attr("class","table table-bordered table-striped");
     
    }

  });
  
  
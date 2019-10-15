
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
            url: "../Controller/Asignado.php",
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
                { "data": "Enero" },
                { "data": "Febrero" },
                { "data": "Marzo" },
                { "data": "Abril" },
                { "data": "Mayo" },
                { "data": "Junio" },
                { "data": "Julio" },
                { "data": "Agosto" },
                { "data": "Septiembre" },
                { "data": "Octubre" },
                { "data": "Noviembre" },
                { "data": "Diciembre" },
            ],
             "paging":   false,
             "info":     false            
        });

        $('#Tabla').attr("class","table table-bordered table-striped");
     
    }

  });
  
  
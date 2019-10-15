$(document).ready(function(){

    $("#myInput").on("keyup", function() 
    {
          var value = $(this).val().toLowerCase();

          $("#tdResultado tr").filter(function() 
           {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);

            
           });
    });
    

    $('#Tabla tbody').on('click', 'tr', function () 
    {
        $(".card-body").html("");

        var table = $('#Tabla').DataTable();
        var data = table.row( this ).data();
        ventaSoltic(data.ingeniero,data.id);

    } );
   
    $('#txtFechaInicial').datepicker();
  
    $('#txtFechaFinal').datepicker();

    var date = new Date();
    var primerDia = new Date(date.getFullYear(), date.getMonth(), 1);
    var ultimoDia = new Date(date.getFullYear(), date.getMonth() + 1, 0);
    $('#txtFechaInicial').val(primerDia.toLocaleDateString('en-US'));
    $('#txtFechaFinal').val(ultimoDia.toLocaleDateString('en-US'));
  

    $("#btnBuscar").click(function(){
         
        parametro = {
            'fechaInicial': $("#txtFechaInicial").val(),
            'fechaFinal': $("#txtFechaFinal").val(),
            'area': $("#ddlProceso option:selected").text().trim(),
            'accion':'area',
            'prioridad': $("#ddlPrioridad").val()
        };

        buscar(parametro);
      
    });


    function dibujar(response)
    {

        $("#Tabla").dataTable().fnDestroy();

        var objJson= JSON.parse(response);
        $('#Tabla').DataTable( {
            data: objJson,
            "columns": [
                { "data": "ingeniero" },
                { "data": "progreso" },
                { "data": "detenida" },
                { "data": "resuelta" },
                { "data": "cerrada" },
                { "data": "rechazada" },
                { "data": "id" },
                { "data": "tiempo" },
                { "data": "noTiempo" },
            ],
           "columnDefs": [
                {
                    "targets": [ 6 ],
                    "visible": false,
                    "searchable": false
                }
           ],
             "paging":   false,
             "info":     false,
             "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(), data;
     
                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };
     
                // Total over all pages
                progreso = api
                    .column( 1 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
     
                detenida = api
                    .column( 2 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                resuleta = api
                    .column( 3 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                    
                cerrada = api
                 .column( 4 )
                 .data()
                 .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

                rechazada = api
                .column( 5 )
                .data()
                .reduce( function (a, b) {
                   return intVal(a) + intVal(b);
               }, 0 );
     
                
                $( api.column( 1 ).footer() ).html(
                    progreso
                );

                $( api.column( 2 ).footer() ).html(
                    detenida
                );
                
                $( api.column( 3 ).footer() ).html(
                    resuleta
                );
                
                $( api.column( 4 ).footer() ).html(
                    cerrada
                );

                $( api.column( 5 ).footer() ).html(
                    rechazada
                );
            }   
                     
        });

        $('#Tabla').attr("class","table table-bordered table-striped");

        $("#Tabla").attr("style","visible");

     
    }

    function ventaSoltic(ingeniero,id)
    {

        $("#ventaSoltic").modal();
       
        $("#txtTituloModal").text(ingeniero);

        parametro = {
            'fechaInicial': $("#txtFechaInicial").val(),
            'fechaFinal': $("#txtFechaFinal").val(),
            'area': $("#ddlProceso option:selected").text().trim(),
            'accion':'detenida',
            'id':id,
            'prioridad': $("#ddlPrioridad").val()
        };

    
        buscar(parametro)

        parametro.accion="resuelta";
        
        buscar(parametro);

        parametro.accion="cerrada";
       
        buscar(parametro);

        parametro.accion="progreso";

        buscar(parametro);

        parametro.accion="rechazado";

        buscar(parametro);
        
        
    }

    function buscar(parametro)
    {
        
        $.ajax({

            type: "POST",
            url: "../Controller/Tablero.php",
            data: parametro,
            async: false,
            success: function(response)
            {
                 switch(parametro.accion)
                 {
                     case "area":
                       dibujar(response);
                       break;
                    default:
                        bloque(response,parametro.accion);
                    break;

                 }
            },
            failure: function (response) {
                alert(response.d);
            }
        })
    }

    function bloque(response,accion)
    {
        var objJson= JSON.parse(response);

        panel="";
        
        
        switch(accion)
        {
            case "detenida":
            panel="panelDetenida";
            lbl="lblNDetenida";
            break;
            case "resuelta":
            panel="panelResuelta";
            lbl="lblNResuelta";
            break;
            case "cerrada":
            panel="panelCerrada";
            lbl="lblNCerrada";
            break;
            case "progreso":
            panel="panelProgreso";
            lbl="lblNProgreso";
            break;
            case "rechazado":
            panel="panelRechazado";
            lbl="lblNRechazado";
            break;
            
        }

        


        for (obj in objJson) 
        {
            $tabla="";
            
            if(accion=="cerrada")
            {
               fecha= objJson[obj].estimatedDate=="1900/01/01" ? " - ": objJson[obj].estimatedDate ;
            }
            else{
               fecha= objJson[obj].estimatedDate=="1900/01/01" ? " - ": objJson[obj].estimatedDate ;
            }

            prioridad=accion=="progreso"? "<br/> <strong>Prioridad:</strong>"+objJson[obj].prioridad:"";
            
            $tabla+= "<div class='card bg-light'>";
            $tabla+= "<br/> <strong>Codigo:</strong>";
            $tabla+="<a href='http://POSEIDON/proactivanet/servicedesk/incidents/formIncidents/formIncidents.paw?id="+objJson[obj].id+"&amp;source=viewAllGlobalIncidents' target='_blank' rel='noopener noreferrer' data-auth='NotApplicable'>"+objJson[obj].codigo+"</a>";
            $tabla+= "<strong>Categoria:</strong>"+objJson[obj].categoria;
            $tabla+= "<br/> <strong>Titulo:</strong>"+objJson[obj].titulo;
            $tabla+= "<br/> <a class='text-warning'> <strong>F.Estimada:</strong>"+ fecha +"</a>";
            $tabla+= prioridad;
            $tabla+= "</div>";
            $tabla+= "</div>";
            $tabla+= "<br/>";
            $("#"+panel).append($tabla);
        }
       
        $("#"+lbl).text(objJson.length);
        
    }



    

  });
  
  
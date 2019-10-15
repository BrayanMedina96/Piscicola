function validarCampos(tipo)
{
        var estado=true;
        var result= $(tipo);
        for (var indice in result ) 
        {
            if( $("#"+result[indice]["id"] ).val()=="")
            {
                estado=false;
            }

            $("#"+result[indice]["id"] ).parent().addClass("was-validated") ;
        }
       
       return estado;
}


function modal(titulo,mensaje,largo)
{
    var modal="";

    modal+="<div class='modal fade' id='myModal'>";
    modal+="<div class='modal-dialog "+largo+" '>";
    modal+="<div class='modal-content'>";
      
        
    modal+="<div class='modal-header'>";
    modal+="<h5 class='modal-title'> <em>"+titulo+"</em></h5>";
    modal+="<button type='button' class='close' data-dismiss='modal'>&times;</button>";
    modal+="</div>";
        
        
    modal+="<div class='modal-body'>";
    modal+="<em>"+mensaje+"</em>";
    modal+="</div>";
        
        
    modal+="<div class='modal-footer'>";
   // modal+="<button type='button' class='btn btn-primary' data-dismiss='modal'>Aceptar</button>";
    modal+="</div>";
        
    modal+="</div>";
    modal+="</div>";
    modal+="</div>";

    return modal;

}



function tabla(elemento,datos,columna)
{
    
    $("#"+elemento).dataTable().fnDestroy();

    var objJson= datos; //JSON.parse(datos);

    $('#'+elemento).DataTable( {
        data: objJson,
        "columns": columna,
        "columnDefs": [
            {
               // "targets": [ 0 ],
                "visible": false,
                "searching": false
            }
       ],
         "paging":   false,
         "info":     false,
                    
    });


    $('#'+elemento).attr("class","table table-bordered table-striped");

    $("#"+elemento).attr("style","visible");

}
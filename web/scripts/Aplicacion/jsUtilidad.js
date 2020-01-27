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

function  badge(elem,mensaje,tipo) {
   
   var alert="";
   alert+="<span id='badgeID' class='badge badge-"+tipo+"'>"+mensaje+"</span>";
   
   $(elem).append(alert);

   $("#badgeID").fadeOut(4000);
   setTimeout(function () {
      $("#badgeID").remove();
     }, 5000);

}


function tabla(elemento,datos,columna,funcion)
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
               
            },
            funcion
            
       ],
         "paging":   false,
         "info":     false,
         "searching": false
                    
    });


    $('#'+elemento).attr("class","table table-bordered table-striped");

    $("#"+elemento).attr("style","visible");

}

function  limpiar (elemento) {
    
  $(elemento).val(" ");
  $(".was-validated").removeClass("was-validated");

}


function  validarPassword(myInput) {
    
   
    
    var obj={
        porcentaje : 0,
        color:"progress-bar bg-dark"
    }
      

     // Validate lowercase letters
    /* var lowerCaseLetters = /[a-z]/g;
     if (myInput.value.match(lowerCaseLetters)) {
        obj.porcentaje += 20;

     }*/

     // Validate capital letters
     var upperCaseLetters = /[A-Z]/g;
     if (myInput.value.match(upperCaseLetters)) {
        obj.porcentaje += 20;
     }

     // Validate numbers
     var numbers = /[0-9]/g;
     if (myInput.value.match(numbers)) {
        obj.porcentaje += 20;
     }
     
     //Validate symbols
     var simbolo = /[!#$%&()=?¡¿*.@]/g;
     if (myInput.value.match(simbolo)) {
        obj.porcentaje += 21;
     }
     
   
     // Validate length
     if ( (myInput.value.length >= 8) &&  (obj.porcentaje>60) ) {

        obj.porcentaje += 39;

     } 
     
   

     if(obj.porcentaje>23)
     {
        obj.color="progress-bar progress-bar-striped progress-bar-animated bg-danger";
     }

     if(obj.porcentaje>46)
     {
        obj.color="progress-bar progress-bar-striped progress-bar-animated bg-warning";
     }

     if(obj.porcentaje>69)
     {
        obj.color="progress-bar progress-bar-striped progress-bar-animated bg-info";
     }

     if(obj.porcentaje>92)
     {
        obj.color="progress-bar progress-bar-striped progress-bar-animated bg-succes";
     }


     return obj;

}


function checkPassword(params,txt) {



   if ($("#" + params).attr("go") == "no") {
      $("#" + params).attr("src", "../svg/ojo-abierto.png");
      $("#" + params).attr("go", "si");
      $("#"+txt).attr("type","text");
   } else {
      $("#" + params).attr("src", "../svg/ojo-cerrado.png");
      $("#" + params).attr("go", "no");
      $("#"+txt).attr("type","password");
   }


}



function validarEmail(email) {

   var verificar = false;
   expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

   if (!expr.test(email)) {
      verificar = true;
   }

   return verificar;
}


function  compararTxt(txt1,txt2) {
   
   var estado=false;
   if(txt1==txt2)
   {
       estado=true;
   }
  return estado;
  
}
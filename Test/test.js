
$(function(){


$("#btnEnviar").click(function(){

    var tipo=$("#ddlMetodoPeticion").val();
    ///este se utiliza para get
    var parametro={
        entidad:"Persona",
 	perosnaNombre:"NNNNN", 
    personaApellido:"MEDINA",
	personaTelefono:"3219047590",
	personaTelefonoOpcional:"",
	personaCorreo:"",
	tipoDocumentoID:1,
	personaNumeroDocumento:"1080296146" 
    }
    
   // var parametro= eval( $("#txtData").val() ) ;

$.ajax({
        type: tipo,
        url: "http://localhost:8000/Piscicultura/api/?entidad=Usuario&do=login",
        //data: parametro,
        contentType: "application/json; charset=utf-8",
        dataType: 'json',
        success: function(response){
             alert(response);
        },
        failure: function (response) {
            alert(response.d);
        }
        
    });
    
});



});


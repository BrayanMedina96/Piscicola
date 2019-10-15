class tipodocumento{


  tipoDocumento()
  {
   
     var parametro={
        entidad:"TipoDocumento",
        do:""
     }
    
      return consultarAjax('GET',parametro) ;

  }



  cargarTipoDocumento(elemento,result)
 {
        $("#"+elemento).html("");
        var option="";
        for (var indice in result) 
        {
            option+="<option value="+result[indice]["tipodocumentoid"]+">"+result[indice]["tipodocumentonombre"]+"</option>";
        }
        $("#"+elemento).append(option);
 }

}
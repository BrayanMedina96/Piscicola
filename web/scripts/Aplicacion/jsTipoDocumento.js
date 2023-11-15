class tipodocumento{

   token="null";

  tipoDocumento()
  {
   
     var parametro={
        entidad:"TipoDocumento",
        token:this.token,
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
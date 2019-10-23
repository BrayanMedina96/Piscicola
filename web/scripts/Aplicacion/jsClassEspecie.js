class Especie{

    consultar()
    {
     
       var parametro={
          entidad:"Especie",
          do:""
       }
      
        return consultarAjax('GET',parametro) ;
  
    }
  
  
   cargarddl(elemento,result)
   {
          $("#"+elemento).html("");
          var option="";
          for (var indice in result) 
          {
              option+="<option value="+result[indice]["pezid"]+">"+result[indice]["especiepez"]+"</option>";
          }
          $("#"+elemento).append(option);
   }


}
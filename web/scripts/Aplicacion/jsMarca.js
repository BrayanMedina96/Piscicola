class Marca{

    entidad="Marca";
    token;
    
    consultar()
    {
     
       var parametro={
          entidad:this.entidad,
          token:this.token,
          do:""
       }
      
        return consultarAjax('GET',parametro) ;
  
    }
  
  
  
   cargarMarca(elemento,result)
   {
          $("#"+elemento).html("");
          var option="";
          for (var indice in result) 
          {
              option+="<option value="+result[indice]["marcaid"]+">"+result[indice]["marcanombre"]+"</option>";
          }
          $("#"+elemento).append(option);
   }


}
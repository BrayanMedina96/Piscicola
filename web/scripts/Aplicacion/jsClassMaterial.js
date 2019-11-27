class Material{

    token;
    
    consultar()
    {
     
       var parametro={
          entidad:"Material",
          token:this.token,
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
              option+="<option value="+result[indice]["tipolagoid"]+">"+result[indice]["tipolagonombre"]+"</option>";
          }
          $("#"+elemento).append(option);
   }


}
$(function(){

   var data= getParameterByName('MC')
   if(data.toString()!="")
   {
      setData("user",data)
      window.location.assign("../view/home.php")
   }
   

})
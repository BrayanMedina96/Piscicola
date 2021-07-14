$(function () {

   var data = getParameterByName('MC');
   if (data.toString() != "") {
     
     // window.location.assign("../view/home.php");
      setData("user", data);
   }


})
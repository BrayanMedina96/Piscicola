<?php

if (isset($_GET['txtUsuariohd']) != "") 
{
      /*
      $variable = '{"usuario":"'.$_GET['txtUsuariohd'].
      '","token":"'.$_GET['txtToken'].
      '","nombre":"'.$_GET['txtNombreUsuario'].
      '"}';
*/
     // $variable = base64_encode($variable);
      
            header('Location: http://localhost:8000/Piscicultura/web/view/home.php?MC='.$_GET['txtUsuariohd']);
            die();
      
      

}


?>



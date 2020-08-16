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
      $ip=$_SERVER['REMOTE_ADDR'];
      header("Location: $ip/Piscicultura/web/view/home.php?MC=".$_GET['txtUsuariohd']);
      die();
      
      

}


?>



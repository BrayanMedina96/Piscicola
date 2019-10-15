<?php

if( isset($_GET['txtSalir'])!="")
{
      if($_GET['txtSalir']=="salir")
      {
            header('Location:../view/login.php');
            die(); 
      }

      
}

if( isset($_GET['txtVarUrl'])!="")
{

      header('Location:'.$_GET['txtUrl'].'?MC='.$_GET['txtVarUrl']);
      die();
}

?>
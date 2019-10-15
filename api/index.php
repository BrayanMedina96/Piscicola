<?php


require "Config/CabeceraHTTP.php";
require "Controller/Piscicultura.php";

$respuesta;
$objPiscicultura=new Piscicultura();;

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
          $respuesta= $objPiscicultura->control('GET',$_REQUEST);
               
        break;
    case 'POST':
          $respuesta=$objPiscicultura->control('POST',$_REQUEST);
               
        break;
    case 'DELETE':
          $respuesta= $objPiscicultura->control('DELETE',$_REQUEST);
        break;
    case 'PUT':
          $respuesta= $objPiscicultura->control('PUT',$_REQUEST);
              
        break;
    default:
             $respuesta="ESto es NULL";
        break;
}

echo json_encode($respuesta);



?>
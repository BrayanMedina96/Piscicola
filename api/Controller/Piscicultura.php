<?php

require "Model/Base64.php";
require "Model/Conexion.php";
require "Ruta.php";
require "Model/Persona.php";
require "Model/Usuario.php";
require "Model/TipoDocumento.php";
require "Model/PersonaUsuario.php";

class Piscicultura
{

    function control($verbo,$obj)
    {
    
        $resultado;

        try 
        {
            $objRuta=new Ruta();
            $metodo=$obj['entidad']."_".$verbo.$obj["do"];
    
            $funcion=$objRuta->ruta()[$metodo];
            $objClass=new $obj['entidad']();
    
            $resultado=$objClass->$funcion($obj);

        } catch (\Exception  $e) 
        {
            $resultado="Error :".$e->getMessage();
           
        }


        return  $resultado;

        
    }

}





?>
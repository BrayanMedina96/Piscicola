<?php

require "Model/Base64.php";
require "Model/Conexion.php";
require "Ruta.php";
require "Model/Persona.php";
require "Model/Usuario.php";
require "Model/TipoDocumento.php";
require "Model/PersonaUsuario.php";
require "Model/Lago.php";
require "Model/Marca.php";
require "Model/Sensor.php";
require "Model/Especie.php";
require "Model/LagoSensor.php";
require "Model/Sonda.php";
require "Model/Dashboard.php";
require "Model/Material.php";
require "Model/Seguridad.php";
require "Model/TipoLago.php";
require "Model/Cultivo.php";

class Piscicultura
{

    function control($verbo,$obj)
    {
    
        $resultado=null;

        try 
        {
            if($obj["do"]=="login")
            {
                $resulUsuairio=[1];
            }
            else{
                
                $objBase64 = new Base64($obj["token"]);
                $objUsuario = new Usuario();
                $resulUsuairio = $objUsuario -> consultarUsuarioToken($objBase64 -> decodeUsuario()["token"]);
            }
         
            
            if(count($resulUsuairio)>0)
            {
                 $objRuta=new Ruta();
                 $metodo=$obj['entidad']."_".$verbo.$obj["do"];
    
                 $funcion=$objRuta->ruta()[$metodo];
                 $objClass=new $obj['entidad']();
                 $objClass->usuario=$resulUsuairio;

                 $resultado=$objClass->$funcion($obj);
            }

          

        } catch (\Exception  $e) 
        {
            $resultado="Error :".$e->getMessage();
           
        }


        return  $resultado;

        
    }

}





?>
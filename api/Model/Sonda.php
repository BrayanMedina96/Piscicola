<?php

class Sonda
{
    public $usuario;

    public function consultar($parametro)
    {
       
        $result=['estado'=>true,'mensaje'=>'','data'=>null];
        $conn=Conexion::getInstance()->cnn();

        try {


            $fecha="";
            $dia=[];

            if($parametro["fecharegistro"]!="")
            {
               $dia=explode("-", $parametro["fecharegistro"] );

               if(count($dia)>1)
               {
                 $fecha=" AND fecharegistro BETWEEN :fechaInicial AND :fechaFinal ";
                }else{
                $fecha=" AND fecharegistro=:fecharegistro ";
               }

            }

            $hora=$parametro["horaregistro"]==""?"": "AND horaregistro=CAST(:horaregistro AS TIME)";

        
            $sqlCommand = "SELECT estadofisicoquimico.estadofisicoquimicoid, estadofisicoquimico.fecharegistro,
            estadofisicoquimico.oxigenodisuelto, estadofisicoquimico.ph, estadofisicoquimico.cultivoid,
            CAST(estadofisicoquimico.horaregistro AS TIME) AS horaregistro, estadofisicoquimico.temperaturaambiente,
            estadofisicoquimico.temperaturaestanque, estadofisicoquimico.conductividadelectrica,
            estadofisicoquimico.amonionh3, estadofisicoquimico.amonionh4, estadofisicoquimico.nitrito,
            estadofisicoquimico.alcalinidad, estadofisicoquimico.descripcion, estadofisicoquimico.pecesmuertos,
            estadofisicoquimico.usuarioid, estadofisicoquimico.usuariopadreid, 
            CONCAT(lago.lagonombre,' - ',pez.especiepez) AS nombre
            FROM estadofisicoquimico
            INNER JOIN cultivo ON estadofisicoquimico.cultivoid=cultivo.cultivoid
            INNER JOIN lago ON cultivo.lagoid=lago.lagoid
            INNER JOIN pez ON cultivo.pezid=pez.pezid
            WHERE estadofisicoquimico.usuariopadreid=:usuariopadreid AND estadofisicoquimico.cultivoid=:cultivoid  AND fechaelimina IS NULL  $fecha   $hora
           ORDER BY fecharegistro DESC , horaregistro DESC;";

           $statement  = $conn->prepare($sqlCommand); 
           $statement ->bindValue(':usuariopadreid',$this->usuario[0]['usuariopadreid'],PDO::PARAM_INT);
           $statement ->bindValue(':cultivoid',$parametro["cultivo"],PDO::PARAM_INT);

          if($parametro["fecharegistro"]!="")
         {
            if(count($dia)>1)
            {
                $statement ->bindValue(':fechaInicial',$dia[0],PDO::PARAM_STR);
                $statement ->bindValue(':fechaFinal',$dia[1],PDO::PARAM_STR);

            }else{
                $statement ->bindValue(':fecharegistro',$parametro["fecharegistro"],PDO::PARAM_STR);
            }
         }
       
        if($hora!="")
        {
            $statement ->bindValue(':horaregistro',$parametro["horaregistro"],PDO::PARAM_STR);
        }

        $statement->execute();              
        $result['data']= $statement->fetchAll();

    }catch (PDOException  $Exception) {

        $result['estado']=false;
        $result['mensaje']= UserError::getInstance()->getError($Exception->getCode(),$Exception->getMessage());
    }
    finally{
       Conexion::cerrar($conn);
    }

     return $result;

    }

    public function getParametros($parametro)
    {
       
        $result=['estado'=>true,'mensaje'=>'','data'=>null];
        $conn=Conexion::getInstance()->cnn();

        try {


                $sqlCommand = "SELECT lago.lagonombre, sensor.sensornombre,rango.descripcion AS configuracion,tipolago.tipolagonombre,
                cultivo.fechainicio,cultivo.fechafinalizacion,
                
                rango.temperaturaambiente_max+rango.temperaturaambiente_min AS temperaturaambiente,
                rango.temperaturaestanque_max+rango.temperaturaestanque_min AS temperaturaestanque,
                rango.oxigeno_max+rango.oxigeno_min AS oxigeno, 
                rango.ph_max+rango.ph_min AS ph,
                rango.conductividad_max+rango.conductividad_min AS conductividad,
                rango.amonionh3_max+rango.amonionh3_min AS amonionh3, 
                rango.amonionh4_max+rango.amonionh4_min AS amonionh4,
                rango.nitrito_max+rango.nitrito_min AS nitrito, 
                rango.alcalinidad_max+rango.alcalinidad_min AS alcalinidad 
                       
                   
                FROM cultivo
                INNER JOIN lago ON cultivo.lagoid=lago.lagoid
                INNER JOIN lagosensor ON  lago.lagoid=lagosensor.lagoid AND lagosensorestado=TRUE
                INNER JOIN sensor ON lagosensor.sensorid=sensor.sensorid
                INNER JOIN rango_sensor ON sensor.sensorid=rango_sensor.sonda_id
                INNER JOIN rango ON   rango_sensor.rango_id =rango.id
                INNER JOIN tipolago ON  lago.tipolagoid= tipolago.tipolagoid
                WHERE cultivo.cultivoid=:cultivoid";

                $statement  = $conn->prepare($sqlCommand); 
        
                $statement ->bindValue(':cultivoid',$parametro["cultivo"],PDO::PARAM_INT);

    
                $statement->execute();              
                $result['data']= $statement->fetchAll();

        }catch (PDOException  $Exception) {

           $result['estado']=false;
           $result['mensaje']= UserError::getInstance()->getError($Exception->getCode(),$Exception->getMessage());
       }
       finally{
          Conexion::cerrar($conn);
       }

        return $result;
 
    }


    public function guardar($parametro)
    {
         
        $result=['estado'=>true,'mensaje'=>'Registro guardado.','data'=>null];
        $conn=Conexion::getInstance()->cnn();

        try {
            
            $sqlCommand ='INSERT INTO estadofisicoquimico(
                fecharegistro,
                horaregistro,
                temperaturaambiente,
                temperaturaestanque,
                oxigenodisuelto,
                ph,
                conductividadelectrica,
                amonionh3,
                amonionh4,
                nitrito,
                alcalinidad,
                pecesmuertos,
                descripcion,
                cultivoid,
                usuarioid,
                usuariopadreid) VALUES ( CAST(:fecharegistro AS Date), CAST(:horaregistro AS TIME),:temperaturaambiente,:temperaturaestanque
                ,:oxigenodisuelto,:ph,:conductividadelectrica,:amonionh3,:amonionh4,:nitrito,:alcalinidad,:pecesmuertos
                ,:descripcion,:cultivoid,:usuarioid,:usuariopadreid )';
    
            $statement  = $conn->prepare($sqlCommand);
            $statement ->bindValue(':fecharegistro',$parametro["fecharegistro"],PDO::PARAM_STR);
            $statement ->bindValue(':horaregistro',$parametro["horaregistro"],PDO::PARAM_STR);

            $statement ->bindValue(':temperaturaambiente',$parametro["temperaturaambiente"]==""?NULL:$parametro["temperaturaambiente"],PDO::PARAM_INT);
            $statement ->bindValue(':temperaturaestanque',$parametro['temperaturaestanque']==""?NULL:$parametro["temperaturaestanque"],PDO::PARAM_INT);
            $statement ->bindValue(':oxigenodisuelto',$parametro["oxigenodisuelto"]==""?NULL:$parametro["oxigenodisuelto"],PDO::PARAM_INT);
            $statement ->bindValue(':ph',$parametro["ph"]==""?NULL:$parametro["ph"],PDO::PARAM_INT);
            $statement ->bindValue(':conductividadelectrica',$parametro["conductividadelectrica"]==""?NULL:$parametro["conductividadelectrica"],PDO::PARAM_INT);
            $statement ->bindValue(':amonionh3',$parametro['amonionh3']==""?NULL:$parametro["amonionh3"],PDO::PARAM_INT);
            $statement ->bindValue(':amonionh4',$parametro['amonionh4']==""?NULL:$parametro["amonionh4"],PDO::PARAM_INT);
            $statement ->bindValue(':nitrito',$parametro['nitrito']==""?NULL:$parametro["nitrito"],PDO::PARAM_INT);
            $statement ->bindValue(':alcalinidad',$parametro['alcalinidad']==""?NULL:$parametro["alcalinidad"],PDO::PARAM_INT);
            $statement ->bindValue(':pecesmuertos',$parametro['pecesmuertos']==""?NULL:$parametro["pecesmuertos"],PDO::PARAM_INT);
            $statement ->bindValue(':descripcion',$parametro['descripcion'],PDO::PARAM_STR);
            $statement ->bindValue(':cultivoid',$parametro['cultivo'],PDO::PARAM_INT);
            $statement ->bindValue(':usuarioid',$this->usuario[0]['usuarioid'],PDO::PARAM_INT);
            $statement ->bindValue(':usuariopadreid',$this->usuario[0]['usuariopadreid'],PDO::PARAM_INT);
            
            $statement ->execute();
    
            
        }catch (PDOException  $Exception) {

            $result['estado']=false;
            $result['mensaje']= UserError::getInstance()->getError($Exception->getCode(),$Exception->getMessage());
        }
        finally{
           Conexion::cerrar($conn);
        }
 
         return $result;

    }

    public function eliminar($parametro)
    {

        $result=['estado'=>true,'mensaje'=>'Registro eliminado.','data'=>null];
        $conn=Conexion::getInstance()->cnn();

        try {

          $sqlCommand ='DELETE FROM estadofisicoquimico
                      WHERE estadofisicoquimicoid=:estadofisicoquimicoid' ;

          $statement  = $conn->prepare($sqlCommand);
          $statement ->bindValue(':estadofisicoquimicoid',$parametro["id"],PDO::PARAM_INT);
          $statement ->execute();
        
        }catch (PDOException  $Exception) {

           $result['estado']=false;
            $result['mensaje']= UserError::getInstance()->getError($Exception->getCode(),$Exception->getMessage());
        }
        finally{
          Conexion::cerrar($conn);
        }

        return $result;

    }

    public function actualizar($parametro)
    {

        $result=['estado'=>true,'mensaje'=>'Registro actualizado.','data'=>null];
        $conn=Conexion::getInstance()->cnn();

        try {
            
            $sqlCommand ='UPDATE  estadofisicoquimico SET
                fecharegistro=CAST(:fecharegistro AS DATE),
                horaregistro=CAST(:horaregistro AS TIME),
                temperaturaambiente=:temperaturaambiente,
                temperaturaestanque=:temperaturaestanque,
                oxigenodisuelto=:oxigenodisuelto,
                ph=:ph,
                conductividadelectrica=:conductividadelectrica,
                amonionh3=:amonionh3,
                amonionh4=:amonionh4,
                nitrito=:nitrito,
                alcalinidad=:alcalinidad,
                pecesmuertos=:pecesmuertos,
                descripcion=:descripcion,
                cultivoid=:cultivoid,
                usuarioactulizaid=:usuarioactulizaid,
                fechaactualiza=NOW()
                WHERE estadofisicoquimicoid=:estadofisicoquimicoid;';
    
            $statement  = $conn->prepare($sqlCommand);
            $statement ->bindValue(':fecharegistro',$parametro["fecharegistro"],PDO::PARAM_STR);
            $statement ->bindValue(':horaregistro',$parametro["horaregistro"],PDO::PARAM_STR);
            $statement ->bindValue(':temperaturaambiente',$parametro["temperaturaambiente"],PDO::PARAM_INT);
            $statement ->bindValue(':temperaturaestanque',$parametro['temperaturaestanque'],PDO::PARAM_INT);
            $statement ->bindValue(':oxigenodisuelto',$parametro["oxigenodisuelto"],PDO::PARAM_INT);
            $statement ->bindValue(':ph',$parametro["ph"],PDO::PARAM_INT);
            $statement ->bindValue(':conductividadelectrica',$parametro["conductividadelectrica"],PDO::PARAM_INT);
            $statement ->bindValue(':amonionh3',$parametro['amonionh3'],PDO::PARAM_INT);
            $statement ->bindValue(':amonionh4',$parametro['amonionh4'],PDO::PARAM_INT);
            $statement ->bindValue(':nitrito',$parametro['nitrito'],PDO::PARAM_INT);
            $statement ->bindValue(':alcalinidad',$parametro['alcalinidad'],PDO::PARAM_INT);
            $statement ->bindValue(':pecesmuertos',$parametro['pecesmuertos'],PDO::PARAM_INT);
            $statement ->bindValue(':descripcion',$parametro['descripcion'],PDO::PARAM_STR);
            $statement ->bindValue(':cultivoid',$parametro['cultivo'],PDO::PARAM_INT);
            $statement ->bindValue(':usuarioactulizaid',$this->usuario[0]['usuarioid'],PDO::PARAM_INT);
            $statement ->bindValue(':estadofisicoquimicoid',$parametro['id'],PDO::PARAM_INT);
            
            $statement ->execute();
    
            
        }catch (PDOException  $Exception) {

            $result['estado']=false;
             $result['mensaje']= UserError::getInstance()->getError($Exception->getCode(),$Exception->getMessage());
         }
         finally{
           Conexion::cerrar($conn);
         }
 
         return $result;

    }


    public function importar($parametro)
    {
        $result = true;
        $conn=Conexion::getInstance()->cnn();

        try {
            
            $objBase64=new Base64($parametro["token"]);
            
            $objUsuario=new Usuario();
            $resulUsuairio=$objUsuario->consultarUsuarioToken( $objBase64->decodeUsuario()["token"] );
    
            $obj=new Sonda();
            $value=$obj->prepararDato( $parametro['importarText'],$resulUsuairio[0]['usuarioid'] );

          echo  $sqlCommand = 'INSERT INTO estadofisicoquimico(
                fecharegistro,
                horaregistro,
                temperaturaambiente,
                temperaturaestanque,
                oxigenodisuelto,
                ph,
                conductividadelectrica,
                amonionh3,
                amonionh4,
                nitrito,
                alcalinidad,
                pecesmuertos,
                descripcion,
                cultivoid,
                usuarioid) VALUES '.$value;
        
                $statement  = $conn->prepare($sqlCommand);
                $statement ->execute();
                    

        } catch (Exception $e) {
            $result= ["data" => $e->getMessage() ];
        }
        finally{
            Conexion::cerrar($conn);
        }

      
        return $result;
    }



     public function prepararDato($importarText,$usuario)
     {
        $datos = explode('|',$importarText);
        $value="";
        
        for ($i = 0; $i < count($datos); $i++) 
        {
            $linea = explode(";", $datos[$i]);
            $text = "";
            $primera="";
            $one="";

            for ($j = 0; $j < count($linea); $j++) 
            {
                $text.= $primera."'".str_replace(",",".",$linea[$j])."'";
                if($primera=="")
                {
                    $primera=",";
                }
            }
             
            if($one=="")
            {
                $one=",";
            }
            if($i==count($datos)-1)
            {
                $one="";
            }

            $value.= "  (". $text.",". $usuario .")  ".$one;
        }

        return $value;
     }

    
}

?>
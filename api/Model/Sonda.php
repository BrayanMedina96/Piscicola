<?php

class Sonda
{
    public $usuario;

    public function consultar($parametro)
    {
       
        $conn=Conexion::getInstance()->cnn();

        

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
        $resultado= $statement->fetchAll();

        Conexion::cerrar($conn);

        return $resultado;
    }


    public function guardar($parametro)
    {
         
        $result="OK";
        $conn=Conexion::getInstance()->cnn();

        try 
        {
            
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
            $statement ->bindValue(':usuarioid',$this->usuario[0]['usuarioid'],PDO::PARAM_INT);
            $statement ->bindValue(':usuariopadreid',$this->usuario[0]['usuariopadreid'],PDO::PARAM_INT);
            
            $statement ->execute();
    
            
        } catch (PDOException  $Exception) {
            $result=$Exception->getMessage();
        }
        finally{
            Conexion::cerrar($conn);
        }
        
     return   $result;

    }

    public function eliminar($parametro)
    {

        $result="OK";
        $conn=Conexion::getInstance()->cnn();

        $sqlCommand ='UPDATE estadofisicoquimico
                      SET usuarioelimina=:usuarioidelimina,
                          fechaelimina=NOW()
                      WHERE estadofisicoquimicoid=:estadofisicoquimicoid' ;

        $statement  = $conn->prepare($sqlCommand);
        $statement ->bindValue(':usuarioidelimina',$this->usuario[0]['usuarioid'],PDO::PARAM_INT);
        $statement ->bindValue(':estadofisicoquimicoid',$parametro["id"],PDO::PARAM_INT);
        $statement ->execute();
        
        Conexion::cerrar($conn);

        return $result;

    }

    public function actualizar($parametro)
    {

        $result="OK";
        $conn=Conexion::getInstance()->cnn();

        try 
        {
            
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
    
            
        } catch (PDOException  $Exception) {
            $result=$Exception->getMessage();
        }
        finally{
            Conexion::cerrar($conn);
        }
        
     return   $result;

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

            $sqlCommand = 'INSERT INTO estadofisicoquimico(
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
                    




        } catch (\Throwable $th) {
            $result="Error";
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
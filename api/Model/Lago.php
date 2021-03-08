<?php

class Lago
{

    public $usuario;

    public function consultar($parametro)
    {
        
        $result=['estado'=>true,'mensaje'=>'','data'=>null];
        $conn=Conexion::getInstance()->cnn();

        try {

           $sqlCommand = 'SELECT lago.lagoid, lago.lagonombre, lago.lagodescripcion, lago.lagogeolocalizacion, lago.lagoarea,
           lago.lagoaltitud, lago.lagocantidadpeces, lago.lagoprofundidad, lago.lagofechacreacion,
           lago.lagofechaactualizacion, lago.lagofechaelimar, lago.usuariocrea, lago.usuarioactualiza,
           lago.usuarioelimina, lago.usuarioid, lago.importado,lago.tipolagoid,tipolago.tipolagonombre
           FROM lago 
           INNER JOIN tipolago ON lago.tipolagoid=tipolago.tipolagoid 
           WHERE lago.usuariopadreid=:usuarioid AND  lago.lagofechaelimar IS  NULL;';

           $statement  = $conn->prepare($sqlCommand); 
           $statement ->bindValue(':usuarioid',$this->usuario[0]['usuariopadreid'],PDO::PARAM_INT);
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

            
            $sqlCommand ='INSERT INTO lago(
            lagonombre, lagodescripcion, lagogeolocalizacion, lagoarea,
            lagoaltitud, lagocantidadpeces, lagoprofundidad, lagofechacreacion,
            usuariocrea,
            usuarioid,tipolagoid,usuariopadreid)
            VALUES ( :lagonombre, :lagodescripcion, :lagogeolocalizacion, :lagoarea,
            :lagoaltitud, :lagocantidadpeces, :lagoprofundidad, NOW(),
            :usuariocrea,
            :usuarioid,:tipolagoid,:usuariopadreid);';
    
            $statement  = $conn->prepare($sqlCommand);
            $statement ->bindValue(':lagonombre',$parametro["nombre"],PDO::PARAM_STR);
            $statement ->bindValue(':lagodescripcion',$parametro["descripcion"],PDO::PARAM_STR);
            $statement ->bindValue(':lagogeolocalizacion',$parametro["geolocalizacion"],PDO::PARAM_STR);
            $statement ->bindValue(':lagoarea',$parametro["area"],PDO::PARAM_STR);
            $statement ->bindValue(':lagoaltitud',$parametro["altitud"],PDO::PARAM_STR);
            $statement ->bindValue(':lagocantidadpeces',$parametro["catidadPeces"],PDO::PARAM_STR);
            $statement ->bindValue(':lagoprofundidad',$parametro["profundidad"],PDO::PARAM_STR);
            $statement ->bindValue(':tipolagoid',$parametro["tipolago"],PDO::PARAM_STR);
            $statement ->bindValue(':usuariocrea',$this->usuario[0]['usuarioid'],PDO::PARAM_INT);
            $statement ->bindValue(':usuarioid',$this->usuario[0]['usuarioid'],PDO::PARAM_INT);
            $statement ->bindValue(':usuariopadreid',$this->usuario[0]['usuariopadreid'],PDO::PARAM_INT);

            $statement ->execute();
    
            
        } catch (PDOException  $Exception) {
            $result['estado']=false;
            $result['mensaje']= UserError::getInstance()->getError($Exception->getCode(),$Exception->getMessage());
         }
        finally{
            Conexion::cerrar($conn);
        }
        
      return   $result;

    }

    public function eliminar($parametro)
    {

        $result=['estado'=>true,'mensaje'=>'Registro eliminado.','data'=>null];
        $conn=Conexion::getInstance()->cnn();

        try {

            $sqlCommand ='DELETE FROM lago
                      WHERE lagoid=:lagoid;';

            $statement  = $conn->prepare($sqlCommand);
            $statement ->bindValue(':lagoid',$parametro["id"],PDO::PARAM_INT);
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

            $sqlCommand =' UPDATE lago SET
            lagonombre=:lagonombre,
            lagodescripcion=:lagodescripcion,
            lagogeolocalizacion=:lagogeolocalizacion,
            lagoarea=:lagoarea, 
            lagoaltitud=:lagoaltitud,
            lagocantidadpeces=:lagocantidadpeces,
            lagoprofundidad=:lagoprofundidad,  
            lagofechaactualizacion=NOW(),
            usuarioactualiza=:usuarioactualiza,
            tipolagoid=:tipolagoid
            WHERE lagoid=:lagoid;';
    
                        
                 $statement  = $conn->prepare($sqlCommand);
                 $statement ->bindValue(':lagonombre',$parametro["nombre"],PDO::PARAM_STR);
                 $statement ->bindValue(':lagodescripcion',$parametro["descripcion"],PDO::PARAM_STR);
                 $statement ->bindValue(':lagogeolocalizacion',$parametro["geolocalizacion"],PDO::PARAM_STR);
                 $statement ->bindValue(':lagoarea',$parametro["area"],PDO::PARAM_STR);
                 $statement ->bindValue(':lagoaltitud',$parametro["altitud"],PDO::PARAM_STR);
                 $statement ->bindValue(':lagocantidadpeces',$parametro["catidadPeces"],PDO::PARAM_STR);
                 $statement ->bindValue(':lagoprofundidad',$parametro["profundidad"],PDO::PARAM_STR);
                 $statement ->bindValue(':tipolagoid',$parametro["tipolago"],PDO::PARAM_STR);
                 $statement ->bindValue(':usuarioactualiza',$this->usuario[0]['usuarioid'],PDO::PARAM_INT);
                 $statement ->bindValue(':lagoid',$parametro["id"],PDO::PARAM_INT);
                 
                 $statement ->execute();

         } catch (PDOException  $Exception) {
            $result['estado']=false;
            $result['mensaje']= UserError::getInstance()->getError($Exception->getCode(),$Exception->getMessage());
         }
         finally{
            Conexion::cerrar($conn);
         }

        return  $result;

    }

    public function importar($parametro)
    {
        $result = true;
        $conn=Conexion::getInstance()->cnn();

        $obj=new Lago();
        $value=$obj->prepararDato( $parametro['importarText'],$this->usuario[0]['usuarioid'],$this->usuario[0]['usuariopadreid'] );


        try {
            
             $sqlCommand = 'INSERT INTO lago(
                lagonombre,
                tipolagoid,
                lagodescripcion,
                lagoarea,
                lagoaltitud,
                lagocantidadpeces,
                lagoprofundidad,
                usuariocrea,
                importado,
                usuariopadreid)  VALUES '.$value;
    
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



     public function prepararDato($importarText,$usuario,$usuaioPadre)
     {
        $datos = explode('|',$importarText);
        $value="";
        
        for ($i = 0; $i < count($datos); $i++) 
        {
            $linea = explode(";", $datos[$i]);
            $text = "";
            $primera="";
            $one="";

            for ($j = 0; $j < count($linea)-1; $j++) 
            {

            
                $text.= $primera."'".str_replace(",",".",$linea[$j])."'";

                if($primera=="")
                {
                    $text.=",(SELECT tipolagoid FROM tipolago  WHERE tipolagonombre='".str_replace(",",".",$linea[6])."' AND (usuariopadreid=".$usuaioPadre." OR usuariopadreid IS NULL) )";
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

            $value.= "  (". $text.",". $usuario.",TRUE".",".$usuaioPadre.")".$one;
        }

        return $value;
     }


}

?>
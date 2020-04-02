<?php

class Lago
{

    public $usuario;

    public function consultar($parametro)
    {
        $objBase64 = new Base64($parametro["token"]);

        $objUsuario = new Usuario();
        $resulUsuairio = $objUsuario -> consultarUsuarioToken($objBase64 -> decodeUsuario()["token"]);

        $conn=Conexion::getInstance()->cnn();

        $sqlCommand = 'SELECT lagoid, lagonombre, lagodescripcion, lagogeolocalizacion, lagoarea,
        lagoaltitud, lagocantidadpeces, lagoprofundidad, lagofechacreacion,
        lagofechaactualizacion, lagofechaelimar, usuariocrea, usuarioactualiza,
        usuarioelimina, usuarioid, importado,tipolagoid
        FROM lago WHERE usuariopadreid=:usuarioid AND  lagofechaelimar IS  NULL;';

        $statement  = $conn->prepare($sqlCommand); 
        $statement ->bindValue(':usuarioid',$this->usuario[0]['usuariopadreid'],PDO::PARAM_INT);
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

        $sqlCommand ='UPDATE lago
        SET
        lagofechaelimar=NOW(),
        usuarioelimina=:usuarioelimina
        WHERE lagoid=:lagoid;';

        $statement  = $conn->prepare($sqlCommand);
        $statement ->bindValue(':usuarioelimina',$resulUsuairio[0]['usuarioid'],PDO::PARAM_INT);
        $statement ->bindValue(':lagoid',$parametro["id"],PDO::PARAM_INT);
        $statement ->execute();
        
        Conexion::cerrar($conn);

        return $result;

    }

    public function actualizar($parametro)
    {

        $result=true;
        $conn=Conexion::getInstance()->cnn();


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
            
             Conexion::cerrar($conn);

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
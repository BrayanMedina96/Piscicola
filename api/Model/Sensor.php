<?php

class Sensor
{

    public function consultar($parametro)
    {
        $objBase64 = new Base64($parametro["token"]);

        $objUsuario = new Usuario();
        $resulUsuairio = $objUsuario -> consultarUsuarioToken($objBase64 -> decodeUsuario()["token"]);

        $conn=Conexion::getInstance()->cnn();

        $sqlCommand = 'SELECT sensordescripcion, sensorcodigo, usuarioid, sensorfechamantenimiento,
        sensorperiodicidadmantenimiento, sensorfechacreacion, usuarioidcrea,
        sensorid, sensornombre, sensorestado, marcaid
        FROM sensor WHERE usuarioid=:usuarioid
        AND sensorfechaeliminacion IS NULL;';

        $statement  = $conn->prepare($sqlCommand); 
        $statement ->bindValue(':usuarioid',$resulUsuairio[0]['usuarioid'],PDO::PARAM_INT);
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
            $objBase64 = new Base64($parametro["token"]);

            $objUsuario = new Usuario();
            $resulUsuairio = $objUsuario -> consultarUsuarioToken($objBase64 -> decodeUsuario()["token"]);

            $sqlCommand ='INSERT INTO sensor(
                sensornombre,sensorcodigo,sensordescripcion, usuarioid, sensorestado, marcaid, 
                sensorfechamantenimiento, sensorperiodicidadmantenimiento, sensorfechacreacion, 
                usuarioidcrea)
                VALUES (:sensornombre,:sensorcodigo,:sensordescripcion, :usuarioid, :sensorestado, :sensormarca, 
                :sensorfechamantenimiento, :sensorperiodicidadmantenimiento,NOW(), 
                :usuarioidcrea);';
    
            $statement  = $conn->prepare($sqlCommand);
            $statement ->bindValue(':sensornombre',$parametro["nombre"],PDO::PARAM_STR);
            $statement ->bindValue(':sensorcodigo',$parametro["codigo"],PDO::PARAM_STR);
            $statement ->bindValue(':sensordescripcion',$parametro["descripcion"],PDO::PARAM_STR);
            $statement ->bindValue(':usuarioid',$resulUsuairio[0]['usuarioid'],PDO::PARAM_STR);
            $statement ->bindValue(':sensorestado',$parametro["estado"],PDO::PARAM_BOOL);
            $statement ->bindValue(':sensormarca',$parametro["marca"],PDO::PARAM_STR);
            $statement ->bindValue(':sensorfechamantenimiento',$parametro["fechaMantenimiento"],PDO::PARAM_STR);
            $statement ->bindValue(':sensorperiodicidadmantenimiento',$resulUsuairio[0]['usuarioid'],PDO::PARAM_INT);
            $statement ->bindValue(':usuarioidcrea',$resulUsuairio[0]['usuarioid'],PDO::PARAM_INT);
           
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


        $objBase64 = new Base64($parametro["token"]);

        $objUsuario = new Usuario();
        $resulUsuairio = $objUsuario -> consultarUsuarioToken($objBase64 -> decodeUsuario()["token"]);

        $sqlCommand ='UPDATE sensor
        SET
        sensorfechaeliminacion=NOW(),
        usuarioidelimina=:usuarioidelimina
        WHERE sensorid=:sensorid;';

        $statement  = $conn->prepare($sqlCommand);
        $statement ->bindValue(':usuarioidelimina',$resulUsuairio[0]['usuarioid'],PDO::PARAM_INT);
        $statement ->bindValue(':sensorid',$parametro["id"],PDO::PARAM_INT);
        $statement ->execute();
        
        Conexion::cerrar($conn);

        return $result;

    }

    public function actualizar($parametro)
    {

        $result=true;
        $conn=Conexion::getInstance()->cnn();

        $objBase64=new Base64($parametro["token"]);
            
        $objUsuario=new Usuario();
        $resulUsuairio=$objUsuario->consultarUsuarioToken( $objBase64->decodeUsuario()["token"] );

        $sqlCommand ='UPDATE sensor
        SET sensordescripcion=:sensordescripcion, sensorcodigo=:sensorcodigo, sensorfechamantenimiento=:sensorfechamantenimiento, 
            sensorperiodicidadmantenimiento=:sensorperiodicidadmantenimiento, 
             sensornombre=:sensornombre, sensorestado=:sensorestado, marcaid=:marcaid,  
             sensorfechaactualiza=NOW(),usuarioidactualiza=:usuarioidactualiza
      WHERE sensorid=:sensorid;';

                     

             $statement  = $conn->prepare($sqlCommand);
             $statement ->bindValue(':sensornombre',$parametro["nombre"],PDO::PARAM_STR);
             $statement ->bindValue(':sensordescripcion',$parametro["descripcion"],PDO::PARAM_STR);
             $statement ->bindValue(':sensorcodigo',$parametro["codigo"],PDO::PARAM_STR);
             $statement ->bindValue(':sensorfechamantenimiento',$parametro["fechaMantenimiento"],PDO::PARAM_STR);
             $statement ->bindValue(':sensorperiodicidadmantenimiento',$parametro["repetir"],PDO::PARAM_STR);
             $statement ->bindValue(':sensorestado',$parametro["estado"],PDO::PARAM_BOOL);
             $statement ->bindValue(':marcaid',$parametro["marca"],PDO::PARAM_STR);
             $statement ->bindValue(':usuarioidactualiza',$resulUsuairio[0]['usuarioid'],PDO::PARAM_INT);
             $statement ->bindValue(':sensorid',$parametro["id"],PDO::PARAM_INT);
             
            
             
             $statement ->execute();
            
             Conexion::cerrar($conn);

        return  $result;

    }


    



    




    



}

?>
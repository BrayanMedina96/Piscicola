<?php

class LagoSensor
{

    public function consultar($parametro)
    {
        $objBase64 = new Base64($parametro["token"]);

        $objUsuario = new Usuario();
        $resulUsuairio = $objUsuario -> consultarUsuarioToken($objBase64 -> decodeUsuario()["token"]);

        $conn=Conexion::getInstance()->cnn();
        $sqlCommand = 'SELECT lagosensor.lagosensorid, lagosensor.lagoid, lagosensor.sensorid, lagosensor.lagosensorfechainstalacion, lagosensor.usuarioidcrea, 
        lagosensor.fechacreacion, lagosensor.lagosensorestado, lagosensor.usuarioid, lago.lagonombre, sensor.sensornombre,
        cultivo.pezid,pez.especiepez,cultivo.fechainicio ,cultivo.fechafinalizacion
        FROM lagosensor
        INNER JOIN lago ON lagosensor.lagoid = lago.lagoid
        INNER JOIN sensor ON lagosensor.sensorid = sensor.sensorid 
        INNER JOIN cultivo ON lagosensor.lagosensorid=cultivo.lagosensorid
        INNER JOIN pez ON cultivo.pezid=pez.pezid
        WHERE lagosensor.usuarioid =:usuarioid AND lagosensor.fechaelimina IS NULL;
        ';

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

            $sqlCommand ='SELECT insertlagosensor(
                :lagoid,
                :sensorid,
                :lagosensorfechainstalacion,
                :lagosensorestado,
                :usuarioidcrea,
                :pezid,
                :fechainicio,
                :fechafinalizacion
            );;';
    
            $statement  = $conn->prepare($sqlCommand);
            $statement ->bindValue(':lagoid',$parametro["lago"],PDO::PARAM_INT);
            $statement ->bindValue(':sensorid',$parametro["sensor"],PDO::PARAM_INT);
            $statement ->bindValue(':lagosensorfechainstalacion',$parametro["instalacion"],PDO::PARAM_STR);
            $statement ->bindValue(':lagosensorestado',$parametro["estado"],PDO::PARAM_BOOL);
            $statement ->bindValue(':usuarioidcrea',$resulUsuairio[0]['usuarioid'],PDO::PARAM_INT);
            $statement ->bindValue(':pezid',$parametro["especie"],PDO::PARAM_INT);
            $statement ->bindValue(':fechainicio',$parametro["fechaInicio"],PDO::PARAM_STR);
            $statement ->bindValue(':fechafinalizacion',$parametro["fechaFinal"],PDO::PARAM_INT);
            
            $statement ->execute();
            $result= $statement->fetchAll();
    
            
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

        $sqlCommand ='UPDATE lagosensor 
        SET fechaelimina=CAST(NOW() AS DATE),
        usuarioelimina=:usuarioelimina 
        WHERE lagosensorid=:lagosensorid';

        $statement  = $conn->prepare($sqlCommand);
        $statement ->bindValue(':usuarioelimina',$resulUsuairio[0]['usuarioid'],PDO::PARAM_INT);
        $statement ->bindValue(':lagosensorid',$parametro["id"],PDO::PARAM_INT);
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

        $sqlCommand ='UPDATE lagosensor
        SET lagoid=:lagoid, sensorid=:sensorid, lagosensorfechainstalacion=:lagosensorfechainstalacion,
        lagosensorestado=:lagosensorestado,fechaactualiza=CAST(NOW() AS DATE),
        usuarioactualiza=:usuarioactualiza
        WHERE lagosensorid=:lagosensorid;';


             $statement  = $conn->prepare($sqlCommand);
             $statement ->bindValue(':lagosensorid',$parametro["id"],PDO::PARAM_STR);
             $statement ->bindValue(':lagoid',$parametro["lago"],PDO::PARAM_STR);
             $statement ->bindValue(':sensorid',$parametro["sensor"],PDO::PARAM_STR);
             $statement ->bindValue(':lagosensorfechainstalacion',$parametro["instalacion"],PDO::PARAM_STR);
             $statement ->bindValue(':lagosensorestado',$parametro["estado"],PDO::PARAM_STR);
             $statement ->bindValue(':usuarioactualiza',$resulUsuairio[0]['usuarioid'],PDO::PARAM_INT);
             $statement ->bindValue(':lagosensorid',$parametro["id"],PDO::PARAM_INT);
             
            
             
             $statement ->execute();
            
             Conexion::cerrar($conn);

        return  $result;

    }


}

?>
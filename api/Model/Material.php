<?php

class Material
{

    public function consultar($parametro)
    {
        $objBase64 = new Base64($parametro["token"]);

        $objUsuario = new Usuario();
        $resulUsuairio = $objUsuario -> consultarUsuarioToken($objBase64 -> decodeUsuario()["token"]);

        $conn=Conexion::getInstance()->cnn();

        $sqlCommand = 'SELECT tipolagoid, tipolagonombre, tipolagodescripcion, tipolagomaterial
                       FROM tipolago;';

        $statement  = $conn->prepare($sqlCommand); 
       // $statement ->bindValue(':usuarioid',$resulUsuairio[0]['usuarioid'],PDO::PARAM_INT);
        $statement->execute();              
        $resultado= $statement->fetchAll();

        Conexion::cerrar($conn);

        return $resultado;
    }

   

    public function guardar($parametro)
    {
         
        /*
        $result="OK";

        $conn=Conexion::getInstance()->cnn();

        try 
        {
            $objBase64 = new Base64($parametro["token"]);

            $objUsuario = new Usuario();
            $resulUsuairio = $objUsuario -> consultarUsuarioToken($objBase64 -> decodeUsuario()["token"]);

            $sqlCommand ='INSERT INTO dashboard(nombre, x, y,usuarioid,filtro,tipografica)
                                         VALUES (:nombre,:x,:y,:usuarioid,:filtro,:tipografica);';
    
            $statement  = $conn->prepare($sqlCommand);
            $statement ->bindValue(':nombre',$parametro["nombre"],PDO::PARAM_STR);
            $statement ->bindValue(':x',$parametro["x"],PDO::PARAM_STR);
            $statement ->bindValue(':y',$parametro["y"],PDO::PARAM_STR);
            $statement ->bindValue(':filtro',$parametro["filtro"],PDO::PARAM_STR);
            $statement ->bindValue(':tipografica',$parametro["tipografica"],PDO::PARAM_STR);
            $statement ->bindValue(':usuarioid',$resulUsuairio[0]['usuarioid'],PDO::PARAM_STR);   
            $statement ->execute();
    
            
        } catch (PDOException  $Exception) {
            $result=$Exception->getMessage();
        }
        finally{
            Conexion::cerrar($conn);
        }
        
        return   $result;*/

    }

    public function eliminar($parametro)
    {
/*
        $result="OK";
        $conn=Conexion::getInstance()->cnn();


        $objBase64 = new Base64($parametro["token"]);

        $objUsuario = new Usuario();
        $resulUsuairio = $objUsuario -> consultarUsuarioToken($objBase64 -> decodeUsuario()["token"]);

        $sqlCommand ='DELETE FROM dashboard WHERE dashboardid=:dashboardid';

        $statement  = $conn->prepare($sqlCommand);
        $statement ->bindValue(':dashboardid',$parametro["id"],PDO::PARAM_INT);
        $statement ->execute();
        
        Conexion::cerrar($conn);

        return $result;*/

    }

    public function actualizar($parametro)
    {

    //     $result=true;
    //     $conn=Conexion::getInstance()->cnn();

    //     $objBase64=new Base64($parametro["token"]);
            
    //     $objUsuario=new Usuario();
    //     $resulUsuairio=$objUsuario->consultarUsuarioToken( $objBase64->decodeUsuario()["token"] );

    //     $sqlCommand ='UPDATE sensor
    //     SET sensordescripcion=:sensordescripcion, sensorcodigo=:sensorcodigo, sensorfechamantenimiento=:sensorfechamantenimiento, 
    //         sensorperiodicidadmantenimiento=:sensorperiodicidadmantenimiento, 
    //          sensornombre=:sensornombre, sensorestado=:sensorestado, marcaid=:marcaid,  
    //          sensorfechaactualiza=NOW(),usuarioidactualiza=:usuarioidactualiza
    //   WHERE sensorid=:sensorid;';

                     

    //          $statement  = $conn->prepare($sqlCommand);
    //          $statement ->bindValue(':sensornombre',$parametro["nombre"],PDO::PARAM_STR);
    //          $statement ->bindValue(':sensordescripcion',$parametro["descripcion"],PDO::PARAM_STR);
    //          $statement ->bindValue(':sensorcodigo',$parametro["codigo"],PDO::PARAM_STR);
    //          $statement ->bindValue(':sensorfechamantenimiento',$parametro["fechaMantenimiento"],PDO::PARAM_STR);
    //          $statement ->bindValue(':sensorperiodicidadmantenimiento',$parametro["repetir"],PDO::PARAM_STR);
    //          $statement ->bindValue(':sensorestado',$parametro["estado"],PDO::PARAM_BOOL);
    //          $statement ->bindValue(':marcaid',$parametro["marca"],PDO::PARAM_STR);
    //          $statement ->bindValue(':usuarioidactualiza',$resulUsuairio[0]['usuarioid'],PDO::PARAM_INT);
    //          $statement ->bindValue(':sensorid',$parametro["id"],PDO::PARAM_INT);
             
            
             
    //          $statement ->execute();
            
    //          Conexion::cerrar($conn);

    //     return  $result;

    }

    
    

}

?>
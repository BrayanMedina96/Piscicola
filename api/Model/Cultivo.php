<?php

class Cultivo 
{
    public $usuario;

    public function consultar($parametro)
    {
        $result=['estado'=>true,'mensaje'=>'','data'=>null];

        $conn=Conexion::getInstance()->cnn();

        try {
            
             $sqlCommand = "SELECT cultivo.cultivoid, cultivo.pezid, cultivo.fechainicio, cultivo.fechafinalizacion, cultivo.usuarioidcrea, 
             cultivo.cantidadpezmuerto, cultivo.fechacreacion, cultivo.lagoid ,lago.lagonombre,pez.especiepez,
             CONCAT('Lago: ',lago.lagonombre,' - Pez: ',pez.especiepez) AS nombre,
             rango_sensor.id AS rango
             FROM cultivo
             INNER JOIN lago ON cultivo.lagoid=lago.lagoid
             INNER JOIN pez ON cultivo.pezid=pez.pezid
             LEFT JOIN rango_sensor ON lago.lagoid=rango_sensor.lago_id
             WHERE cultivo.usuariopadreid=:usuariopadreid AND cultivo.estado='TRUE' AND elimina IS  NULL;";

             $statement  = $conn->prepare($sqlCommand); 
             $statement ->bindValue(':usuariopadreid',$this->usuario[0]['usuariopadreid'],PDO::PARAM_INT);
             $statement->execute();              
             $result['data']= $statement->fetchAll();

        } catch (PDOException  $Exception) {
            $result['estado']=false;
            $result['mensaje']= UserError::getInstance()->getError($Exception->getCode(),$Exception->getMessage());

        }finally{
            Conexion::cerrar($conn);
        }


        return $result;

    }

    public function consultarSonda($parametro)
    {
        $result=['estado'=>true,'mensaje'=>'','data'=>null];
        $conn=Conexion::getInstance()->cnn();

        try {
            
            $sqlCommand = "SELECT cultivo.cultivoid,CONCAT(lago.lagonombre,' - ',pez.especiepez) AS nombre,max(fecharegistro) 
             FROM cultivo
             INNER JOIN lago ON cultivo.lagoid=lago.lagoid
             INNER JOIN pez ON cultivo.pezid=pez.pezid
             INNER JOIN estadofisicoquimico ON cultivo.cultivoid=estadofisicoquimico.cultivoid 
             WHERE cultivo.usuariopadreid=:usuariopadreid AND fechaelimina IS  NULL
             GROUP BY cultivo.cultivoid,lago.lagonombre,pez.especiepez;";

             $statement  = $conn->prepare($sqlCommand); 
             $statement ->bindValue(':usuariopadreid',$this->usuario[0]['usuariopadreid'],PDO::PARAM_INT);
             $statement->execute();              
             $result['data']= $statement->fetchAll();

        }catch (PDOException  $Exception) {
            $result['estado']=false;
            $result['mensaje']= UserError::getInstance()->getError($Exception->getCode(),$Exception->getMessage());

        }finally{
            Conexion::cerrar($conn);
        }

       
        return $result;

    }

    public function guardar($parametro)
    {
        $result=['estado'=>true,'mensaje'=>'Registro guardado.','data'=>null];

        $conn=Conexion::getInstance()->cnn();

        try {
            
            $sqlCommand = 'INSERT INTO cultivo(pezid, fechainicio, fechafinalizacion, usuarioidcrea,
                           fechacreacion, usuariopadreid, lagoid)
            VALUES (:pezid, :fechainicio ,:fechafinalizacion , :usuarioidcrea,
            CAST(NOW() AS DATE), :usuariopadreid, :lagoid);';

            $statement = $conn->prepare($sqlCommand);
            $statement ->bindValue(':pezid',$parametro['especie'],PDO::PARAM_INT);
            $statement ->bindValue(':fechainicio',$parametro['fechaInicio'],PDO::PARAM_STR);
            $statement ->bindValue(':fechafinalizacion',$parametro['fechaFinal'],PDO::PARAM_STR);
            $statement ->bindValue(':usuarioidcrea',$this->usuario[0]['usuarioid'],PDO::PARAM_INT);
            $statement ->bindValue(':usuariopadreid',$this->usuario[0]['usuariopadreid'],PDO::PARAM_INT);
            $statement ->bindValue(':lagoid',$parametro['lago'],PDO::PARAM_INT);

            $statement->execute();

          

        } catch (PDOException $Exception) {
            $result['estado']=false;
            $result['mensaje']= UserError::getInstance()->getError($Exception->getCode(),$Exception->getMessage());

        }finally{
            Conexion::cerrar($conn);
        }

        return   $result;
    }

    public function eliminar($parametro)
    {
        $result=['estado'=>true,'mensaje'=>'Registro eliminado.','data'=>null];

        $conn=Conexion::getInstance()->cnn();

        try {

           $sqlCommand = 'DELETE FROM cultivo
                          WHERE cultivoid=:cultivoid;';

           $statement = $conn->prepare($sqlCommand);
    
           $statement ->bindValue(':cultivoid',$parametro['id'],PDO::PARAM_INT);

           $statement->execute();

        }catch (PDOException $Exception) {
            $result['estado']=false;
            $result['mensaje']= UserError::getInstance()->getError($Exception->getCode(),$Exception->getMessage());

        }finally{
            Conexion::cerrar($conn);
        }

        return $result;
    }

    public function actualizar($parametro)
    {
        $result=['estado'=>true,'mensaje'=>'Registro actualizado.','data'=>null];

        $conn=Conexion::getInstance()->cnn();

        try {
            
            $sqlCommand = 'UPDATE cultivo
                           SET pezid=:pezid, fechainicio=:fechainicio, fechafinalizacion=:fechafinalizacion,
                           lagoid=:lagoid,usuarioactualiza=:usuarioactualiza
                           WHERE cultivoid=:cultivoid;';

            $statement = $conn->prepare($sqlCommand);
            $statement ->bindValue(':pezid',$parametro['especie'],PDO::PARAM_INT);
            $statement ->bindValue(':fechainicio',$parametro['fechaInicio'],PDO::PARAM_STR);
            $statement ->bindValue(':fechafinalizacion',$parametro['fechaFinal'],PDO::PARAM_STR);
            $statement ->bindValue(':usuarioactualiza',$this->usuario[0]['usuarioid'],PDO::PARAM_INT);
            $statement ->bindValue(':lagoid',$parametro['lago'],PDO::PARAM_INT);
            $statement ->bindValue(':cultivoid',$parametro['id'],PDO::PARAM_INT);

            $statement->execute();

          

        }catch (PDOException $Exception) {
            $result['estado']=false;
            $result['mensaje']= UserError::getInstance()->getError($Exception->getCode(),$Exception->getMessage());

        }finally{
            Conexion::cerrar($conn);
        }

    
        return   $result;
    }



}    


?>
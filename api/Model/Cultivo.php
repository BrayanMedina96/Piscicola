<?php

class Cultivo 
{
    public $usuario;

    public function consultar($parametro)
    {
       
        $conn=Conexion::getInstance()->cnn();

        $sqlCommand = "SELECT cultivo.cultivoid, cultivo.pezid, cultivo.fechainicio, cultivo.fechafinalizacion, cultivo.usuarioidcrea, 
                              cultivo.cantidadpezmuerto, cultivo.fechacreacion, cultivo.lagoid ,lago.lagonombre,pez.especiepez,
                              CONCAT(lago.lagonombre,' - ',pez.especiepez) AS nombre
                       FROM cultivo
                       INNER JOIN lago ON cultivo.lagoid=lago.lagoid
                       INNER JOIN pez ON cultivo.pezid=pez.pezid
                       WHERE cultivo.usuariopadreid=:usuariopadreid AND elimina IS  NULL;";

        $statement  = $conn->prepare($sqlCommand); 
        $statement ->bindValue(':usuariopadreid',$this->usuario[0]['usuariopadreid'],PDO::PARAM_INT);
        $statement->execute();              
        $resultado= $statement->fetchAll();

        Conexion::cerrar($conn);

        return $resultado;

    }

    public function guardar($parametro)
    {
        $result="OK";

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

          

        } catch (\PDOException $th) {
            $result= $th;
        }

        Conexion::cerrar($conn);

    
        return   $result;
    }

    public function eliminar($parametro)
    {
        $result="OK";

        $conn=Conexion::getInstance()->cnn();

        $sqlCommand = 'UPDATE cultivo
        SET elimina=CAST(NOW() AS DATE),
        usuarioactualiza=:usuarioactualiza
        WHERE cultivoid=:cultivoid;';

        $statement = $conn->prepare($sqlCommand);
        
        $statement ->bindValue(':usuarioactualiza',$this->usuario[0]['usuarioid'],PDO::PARAM_INT);
        $statement ->bindValue(':cultivoid',$parametro['id'],PDO::PARAM_INT);

        $statement->execute();

        Conexion::cerrar($conn);

        return $result;
    }

    public function actualizar($parametro)
    {
        $result="OK";

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

          

        } catch (\PDOException $th) {
            $result= $th;
        }

        Conexion::cerrar($conn);

    
        return   $result;
    }



}    


?>
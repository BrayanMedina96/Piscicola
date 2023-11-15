<?php

require "Model/UserError.php";
require "Model/Conexion.php";


class task_rango{

    public $usuario;

    public function consultar($parametro)
    {
        $result=['estado'=>true,'mensaje'=>'','data'=>null];

        $conn=Conexion::getInstance()->cnn();

        try {
            
             $sqlCommand = "SELECT cultivo.cultivoid, cultivo.pezid, cultivo.fechainicio, cultivo.fechafinalizacion, cultivo.usuarioidcrea, 
             cultivo.cantidadpezmuerto, cultivo.fechacreacion, cultivo.lagoid ,lago.lagonombre,pez.especiepez,
             CONCAT('Lago: ',lago.lagonombre,' - Pez: ',pez.especiepez) AS nombre
             FROM cultivo
             INNER JOIN lago ON cultivo.lagoid=lago.lagoid
             INNER JOIN pez ON cultivo.pezid=pez.pezid
             WHERE cultivo.usuariopadreid=:usuariopadreid AND elimina IS  NULL;";

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

}



?>
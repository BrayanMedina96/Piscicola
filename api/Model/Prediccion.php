<?php

class Prediccion 
{
    public $usuario;

    public function consultar($parametro)
    {
        $command = 'python C:\Users\Administrator\Desktop\ForecastingLibrary\integracion.py';
        $output = Shell_exec($command);
        $conn=Conexion::getInstance()->cnn();
        $dia=0;
        $contdor=0;
        $result=null;

        try {

            $fechaInicio=$this->validarFecha($parametro);

            if (count( $fechaInicio )>0) {
    
    
            } else {
    
                $fechaInicio=null;
    
                foreach(json_decode($output)->data as $value) {
    
                        $data = $value->data;
                        $contdor++;
    
                        $sqlCommand = "INSERT INTO prediccion(
                             fecha_inicio,fecha, hora, temperatura_ambiente, temperatura_estanque,
                             oxigeno, ph, conductividad_electrica, nh3, nh4, nitrito, alcalanidad,
                             lago_id)
                              VALUES ( now(),  CAST(now()::DATE + CAST('$dia days' AS INTERVAL) AS DATE),
                             :hora,:temperatura_ambiente,:temperatura_estanque,
                             :oxigeno,:ph,:conductividad_electrica,:nh3,:nh4,:nitrito,:alcalanidad,
                             :lago_id);";
    
                              $statement = $conn -> prepare($sqlCommand);
                              $statement -> bindValue(':hora', $data[0], PDO::PARAM_INT);
                              $statement -> bindValue(':temperatura_ambiente', $data[1], PDO::PARAM_INT);
                              $statement -> bindValue(':temperatura_estanque', $data[2], PDO::PARAM_INT);
                              $statement -> bindValue(':oxigeno', $data[3], PDO::PARAM_INT);
                              $statement -> bindValue(':ph', $data[4], PDO::PARAM_INT);
                              $statement -> bindValue(':conductividad_electrica', $data[5], PDO::PARAM_INT);
                              $statement -> bindValue(':nh3', $data[6], PDO::PARAM_INT);
                              $statement -> bindValue(':nh4', $data[7], PDO::PARAM_INT);
                              $statement -> bindValue(':nitrito', $data[8], PDO::PARAM_INT);
                              $statement -> bindValue(':alcalanidad', $data[9], PDO::PARAM_INT);
                              $statement -> bindValue(':lago_id', $parametro['lago_id'], PDO::PARAM_INT);
                              $statement -> execute();
    
                             if ($contdor == 2) {
                                $contdor = 0;
                               $dia++;
                            }
    
                }
    
            }
    
            if($fechaInicio==null)
            {
                $fechaInicio=$this->validarFecha($parametro);
            }
            
             $dataPrediccion=$this->getData($parametro, $fechaInicio[0]['fecha_inicio']);

             $result=["data"=> $dataPrediccion];

        } catch (PDOException  $Exception) {
            $result=$Exception->getMessage();
        }finally{
            Conexion::cerrar($conn);
        }
       

        return $result; // json_decode( $output)->data[0]->data;
        
    }

    public function validarFecha($parametro)
    {
        $conn=Conexion::getInstance()->cnn();
        $sqlCommand="SELECT fecha_inicio FROM prediccion WHERE fecha=CAST(NOW() AS DATE) AND lago_id=:lago_id";
        $statement  = $conn->prepare($sqlCommand);
        $statement ->bindValue(':lago_id',  $parametro['lago_id'] ,PDO::PARAM_INT);
        $statement->execute();   
        $resultado= $statement->fetchAll();

        Conexion::cerrar($conn);

        return $resultado;
    }

    public function getData($parametro,$fechaInicio)
    {
        /*(SELECT MAX(estadofisicoquimico.fecharegistro) FROM
        estadofisicoquimico
        INNER JOIN cultivo ON estadofisicoquimico.cultivoid=cultivo.cultivoid
        WHERE lagoid=:lago_id) */

        $conn=Conexion::getInstance()->cnn();
        $sqlCommand="SELECT hora, temperatura_ambiente, temperatura_estanque,
        oxigeno, ph, conductividad_electrica, nh3, nh4, nitrito, alcalanidad,
        lago_id,fecha FROM prediccion WHERE CAST(fecha_inicio AS DATE)=CAST(:fecha_inicio AS DATE) AND lago_id=:lago_id";
        $statement  = $conn->prepare($sqlCommand);
        $statement ->bindValue(':lago_id',  $parametro['lago_id'] ,PDO::PARAM_STR);
        $statement ->bindValue(':fecha_inicio', $fechaInicio ,PDO::PARAM_STR);
        $statement->execute();   
        $resultado= $statement->fetchAll();

        Conexion::cerrar($conn);

        return $resultado;
    }

}    


?>
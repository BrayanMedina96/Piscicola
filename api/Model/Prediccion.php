<?php

class Prediccion 
{
    public $usuario;

    public function consultar($parametro)
    {
        
        $conn=Conexion::getInstance()->cnn();

        try {
           
            $dataPrediccion=$this->getData($parametro);

            if (count( $dataPrediccion )>0) {
    
            } else {

                $command ='python C:\Users\Administrator\Desktop\ForecastingLibrary\integracion.py'; 
                //'python C:\Users\PCBRAYAN\Desktop\CORHUILA\ForecastingLibrary\integracion.py';
                $output = Shell_exec($command);
                $dia=0;
                $contdor=0;
                
                foreach(json_decode($output)->data as $value) {
    
                        $data = $value->data;
                        $contdor++;
    
                        $sqlCommand = "INSERT INTO prediccion(
                             fecha_inicio,fecha, hora, temperatura_ambiente, temperatura_estanque,
                             oxigeno, ph, conductividad_electrica, nh3, nh4, nitrito, alcalanidad,
                              cultivo_id)
                              VALUES ( :fecha_inicio,  CAST(:fecha_inicio ::DATE + CAST('$dia days' AS INTERVAL) AS DATE),
                             :hora,:temperatura_ambiente,:temperatura_estanque,
                             :oxigeno,:ph,:conductividad_electrica,:nh3,:nh4,:nitrito,:alcalanidad,
                             :cultivo_id);";
    
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
                              $statement -> bindValue(':cultivo_id', $parametro['cultivo_id'], PDO::PARAM_INT);
                              $statement -> bindValue(':fecha_inicio', $parametro['fecha'], PDO::PARAM_INT);

                              $statement -> execute();
    
                             if ($contdor == 2) {
                                $contdor = 0;
                                $dia++;
                            }
    
                }
    
                $dataPrediccion=$this->getData($parametro);
            }
    
             $result=["data"=> $dataPrediccion];

        } catch (PDOException  $Exception) {
            $result=$Exception->getMessage();
        }finally{
            Conexion::cerrar($conn);
        }
       
        return $result; // json_decode( $output)->data[0]->data;
        
    }

   /* public function validarFecha($parametro)
    {
        $conn=Conexion::getInstance()->cnn();
        $sqlCommand="SELECT fecha_inicio FROM prediccion WHERE fecha=CAST(NOW() AS DATE) AND lago_id=:lago_id";
        $statement  = $conn->prepare($sqlCommand);
        $statement ->bindValue(':lago_id',  $parametro['lago_id'] ,PDO::PARAM_INT);
        $statement->execute();   
        $resultado= $statement->fetchAll();

        Conexion::cerrar($conn);

        return $resultado;
    }*/

    public function getData($parametro)
    {
        
        $conn=Conexion::getInstance()->cnn();
        $sqlCommand="SELECT prediccion.hora, prediccion.temperatura_ambiente, prediccion.temperatura_estanque,
        prediccion.oxigeno, prediccion.ph, prediccion.conductividad_electrica, prediccion.nh3, prediccion.nh4, prediccion.nitrito, prediccion.alcalanidad, 
        prediccion.fecha_inicio,
        prediccion.cultivo_id, prediccion.fecha FROM prediccion 
        WHERE fecha_inicio = (SELECT fecha FROM prediccion WHERE fecha=CAST(:fecha_inicio AS DATE) limit 1) 
        AND cultivo_id=:cultivo_id";

        $statement  = $conn->prepare($sqlCommand);
        $statement ->bindValue(':cultivo_id',  $parametro['cultivo_id'] ,PDO::PARAM_STR);
        $statement ->bindValue(':fecha_inicio', $parametro['fecha']  ,PDO::PARAM_STR);
        $statement->execute();   
        $resultado= $statement->fetchAll();

        Conexion::cerrar($conn);

        return $resultado;
    }

}    


?>
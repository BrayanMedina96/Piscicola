<?php

require_once './Excel/PHPExcel.php';

class Prediccion 
{
    public $usuario;

    public function consultar($parametro,$resultado,$fechaInicio)
    {
        $result=['estado'=>true,'mensaje'=>'','data'=>null];

        try {

            $conn=Conexion::getInstance()->cnn();
            $dataPrediccion=$this->getData($parametro,$fechaInicio);

            if (count($dataPrediccion)>0) {

                $result['data']= $dataPrediccion;
            }
            else {


                if(count($resultado)==0 )
                {
                    $sqlCommand = "SELECT estadofisicoquimicoid, fecharegistro, oxigenodisuelto, ph, cultivoid, 
                                    horaregistro, temperaturaambiente, temperaturaestanque, conductividadelectrica, 
                                    amonionh3, amonionh4, nitrito, alcalinidad, descripcion, pecesmuertos, 
                                    usuarioid
                                    FROM estadofisicoquimico 
                                    WHERE lagoid=:lagoid
                                    ORDER BY fecharegistro DESC  limit 4;";

                    $statement  = $conn->prepare($sqlCommand); 
                    $statement ->bindValue(':lagoid',$parametro['lagoid'],PDO::PARAM_INT);
                    $statement->execute();              
                    $resultado = $statement->fetchAll();

                }

                if(count($resultado)==0)
                {
                    return $result; 
                }

                $id=random_int(0, 999);
                $index=0;
                 
                foreach ($resultado as $key) {

                    $index++;

                    $horaregistro=explode(":",$key['horaregistro'])[0] ;
                    $temperaturaambiente=$key['temperaturaambiente'];
                    $temperaturaestanque=$key['temperaturaestanque'];
                    $oxigenodisuelto=$key['oxigenodisuelto'];
                    $conductividadelectrica=$key['conductividadelectrica'];
                    $ph=$key['ph'];
                    $amonionh3=$key['amonionh3'];
                    $amonionh4= $key['amonionh4'];
                    $nitrito= $key['nitrito'];
                    $alcalinidad=$key['alcalinidad'];

                    $sqlCommand = "INSERT INTO temporal_data(
                        id, horaregistro, temperaturaambiente, temperaturaestanque, oxigenodisuelto, 
                        ph, conductividadelectrica, amonionh3, amonionh4, nitrito, alcalinidad)
                        VALUES ( :id, :horaregistro, :temperaturaambiente, :temperaturaestanque, :oxigenodisuelto, 
                         :ph, :conductividadelectrica, :amonionh3, :amonionh4, :nitrito, :alcalinidad);";

                    $statement  = $conn->prepare($sqlCommand); 
                    $statement ->bindValue(':id',$id,PDO::PARAM_INT);
                    $statement ->bindValue(':horaregistro',$horaregistro,PDO::PARAM_STR);
                    $statement ->bindValue(':temperaturaambiente',$temperaturaambiente,PDO::PARAM_INT);
                    $statement ->bindValue(':temperaturaestanque',$temperaturaestanque,PDO::PARAM_INT);
                    $statement ->bindValue(':oxigenodisuelto',$oxigenodisuelto,PDO::PARAM_INT);
                    $statement ->bindValue(':conductividadelectrica',$conductividadelectrica,PDO::PARAM_INT);
                    $statement ->bindValue(':ph',$ph,PDO::PARAM_INT);
                    $statement ->bindValue(':amonionh3',$amonionh3,PDO::PARAM_INT);
                    $statement ->bindValue(':amonionh4',$amonionh4,PDO::PARAM_INT);
                    $statement ->bindValue(':nitrito',$nitrito,PDO::PARAM_INT);
                    $statement ->bindValue(':alcalinidad',$alcalinidad,PDO::PARAM_INT);
                    $statement->execute();   

                }

                if($index<4)
                {
                   while ($index < 4) {

                       $index++;
                        // Agregar Informacion
                        $sqlCommand = "INSERT INTO temporal_data(
                            id, horaregistro, temperaturaambiente, temperaturaestanque, oxigenodisuelto, 
                            ph, conductividadelectrica, amonionh3, amonionh4, nitrito, alcalinidad)
                            VALUES ( :id, :horaregistro, :temperaturaambiente, :temperaturaestanque, :oxigenodisuelto, 
                             :ph, :conductividadelectrica, :amonionh3, :amonionh4, :nitrito, :alcalinidad);";
    
                        $statement  = $conn->prepare($sqlCommand); 
                        $statement ->bindValue(':id',$id,PDO::PARAM_INT);
                        $statement ->bindValue(':horaregistro',$horaregistro,PDO::PARAM_STR);
                        $statement ->bindValue(':temperaturaambiente',$temperaturaambiente,PDO::PARAM_INT);
                        $statement ->bindValue(':temperaturaestanque',$temperaturaestanque,PDO::PARAM_INT);
                        $statement ->bindValue(':oxigenodisuelto',$oxigenodisuelto,PDO::PARAM_INT);
                        $statement ->bindValue(':conductividadelectrica',$conductividadelectrica,PDO::PARAM_INT);
                        $statement ->bindValue(':ph',$ph,PDO::PARAM_INT);
                        $statement ->bindValue(':amonionh3',$amonionh3,PDO::PARAM_INT);
                        $statement ->bindValue(':amonionh4',$amonionh4,PDO::PARAM_INT);
                        $statement ->bindValue(':nitrito',$nitrito,PDO::PARAM_INT);
                        $statement ->bindValue(':alcalinidad',$alcalinidad,PDO::PARAM_INT);
                        $statement->execute();  

                   }
                }
        
            
                $command = 'py C:\laragon\www\Piscicola\ForecastingLibrary\integracion.py'; 
                $output = Shell_exec($command);
                $dia=0;
                $contdor=0;

                foreach(json_decode($output)->data as $value) {
    
                    $data = $value->data;
                    $contdor++;

                    $sqlCommand = "INSERT INTO prediccion(
                         fecha_inicio,fecha, hora, temperatura_ambiente, temperatura_estanque,
                         oxigeno, ph, conductividad_electrica, nh3, nh4, nitrito, alcalinidad,
                          cultivo_id,lagoid)
                          VALUES ( :fecha_inicio,  CAST(:fecha_inicio::DATE + CAST('$dia days' AS INTERVAL) AS DATE),
                         :hora,:temperatura_ambiente,:temperatura_estanque,
                         :oxigeno,:ph,:conductividad_electrica,:nh3,:nh4,:nitrito,:alcalinidad,
                         :cultivo_id,:lagoid);";

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
                          $statement -> bindValue(':alcalinidad', $data[9], PDO::PARAM_INT);
                          $statement -> bindValue(':cultivo_id', 0, PDO::PARAM_INT);//$parametro['cultivo_id']
                          $statement -> bindValue(':fecha_inicio',$fechaInicio, PDO::PARAM_STR);
                          $statement -> bindValue(':lagoid', $parametro['lagoid'], PDO::PARAM_INT);

                          $statement -> execute();

                         if ($contdor == 2) {
                            $contdor = 0;
                            $dia++;
                        }

                }


               // $sqlCommand = "DELETE FROM temporal_data WHERE id=:id;";
                $statement = $conn -> prepare($sqlCommand);
                $statement -> bindValue(':id',$id, PDO::PARAM_INT);
                $statement -> execute();

                $result['data']=$this->getData($parametro,$fechaInicio);// json_decode($output)->data ;// $this->getData($parametro);
                
            }


        }catch (PDOException  $Exception) {
            $result['estado']=false;
            $result['mensaje']= UserError::getInstance()->getError($Exception->getCode(),$Exception->getMessage()).' - '.$parametro['fechaInicio'];
         }
         finally{
            Conexion::cerrar($conn);
         }


        return $result; 
        
    }

   
    public function getData($parametro,$fechaInicio)
    {
        
        $conn=Conexion::getInstance()->cnn();
        $sqlCommand="SELECT prediccion.hora, prediccion.temperatura_ambiente AS temperaturaambiente , prediccion.temperatura_estanque AS temperaturaestanque ,
        prediccion.oxigeno AS oxigenodisuelto, prediccion.ph,
         prediccion.conductividad_electrica AS conductividadelectrica ,
          prediccion.nh3 AS amonionh3 ,
           prediccion.nh4 AS amonionh4 , prediccion.nitrito,
            prediccion.alcalinidad , 
        prediccion.fecha_inicio,
        prediccion.cultivo_id, 
        prediccion.fecha AS fecharegistro,
        prediccion.lagoid
        FROM prediccion 
        WHERE fecha_inicio = (SELECT fecha FROM prediccion WHERE fecha=CAST(:fecha_inicio AS DATE) limit 1) 
        AND lagoid=:lagoid";

        $statement  = $conn->prepare($sqlCommand);
        $statement ->bindValue(':lagoid',  $parametro['lagoid'] ,PDO::PARAM_STR);
        $statement ->bindValue(':fecha_inicio', $fechaInicio ,PDO::PARAM_STR);
        $statement->execute();   
        $resultado= $statement->fetchAll();

        Conexion::cerrar($conn);

        return $resultado;
    }

}    


?>
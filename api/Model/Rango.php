<?php

class Rango
{
    public $usuario;


    public function getRecomendado()
    {
        $result=['estado'=>true,'mensaje'=>'','data'=>null];
        $conn=Conexion::getInstance()->cnn();

        try {
            
            $sqlCommand ="SELECT  id, temperaturaambiente_max, temperaturaestanque_max, oxigeno_max, 
            ph_max, conductividad_max, amonionh3_max, amonionh4_max, nitrito_max, 
            alcalinidad_max, temperaturaambiente_min, temperaturaestanque_min, 
            oxigeno_min, ph_min, conductividad_min, amonionh3_min, amonionh4_min, 
            nitrito_min, alcalinidad_min, estado
            FROM rango_plantilla WHERE estado=TRUE LIMIT 1;";

            $statement  = $conn->prepare($sqlCommand); 

            $statement->execute();              
            $resultado= $statement->fetchAll();

        } catch (PDOException  $Exception) {
            $result['estado']=false;
            $result['mensaje']= UserError::getInstance()->getError($Exception->getCode(),$Exception->getMessage());
        }finally{
            Conexion::cerrar($conn);
        }

        return $resultado;
    }

    public function getRangoSensor()
    {
        $result=['estado'=>true,'mensaje'=>'','data'=>null];
        $conn=Conexion::getInstance()->cnn();

        try {
            
            $sqlCommand ="SELECT rango_sensor.id, sensor.sensornombre , rango.temperaturaambiente_max, rango.temperaturaestanque_max, rango.oxigeno_max, 
            rango.ph_max, rango.conductividad_max, rango.amonionh3_max, rango.amonionh4_max, rango.nitrito_max, 
            rango.alcalinidad_max, rango.temperaturaambiente_min, rango.temperaturaestanque_min, 
            rango.oxigeno_min, rango.ph_min, rango.conductividad_min, rango.amonionh3_min, rango.amonionh4_min, 
            rango.nitrito_min, rango.alcalinidad_min, rango.descripcion FROM rango_sensor
            INNER JOIN  rango ON  rango_sensor.rango_id=rango.id
            INNER JOIN  sensor ON  rango_sensor.sonda_id= sensor.sensorid
            WHERE rango_sensor.usuariopadreid=:usuariopadreid";


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


    public function consultar($parametro)
    {
       
        $result=['estado'=>true,'mensaje'=>'','data'=>null];

        $conn=Conexion::getInstance()->cnn();

        try {

             $sqlCommand = "SELECT id, temperaturaambiente_max, temperaturaestanque_max, oxigeno_max, 
             ph_max, conductividad_max, amonionh3_max, amonionh4_max, nitrito_max, 
             alcalinidad_max, temperaturaambiente_min, temperaturaestanque_min, 
             oxigeno_min, ph_min, conductividad_min, amonionh3_min, amonionh4_min, 
             nitrito_min, alcalinidad_min, usuariopadreid, descripcion
             FROM rango WHERE usuariopadreid=:usuariopadreid;";

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

    public function guardar($parametro)
    {
         
        $result=['estado'=>true,'mensaje'=>'Registro guardado','data'=>null];

        $conn=Conexion::getInstance()->cnn();

        try 
        {
            
            $sqlCommand ='INSERT INTO rango(
                temperaturaambiente_max, temperaturaestanque_max, oxigeno_max, 
                ph_max, conductividad_max, amonionh3_max, amonionh4_max, nitrito_max, 
                alcalinidad_max,temperaturaambiente_min, temperaturaestanque_min, 
                oxigeno_min, ph_min, conductividad_min, amonionh3_min, amonionh4_min, 
                nitrito_min, alcalinidad_min, usuariopadreid,descripcion)
             VALUES (:temperaturaambiente_max,:temperaturaestanque_max,:oxigeno_max, 
                :ph_max,:conductividad_max,:amonionh3_max,:amonionh4_max,:nitrito_max,:alcalinidad_max, 
                :temperaturaambiente_min,:temperaturaestanque_min,:oxigeno_min, 
                :ph_min,:conductividad_min,:amonionh3_min,:amonionh4_min,:nitrito_min,:alcalinidad_min,
                :usuariopadreid,:descripcion 
                );';
    
            $statement  = $conn->prepare($sqlCommand);

            $statement ->bindValue(':temperaturaambiente_max',$parametro["temperaturaambiente_max"]==""?NULL:$parametro["temperaturaambiente_max"],PDO::PARAM_STR);
            $statement ->bindValue(':temperaturaestanque_max',$parametro["temperaturaestanque_max"]==""?NULL:$parametro["temperaturaestanque_max"],PDO::PARAM_STR);
            $statement ->bindValue(':oxigeno_max',$parametro["oxigeno_max"]==""?NULL:$parametro["oxigeno_max"],PDO::PARAM_INT);
            $statement ->bindValue(':ph_max',$parametro['ph_max']==""?NULL:$parametro['ph_max'],PDO::PARAM_INT);
            $statement ->bindValue(':conductividad_max',$parametro["conductividad_max"]==""?NULL:$parametro["conductividad_max"],PDO::PARAM_INT);
            $statement ->bindValue(':amonionh3_max',$parametro["amonionh3_max"]==""?NULL:$parametro["amonionh3_max"],PDO::PARAM_INT);
            $statement ->bindValue(':amonionh4_max',$parametro["amonionh4_max"]==""?NULL:$parametro["amonionh4_max"],PDO::PARAM_INT);
            $statement ->bindValue(':nitrito_max',$parametro['nitrito_max']==""?NULL:$parametro['nitrito_max'],PDO::PARAM_INT);
            $statement ->bindValue(':alcalinidad_max',$parametro['alcalinidad_max']==""?NULL:$parametro['alcalinidad_max'],PDO::PARAM_INT);

            $statement ->bindValue(':temperaturaambiente_min',$parametro["temperaturaambiente_min"]==""?NULL:$parametro["temperaturaambiente_min"],PDO::PARAM_STR);
            $statement ->bindValue(':temperaturaestanque_min',$parametro["temperaturaestanque_min"]==""?NULL:$parametro["temperaturaestanque_min"],PDO::PARAM_STR);
            $statement ->bindValue(':oxigeno_min',$parametro["oxigeno_min"]==""?NULL:$parametro["oxigeno_min"],PDO::PARAM_INT);
            $statement ->bindValue(':ph_min',$parametro['ph_min']==""?NULL:$parametro['ph_min'],PDO::PARAM_INT);
            $statement ->bindValue(':conductividad_min',$parametro["conductividad_min"]==NULL?NULL:$parametro["conductividad_min"],PDO::PARAM_INT);
            $statement ->bindValue(':amonionh3_min',$parametro["amonionh3_min"]==""?NULL:$parametro["amonionh3_min"],PDO::PARAM_INT);
            $statement ->bindValue(':amonionh4_min',$parametro["amonionh4_min"]==""?NULL:$parametro["amonionh4_min"],PDO::PARAM_INT);
            $statement ->bindValue(':nitrito_min',$parametro['nitrito_min']==""?NULL:$parametro['nitrito_min'],PDO::PARAM_INT);
            $statement ->bindValue(':alcalinidad_min',$parametro['alcalinidad_min']==""?NULL:$parametro['alcalinidad_min'],PDO::PARAM_INT);

         
            $statement ->bindValue(':descripcion',$parametro['descripcion'],PDO::PARAM_INT);
            $statement ->bindValue(':usuariopadreid',$this->usuario[0]['usuariopadreid'],PDO::PARAM_INT);
            
            $statement ->execute();
    
            
        } catch (PDOException  $Exception) {
            $result['estado']=false;
            $result['mensaje']= UserError::getInstance()->getError($Exception->getCode(),$Exception->getMessage());
        }
        finally{
            Conexion::cerrar($conn);
        }
        
       return   $result;

    }

    public function rangoSensor($parametro)
    {
        $result=['estado'=>true,'mensaje'=>'Registro guardado','data'=>null];

        $conn=Conexion::getInstance()->cnn();

        try 
        {
            
            $sqlCommand ='INSERT INTO rango_sensor(
                          rango_id, sonda_id, fecha, usuario_id,usuariopadreid)
                         VALUES (:rango_id,:sonda_id,NOW(),:usuario_id,:usuariopadreid);';
    
            $statement  = $conn->prepare($sqlCommand);

            $statement ->bindValue(':rango_id',$parametro["rangoID"],PDO::PARAM_INT);
            $statement ->bindValue(':sonda_id',$parametro["sondaID"],PDO::PARAM_STR);
            
            $statement ->bindValue(':usuario_id',$this->usuario[0]['usuarioid'],PDO::PARAM_INT);
            $statement ->bindValue(':usuariopadreid',$this->usuario[0]['usuariopadreid'],PDO::PARAM_INT);
            
            $statement ->execute();
    
            
        } catch (PDOException  $Exception) {

            $result['estado']=false;
            $result['mensaje']= UserError::getInstance()->getError($Exception->getCode(),$Exception->getMessage());
            
        }catch(Exception $Exception)
        {
            $result['estado']=false;
            $result['mensaje']= UserError::getInstance()->getError($Exception->getCode(),$Exception->getMessage());
            
        }
        finally{
            Conexion::cerrar($conn);
        }
        
       return   $result;
    }

    public function eliminar($parametro)
    {

        $result=['estado'=>true,'mensaje'=>'Registro eliminado.','data'=>null];
        $conn=Conexion::getInstance()->cnn();

        try {
            
            $sqlCommand="DELETE FROM rango WHERE id=:id";
            $statement  = $conn->prepare($sqlCommand);
            $statement ->bindValue(':id',$parametro["id"],PDO::PARAM_INT);
            $statement ->execute();

        }catch (PDOException  $Exception) {
            $result['estado']=false;
            $result['mensaje']= UserError::getInstance()->getError($Exception->getCode(),$Exception->getMessage());
        }
        finally{
            Conexion::cerrar($conn);
        }

        return $result;

    }

    public function eliminarSondaRango($parametro)
    {

        $result=['estado'=>true,'mensaje'=>'Registro eliminado.','data'=>null];
        $conn=Conexion::getInstance()->cnn();

        try {
            
            $sqlCommand="DELETE FROM rango_sensor WHERE id=:id";
            $statement  = $conn->prepare($sqlCommand);
            $statement ->bindValue(':id',$parametro["id"],PDO::PARAM_INT);
            $statement ->execute();

        }catch (PDOException  $Exception) {
            $result['estado']=false;
            $result['mensaje']= UserError::getInstance()->getError($Exception->getCode(),$Exception->getMessage());
        }
        finally{
            Conexion::cerrar($conn);
        }

        return $result;

    }


    

    public function actualizar($parametro)
    {

        $result=['estado'=>true,'mensaje'=>'Registro actualizado.','data'=>null];

        $conn=Conexion::getInstance()->cnn();

        try 
        {
            
            $sqlCommand ='UPDATE rango
                SET temperaturaambiente_max=:temperaturaambiente_max,
                    temperaturaestanque_max=:temperaturaestanque_max,
                    oxigeno_max=:oxigeno_max, 
                    ph_max=:ph_max,
                    conductividad_max=:conductividad_max,
                    amonionh3_max=:amonionh3_max,
                    amonionh4_max=:amonionh4_max, 
                    nitrito_max=:nitrito_max,
                    alcalinidad_max=:alcalinidad_max,
                    temperaturaambiente_min=:temperaturaambiente_min, 
                    temperaturaestanque_min=:temperaturaestanque_min,
                    oxigeno_min=:oxigeno_min,
                    ph_min=:ph_min,
                    conductividad_min=:conductividad_min, 
                    amonionh3_min=:amonionh3_min,
                    amonionh4_min=:amonionh4_min,
                    nitrito_min=:nitrito_min,
                    alcalinidad_min=:alcalinidad_min, 
                    descripcion=:descripcion
                    WHERE id=:id;';
    
            $statement  = $conn->prepare($sqlCommand);
            
            $statement ->bindValue(':temperaturaambiente_max',$parametro["temperaturaambiente_max"]==""?NULL:$parametro["temperaturaambiente_max"],PDO::PARAM_STR);
            $statement ->bindValue(':temperaturaestanque_max',$parametro["temperaturaestanque_max"]==""?NULL:$parametro["temperaturaestanque_max"],PDO::PARAM_STR);
            $statement ->bindValue(':oxigeno_max',$parametro["oxigeno_max"]==""?NULL:$parametro["oxigeno_max"],PDO::PARAM_INT);
            $statement ->bindValue(':ph_max',$parametro['ph_max']==""?NULL:$parametro['ph_max'],PDO::PARAM_INT);
            $statement ->bindValue(':conductividad_max',$parametro["conductividad_max"]==""?NULL:$parametro["conductividad_max"],PDO::PARAM_INT);
            $statement ->bindValue(':amonionh3_max',$parametro["amonionh3_max"]==""?NULL:$parametro["amonionh3_max"],PDO::PARAM_INT);
            $statement ->bindValue(':amonionh4_max',$parametro["amonionh4_max"]==""?NULL:$parametro["amonionh4_max"],PDO::PARAM_INT);
            $statement ->bindValue(':nitrito_max',$parametro['nitrito_max']==""?NULL:$parametro['nitrito_max'],PDO::PARAM_INT);
            $statement ->bindValue(':alcalinidad_max',$parametro['alcalinidad_max']==""?NULL:$parametro['alcalinidad_max'],PDO::PARAM_INT);

            $statement ->bindValue(':temperaturaambiente_min',$parametro["temperaturaambiente_min"]==""?NULL:$parametro["temperaturaambiente_min"],PDO::PARAM_STR);
            $statement ->bindValue(':temperaturaestanque_min',$parametro["temperaturaestanque_min"]==""?NULL:$parametro["temperaturaestanque_min"],PDO::PARAM_STR);
            $statement ->bindValue(':oxigeno_min',$parametro["oxigeno_min"]==""?NULL:$parametro["oxigeno_min"],PDO::PARAM_INT);
            $statement ->bindValue(':ph_min',$parametro['ph_min']==""?NULL:$parametro['ph_min'],PDO::PARAM_INT);
            $statement ->bindValue(':conductividad_min',$parametro["conductividad_min"]==NULL?NULL:$parametro["conductividad_min"],PDO::PARAM_INT);
            $statement ->bindValue(':amonionh3_min',$parametro["amonionh3_min"]==""?NULL:$parametro["amonionh3_min"],PDO::PARAM_INT);
            $statement ->bindValue(':amonionh4_min',$parametro["amonionh4_min"]==""?NULL:$parametro["amonionh4_min"],PDO::PARAM_INT);
            $statement ->bindValue(':nitrito_min',$parametro['nitrito_min']==""?NULL:$parametro['nitrito_min'],PDO::PARAM_INT);
            $statement ->bindValue(':alcalinidad_min',$parametro['alcalinidad_min']==""?NULL:$parametro['alcalinidad_min'],PDO::PARAM_INT);


         
            $statement ->bindValue(':descripcion',$parametro['descripcion'],PDO::PARAM_INT);
            $statement ->bindValue(':id',$parametro['id'],PDO::PARAM_INT);

            $statement ->execute();
    
            
        } catch (PDOException  $Exception) {
            $result['estado']=false;
            $result['mensaje']= UserError::getInstance()->getError($Exception->getCode(),$Exception->getMessage());
        }
        finally{
            Conexion::cerrar($conn);
        }
        
       return   $result;

    }


    
}

?>
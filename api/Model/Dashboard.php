<?php

class Dashboard
{
     
    public $usuario;

    public function consultar($parametro)
    {
        $conn=Conexion::getInstance()->cnn();

        $sqlCommand = 'SELECT dashboardid, nombre, x, y, usuarioid,filtro,tipografica
                       FROM dashboard WHERE usuariopadreid=:usuariopadreid;';

        $statement  = $conn->prepare($sqlCommand); 
        $statement ->bindValue(':usuariopadreid', $this->usuario[0]['usuariopadreid'] ,PDO::PARAM_INT);
        $statement->execute();              
        $resultado= $statement->fetchAll();

        Conexion::cerrar($conn);

        return $resultado;
    }

    public function consultarSonda($parametro)
    {
        $result=['estado'=>true,'mensaje'=>'','data'=>null,'prediccion'=>null];

        $fechaInicio=$parametro["fechaInicio"];
        $fechaFinal=$parametro["fechaFinal"];

        if($fechaInicio=="")
        {

           $fechaInicio=$this->primerDiaMes();
           $fechaFinal=$this->ultimoDiaMes();
           
        }

        $conn=Conexion::getInstance()->cnn();

        $sqlCommand = "SELECT estadofisicoquimicoid, fecharegistro, oxigenodisuelto, ph, cultivoid, 
        horaregistro, temperaturaambiente, temperaturaestanque, conductividadelectrica, 
        amonionh3, amonionh4, nitrito, alcalinidad, descripcion, pecesmuertos, 
        usuarioid
        FROM estadofisicoquimico 
        WHERE lagoid=:lagoid
        AND  fecharegistro BETWEEN :fechaInicio AND :fechaFinal  
        ORDER BY fecharegistro ASC;";


        $statement  = $conn->prepare($sqlCommand); 
        $statement ->bindValue(':lagoid',$parametro['lagoid'],PDO::PARAM_INT);
        $statement ->bindValue(':fechaInicio',$fechaInicio,PDO::PARAM_STR);
        $statement ->bindValue(':fechaFinal',$fechaFinal,PDO::PARAM_STR);

        $statement->execute();              
        $result['data']= $statement->fetchAll();

        $objPrediccion=new Prediccion();
        $result['prediccion']= $objPrediccion->consultar($parametro, $result['data'],$fechaInicio)['data'];
        
        Conexion::cerrar($conn);

        return  $result;


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

            $sqlCommand ='INSERT INTO dashboard(nombre, x, y,usuarioid,filtro,tipografica,usuariopadreid)
                                         VALUES (:nombre,:x,:y,:usuarioid,:filtro,:tipografica,:usuariopadreid);';
    
            $statement  = $conn->prepare($sqlCommand);
            $statement ->bindValue(':nombre',$parametro["nombre"],PDO::PARAM_STR);
            $statement ->bindValue(':x',$parametro["x"],PDO::PARAM_STR);
            $statement ->bindValue(':y',$parametro["y"],PDO::PARAM_STR);
            $statement ->bindValue(':filtro',$parametro["filtro"],PDO::PARAM_STR);
            $statement ->bindValue(':tipografica',$parametro["tipografica"],PDO::PARAM_STR);
            $statement ->bindValue(':usuarioid',$this->usuario[0]['usuarioid'],PDO::PARAM_STR);  
            $statement ->bindValue(':usuariopadreid',$this->usuario[0]['usuariopadreid'],PDO::PARAM_STR); 
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

        $sqlCommand ='DELETE FROM dashboard WHERE dashboardid=:dashboardid';

        $statement  = $conn->prepare($sqlCommand);
        $statement ->bindValue(':dashboardid',$parametro["id"],PDO::PARAM_INT);
        $statement ->execute();
        
        Conexion::cerrar($conn);

        return $result;

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

    public function variable($parametro)
    {
        $objBase64 = new Base64($parametro["token"]);

        $objUsuario = new Usuario();
        $resulUsuairio = $objUsuario -> consultarUsuarioToken($objBase64 -> decodeUsuario()["token"]);

        $conn=Conexion::getInstance()->cnn();

        $sqlCommand = 'SELECT nombre, campotabla, tabla, estado, campograficaid
                       FROM campografica WHERE estado=TRUE;';

        $statement  = $conn->prepare($sqlCommand); 
        $statement->execute();              
        $resultado= $statement->fetchAll();

        Conexion::cerrar($conn);

        return $resultado;
    }

    

      
      static function  ultimoDiaMes() 
      {
         $month = date('m');
         $year = date('Y');
         $day = date("d", mktime(0,0,0, $month+1, 0, $year));

         return date('Y-m-d', mktime(0,0,0, $month, $day, $year));
      }

      
      static function  primerDiaMes() 
      {
          $month = date('m');
          $year = date('Y');

          return date('Y-m-d', mktime(0,0,0, $month, 1, $year));
      }


}

?>
<?php

class Seguridad
{

    public function consultar($parametro)
    {
        $objBase64 = new Base64($parametro["token"]);

        $objUsuario = new Usuario();
        $resulUsuairio = $objUsuario -> consultarUsuarioToken($objBase64 -> decodeUsuario()["token"]);

        $conn=Conexion::getInstance()->cnn();

        $sqlCommand = 'SELECT restriccionperfil.restriccionid,restriccionperfil.campo,restriccionperfil.formulario,restriccionperfil.perfilid,restriccionperfil.accion,restriccionperfil.usuariocrea,formulario.formularionombre,
        perfil.perfilnombre ,accion.acciondescripcion
        FROM  restriccionperfil 
        INNER JOIN formulario ON restriccionperfil.formulario=formulario.formularioid
        INNER JOIN perfil ON restriccionperfil.perfilid=perfil.perfilid
        INNER JOIN accion ON restriccionperfil.accion=accion.accionid
        WHERE restriccionperfil.usuariocrea=:usuariocrea';

        $statement  = $conn->prepare($sqlCommand); 
        $statement ->bindValue(':usuariocrea',$resulUsuairio[0]['usuarioid'],PDO::PARAM_INT);
        $statement->execute();              
        $resultado= $statement->fetchAll();

        Conexion::cerrar($conn);

        return $resultado;



    }

    public function getPerfil($parametro)
    {
        try {

            $objBase64 = new Base64($parametro["token"]);

            $objUsuario = new Usuario();
            $resulUsuairio = $objUsuario -> consultarUsuarioToken($objBase64 -> decodeUsuario()["token"]);
            $filtro="";
        
             if( $this->getPerfilUsuario($resulUsuairio[0]['usuarioid'])[0]['perfilnombre']!="Super Administrador" )
             {
               $filtro=" AND perfilid<>3 ";
             }

             $conn=Conexion::getInstance()->cnn();

              $sqlCommand = "SELECT perfilid,perfilnombre,perfildescripcion,usuariocrea FROM perfil
                 WHERE (usuariocrea=:usuariocrea OR usuariocrea IS NULL)
                 AND usuarioelimina IS  NULL  $filtro
                 ORDER BY perfilnombre";

             $statement  = $conn->prepare($sqlCommand); 
             $statement ->bindValue(':usuariocrea',$resulUsuairio[0]['usuarioid'],PDO::PARAM_INT);
             $statement->execute();              
             $resultado= $statement->fetchAll();

            Conexion::cerrar($conn);

        } catch (PDOException  $Exception) {
            $result=$Exception->getMessage();
        }

        return $resultado;
    }

    public function getPerfilUsuario($id)
    {
        $conn=Conexion::getInstance()->cnn();
        $sqlCommand = 'SELECT perfil.perfilnombre FROM usuario
        INNER JOIN perfil ON usuario.perfilid=perfil.perfilid
        WHERE usuario.usuarioid=:usuarioid';
        $statement  = $conn->prepare($sqlCommand); 
        $statement ->bindValue(':usuarioid',$id,PDO::PARAM_INT);
        $statement->execute();              
        $resultado= $statement->fetchAll();
        Conexion::cerrar($conn);
        return $resultado;
    }

    public function getFormulario($parametro)
    {
        $objBase64 = new Base64($parametro["token"]);

        $objUsuario = new Usuario();
        $resulUsuairio = $objUsuario -> consultarUsuarioToken($objBase64 -> decodeUsuario()["token"]);

        $conn=Conexion::getInstance()->cnn();

        $sqlCommand = "SELECT formularioid,formularionombre FROM formulario
                       UNION SELECT '' AS formularioid,'Seleccionar' AS formularionombre  FROM formulario 
                       ORDER BY formularioid";

        $statement  = $conn->prepare($sqlCommand); 
        $statement->execute();              
        $resultado= $statement->fetchAll();

        Conexion::cerrar($conn);

        return $resultado;
    }

    public function getCampo($parametro)
    {
        $objBase64 = new Base64($parametro["token"]);

        $objUsuario = new Usuario();
        $resulUsuairio = $objUsuario -> consultarUsuarioToken($objBase64 -> decodeUsuario()["token"]);

        $conn=Conexion::getInstance()->cnn();

        $sqlCommand = 'SELECT formulario,campo FROM campo WHERE formulario=:formulario  ORDER BY campo';
        $statement  = $conn->prepare($sqlCommand);
        $statement ->bindValue(':formulario',$parametro["formulario"],PDO::PARAM_STR); 
        $statement->execute();              
        $resultado= $statement->fetchAll();

        Conexion::cerrar($conn);

        return $resultado;
    }

    public function getAccion($parametro)
    {
        $objBase64 = new Base64($parametro["token"]);

        $objUsuario = new Usuario();
        $resulUsuairio = $objUsuario -> consultarUsuarioToken($objBase64 -> decodeUsuario()["token"]);

        $conn=Conexion::getInstance()->cnn();

        $sqlCommand = "SELECT accionid,acciondescripcion FROM accion";

        $statement  = $conn->prepare($sqlCommand);
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

            $sqlCommand ='INSERT INTO perfil (perfilnombre,perfildescripcion,usuariocrea) 
                          VALUES (:perfilnombre,:perfildescripcion,:usuariocrea)';

    
            $statement  = $conn->prepare($sqlCommand);
            $statement ->bindValue(':perfilnombre',$parametro["nombre"],PDO::PARAM_STR);
            $statement ->bindValue(':perfildescripcion',$parametro["descripcion"],PDO::PARAM_STR);
            $statement ->bindValue(':usuariocrea',$resulUsuairio[0]['usuarioid'],PDO::PARAM_INT);
           
            $statement ->execute();
    
            
        } catch (PDOException  $Exception) {
            $result=$Exception->getMessage();
        }
        finally{
            Conexion::cerrar($conn);
        }
        
     return   $result;

    }

    public function gurdarRestriccion($parametro)
    {
         
        $result="OK";
        $conn=Conexion::getInstance()->cnn();

        try 
        {
            $objBase64 = new Base64($parametro["token"]);

            $objUsuario = new Usuario();
            $resulUsuairio = $objUsuario -> consultarUsuarioToken($objBase64 -> decodeUsuario()["token"]);

            $sqlCommand ='INSERT INTO restriccionperfil (campo,formulario,perfilid,accion,usuariocrea) VALUES (:campo,:formulario,:perfilid,:accion,:usuariocrea)';

    
            $statement  = $conn->prepare($sqlCommand);
            $statement ->bindValue(':campo',$parametro["campo"],PDO::PARAM_STR);
            $statement ->bindValue(':formulario',$parametro["formulario"],PDO::PARAM_STR);
            $statement ->bindValue(':perfilid',$parametro["perfilid"],PDO::PARAM_INT);
            $statement ->bindValue(':accion',$parametro["accion"],PDO::PARAM_STR);
            $statement ->bindValue(':usuariocrea',$resulUsuairio[0]['usuarioid'],PDO::PARAM_INT);
           
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

        $sqlCommand ='DELETE FROM restriccionperfil 
                      WHERE restriccionid=:restriccionid';

        $statement  = $conn->prepare($sqlCommand);
        //$statement ->bindValue(':usuarioidelimina',$resulUsuairio[0]['usuarioid'],PDO::PARAM_INT);
        $statement ->bindValue(':restriccionid',$parametro["id"],PDO::PARAM_INT);
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

        $sqlCommand ='UPDATE sensor
        SET sensordescripcion=:sensordescripcion, sensorcodigo=:sensorcodigo, sensorfechamantenimiento=:sensorfechamantenimiento, 
            sensorperiodicidadmantenimiento=:sensorperiodicidadmantenimiento, 
             sensornombre=:sensornombre, sensorestado=:sensorestado, marcaid=:marcaid,  
             sensorfechaactualiza=NOW(),usuarioidactualiza=:usuarioidactualiza
      WHERE sensorid=:sensorid;';

                     

             $statement  = $conn->prepare($sqlCommand);
             $statement ->bindValue(':sensornombre',$parametro["nombre"],PDO::PARAM_STR);
             $statement ->bindValue(':sensordescripcion',$parametro["descripcion"],PDO::PARAM_STR);
             $statement ->bindValue(':sensorcodigo',$parametro["codigo"],PDO::PARAM_STR);
             $statement ->bindValue(':sensorfechamantenimiento',$parametro["fechaMantenimiento"],PDO::PARAM_STR);
             $statement ->bindValue(':sensorperiodicidadmantenimiento',$parametro["repetir"],PDO::PARAM_STR);
             $statement ->bindValue(':sensorestado',$parametro["estado"],PDO::PARAM_BOOL);
             $statement ->bindValue(':marcaid',$parametro["marca"],PDO::PARAM_STR);
             $statement ->bindValue(':usuarioidactualiza',$resulUsuairio[0]['usuarioid'],PDO::PARAM_INT);
             $statement ->bindValue(':sensorid',$parametro["id"],PDO::PARAM_INT);
             
            
             
             $statement ->execute();
            
             Conexion::cerrar($conn);

        return  $result;

    }


    



    




    



}

?>
<?php

class TipoLago
{

     public $usuario;
    
    public function consultar($parametro)
    {
        
        $conn=Conexion::getInstance()->cnn();

        $sqlCommand = 'SELECT tipolagoid, tipolagonombre, tipolagodescripcion, tipolagomaterial, 
                       usuariopadre, usuariocrea
                       FROM tipolago WHERE (usuariopadre IS NULL) OR (usuariopadre=:usuariopadre);';

        $statement  = $conn->prepare($sqlCommand); 
        $statement ->bindValue(':usuariopadre',$this->usuario[0]['usuariopadreid'],PDO::PARAM_INT);
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

            $sqlCommand ='INSERT INTO tipolago(tipolagonombre,tipolagodescripcion,usuariocrea,usuariopadre)
                          VALUES (:tipolagonombre,:tipolagodescripcion,:usuarioid,:usuariopadre);';
    
            $statement  = $conn->prepare($sqlCommand);
            $statement ->bindValue(':tipolagonombre',$parametro["nombre"],PDO::PARAM_STR);
            $statement ->bindValue(':tipolagodescripcion',$parametro["descripcion"],PDO::PARAM_STR);
            $statement ->bindValue(':usuarioid',$this->usuario[0]['usuarioid'],PDO::PARAM_INT);
            $statement ->bindValue(':usuariopadre',$this->usuario[0]['usuariopadreid'],PDO::PARAM_INT);
           
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

        $sqlCommand ='DELETE FROM tipolago
        WHERE tipolagoid=:tipolagoid AND usuariopadre=:usuariopadre;';

        $statement  = $conn->prepare($sqlCommand);
        $statement ->bindValue(':tipolagoid',$parametro["id"],PDO::PARAM_INT);
        $statement ->bindValue(':usuariopadre',$this->usuario[0]['usuariopadreid'],PDO::PARAM_INT);
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

        $sqlCommand ='UPDATE tipolago
                      SET  tipolagonombre=:tipolagonombre, tipolagodescripcion=:tipolagodescripcion 
                      WHERE tipolagoid=:tipolagoid;';

                     

             $statement  = $conn->prepare($sqlCommand);
             $statement ->bindValue(':tipolagonombre',$parametro["nombre"],PDO::PARAM_STR);
             $statement ->bindValue(':tipolagodescripcion',$parametro["descripcion"],PDO::PARAM_STR);
             $statement ->bindValue(':tipolagoid',$parametro["id"],PDO::PARAM_STR);
            
             $statement ->execute();
            
             Conexion::cerrar($conn);

        return  $result;

    }

    
}

?>
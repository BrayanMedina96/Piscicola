<?php

class Marca 
{
    public $usuario;
  
    public function __construct()
    {
        
    }

    public function __get($atributoNombre)
    {
        if(array_key_exists($atributoNombre, $this->atributo))
        {
           return $this->atributo[$atributoNombre];
        }
        
    } 

    public function __set($atributoNombre, $atributoValor)
    {
        $this->atributo[$atributoNombre] = $atributoValor;
    } 

    public function consultar($parametro)
    {
       
        $result=['estado'=>true,'mensaje'=>'','data'=>null];
        $conn=Conexion::getInstance()->cnn();

        try {

             $conn=Conexion::getInstance()->cnn();

             $sqlCommand = 'SELECT marcaid,marcanombre,marcadescripcion FROM marca 
             WHERE marcafechaelimina IS NULL AND usuariopadreid=:usuariopadre;';
             $statement = $conn->prepare($sqlCommand);
             $statement ->bindValue(':usuariopadre',$this->usuario[0]['usuariopadreid'],PDO::PARAM_INT);
             $statement->execute();
             $result['data']= $statement->fetchAll();

        }catch (PDOException  $Exception) {
           $result['estado']=false;
           $result['mensaje']= UserError::getInstance()->getError($Exception->getCode(),$Exception->getMessage());
        }
        finally{
             Conexion::cerrar($conn);
        }

        return $result;

    }

  

    public function guardar($parametro)
    {
        $result=['estado'=>true,'mensaje'=>'Registro guardado.','data'=>null];
        $conn=Conexion::getInstance()->cnn();

        try {

            $sqlCommand ='INSERT INTO marca(marcanombre, marcafechacrea,marcausuariocrea,marcadescripcion,usuariopadreid)
                          VALUES (:marcanombre,NOW(),:usuarioid,:marcadescripcion,:usuariopadre);';
    
            $statement  = $conn->prepare($sqlCommand);
            $statement ->bindValue(':marcanombre',$parametro["nombre"],PDO::PARAM_STR);
            $statement ->bindValue(':marcadescripcion',$parametro["descripcion"],PDO::PARAM_STR);
            $statement ->bindValue(':usuarioid',$this->usuario[0]['usuarioid'],PDO::PARAM_INT);
            $statement ->bindValue(':usuariopadre',$this->usuario[0]['usuariopadreid'],PDO::PARAM_INT);
           
            $statement ->execute();
    
            
        }catch (PDOException  $Exception) {
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
        
        $result=['estado'=>true,'mensaje'=>'Registro eliminado','data'=>null];
        $conn=Conexion::getInstance()->cnn();

        try {

                $sqlCommand ='DELETE FROM marca
                      WHERE marcaid=:marcaid';

                 $statement  = $conn->prepare($sqlCommand);
                 $statement ->bindValue(':marcaid',$parametro["id"],PDO::PARAM_INT);
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

        try {

            $sqlCommand ='UPDATE marca
                          SET  marcanombre=:marcanombre,
                               marcafechaactualiza=NOW(), 
                               marcausuarioactualiza=:marcausuarioactualiza, 
                               marcadescripcion=:marcadescripcion
                        WHERE marcaid=:marcaid';
    
            $statement  = $conn->prepare($sqlCommand);
            $statement ->bindValue(':marcanombre',$parametro["nombre"],PDO::PARAM_STR);
            $statement ->bindValue(':marcadescripcion',$parametro["descripcion"],PDO::PARAM_STR);
            $statement ->bindValue(':marcausuarioactualiza',$this->usuario[0]['usuarioid'],PDO::PARAM_INT);
            $statement ->bindValue(':marcaid',$parametro["marcaid"],PDO::PARAM_INT);
            $statement ->execute();
    
            
        }catch (PDOException  $Exception) {
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
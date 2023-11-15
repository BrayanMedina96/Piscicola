<?php



class TipoDocumento 
{
    
    public function consultar($parametro)
    {
       
        $conn=Conexion::getInstance()->cnn();

        $sqlCommand  = 'SELECT tipodocumentoid, tipodocumentonombre, tipodocumento, tipodocumentoestado
                        FROM tipodocumento WHERE tipodocumentoestado=1;';
        $statement  = $conn->prepare($sqlCommand); 
        $statement->execute();              
        $resultado= $statement->fetchAll();

        Conexion::cerrar($conn);

        return $resultado;

    }

    public function guardar($parametro)
    {
        $result="OK";
      
        
        return   $result;
    }

    public function eliminar($parametro)
    {
        $result="OK";
        

        return $result;
    }

    public function actualizar($parametro)
    {
        $result="OK";
        
        return $result;
    }
    
    
}

<?php

class Marca 
{
    
  
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
       
        $conn=Conexion::getInstance()->cnn();

        $sqlCommand = 'SELECT marcaid,marcanombre FROM marca WHERE marcafechaelimina IS NULL;';
        $statement = $conn->prepare($sqlCommand);
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



?>
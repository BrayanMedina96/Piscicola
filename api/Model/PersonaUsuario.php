<?php


class PersonaUsuario 
{
    
    private  $personaID;
    private  $perosnaNombre;
    private  $personaApellido;
    private  $personaTelefono;
    private  $personaTelefonoOpcional;
    private  $personaCorreo;
    private  $tipoDocumentoID;
    private  $personaNumeroDocumento;
    private  $personaFechaCreacion;
    private  $personaFechaActualizacion;
    private  $atributo;

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

    public function consultar($parametro) {

        $conn = Conexion::getInstance() -> cnn();
        $resultado = null;

        try {

            $sqlCommand = 'SELECT persona.personaid, persona.perosnanombre, persona.personaapellido,
            persona.personatelefono, persona.personatelefonoopcional,
                persona.personacorreo, persona.tipodocumentoid, persona.personanumerodocumento, persona.personafechacreacion,
                persona.personafechaactualizacion, persona.personafechaeliminar, persona.usuarioidelimina,
                persona.usuarioidactualiza, usuarionombre, usuarioid,usuarioestado
            FROM persona
            INNER JOIN usuario ON persona.personaid = usuario.personaid ';
            $statement = $conn -> prepare($sqlCommand);
            $statement -> execute();
            $resultado = $statement -> fetchAll();


        } catch (\Throwable $th) {
            //throw $th;
        } finally {
            Conexion::cerrar($conn);
        }

    

        return $resultado;

    }

    public function guardar($parametro)
    {
        $result;
        
        $conn=Conexion::getInstance()->cnn();

        try 
        {
            
            $sqlCommand ='SELECT personausuario(:nombre,:apellido,:numerodocumento,CAST( :tipoDocumento AS SMALLINT),:usuario,:contrasenia )';
    
            $statement  = $conn->prepare($sqlCommand);
            $statement ->bindValue(':nombre',$parametro["nombre"],PDO::PARAM_STR);
            $statement ->bindValue(':apellido',$parametro["apellido"],PDO::PARAM_STR);
            $statement ->bindValue(':numerodocumento',$parametro["numeroDocumento"],PDO::PARAM_STR);
            $statement ->bindValue(':tipoDocumento',$parametro["tipoDocumento"],PDO::PARAM_INT);
            $statement ->bindValue(':usuario',$parametro["usuario"],PDO::PARAM_STR);
            $statement ->bindValue(':contrasenia',$parametro["contrasenia"],PDO::PARAM_STR);
            
            
            $statement ->execute();
            $result= $statement->fetchAll()[0]["personausuario"];
    
            
        } catch (Exception $Exception) {
            $result=$Exception->getMessage();
        }
        finally{
            Conexion::cerrar($conn);
        }
        
      return $result;
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
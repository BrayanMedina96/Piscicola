<?php

class Persona 
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

    public function consultar($parametro)
    {
       
        $conn=Conexion::getInstance()->cnn();

        $sqlCommand = 'SELECT personaID, perosnaNombre, personaApellido, personaTelefono,
        personaTelefonoOpcional, personaCorreo, tipoDocumentoID, personaNumeroDocumento, personaFechaCreacion,
        personaFechaActualizacion
         FROM Persona;';
        $statement = $conn->prepare($sqlCommand);
        $statement->execute();
        $resultado= $statement->fetchAll();

        Conexion::cerrar($conn);

        return $resultado;

    }

    public function consultarUN($parametro)
    {
        
        $conn = Conexion::getInstance() -> cnn();
        $resultado = null;

        try {

            $objBase64=new Base64($parametro["token"]);
            
            $objUsuario=new Usuario();
            $resulUsuairio=$objUsuario->consultarUsuarioToken( $objBase64->decodeUsuario()["token"] );


            $sqlCommand = 'SELECT persona.personaid, persona.perosnanombre, persona.personaapellido,
            persona.personatelefono, persona.personatelefonoopcional,
                persona.personacorreo, persona.tipodocumentoid, persona.personanumerodocumento, persona.personafechacreacion,
                persona.personafechaactualizacion, persona.personafechaeliminar, persona.usuarioidelimina,
                persona.usuarioidactualiza,usuarionombre,usuarioid,notificacioncorreo,notificacionmensaje,
                usuario.perfilid
            FROM persona
            INNER JOIN usuario ON persona.personaid = usuario.personaid
            WHERE persona.personaid =:personaid;
            ';
            $statement = $conn -> prepare($sqlCommand);
            $statement -> bindValue(':personaid',$parametro["id"], PDO::PARAM_INT );
            $statement -> execute();
            $resultado = $statement -> fetchAll();


        } catch (\Throwable $th) {
            //throw $th;
        } finally {
            Conexion::cerrar($conn);
        }

        return   $resultado;
    }

    public function guardar($parametro)
    {
        $result="OK";
        $conn=Conexion::getInstance()->cnn();

        try 
        {
            
            $sqlCommand ='INSERT INTO Persona (perosnaNombre, personaApellido, personaTelefono, personaTelefonoOpcional, personaCorreo, tipoDocumentoID, personaNumeroDocumento, personaFechaCreacion)
                                                               VALUES (:perosnaNombre, :personaApellido, :personaTelefono,:personaTelefonoOpcional,:personaCorreo,:tipoDocumentoID,:personaNumeroDocumento,NOW());';
    
            $statement  = $conn->prepare($sqlCommand);
            $statement ->bindValue(':perosnaNombre',$parametro["perosnaNombre"],PDO::PARAM_STR);
            $statement ->bindValue(':personaApellido',$parametro["personaApellido"],PDO::PARAM_STR);
            $statement ->bindValue(':personaTelefono',$parametro["personaTelefono"],PDO::PARAM_STR);
            $statement ->bindValue(':personaTelefonoOpcional',$parametro["personaTelefonoOpcional"],PDO::PARAM_STR);
            $statement ->bindValue(':personaCorreo',$parametro["personaCorreo"],PDO::PARAM_STR);
            $statement ->bindValue(':tipoDocumentoID',$parametro["tipoDocumentoID"],PDO::PARAM_STR);
            $statement ->bindValue(':personaNumeroDocumento',$parametro["personaNumeroDocumento"],PDO::PARAM_STR);
            
            $statement ->execute();
    
            
        } catch (Exception $Exception) {
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

        $sqlCommand ='UPDATE public."Persona"
                      SET   "usuarioIDElimina"=:usuarioIDElimina,"personaFechaEliminar"=NOW()
                      WHERE "personaID"=:personaID;';

        $statement  = $conn->prepare($sqlCommand);
        $statement ->bindValue(':usuarioIDElimina',$parametro["usuarioID"],PDO::PARAM_INT);
        $statement ->bindValue(':personaID',$parametro["personaID"],PDO::PARAM_INT);
        $statement ->execute();
        
        Conexion::cerrar($conn);

        return $result;
    }

    public function actualizar($parametro)
    {
        $result = true;
        $conn = Conexion::getInstance() -> cnn();

        try {

            $objBase64 = new Base64($parametro["token"]);

            $objUsuario = new Usuario();
            $resulUsuairio = $objUsuario -> consultarUsuarioToken($objBase64 -> decodeUsuario()["token"]);

            $sqlCommand = ' UPDATE public.persona
            SET perosnanombre =:perosnanombre, personaapellido =:personaapellido, 
                personatelefono =:personatelefono,
                personatelefonoopcional =:personatelefonoopcional, personacorreo =:personacorreo,
                tipodocumentoid =:tipoDocumentoid,
                personanumerodocumento =:personanumerodocumento,
                personafechaactualizacion = NOW(), usuarioidactualiza =:usuarioidactualiza,
                notificacioncorreo=:notificacioncorreo,notificacionmensaje=:notificacionmensaje
            WHERE personaid =:personaid ';

            $statement = $conn -> prepare($sqlCommand);
            $statement -> bindValue(':perosnanombre', $parametro["nombre"], PDO::PARAM_STR);
            $statement -> bindValue(':personaapellido', $parametro["apellido"], PDO::PARAM_STR);
            $statement -> bindValue(':personatelefono', $parametro["telefono"], PDO::PARAM_STR);
            $statement -> bindValue(':personatelefonoopcional', $parametro["telefonoOpcional"], PDO::PARAM_STR);
            $statement -> bindValue(':personacorreo', $parametro["correo"], PDO::PARAM_STR);
            $statement -> bindValue(':tipoDocumentoid', $parametro["tipodocumento"], PDO::PARAM_INT);
            $statement -> bindValue(':personanumerodocumento', $parametro["numeroDocumento"], PDO::PARAM_STR);
            $statement -> bindValue(':usuarioidactualiza', $resulUsuairio[0]['usuarioid'], PDO::PARAM_INT);
            $statement -> bindValue(':notificacioncorreo', $parametro["notificacorreo"], PDO::PARAM_BOOL);
            $statement -> bindValue(':notificacionmensaje', $parametro['notificamensaje'], PDO::PARAM_BOOL);
            $statement -> bindValue(':personaid', $parametro["id"], PDO::PARAM_INT);

            $statement -> execute();

        } catch (PDOException   $Exception) {
            $result= $Exception->getMessage( ) ." ". (int)$Exception->getCode( ) ;
        } finally {
            Conexion::cerrar($conn);
        }

        return $result;
    }

    public function importar($parametro)
    {
        $result = true;
        $conn=Conexion::getInstance()->cnn();

        $obj=new Persona();
        $value=$obj->prepararDato( $parametro['importarText'],$this->usuario[0]['usuarioid'],$this->usuario[0]['usuariopadreid'] );


        try {
            
              $sqlCommand = 'INSERT INTO persona(
                 tipodocumentoid,
                 personanumerodocumento,
                 perosnanombre, 
                 personaapellido, 
                 usuariocrea,
                 usuariopadreid
                 ) VALUES '.$value;
        
                $statement  = $conn->prepare($sqlCommand);
                $statement ->execute();

                    
        } catch (Exception  $e) {
             $result= ["data" => $e->getMessage() ];
        }
        finally{
            Conexion::cerrar($conn);
        }

        return $result;
    }



     public function prepararDato($importarText,$usuario,$usuaioPadre)
     {
        $datos = explode('|',$importarText);
        $value="";
        
        for ($i = 0; $i < count($datos); $i++) 
        {
            $linea = explode(";", $datos[$i]);
            $text = "";
            $primera="";
            $one="";

            for ($j = 0; $j < count($linea); $j++) 
            {
                $text.= $primera."'".str_replace(",",".",$linea[$j])."'";
                if($primera=="")
                {
                    $text= $primera."(SELECT tipodocumentoid FROM tipodocumento WHERE tipodocumento='".str_replace(",",".",$linea[$j])."')";
                    $primera=",";
                }
            }
             
            if($one=="")
            {
                $one=",";
            }
            if($i==count($datos)-1)
            {
                $one="";
            }

            $value.= "  (". $text.",". $usuario.",".$usuaioPadre.")".$one;
        }

        return $value;
     }
    
    
}



?>
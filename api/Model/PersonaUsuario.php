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
        if (array_key_exists($atributoNombre, $this->atributo)) {
            return $this->atributo[$atributoNombre];
        }
    }

    public function __set($atributoNombre, $atributoValor)
    {
        $this->atributo[$atributoNombre] = $atributoValor;
    }

    public function consultar($parametro)
    {

        $conn = Conexion::getInstance()->cnn();
        $resultado = null;

        try {

            $sqlCommand = 'SELECT persona.personaid, persona.perosnanombre, persona.personaapellido,
            persona.personatelefono, persona.personatelefonoopcional,
                persona.personacorreo, persona.tipodocumentoid, persona.personanumerodocumento, persona.personafechacreacion,
                persona.personafechaactualizacion, persona.personafechaeliminar, persona.usuarioidelimina,
                persona.usuarioidactualiza, usuarionombre, usuarioid,usuarioestado,perfil.perfilnombre
            FROM persona
            INNER JOIN usuario ON persona.personaid = usuario.personaid 
            INNER JOIN perfil ON usuario.perfilid=perfil.perfilid';

            $statement = $conn->prepare($sqlCommand);
            $statement->execute();
            $resultado = $statement->fetchAll();
        } catch (\Throwable $th) {
            //throw $th;
        } finally {
            Conexion::cerrar($conn);
        }



        return $resultado;
    }

    public function consultarMiUsuario($parametro)
    {

        $conn = Conexion::getInstance()->cnn();
        $resultado = null;

        try {

            $sqlCommand = 'SELECT persona.personaid, persona.perosnanombre, persona.personaapellido,
            persona.personatelefono, persona.personatelefonoopcional,
                persona.personacorreo, persona.tipodocumentoid, persona.personanumerodocumento, persona.personafechacreacion,
                persona.personafechaactualizacion, persona.personafechaeliminar, persona.usuarioidelimina,
                persona.usuarioidactualiza, usuarionombre, usuarioid,usuarioestado, usuario.usuariopadreid,perfil.perfilnombre
            FROM persona
            INNER JOIN usuario ON persona.personaid = usuario.personaid 
            INNER JOIN perfil ON usuario.perfilid=perfil.perfilid
            WHERE usuario.usuariopadreid=:usuariopadreid';


            $statement = $conn->prepare($sqlCommand);
            $statement->bindValue(':usuariopadreid', $parametro["usuarioPadre"], PDO::PARAM_INT);
            $statement->execute();
            $resultado = $statement->fetchAll();
        } catch (\Throwable $th) {
            //throw $th;
        } finally {
            Conexion::cerrar($conn);
        }



        return $resultado;
    }

    public function guardar($parametro)
    {
        $result = ["response" => null, "mensaje" => null, "tipo" => null];

        $conn = Conexion::getInstance()->cnn();

        try {

            $objUsuario = new Usuario();


            /*
            if ($this->validarExistencia($parametro["numeroDocumento"]) > 0) {
                $result["mensaje"] = "Este numero de documento ya se encuentra registrado.";
                $result["response"] = "ok";
            } elseif ($objUsuario->validarExistencia($parametro["usuario"]) > 0) {
                $result["mensaje"] = "Este nombre de usuario {$parametro["usuario"]} no se encuentra disponible.";
                $result["response"] = "ok";
                $result["tipo"] = "user";
            } else {
*/

            $sqlCommand = ' INSERT INTO persona (perosnanombre,personaapellido,tipodocumentoid,personanumerodocumento)
                VALUES (:nombre,:apellido,:tipodocumento,:numerodocumento);';

            // $sqlCommand = 'SELECT personausuario(:nombre,:apellido,:numerodocumento,CAST( :tipoDocumento AS SMALLINT),:usuario,CAST(:contrasenia AS TEXT),:nombrecomercial )';

            $statement  = $conn->prepare($sqlCommand);
            /*
            $statement->bindParam(':nombre', $parametro["nombre"], PDO::PARAM_STR);
            $statement->bindParam(':apellido', $parametro["apellido"], PDO::PARAM_STR);
            $statement->bindParam(':numerodocumento', $parametro["numeroDocumento"], PDO::PARAM_STR);
            $statement->bindParam(':tipoDocumento', $parametro["tipoDocumento"], PDO::PARAM_INT);
            */
            //$statement->bindValue(':usuario', $parametro["usuario"], PDO::PARAM_STR);
            //$statement->bindValue(':contrasenia', $parametro["contrasenia"], PDO::PARAM_STR);
            // $statement->bindValue(':nombrecomercial', $parametro["nombreComercial"], PDO::PARAM_STR);


            $statement->execute(array(
                ':nombre' => $parametro["nombre"],
                ':apellido' => $parametro["apellido"],
                ':numerodocumento' => $parametro["numeroDocumento"],
                ':tipoDocumento' => $parametro["tipoDocumento"],
            ));
            //$result= $statement->fetchAll()[0]["personausuario"];

            $result["mensaje"] = "Se ha creado correctamente, póngase en contacto con el administrador para darlo de alta.";
            $result["response"] = "ok";
            // }
        } catch (Exception $Exception) {
            $result = ["error" => $Exception->getMessage(), 'sql' => $statement->queryString];
        } finally {
            Conexion::cerrar($conn);
        }

        return $result;
    }

    public function CrearUsuario($parametro)
    {
        $result = ["response" => null, "mensaje" => null, "tipo" => null, 'error' => null];

        $conn = Conexion::getInstance()->cnn();

        try {

            $objUsuario = new Usuario();


            /*
            if ($this->validarExistenciaUsuario($parametro["numeroDocumento"], $parametro["usuarioPadre"]) > 0) {
                $result["mensaje"] = "Numero de documento ya se encuentra registrado.";
                $result["response"] = "ok";
                $result["error"] = true;
            } elseif ($objUsuario->validarExistencia($parametro["usuario"]) > 0) {
                $result["mensaje"] = "Nombre de usuario {$parametro["usuario"]} no se encuentra disponible.";
                $result["response"] = "ok";
                $result["tipo"] = "user";
                $result["error"] = true;
            } else {
*/

            $sqlCommand = ' INSERT INTO persona (perosnanombre,personaapellido,tipodocumentoid,personanumerodocumento,personafechacreacion,usuariocrea)
                                  VALUES (:nombre,:apellido,:tipodocumento,:numerodocumento,NOW(),0) ';

            //  $sqlCommand ='SELECT crearpersonausuario(:nombre,:apellido,:numerodocumento,CAST( :tipoDocumento AS SMALLINT),:usuario, CAST( :usuarioPadre AS SMALLINT ),CAST( :perfil AS SMALLINT ),:correo )';

            $statement  = $conn->prepare($sqlCommand);
            $statement->bindParam(':nombre', $parametro["nombre"], PDO::PARAM_STR);
            $statement->bindParam(':apellido', $parametro["apellido"], PDO::PARAM_STR);
            $statement->bindParam(':numerodocumento', $parametro["numeroDocumento"], PDO::PARAM_STR);
            $statement->bindParam(':tipoDocumento', $parametro["tipoDocumento"], PDO::PARAM_INT);
            // $statement->bindParam(':usuario', $parametro["usuario"], PDO::PARAM_STR);
            // $statement->bindParam(':usuarioPadre', $parametro["usuarioPadre"], PDO::PARAM_INT);
            //$statement->bindParam(':perfil', $parametro["perfil"], PDO::PARAM_INT);
            // $statement->bindParam(':correo', $parametro["correo"], PDO::PARAM_STR);
            $statement->execute();
            $result["mensaje"] = "Usuario se ha creado correctamente.";
            $result["response"] = "ok";


            /*if($parametro["correo"]!="")
                   {
                       $correo=new Correo();
                       $rs= $correo->notificacionCuenta($parametro["correo"],$parametro["usuario"],$parametro["nombre"]);
                       $result["mensaje"]= $result["mensaje"]." ".$rs;
                   }*/
            // }
        } catch (Exception $Exception) {
            $result["error"] = $Exception->getMessage() . '-' . $Exception->getLine();
            $result["sql"] = $statement->queryString;
        } finally {
            Conexion::cerrar($conn);
        }

        return $result;
    }

    public function eliminar($parametro)
    {
        $result = "OK";


        return $result;
    }

    public function actualizar($parametro)
    {
        $result = "OK";


        return $result;
    }

    public function validarExistencia($personanumerodocumento)
    {
        $result = 0;
        $conn = Conexion::getInstance()->cnn();

        $sqlCommand = "SELECT COUNT(*) as numero FROM persona WHERE personanumerodocumento=:personanumerodocumento";

        $statement  = $conn->prepare($sqlCommand);
        $statement->bindValue(':personanumerodocumento', $personanumerodocumento, PDO::PARAM_STR);

        $statement->execute();

        while ($arr = $statement->fetch(PDO::FETCH_ASSOC)) {
            $result = $arr["numero"];
        }

        Conexion::cerrar($conn);

        return  $result;
    }


    public function validarExistenciaUsuario($personanumerodocumento, $usuariopadreid)
    {
        $result = 0;
        $conn = Conexion::getInstance()->cnn();

        $sqlCommand = "SELECT COUNT(*) as numero FROM persona
                     INNER JOIN usuario ON usuario.personaid=persona.personaid 
                     WHERE personanumerodocumento=:personanumerodocumento 
                     AND usuario.usuariopadreid=:usuariopadreid ";

        $statement = $conn->prepare($sqlCommand);
        $statement->bindValue(':personanumerodocumento', $personanumerodocumento, PDO::PARAM_STR);
        $statement->bindValue(':usuariopadreid', $usuariopadreid, PDO::PARAM_STR);
        $statement->execute();

        while ($arr = $statement->fetch(PDO::FETCH_ASSOC)) {
            $result = $arr["numero"];
        }

        Conexion::cerrar($conn);

        return $result;
    }
}

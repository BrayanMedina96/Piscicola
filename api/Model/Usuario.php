<?php

class Usuario
{
    public $usuario;

    public function consultar($parametro)
    {

        $conn = Conexion::getInstance()->cnn();

        $sqlCommand  = 'SELECT usuarioid, usuarionombre, usuariocontrasenia, usuarioestado, usuariofechaexpira, personaid, perfilid, usuarioFechacreacion, usuariofechaactualizacion,
                        usuarioidcrea FROM public.usuario;';

        $statement  = $conn->prepare($sqlCommand);
        $statement->execute();
        $resultado = $statement->fetchAll();

        Conexion::cerrar($conn);

        return $resultado;
    }

    public function consultarUN($parametro)
    {
        $conn = Conexion::getInstance()->cnn();

        $sqlCommand  = 'SELECT usuarioid, usuarionombre, usuariocontrasenia, usuarioestado, usuariofechaexpira, personaid, perfilid, usuarioFechacreacion, usuariofechaactualizacion,
                        usuarioidcrea FROM public.usuario
                        WHERE usuarioid=:usuarioid
                        ;';

        $statement  = $conn->prepare($sqlCommand);
        $statement->bindValue(':usuarioid', $parametro["id"], PDO::PARAM_STR);
        $statement->execute();
        $resultado = $statement->fetchAll();

        Conexion::cerrar($conn);

        return $resultado;
    }

    public function consultarUsuarioToken($token)
    {
        $conn = Conexion::getInstance()->cnn();

        try {
            $sqlCommand = 'SELECT usuario.usuarioid, usuario.usuarionombre, usuario.usuariocontrasenia,
            usuario.usuarioestado,
                usuario.usuariofechaexpira,
                usuario.personaid,
                usuario.perfilid,
                usuario.usuarioFechacreacion,
                usuario.usuariofechaactualizacion,
                usuarioidcrea, 
                usuario.usuariopadreid
                FROM public.usuario 
                INNER JOIN public.login ON usuario.usuarioid = login.usuarioid 
                WHERE login.loginestado = true AND login.logintoken =:token;
            ';
            $statement = $conn->prepare($sqlCommand);
            $statement->bindValue(':token', $token, PDO::PARAM_STR);
            $statement->execute();
            $resultado = $statement->fetchAll();
        } catch (\Throwable $th) {
            //throw $th;
        } finally {
            Conexion::cerrar($conn);
        }
        return $resultado;
    }

    public function login($parametro)
    {
        $conn = Conexion::getInstance()->cnn();
        $token = "";
        $variable = "";
        $estado = false;
        $cambioPass = false;

        try {


            /*
            $sqlCommand  = "SELECT usuario.usuarioid, usuario.usuarionombre, usuario.usuariocontrasenia, 
                                     usuario.usuarioestado, usuario.usuariofechaexpira, usuario.personaid, usuario.perfilid, usuario.usuarioFechacreacion, 
                                     usuario.usuariofechaactualizacion,
                                     CONCAT(persona.perosnanombre,' ',persona.personaapellido) AS nombre,
                                     persona.personaid ,
                                     usuario.usuariocambioclave,
                                     personapadre.personanombrecomercial,
                                     usuarioPadre.usuarioid AS userpadre,
                                     persona.perosnanombre,
                                     persona.personaapellido,
                                     persona.personatelefono,
                                     usuario.correo,
                                     usuario.intro
                                    FROM public.usuario 
                                    INNER JOIN public.persona ON usuario.personaid=persona.personaid 

                                    INNER JOIN public.usuario AS usuariopadre ON public.usuario.usuariopadreid=usuariopadre.usuarioid
                                    INNER JOIN public.persona AS personapadre ON usuariopadre.personaid=personapadre.personaid

                                    WHERE usuario.usuarionombre=:usuarionombre 
                                    AND usuario.usuariocontrasenia=:usuariocontrasenia
                                   -- AND usuarioestado=true
                                    ;";
                    
    
            $statement  = $conn->prepare($sqlCommand);
            $statement ->bindValue(':usuarionombre',$parametro["usuario"],PDO::PARAM_STR);
            $statement ->bindValue(':usuariocontrasenia',$parametro["contrasenia"],PDO::PARAM_STR);
            */

            $sqlCommand  = " SELECT usuario.usuarioid, usuario.usuarionombre, usuario.usuariocontrasenia, 
                                     usuario.usuarioestado, usuario.usuariofechaexpira, usuario.personaid, usuario.perfilid, usuario.usuarioFechacreacion, 
                                     usuario.usuariofechaactualizacion,
                                     CONCAT(persona.perosnanombre,' ',persona.personaapellido) AS nombre,
                                     persona.personaid ,
                                     usuario.usuariocambioclave,
                                     persona.perosnanombre,
                                     persona.personaapellido,
                                     persona.personatelefono,
                                     usuario.correo
                                     FROM usuario 
                                     INNER JOIN persona ON usuario.personaid=persona.personaid 
                                     WHERE usuario.usuarionombre= '" . $parametro["usuario"] . "'
                                     AND usuario.usuariocontrasenia= '" . $parametro["contrasenia"] . "' ";


            $statement  = $conn->prepare($sqlCommand);

            $statement->execute();
            $resultado = $statement->fetchAll();
            foreach ($resultado as $row) {
                $token = Usuario::token();
                Usuario::guardarToken($row["usuarioid"], $row["usuarionombre"], $token);

                Usuario::setIntro($row["usuarioid"]);

                $variable = '{"usuario":"' . $row['usuarionombre'] .
                    '","token":"' . $token .
                    '","usuarioid":"' . $row['usuarioid'] .
                    '","personaid":"' . $row['personaid'] .
                    '","estado":"' . $row['usuarioestado'] .
                    // '","nombreComercial":"' . $row['personanombrecomercial'] .
                    //  '","userPadre":"' . $row['userpadre'] .
                    '","personaapellido":"' . $row['personaapellido'] .
                    '","perosnanombre":"' . $row['perosnanombre'] .
                    '","correo":"' . $row['correo'] .
                    '","personatelefono":"' . $row['personatelefono'] .
                    '","usuariocontrasenia":"' . $row['usuariocontrasenia'] .
                    // '","intro":"' . $row['intro'] .

                    '","nombre":"' . $row['nombre'] . '"}';

                $estado = $row['usuarioestado'];
            }


            $cambioPass = Usuario::cambioPassword($parametro["usuario"]);



            if ($variable == "" && count($cambioPass["data"]) > 0) {
                $variable = '{"token":"' . $cambioPass["data"]["token"] . '"}';
            }

            $existe = "";
            $existeUsuario = $this->consultarNombre($parametro["usuario"]);
            if (count($existeUsuario) > 0) {
                $existe = 1;
            }
        } catch (\Throwable $th) {
            throw $th;
        } finally {
            Conexion::cerrar($conn);
        }

        return array('data' => base64_encode($variable), 'estado' =>  $estado, 'cambioPass' => $cambioPass["estado"], 'dataCambioPass' => $cambioPass["data"], 'existe' => $existe);
    }

    public function consultarNombre($nombre)
    {
        $conn = Conexion::getInstance()->cnn();

        $sqlCommand  = 'SELECT usuarioid, usuarionombre, usuariocontrasenia, usuarioestado, usuariofechaexpira, personaid, perfilid, usuarioFechacreacion, usuariofechaactualizacion,
                        usuarioidcrea FROM public.usuario
                        WHERE usuarionombre=:usuarionombre;';

        $statement  = $conn->prepare($sqlCommand);
        $statement->bindValue(':usuarionombre', $nombre, PDO::PARAM_STR);
        $statement->execute();
        $resultado = $statement->fetchAll();

        Conexion::cerrar($conn);

        return $resultado;
    }

    public function guardar($parametro)
    {

        $result = "OK";
        $conn = Conexion::getInstance()->cnn();

        try {

            $sqlCommand = 'INSERT INTO Usuario (usuarioNombre, usuarioContrasenia, personaID, perfilID, usuarioFechaCreacion, usuarioIDCrea)
                                               VALUES (:usuarioNombre,:usuarioContrasenia,:personaID,:perfilID,NOW(),:usuarioIDCrea);';

            $statement  = $conn->prepare($sqlCommand);
            $statement->bindValue(':usuarioNombre', $parametro["usuarioNombre"], PDO::PARAM_STR);
            $statement->bindValue(':usuarioContrasenia', $parametro["usuarioContrasenia"], PDO::PARAM_STR);
            $statement->bindValue(':personaID', $parametro["personaID"], PDO::PARAM_STR);
            $statement->bindValue(':perfilID', $parametro["perfilID"], PDO::PARAM_STR);
            $statement->bindValue(':usuarioIDCrea', $parametro["usuarioIDCrea"], PDO::PARAM_STR);


            $statement->execute();
        } catch (Exception $Exception) {
            $result = $Exception->getMessage();
        } finally {
            Conexion::cerrar($conn);
        }

        return   $result;
    }

    public function eliminar($parametro)
    {

        $result = "OK";
        $conn = Conexion::getInstance()->cnn();

        $sqlCommand = 'UPDATE public."Usuario"
                      SET   "usuarioIDElimina"=:usuarioIDElimina,"usuarioFechaEliminacion"=NOW()
                      WHERE "UsuarioID"=:UsuarioID;';

        $statement  = $conn->prepare($sqlCommand);
        $statement->bindValue(':usuarioIDElimina', $parametro["usuarioIDElimina"], PDO::PARAM_INT);
        $statement->bindValue(':UsuarioID', $parametro["UsuarioID"], PDO::PARAM_INT);
        $statement->execute();

        Conexion::cerrar($conn);

        return $result;
    }

    public function actualizar($parametro)
    {

        $result = true;
        $conn = Conexion::getInstance()->cnn();

        $objBase64 = new Base64($parametro["token"]);

        $objUsuario = new Usuario();
        $resulUsuairio = $objUsuario->consultarUsuarioToken($objBase64->decodeUsuario()["token"]);

        $sqlCommand = 'UPDATE public.usuario
                      SET  
                           usuariocontrasenia=:usuariocontrasenia,
                           perfilid=:perfilid,
                           usuariofechaactualizacion=NOW(),
                           usuarioidactualiza=:usuarioidactualiza,
                           usuarioestado=:usuarioestado,
                           usuariofechaexpira=:usuariofechaexpira,
                           usuariocambioclave=:usuariocambioclave
                      WHERE usuarioid=:usuarioid;';



        $statement  = $conn->prepare($sqlCommand);
        $statement->bindValue(':usuariocontrasenia', $parametro["contrasenia"], PDO::PARAM_STR);
        $statement->bindValue(':perfilid', $parametro["perfil"], PDO::PARAM_INT);
        $statement->bindValue(':usuarioidactualiza', $resulUsuairio[0]['usuarioid'], PDO::PARAM_INT);
        $statement->bindValue(':usuarioestado', $parametro["estado"], PDO::PARAM_BOOL);
        $statement->bindValue(':usuariofechaexpira', $parametro["fecha"], PDO::PARAM_STR);
        $statement->bindValue(':usuariocambioclave', $parametro["cambioPassword"], PDO::PARAM_BOOL);
        $statement->bindValue(':usuarioid', $parametro["id"], PDO::PARAM_INT);

        $statement->execute();

        Conexion::cerrar($conn);

        return  $result;
    }

    public function actualizarAPP($parametro)
    {

        $result = "OK";
        $conn = Conexion::getInstance()->cnn();

        $objBase64 = new Base64($parametro["token"]);

        $objUsuario = new Usuario();
        $resulUsuairio = $objUsuario->consultarUsuarioToken($objBase64->decodeUsuario()["token"]);

        $sqlCommand = 'UPDATE public.usuario
                      SET  
                           usuariocontrasenia=:usuariocontrasenia,
                           usuariofechaactualizacion=NOW(),
                           usuarioidactualiza=:usuarioidactualiza,
                           correo=:correo
                      WHERE usuarioid=:usuarioid  ;';



        $statement  = $conn->prepare($sqlCommand);
        $statement->bindValue(':usuariocontrasenia', $parametro["contrasenia"], PDO::PARAM_STR);
        $statement->bindValue(':correo', $parametro["correo"], PDO::PARAM_STR);
        $statement->bindValue(':usuarioidactualiza', $resulUsuairio[0]['usuarioid'], PDO::PARAM_INT);
        $statement->bindValue(':usuarioid', $parametro["usuarioid"], PDO::PARAM_INT);

        $statement->execute();

        $sqlCommand = 'UPDATE public.persona  
                      SET perosnanombre=:nombrePersona,
                          personaapellido=:apellido,
                          personatelefono=:telefono
                      WHERE personaid=:personaid';

        $statement  = $conn->prepare($sqlCommand);
        $statement->bindValue(':nombrePersona', $parametro["nombrePersona"], PDO::PARAM_STR);
        $statement->bindValue(':apellido', $parametro["apellido"], PDO::PARAM_STR);
        $statement->bindValue(':telefono', $parametro["telefono"], PDO::PARAM_STR);
        $statement->bindValue(':personaid', $parametro["personaid"], PDO::PARAM_INT);

        $statement->execute();

        Conexion::cerrar($conn);

        return  $result;
    }

    public function actualizarPassword($parametro)
    {

        $result = true;
        $conn = Conexion::getInstance()->cnn();

        $sqlCommand = "UPDATE public.usuario
                      SET  
                           usuariocontrasenia=:usuariocontrasenia,
                           usuariofechaactualizacion=NOW(),
                           usuarioidactualiza=:usuarioidactualiza,
                           usuariocambioclave='FALSE'
                      WHERE usuarioid=:usuarioid;";



        $statement  = $conn->prepare($sqlCommand);

        $statement->bindValue(':usuariocontrasenia', $parametro["contrasenia"], PDO::PARAM_STR);
        $statement->bindValue(':usuarioidactualiza', $this->usuario[0]['usuarioid'], PDO::PARAM_INT);
        $statement->bindValue(':usuarioid', $this->usuario[0]['usuarioid'], PDO::PARAM_INT);

        $statement->execute();

        Conexion::cerrar($conn);

        return  $result;
    }


    private static function token()
    {
        return bin2hex(openssl_random_pseudo_bytes(64));
    }

    private static function  guardarToken($usuarioid, $usuario, $logintoken)
    {
        $conn = Conexion::getInstance()->cnn();

        try {

            $sqlCommand = 'INSERT INTO login (usuarioid,loginusuario, logintoken, loginfecha)
                                     VALUES (:usuarioid,:loginusuario,:logintoken,NOW());';

            $statement  = $conn->prepare($sqlCommand);
            $statement->bindValue(':usuarioid', $usuarioid, PDO::PARAM_STR);
            $statement->bindValue(':loginusuario', $usuario, PDO::PARAM_STR);
            $statement->bindValue(':logintoken', $logintoken, PDO::PARAM_STR);

            $statement->execute();
        } catch (Exception $Exception) {
            $result = $Exception->getMessage();
        } finally {
            Conexion::cerrar($conn);
        }
    }

    private static function  setIntro($usuarioid)
    {
        $conn = Conexion::getInstance()->cnn();

        try {

            $sqlCommand = "UPDATE usuario SET intro='TRUE' WHERE usuarioid=:usuarioid;";

            $statement  = $conn->prepare($sqlCommand);
            $statement->bindValue(':usuarioid', $usuarioid, PDO::PARAM_STR);

            $statement->execute();
        } catch (Exception $Exception) {
            $result = $Exception->getMessage();
        } finally {
            Conexion::cerrar($conn);
        }
    }


    public function seguridad($parametro)
    {

        $result = "OK";
        $conn = Conexion::getInstance()->cnn();

        try {

            $objBase64 = new Base64($parametro["token"]);

            $objUsuario = new Usuario();
            $decode = $objBase64->decodeUsuario();

            $resulUsuairio = $objUsuario->consultarUsuarioToken($decode["token"]);


            $sqlCommand = 'SELECT campo,accion FROM restriccionperfil
            INNER JOIN perfil on restriccionperfil.perfilid = perfil.perfilid
            INNER JOIN usuario on perfil.perfilid = usuario.perfilid
            WHERE usuario.usuarioid = :usuarioid  AND restriccionperfil.usuariocrea=:usuariocrea 
            AND restriccionperfil.formulario=:formulario;';

            $statement = $conn->prepare($sqlCommand);
            $statement->bindValue(':usuarioid', $resulUsuairio[0]['usuarioid'], PDO::PARAM_INT);
            $statement->bindValue(':usuariocrea',  $decode["userPadre"], PDO::PARAM_INT);
            $statement->bindValue(':formulario',   $parametro["formulario"], PDO::PARAM_STR);
            $statement->execute();
            $result = $statement->fetchAll();
        } catch (\Throwable $th) {
            //throw $th;
        } finally {
            Conexion::cerrar($conn);
        }


        return $result;
    }


    public function perfil()
    {
        $result = "OK";
        $conn = Conexion::getInstance()->cnn();

        try {

            $sqlCommand = 'SELECT perfilid,perfilnombre FROM perfil
            ;
            ';

            $statement = $conn->prepare($sqlCommand);
            $statement->execute();
            $result = $statement->fetchAll();
        } catch (\Throwable $th) {
            //throw $th;
        } finally {
            Conexion::cerrar($conn);
        }

        return $result;
    }

    public function validarExistencia($usuarionombre)
    {
        $result = 0;
        $conn = Conexion::getInstance()->cnn();

        $sqlCommand = "SELECT COUNT(*) as numero FROM usuario WHERE usuarionombre=:usuarionombre";

        $statement  = $conn->prepare($sqlCommand);
        $statement->bindValue(':usuarionombre', $usuarionombre, PDO::PARAM_STR);

        $statement->execute();
        while ($arr = $statement->fetch(PDO::FETCH_ASSOC)) {
            $result = $arr["numero"];
        }

        Conexion::cerrar($conn);

        return  $result;
    }

    public static function cambioPassword($usuarionombre)
    {

        $estado = false;
        $array = [];

        $conn = Conexion::getInstance()->cnn();

        $sqlCommand = "SELECT usuario.usuarioid, usuario.usuarionombre, usuario.usuariocontrasenia
        FROM usuario WHERE  usuario.usuarionombre=:usuarionombre  AND usuariocambioclave='TRUE'";

        $statement  = $conn->prepare($sqlCommand);
        $statement->bindValue(':usuarionombre', $usuarionombre, PDO::PARAM_STR);

        $statement->execute();
        $resultado = $statement->fetchAll();

        foreach ($resultado as $row) {
            $token = Usuario::token();
            Usuario::guardarToken($row["usuarioid"], $row["usuarionombre"], $token);

            $array = array(
                'usuario' => $row["usuarionombre"],
                'token' => $token,
                'usuarioid' => $row["usuarioid"]
            );

            $estado = true;
        }



        Conexion::cerrar($conn);



        return  ["estado" => $estado, "data" => $array];
    }


    public function importar($parametro)
    {
        $result = true;
        $conn = Conexion::getInstance()->cnn();

        $obj = new Usuario();
        $value = $obj->prepararDato($parametro['importarText'], $this->usuario[0]['usuarioid'], $this->usuario[0]['usuariopadreid']);


        try {

            $sqlCommand = 'INSERT INTO usuario(
                personaid,
                usuarionombre,
                perfilid, 
                usuariofechaexpira, 
               
                usuarioidcrea, 
                usuariocambioclave, 
                usuariopadreid) VALUES ' . $value;

            $statement  = $conn->prepare($sqlCommand);
            $statement->execute();
        } catch (Exception $e) {
            $result = ["data" => $e->getMessage()];
        } finally {
            Conexion::cerrar($conn);
        }


        return $result;
    }



    public function prepararDato($importarText, $usuario, $usuaioPadre)
    {
        $datos = explode('|', $importarText);
        $value = "";

        for ($i = 0; $i < count($datos); $i++) {
            $linea = explode(";", $datos[$i]);
            $text = "";
            $primera = "";
            $one = "";

            for ($j = 0; $j < count($linea); $j++) {

                if ($j == 2) {

                    $text .= ",(SELECT perfilid FROM perfil WHERE perfilnombre='" . str_replace(",", ".", $linea[$j]) . "' AND (usuariocrea IS NULL OR usuariocrea=" . $usuaioPadre . "))";
                    continue;
                }

                $text .= $primera . "'" . str_replace(",", ".", $linea[$j]) . "'";
                if ($primera == "") {
                    $text = $primera . "(SELECT personaid FROM persona WHERE personanumerodocumento='" . str_replace(",", ".", $linea[$j]) . "' AND usuariopadreid=" . $usuaioPadre . ")";
                    $primera = ",";
                }
            }

            if ($one == "") {
                $one = ",";
            }
            if ($i == count($datos) - 1) {
                $one = "";
            }

            $value .= "  (" . $text . "," . $usuario . ",TRUE" . "," . $usuaioPadre . ")" . $one;
        }

        return $value;
    }
}

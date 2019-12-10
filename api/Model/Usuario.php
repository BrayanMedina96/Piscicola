<?php

class Usuario
{

    public function consultar($parametro)
    {
        
        $conn=Conexion::getInstance()->cnn();

        $sqlCommand  = 'SELECT usuarioid, usuarionombre, usuariocontrasenia, usuarioestado, usuariofechaexpira, personaid, perfilid, usuarioFechacreacion, usuariofechaactualizacion,
                        usuarioidcrea FROM public.usuario;';

        $statement  = $conn->prepare($sqlCommand); 
        $statement->execute();              
        $resultado= $statement->fetchAll();

        Conexion::cerrar($conn);

        return $resultado;
    }

    public function consultarUN($parametro)
    {
        $conn=Conexion::getInstance()->cnn();

        $sqlCommand  = 'SELECT usuarioid, usuarionombre, usuariocontrasenia, usuarioestado, usuariofechaexpira, personaid, perfilid, usuarioFechacreacion, usuariofechaactualizacion,
                        usuarioidcrea FROM public.usuario
                        WHERE usuarioid=:usuarioid
                        ;';

        $statement  = $conn->prepare($sqlCommand); 
        $statement ->bindValue(':usuarioid',$parametro["id"],PDO::PARAM_STR);
        $statement->execute();              
        $resultado= $statement->fetchAll();

        Conexion::cerrar($conn);

        return $resultado;
    }

    public function consultarUsuarioToken($token)
    {
        $conn=Conexion::getInstance()->cnn();

        try {
            $sqlCommand = 'SELECT usuario.usuarioid, usuario.usuarionombre, usuario.usuariocontrasenia,
            usuario.usuarioestado,
                usuario.usuariofechaexpira,
                usuario.personaid,
                usuario.perfilid,
                usuario.usuarioFechacreacion,
                usuario.usuariofechaactualizacion,
                usuarioidcrea FROM public.usuario 
                INNER JOIN public.login ON usuario.usuarioid = login.usuarioid 
                WHERE login.loginestado = true AND login.logintoken =:token;
            ';
            $statement = $conn -> prepare($sqlCommand);
            $statement -> bindValue(':token', $token, PDO::PARAM_STR);
            $statement -> execute();
            $resultado = $statement -> fetchAll();
        } catch (\Throwable $th) {
            //throw $th;
        } finally {
            Conexion:: cerrar($conn);
        }
        return $resultado;
    }

    public function login($parametro)
    {
        $conn=Conexion::getInstance()->cnn();
        $token="";
        $variable="";
        $estado=false;
        $cambioPass=false;

        try 
        {
         
            $sqlCommand  = "SELECT usuario.usuarioid, usuario.usuarionombre, usuario.usuariocontrasenia, 
                                     usuario.usuarioestado, usuario.usuariofechaexpira, usuario.personaid, usuario.perfilid, usuario.usuarioFechacreacion, 
                                     usuario.usuariofechaactualizacion,
                                     CONCAT(persona.perosnanombre,' ',persona.personaapellido) AS nombre,
                                     persona.personaid ,
                                     usuario.usuariocambioclave,
                                     personapadre.personanombrecomercial
                                    FROM public.usuario 
                                    INNER JOIN public.persona ON usuario.personaid=persona.personaid 

                                    INNER JOIN public.usuario AS usuariopadre ON public.usuario.usuariopadreid=usuariopadre.usuarioid
                                    INNER JOIN public.persona as personapadre ON usuariopadre.personaid=personapadre.personaid

                                    WHERE usuario.usuarionombre=:usuarionombre 
                                    AND usuario.usuariocontrasenia=:usuariocontrasenia
                                   -- AND usuarioestado=true
                                    ;";
    
            $statement  = $conn->prepare($sqlCommand);
            $statement ->bindValue(':usuarionombre',$parametro["usuario"],PDO::PARAM_STR);
            $statement ->bindValue(':usuariocontrasenia',$parametro["contrasenia"],PDO::PARAM_STR);
            $statement->execute();              
            $resultado= $statement->fetchAll();
            foreach ($resultado as $row) 
            {
                $token = Usuario::token();
                Usuario::guardarToken($row["usuarioid"], $row["usuarionombre"], $token);

                $variable = '{"usuario":"'.$row['usuarionombre'].
                '","token":"'.$token.
                '","usuarioid":"'.$row['usuarioid'].
                '","personaid":"'.$row['personaid'].
                '","estado":"'.$row['usuarioestado'].
                '","nombreComercial":"'.$row['personanombrecomercial'].
                '","nombre":"'.$row['nombre'].'"}';

                $estado=$row['usuarioestado'];
               

            }


          $cambioPass=Usuario::cambioPassword( $parametro["usuario"] );


        } catch (\Throwable $th) {
            throw $th;
        }
        finally{
            Conexion::cerrar($conn);
        }

        return array('data' => base64_encode($variable),'estado'=>  $estado, 'cambioPass'=>$cambioPass["estado"],'dataCambioPass'=>$cambioPass["data"] ); 
        
    }

    public function guardar($parametro)
    {
         
        $result="OK";
        $conn=Conexion::getInstance()->cnn();

        try 
        {
            
            $sqlCommand ='INSERT INTO public."Usuario"("usuarioNombre", "usuarioContrasenia", "personaID", "perfilID", "usuarioFechaCreacion", "usuarioIDCrea")
                                               VALUES (:usuarioNombre,:usuarioContrasenia,:personaID,:perfilID,NOW(),:usuarioIDCrea);';
    
            $statement  = $conn->prepare($sqlCommand);
            $statement ->bindValue(':usuarioNombre',$parametro["usuarioNombre"],PDO::PARAM_STR);
            $statement ->bindValue(':usuarioContrasenia',$parametro["usuarioContrasenia"],PDO::PARAM_STR);
            $statement ->bindValue(':personaID',$parametro["personaID"],PDO::PARAM_STR);
            $statement ->bindValue(':perfilID',$parametro["perfilID"],PDO::PARAM_STR);
            $statement ->bindValue(':usuarioIDCrea',$parametro["usuarioIDCrea"],PDO::PARAM_STR);
           
            
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

        $sqlCommand ='UPDATE public."Usuario"
                      SET   "usuarioIDElimina"=:usuarioIDElimina,"usuarioFechaEliminacion"=NOW()
                      WHERE "UsuarioID"=:UsuarioID;';

        $statement  = $conn->prepare($sqlCommand);
        $statement ->bindValue(':usuarioIDElimina',$parametro["usuarioIDElimina"],PDO::PARAM_INT);
        $statement ->bindValue(':UsuarioID',$parametro["UsuarioID"],PDO::PARAM_INT);
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

        $sqlCommand ='UPDATE public.usuario
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
             $statement ->bindValue(':usuariocontrasenia',$parametro["contrasenia"],PDO::PARAM_STR);
             $statement ->bindValue(':perfilid',$parametro["perfil"],PDO::PARAM_INT);
             $statement ->bindValue(':usuarioidactualiza',$resulUsuairio[0]['usuarioid'],PDO::PARAM_INT);
             $statement ->bindValue(':usuarioestado',$parametro["estado"],PDO::PARAM_BOOL);
             $statement ->bindValue(':usuariofechaexpira',$parametro["fecha"],PDO::PARAM_STR);
             $statement ->bindValue(':usuariocambioclave',$parametro["cambioPassword"],PDO::PARAM_BOOL);
             $statement ->bindValue(':usuarioid',$parametro["id"],PDO::PARAM_INT);
             
             $statement ->execute();
            
             Conexion::cerrar($conn);

        return  $result;

    }


    public function actualizarPassword($parametro)
    {

        $result=true;
        $conn=Conexion::getInstance()->cnn();

        
        $objUsuario=new Usuario();
        $resulUsuairio=$objUsuario->consultarUsuarioToken( $parametro["token"] );

        $sqlCommand ="UPDATE public.usuario
                      SET  
                           usuariocontrasenia=:usuariocontrasenia,
                           usuariofechaactualizacion=NOW(),
                           usuarioidactualiza=:usuarioidactualiza,
                           usuariocambioclave='FALSE'
                      WHERE usuarioid=:usuarioid;";

                     

             $statement  = $conn->prepare($sqlCommand);

             $statement ->bindValue(':usuariocontrasenia',$parametro["contrasenia"],PDO::PARAM_STR);
             $statement ->bindValue(':usuarioidactualiza',$resulUsuairio[0]['usuarioid'],PDO::PARAM_INT);
             $statement ->bindValue(':usuarioid',$resulUsuairio[0]['usuarioid'],PDO::PARAM_INT);
             
             $statement ->execute();
            
             Conexion::cerrar($conn);

        return  $result;

    }
    

    private static function token()
    {
        return bin2hex(openssl_random_pseudo_bytes(64)); 
    }

    private static function  guardarToken($usuarioid,$usuario,$logintoken)
    {
        $conn=Conexion::getInstance()->cnn();
        
        try 
        {
            
            $sqlCommand ='INSERT INTO login (usuarioid,loginusuario, logintoken, loginfecha)
                                     VALUES (:usuarioid,:loginusuario,:logintoken,NOW());';
    
            $statement  = $conn->prepare($sqlCommand);
            $statement ->bindValue(':usuarioid',$usuarioid,PDO::PARAM_STR);
            $statement ->bindValue(':loginusuario',$usuario,PDO::PARAM_STR);
            $statement ->bindValue(':logintoken',$logintoken,PDO::PARAM_STR);
            
            $statement ->execute();
    
            
        } catch (Exception $Exception) {
            $result=$Exception->getMessage();
        }
        finally{
            Conexion::cerrar($conn);
        }

        
    }


    public function seguridad($parametro)
    {

        $result = "OK";
        $conn = Conexion::getInstance() ->cnn();

        try {

            $objBase64 = new Base64($parametro["token"]);

            $objUsuario = new Usuario();
            $resulUsuairio = $objUsuario -> consultarUsuarioToken($objBase64 -> decodeUsuario()["token"]);

            $sqlCommand = 'SELECT campo,accion FROM restriccionperfil
            INNER JOIN perfil on restriccionperfil.perfilid = perfil.perfilid
            INNER JOIN usuario on perfil.perfilid = usuario.perfilid
            WHERE usuario.usuarioid = :usuarioid;
            ';

            $statement = $conn ->prepare($sqlCommand);
            $statement ->bindValue(':usuarioid', $resulUsuairio[0]['usuarioid'], PDO::PARAM_INT);
            $statement ->execute();
            $result = $statement -> fetchAll();

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
        $conn = Conexion::getInstance() ->cnn();

        try {

            $sqlCommand = 'SELECT perfilid,perfilnombre FROM perfil
            ;
            ';

            $statement = $conn ->prepare($sqlCommand);
            $statement ->execute();
            $result = $statement -> fetchAll();

        } catch (\Throwable $th) {
            //throw $th;
        } finally {
            Conexion::cerrar($conn);
        }

        return $result;
    }

    public function validarExistencia($usuarionombre)
    {
        $result=0;
        $conn=Conexion::getInstance()->cnn();

        $sqlCommand ="SELECT COUNT(*) as numero FROM usuario WHERE usuarionombre=:usuarionombre";
    
        $statement  = $conn->prepare($sqlCommand);
        $statement ->bindValue(':usuarionombre',$usuarionombre,PDO::PARAM_STR);
        
        $statement ->execute();
        while ($arr = $statement ->fetch(PDO::FETCH_ASSOC) ) {
            $result=$arr["numero"];
        
        }

        Conexion::cerrar($conn);

        return  $result;

    }

    public static function cambioPassword($usuarionombre)
    {

        $estado=false;
        $array=[];

        $conn=Conexion::getInstance()->cnn();

        $sqlCommand ="SELECT usuario.usuarioid, usuario.usuarionombre, usuario.usuariocontrasenia
        FROM usuario WHERE  usuario.usuarionombre=:usuarionombre  AND usuariocambioclave='TRUE'";
    
        $statement  = $conn->prepare($sqlCommand);
        $statement ->bindValue(':usuarionombre',$usuarionombre,PDO::PARAM_STR);
        
        $statement ->execute();
        $resultado= $statement->fetchAll();

        foreach ($resultado as $row) 
        {
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

       

        return  ["estado"=> $estado,"data"=>$array ];

    }
    



}

?>
<?php

class Sonda
{
    public $usuario;

    public function consultar($parametro)
    {

        $result = ['estado' => true, 'mensaje' => '', 'data' => null];
        $conn = Conexion::getInstance()->cnn();

        try {


            $fecha = "";
            $dia = [];

            if ($parametro["fecharegistro"] != "") {
                $dia = explode("-", $parametro["fecharegistro"]);

                if (count($dia) > 1) {
                    $fecha = " AND fecharegistro BETWEEN :fechaInicial AND :fechaFinal ";
                } else {
                    $fecha = " AND fecharegistro=:fecharegistro ";
                }
            }

            $hora = $parametro["horaregistro"] == "" ? "" : "AND horaregistro=CAST(:horaregistro AS TIME)";


            $sqlCommand = "SELECT estadofisicoquimico.estadofisicoquimicoid, estadofisicoquimico.fecharegistro,
            estadofisicoquimico.oxigenodisuelto, estadofisicoquimico.ph, estadofisicoquimico.cultivoid,
            CAST(estadofisicoquimico.horaregistro AS TIME) AS horaregistro, estadofisicoquimico.temperaturaambiente,
            estadofisicoquimico.temperaturaestanque, estadofisicoquimico.conductividadelectrica,
            estadofisicoquimico.amonionh3, estadofisicoquimico.amonionh4, estadofisicoquimico.nitrito,
            estadofisicoquimico.alcalinidad, estadofisicoquimico.descripcion, estadofisicoquimico.pecesmuertos,
            estadofisicoquimico.usuarioid, estadofisicoquimico.usuariopadreid, 
            CONCAT(lago.lagonombre,' - ',pez.especiepez) AS nombre
            FROM estadofisicoquimico
            INNER JOIN cultivo ON estadofisicoquimico.cultivoid=cultivo.cultivoid
            INNER JOIN lago ON cultivo.lagoid=lago.lagoid
            INNER JOIN pez ON cultivo.pezid=pez.pezid
            WHERE estadofisicoquimico.usuariopadreid=:usuariopadreid AND estadofisicoquimico.cultivoid=:cultivoid  AND fechaelimina IS NULL  $fecha   $hora
           ORDER BY fecharegistro DESC , horaregistro DESC;";

            $statement  = $conn->prepare($sqlCommand);
            $statement->bindValue(':usuariopadreid', $this->usuario[0]['usuariopadreid'], PDO::PARAM_INT);
            $statement->bindValue(':cultivoid', $parametro["cultivo"], PDO::PARAM_INT);

            if ($parametro["fecharegistro"] != "") {
                if (count($dia) > 1) {
                    $statement->bindValue(':fechaInicial', $dia[0], PDO::PARAM_STR);
                    $statement->bindValue(':fechaFinal', $dia[1], PDO::PARAM_STR);
                } else {
                    $statement->bindValue(':fecharegistro', $parametro["fecharegistro"], PDO::PARAM_STR);
                }
            }

            if ($hora != "") {
                $statement->bindValue(':horaregistro', $parametro["horaregistro"], PDO::PARAM_STR);
            }

            $statement->execute();
            $result['data'] = $statement->fetchAll();
        } catch (PDOException  $Exception) {

            $result['estado'] = false;
            $result['mensaje'] = UserError::getInstance()->getError($Exception->getCode(), $Exception->getMessage());
        } finally {
            Conexion::cerrar($conn);
        }

        return $result;
    }

    public function getParametros($parametro)
    {

        $result = ['estado' => true, 'mensaje' => '', 'data' => null, 'sonda' => null];
        $conn = Conexion::getInstance()->cnn();

        try {


            $sqlCommand = "SELECT lago.lagonombre, sensor.sensornombre,rango.descripcion AS configuracion,tipolago.tipolagonombre,
                cultivo.fechainicio,cultivo.fechafinalizacion,
                
                rango.temperaturaambiente_max+rango.temperaturaambiente_min AS temperaturaambiente,
                rango.temperaturaestanque_max+rango.temperaturaestanque_min AS temperaturaestanque,
                rango.oxigeno_max+rango.oxigeno_min AS oxigeno, 
                rango.ph_max+rango.ph_min AS ph,
                rango.conductividad_max+rango.conductividad_min AS conductividad,
                rango.amonionh3_max+rango.amonionh3_min AS amonionh3, 
                rango.amonionh4_max+rango.amonionh4_min AS amonionh4,
                rango.nitrito_max+rango.nitrito_min AS nitrito, 
                rango.alcalinidad_max+rango.alcalinidad_min AS alcalinidad 
                       
                   
                FROM cultivo
                INNER JOIN lago ON cultivo.lagoid=lago.lagoid
                INNER JOIN lagosensor ON  lago.lagoid=lagosensor.lagoid AND lagosensorestado=TRUE
                INNER JOIN sensor ON lagosensor.sensorid=sensor.sensorid
                INNER JOIN rango_sensor ON sensor.sensorid=rango_sensor.sonda_id
                INNER JOIN rango ON   rango_sensor.rango_id =rango.id
                INNER JOIN tipolago ON  lago.tipolagoid= tipolago.tipolagoid
                WHERE sensor.sensorid=:sensorid";

            $statement  = $conn->prepare($sqlCommand);

            $statement->bindValue(':sensorid', $parametro["sensorid"], PDO::PARAM_INT);


            $statement->execute();
            $result['data'] = $statement->fetchAll();
        } catch (PDOException  $Exception) {

            $result['estado'] = false;
            $result['mensaje'] = UserError::getInstance()->getError($Exception->getCode(), $Exception->getMessage());
        } finally {
            Conexion::cerrar($conn);
        }

        return $result;
    }

    public function getParametrosLago($parametro)
    {

        $result = ['estado' => true, 'mensaje' => '', 'data' => null, 'sonda' => null];
        $conn = Conexion::getInstance()->cnn();

        try {


            $sqlCommand = "SELECT lago.lagonombre,'' as sensornombre,rango.descripcion AS configuracion,tipolago.tipolagonombre,
                cultivo.fechainicio,cultivo.fechafinalizacion,
                
                rango.temperaturaambiente_max+rango.temperaturaambiente_min AS temperaturaambiente,
                rango.temperaturaestanque_max+rango.temperaturaestanque_min AS temperaturaestanque,
                rango.oxigeno_max+rango.oxigeno_min AS oxigeno, 
                rango.ph_max+rango.ph_min AS ph,
                rango.conductividad_max+rango.conductividad_min AS conductividad,
                rango.amonionh3_max+rango.amonionh3_min AS amonionh3, 
                rango.amonionh4_max+rango.amonionh4_min AS amonionh4,
                rango.nitrito_max+rango.nitrito_min AS nitrito, 
                rango.alcalinidad_max+rango.alcalinidad_min AS alcalinidad 
                    
                FROM cultivo
                INNER JOIN lago ON cultivo.lagoid=lago.lagoid
                INNER JOIN rango_sensor ON lago.lagoid=rango_sensor.lago_id
                INNER JOIN rango ON   rango_sensor.rango_id =rango.id
                INNER JOIN tipolago ON  lago.tipolagoid= tipolago.tipolagoid
                WHERE cultivo.cultivoid=:cultivoid";

            $statement  = $conn->prepare($sqlCommand);

            $statement->bindValue(':cultivoid', $parametro["cultivoid"], PDO::PARAM_INT);

            $statement->execute();
            $result['data'] = $statement->fetchAll();
        } catch (PDOException  $Exception) {

            $result['estado'] = false;
            $result['mensaje'] = UserError::getInstance()->getError($Exception->getCode(), $Exception->getMessage());
        } finally {
            Conexion::cerrar($conn);
        }

        return $result;
    }


    public function getSondaCultivo($parametro)
    {

        $result = ['estado' => true, 'mensaje' => '', 'data' => null];
        $conn = Conexion::getInstance()->cnn();

        try {


            $sqlCommand = "SELECT sensor.sensornombre,sensor.sensorid FROM cultivo
                INNER JOIN lago ON cultivo.lagoid=lago.lagoid
                INNER JOIN lagosensor ON lago.lagoid=lagosensor.lagoid
                INNER JOIN sensor ON lagosensor.sensorid=sensor.sensorid
                WHERE cultivo.cultivoid=:cultivoid";

            $statement  = $conn->prepare($sqlCommand);

            $statement->bindValue(':cultivoid', $parametro["cultivo"], PDO::PARAM_INT);


            $statement->execute();
            $result['data'] = $statement->fetchAll();
        } catch (PDOException  $Exception) {

            $result['estado'] = false;
            $result['mensaje'] = UserError::getInstance()->getError($Exception->getCode(), $Exception->getMessage());
        } finally {
            Conexion::cerrar($conn);
        }

        return $result;
    }


    public function getVariable($parametro)
    {

        $result = ['estado' => true, 'mensaje' => '', 'data' => null];
        $conn = Conexion::getInstance()->cnn();

        try {

            $sqlCommand = "SELECT * FROM public.estadofisicoquimico WHERE cultivoid=:cultivoid
                ORDER BY fecharegistro limit 1";

            $statement  = $conn->prepare($sqlCommand);

            $statement->bindValue(':cultivoid', $parametro["cultivo"], PDO::PARAM_INT);


            $statement->execute();
            $result['data'] = $statement->fetchAll();
        } catch (PDOException  $Exception) {

            $result['estado'] = false;
            $result['mensaje'] = UserError::getInstance()->getError($Exception->getCode(), $Exception->getMessage());
        } finally {
            Conexion::cerrar($conn);
        }

        return $result;
    }


    public function getParametrosInfo2($parametro)
    {
        /*mensaje */
        $mensaje = '';
        $mensaje .= "<figure>
         <center>
             <img src='https://aqualog.southcentralus.cloudapp.azure.com/Aqua/web/svg/pez.png' alt='Red dot' width='100px'>
         </center>
        </figure>";
        $mensaje .= "El Lago <strong>Granja experimental CORHUILA</strong> ; esta presetando variaciones en los rangos permisibles. <br> Los valores actuales de las variables fisicoquímicas son los siguientes :";
        $mensaje .= "<br> <table style='width: 100%; border-collapse: collapse;border: 1px solid black;' class='table h5'>";
        $mensaje .= "<tr style='background-color:#efebea;'> <td style='border: 1px solid black;font-size:18px;font-weight:bold;color:#fb932c;'>Variable</td>  <td style='border: 1px solid black;font-size:18px;font-weight:bold;color:#fb932c;'>Valor</td> </tr>";
        $mensaje .= "<tr> <td style='border: 1px solid black;color: #210049;'>T.Amb</td>  <td style='border: 1px solid black;color: #210049;'>23 </td> </tr>";
        $mensaje .= "<tr style='background-color:#efebea;'> <td style='border: 1px solid black;color: #210049;'>T.Est</td>  <td style='border: 1px solid black;color: #210049;'>25</td> </tr>";
        $mensaje .= "<tr> <td style='border: 1px solid black;color: #210049;'>O.D</td>  <td style='border: 1px solid black;color: #210049;'>1</td> </tr>";
        $mensaje .= "<tr style='background-color:#efebea;'> <td style='border: 1px solid black;color: #210049;'>pH</td>  <td style='border: 1px solid black;color: #210049;'>7.4</td> </tr>";
        $mensaje .= "</table>";

        $correo = new Correo();
        $rs = $correo->enviar('bh-medinac@corhuila.edu.co', 'brayanmedina1080296146', 'Aqua', 'brayanmedinacardozo@gmail.com', 'Alerta de variables', $mensaje);
        $rs = $correo->enviar('bh-medinac@corhuila.edu.co', 'brayanmedina1080296146', 'Aqua', 'af-nunezc@corhuila.edu.co', 'Alerta de variables', $mensaje);
        $rs = $correo->enviar('bh-medinac@corhuila.edu.co', 'brayanmedina1080296146', 'Aqua', 'julian.quimbayo@corhuila.edu.co', 'Alerta de variables', $mensaje);
        $rs = $correo->enviar('bh-medinac@corhuila.edu.co', 'brayanmedina1080296146', 'Aqua', 'alvaro.alarcon@corhuila.edu.co', 'Alerta de variables', $mensaje);
        $rs = $correo->enviar('bh-medinac@corhuila.edu.co', 'brayanmedina1080296146', 'Aqua', 'ivan.alarcon@corhuila.edu.co', 'Alerta de variables', $mensaje);
    }

    public function getParametrosInfo($parametro)
    {

        $result = ['estado' => true, 'mensaje' => '', 'data' => null];
        $conn = Conexion::getInstance()->cnn();

        try {


            $sqlCommand = "SELECT *
               FROM lago 
               LEFT JOIN cultivo ON lago.lagoid=cultivo.lagoid
               LEFT JOIN tipolago ON  lago.tipolagoid= tipolago.tipolagoid
               LEFT JOIN pez ON cultivo.pezid =  pez.pezid
               WHERE lago.usuariopadreid=:usuarioid";

            $statement  = $conn->prepare($sqlCommand);

            $statement->bindValue(':usuarioid', $this->usuario[0]['usuariopadreid'], PDO::PARAM_INT);

            $statement->execute();
            $resultado = $statement->fetchAll();
            $data = [];

            foreach ($resultado as $row) {
                $parametro = ['cultivo' => $row['cultivoid']];

                array_push($data, ['data' => $row, 'sonda' => $this->getSondaCultivo($parametro), 'variable' => $this->getVariable($parametro)]);
            }


            $result['data'] = $data;  //$statement->fetchAll();

        } catch (PDOException  $Exception) {

            $result['estado'] = false;
            $result['mensaje'] = UserError::getInstance()->getError($Exception->getCode(), $Exception->getMessage());
        } finally {
            Conexion::cerrar($conn);
        }

        return $result;
    }


    public function guardar($parametro)
    {

        $result = ['estado' => true, 'mensaje' => 'Registro guardado.', 'data' => null];
        $conn = Conexion::getInstance()->cnn();

        try {

            $lagoId = $this->getLago($parametro['sensorid'])['data'][0]['lagoid'];

            $sqlCommand = 'INSERT INTO estadofisicoquimico(
                fecharegistro,
                horaregistro,
                temperaturaambiente,
                temperaturaestanque,
                oxigenodisuelto,
                ph,
                conductividadelectrica,
                amonionh3,
                amonionh4,
                nitrito,
                alcalinidad,
                pecesmuertos,
                descripcion,
                cultivoid,
                usuarioid,
                usuariopadreid,lagoid) VALUES ( CAST(:fecharegistro AS Date), CAST(:horaregistro AS TIME),:temperaturaambiente,:temperaturaestanque
                ,:oxigenodisuelto,:ph,:conductividadelectrica,:amonionh3,:amonionh4,:nitrito,:alcalinidad,:pecesmuertos
                ,:descripcion,:cultivoid,:usuarioid,:usuariopadreid,:lagoid )';

            $statement  = $conn->prepare($sqlCommand);
            $statement->bindValue(':fecharegistro', $parametro["fecharegistro"], PDO::PARAM_STR);
            $statement->bindValue(':horaregistro', $parametro["horaregistro"], PDO::PARAM_STR);

            $statement->bindValue(':temperaturaambiente', $parametro["temperaturaambiente"] == "" ? 0 : $parametro["temperaturaambiente"], PDO::PARAM_INT);
            $statement->bindValue(':temperaturaestanque', $parametro['temperaturaestanque'] == "" ? 0 : $parametro["temperaturaestanque"], PDO::PARAM_INT);
            $statement->bindValue(':oxigenodisuelto', $parametro["oxigenodisuelto"] == "" ? 0 : $parametro["oxigenodisuelto"], PDO::PARAM_INT);
            $statement->bindValue(':ph', $parametro["ph"] == "" ? 0 : $parametro["ph"], PDO::PARAM_INT);
            $statement->bindValue(':conductividadelectrica', $parametro["conductividadelectrica"] == "" ? 0 : $parametro["conductividadelectrica"], PDO::PARAM_INT);
            $statement->bindValue(':amonionh3', $parametro['amonionh3'] == "" ? 0 : $parametro["amonionh3"], PDO::PARAM_INT);
            $statement->bindValue(':amonionh4', $parametro['amonionh4'] == "" ? 0 : $parametro["amonionh4"], PDO::PARAM_INT);
            $statement->bindValue(':nitrito', $parametro['nitrito'] == "" ? 0 : $parametro["nitrito"], PDO::PARAM_INT);
            $statement->bindValue(':alcalinidad', $parametro['alcalinidad'] == "" ? 0 : $parametro["alcalinidad"], PDO::PARAM_INT);
            $statement->bindValue(':pecesmuertos', $parametro['pecesmuertos'] == "" ? 0 : $parametro["pecesmuertos"], PDO::PARAM_INT);
            $statement->bindValue(':descripcion', $parametro['descripcion'], PDO::PARAM_STR);
            $statement->bindValue(':cultivoid', $parametro['cultivo'], PDO::PARAM_INT);
            $statement->bindValue(':usuarioid', $this->usuario[0]['usuarioid'], PDO::PARAM_INT);
            $statement->bindValue(':usuariopadreid', $this->usuario[0]['usuariopadreid'], PDO::PARAM_INT);
            // $statement ->bindValue(':sensorid',$parametro['sensorid'],PDO::PARAM_INT);
            $statement->bindValue(':lagoid', $lagoId, PDO::PARAM_INT);

            $statement->execute();
        } catch (PDOException  $Exception) {

            $result['estado'] = false;
            $result['mensaje'] = UserError::getInstance()->getError($Exception->getCode(), $Exception->getMessage());
        } finally {
            Conexion::cerrar($conn);
        }

        return $result;
    }

    private function getLago($sensorid)
    {
        $result = ['estado' => true, 'mensaje' => '', 'data' => null];
        $conn = Conexion::getInstance()->cnn();

        try {

            $sqlCommand = 'select lagoid from lagosensor where sensorid=:sensorid';

            $statement  = $conn->prepare($sqlCommand);
            $statement->bindValue(':sensorid', $sensorid, PDO::PARAM_INT);
            $statement->execute();
            $result['data'] = $statement->fetchAll();
        } catch (PDOException  $Exception) {

            $result['estado'] = false;
            $result['mensaje'] = UserError::getInstance()->getError($Exception->getCode(), $Exception->getMessage());
        } finally {
            Conexion::cerrar($conn);
        }

        return $result;
    }

    public function eliminar($parametro)
    {

        $result = ['estado' => true, 'mensaje' => 'Registro eliminado.', 'data' => null];
        $conn = Conexion::getInstance()->cnn();

        try {

            $sqlCommand = 'DELETE FROM estadofisicoquimico
                      WHERE estadofisicoquimicoid=:estadofisicoquimicoid';

            $statement  = $conn->prepare($sqlCommand);
            $statement->bindValue(':estadofisicoquimicoid', $parametro["id"], PDO::PARAM_INT);
            $statement->execute();
        } catch (PDOException  $Exception) {

            $result['estado'] = false;
            $result['mensaje'] = UserError::getInstance()->getError($Exception->getCode(), $Exception->getMessage());
        } finally {
            Conexion::cerrar($conn);
        }

        return $result;
    }

    public function actualizar($parametro)
    {

        $result = ['estado' => true, 'mensaje' => 'Registro actualizado.', 'data' => null];
        $conn = Conexion::getInstance()->cnn();

        try {

            $sqlCommand = 'UPDATE  estadofisicoquimico SET
                fecharegistro=CAST(:fecharegistro AS DATE),
                horaregistro=CAST(:horaregistro AS TIME),
                temperaturaambiente=:temperaturaambiente,
                temperaturaestanque=:temperaturaestanque,
                oxigenodisuelto=:oxigenodisuelto,
                ph=:ph,
                conductividadelectrica=:conductividadelectrica,
                amonionh3=:amonionh3,
                amonionh4=:amonionh4,
                nitrito=:nitrito,
                alcalinidad=:alcalinidad,
                pecesmuertos=:pecesmuertos,
                descripcion=:descripcion,
                cultivoid=:cultivoid,
                usuarioactulizaid=:usuarioactulizaid,
                fechaactualiza=NOW()
                WHERE estadofisicoquimicoid=:estadofisicoquimicoid;';

            $statement  = $conn->prepare($sqlCommand);
            $statement->bindValue(':fecharegistro', $parametro["fecharegistro"], PDO::PARAM_STR);
            $statement->bindValue(':horaregistro', $parametro["horaregistro"], PDO::PARAM_STR);
            $statement->bindValue(':temperaturaambiente', $parametro["temperaturaambiente"], PDO::PARAM_INT);
            $statement->bindValue(':temperaturaestanque', $parametro['temperaturaestanque'], PDO::PARAM_INT);
            $statement->bindValue(':oxigenodisuelto', $parametro["oxigenodisuelto"], PDO::PARAM_INT);
            $statement->bindValue(':ph', $parametro["ph"], PDO::PARAM_INT);
            $statement->bindValue(':conductividadelectrica', $parametro["conductividadelectrica"], PDO::PARAM_INT);
            $statement->bindValue(':amonionh3', $parametro['amonionh3'], PDO::PARAM_INT);
            $statement->bindValue(':amonionh4', $parametro['amonionh4'], PDO::PARAM_INT);
            $statement->bindValue(':nitrito', $parametro['nitrito'], PDO::PARAM_INT);
            $statement->bindValue(':alcalinidad', $parametro['alcalinidad'], PDO::PARAM_INT);
            $statement->bindValue(':pecesmuertos', $parametro['pecesmuertos'], PDO::PARAM_INT);
            $statement->bindValue(':descripcion', $parametro['descripcion'], PDO::PARAM_STR);
            $statement->bindValue(':cultivoid', $parametro['cultivo'], PDO::PARAM_INT);
            $statement->bindValue(':usuarioactulizaid', $this->usuario[0]['usuarioid'], PDO::PARAM_INT);
            $statement->bindValue(':estadofisicoquimicoid', $parametro['id'], PDO::PARAM_INT);

            $statement->execute();
        } catch (PDOException  $Exception) {

            $result['estado'] = false;
            $result['mensaje'] = UserError::getInstance()->getError($Exception->getCode(), $Exception->getMessage());
        } finally {
            Conexion::cerrar($conn);
        }

        return $result;
    }


    public function importar($parametro)
    {
        $result = true;
        $conn = Conexion::getInstance()->cnn();

        try {

            $objBase64 = new Base64($parametro["token"]);

            $objUsuario = new Usuario();
            $resulUsuairio = $objUsuario->consultarUsuarioToken($objBase64->decodeUsuario()["token"]);

            $obj = new Sonda();
            $value = $obj->prepararDato($parametro['importarText'], $resulUsuairio[0]['usuarioid']);

            $sqlCommand = 'INSERT INTO estadofisicoquimico(
                fecharegistro,
                horaregistro,
                temperaturaambiente,
                temperaturaestanque,
                oxigenodisuelto,
                ph,
                conductividadelectrica,
                amonionh3,
                amonionh4,
                nitrito,
                alcalinidad,
                pecesmuertos,
                descripcion,
                cultivoid,
                usuarioid2) VALUES ' . $value;

            $statement  = $conn->prepare($sqlCommand);
            $statement->execute();
        } catch (Exception $e) {
            $result = ["data" => $e->getMessage() . $sqlCommand];
        } finally {
            Conexion::cerrar($conn);
        }


        return $result;
    }


    public function prepararDato($importarText, $usuario)
    {
        $datos = explode('|', $importarText);
        $value = "";

        for ($i = 0; $i < count($datos); $i++) {
            $linea = explode(";", $datos[$i]);
            $text = "";
            $primera = "";
            $one = "";

            for ($j = 0; $j < count($linea); $j++) {
                $text .= $primera . "'" . str_replace(",", ".", $linea[$j]) . "'";
                if ($primera == "") {
                    $primera = ",";
                }
            }

            if ($one == "") {
                $one = ",";
            }
            if ($i == count($datos) - 1) {
                $one = "";
            }

            $value .= "  (" . $text . ", 17," . $usuario . ")  " . $one;
        }

        return $value;
    }
}

<?php

class Prediccion 
{
    public $usuario;

    public function consultar()
    {

        $url = 'http://127.0.0.1:8000/prediccion';
        // Crea un gestor curl con un protocolo con nombre erróneo en una URL
        $ch = curl_init($url);

        // Envía solicitud
        curl_exec($ch);

        // Valida si se ha producido errores y muestra el mensaje de error
        if ($errno = curl_errno($ch)) {
            $error_message = curl_strerror($errno);
            echo "cURL error ({$errno}):\n {$error_message}";
        }

        // Cierra el gestor
        curl_close($ch);


      /*  $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       // curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, false);
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Request Error: '.curl_error($ch);
        }

        return $result;*/

    }

}    


?>
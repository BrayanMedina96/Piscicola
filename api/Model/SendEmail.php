<?php

class SendEmail
{
    public $usuario;

    public function enviar($parametro){

        $result=['estado'=>true,'mensaje'=>'','data'=>null];

        $correo=new Correo();
        $result['data']= $correo->enviarCorreo($parametro);

        return  $result;
        
    }


}


?>
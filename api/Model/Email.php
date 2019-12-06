<?php

class Email
{


    public function gurdar()
    {

    }

    public function consultar()
    {

    }

    public function enviar()
    {

        
        require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

$Mensaje = "PRUEBA NUEVO CORREO";

$Mensaje  = "";



$VL_Prioridad = 1;

//			echo "De: $from     Para:$to";
 
// Indica si los datos provienen del formulario
	$correo='bh-medinac@corhuila.edu.co';
//	$correo='notificaciones@comfamiliarhuila.com';

	$mail = new PHPMailer; # Crea una instancia
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->Host ="smtp.gmail.com";   //"smtp.office365.com"; // SMTP server "10.10.1.67"; //
	$mail->SMTPAuth = true;
    $mail->Username =$correo;
	$mail->Password = 'brayanmedina1080296146';
	;// 'notificaciones@comfamiliarhuila.com';
	//---$mail->Priority = $VL_Prioridad;
	$mail->SMTPSecure = '';
	//$mail->ConfirmReadingTo = $from;
	$mail->setFrom($correo, 'GESTION');
	$mail->Port = 587;
	//$mail -> FromName = $Cargo;
	$mail -> AddAddress("brayanhhmmcc@gmail.com");// ("brayan.medina@comfamiliarhuila.com");

	$mail -> Subject = "prueba";
	$mail -> Body = $Mensaje;
	$mail -> AddReplyTo("brayanhhmmcc@gmail.com", "ok");
	$mail -> Sender = $correo;
	$mail -> IsHTML (true);
	$archivos = '';
    $msg = "Mensaje Enviado";
    
   
	
	if (!$mail -> Send ())
	{
		echo "No se pudo enviar el email ".$mail->ErrorInfo;
	}
	else
	{
		echo $msg ;
	}

	
   




    }


}

?>
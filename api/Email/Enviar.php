
<?php
//https://www.hostinger.co/tutoriales/como-usar-el-servidor-smtp-gmail-gratuito/

 require "PHPMailer.php";
 require "Exception.php";
 require "SMTP.php";
 
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\SMTP;

 class Correo 
 {
    public function enviar($username,$password,$setfrom,$enviara,$subject,$body)
    {
        $mail = new PHPMailer;
        $mail->isSMTP();
        
        $mail->Host ='smtp.gmail.com';
        $mail->Port = 587;
       
        $mail->SMTPAuth = true;
        $mail->isHTML(true);
       // $mail->SMTPDebug = 2;
       
        $mail->Username = $username; // Correo completo a utilizar
        $mail->Password = $password; // Contraseña
       
        $mail->setFrom($username, $setfrom);
       
        $mail->AddAddress($enviara);
       
        $mail->Subject = utf8_decode($subject);
       
        $mail->AltBody = '';
       
        $mail->Body = utf8_decode($body);
       
        
        $exito = $mail->send(); // Envía el correo.
        
        if ($exito) {
            return "El correo fue enviado correctamente.";
        } else {
           // echo  $mail->ErrorInfo;
            return "Hubo un inconveniente. Contacta a un administrador.";
        }
    }

    public function notificacionCuenta($correo,$usuario,$nombre)
    {
           $return="";

           $conn=Conexion::getInstance()->cnn();

           $sqlCommand ="SELECT correo,password,setfrom,subject,body FROM plantilla 
                        WHERE tipo='crearcuenta' AND estado='TRUE'";
           $statement  = $conn->prepare($sqlCommand);
           $statement ->execute();
           $result = $statement -> fetchAll();
           if(count( $result)>0)
           {
              $data= $result[0];
              $body=str_replace("@USUARIO",$usuario,$data['body']); 
              $body=str_replace("@CONTRASEÑA","Por definir.",$body); 
              $body=str_replace("@NOMBRE",$nombre,$body); 
              $return=  $this->enviar($data['correo'],$data['password'],$data['setfrom'],$correo,$data['subject'],$body);
           }
   
        return  $return;
    }

 }
 
 
 
 

?>
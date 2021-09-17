
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
        $mail->Port =587;//465;// 587;
       
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
            return "Hubo un inconveniente. Contacta a un administrador.".$mail->ErrorInfo;
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

    public function enviarCorreo($parametro,$usuarioid)
    {
          $return="";

           $conn=Conexion::getInstance()->cnn();

            $sqlCommand ="SELECT usuario.usuarionombre,persona.perosnanombre,persona.personaapellido,persona.personatelefono,persona.personacorreo from usuario
                         INNER JOIN persona ON usuario.personaid=persona.personaid
                         WHERE usuarioid=:usuarioid";
                            
            $statement  = $conn->prepare($sqlCommand);
            $statement ->bindValue(':usuarioid',$usuarioid,PDO::PARAM_INT);
            $statement ->execute();
            $result = $statement -> fetchAll();
            $persona=  $result[0];
            

           $sqlCommand ="SELECT correo,password,setfrom,subject,body,to_email_default FROM plantilla 
                        WHERE tipo='Solicitud' AND estado='TRUE'";
           $statement  = $conn->prepare($sqlCommand);
           $statement ->execute();
           $result = $statement -> fetchAll();

           if(count( $result)>0)
           {
              $data= $result[0];
              $body=str_replace("@tipo",$parametro['tipo'],$data['body']); 
              $body=str_replace("@usuario", $persona['usuarionombre'],$body); 
              $body=str_replace("@nombre",$persona['perosnanombre'].' '.$persona['personaapellido'],$body); 
              $body=str_replace("@telefono",$persona['personatelefono'],$body); 
              $body=str_replace("@correo",$persona['personacorreo'],$body); 
              $body=str_replace("@descripcion",$parametro['descripcion'],$body); 
              $body=str_replace("@urlsolicitud",URL,$body); 
              
              $return=  $this->enviar($data['correo'],$data['password'],$data['setfrom'],$data['to_email_default'],$data['subject'],$body);
           }
   
        return  $return;
    }

 }
 
 
 
 

?>

<?php
  
  $var='HOLA MUNDO'

?>
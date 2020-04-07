<?php
require 'db.php';
ob_start();
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
//Load Composer's autoloader
require 'vendor/autoload.php';


if($_SERVER['REQUEST_METHOD']== 'POST'){
    
    $email = $mysqli->escape_string($_POST['email']);
    
    $result = $mysqli->query("SELECT * FROM funcionarios WHERE email = '$email'");
    
    if($result -> num_rows == 0){
        echo $email;
        $_SESSION['message'] = "El usuario con este correo no fue encontrado!";
    }else{
        $user = $result->fetch_assoc();
        
        $email = $user['email'];
        $hash = $user['hash'];
        $nombre = $user['nombre'];
        
        $_SESSION['message']= 'Por favor revisa tu correo <strong>'.$email.'</strong>'
                .'Por un link de confirmación para completar el cambio de contraseña!';
        
        $para_usuario = $email;
        $subject = 'cambiar pasword (centralpoint.com)';
        $message_body = '
                Hola '.$nombre.',
                <br/> Has pedido un cambio de Contraseña!
                Por Favor haz click en el link para cambiar tu contraseña
                
                 http://centralpointacceso.com/acceso/LOGIN/reset.php?email='.$email.'&hash='.$hash;
        
        sendEmail($para_usuario, $subject, $message_body);
        header('Location:success.php');
        exit();
    }
}
function sendEmail($para_usuario, $subject, $message_body)
{
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'centralpointacceso@gmail.com';                 // SMTP username
                $mail->Password = 'acceso2018';                           // SMTP password
                $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587;                                    // TCP port to connect to

                //Recipients
                $mail->setFrom('centralpointacceso@gmail.com', 'Control de Acceso');
                $mail->addAddress($para_usuario);     // Add a recipient

                //Attachments
                //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

                //Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = $subject;
                $mail->Body    = $message_body;
    
                $mail->send();
                echo 'El mensaje fue enviado';
                } catch (Exception $e) {
                echo 'El mensaje no pudo ser enviado. Error: ', $mail->ErrorInfo;
        }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Recupera tu Contraseña</title>
        <meta charset="UTF-8">
        <?php include 'css/css.html';?>
    </head>
    <body>
        <div class="form" >
            <h1>Recupera tu contraseña</h1>
            
            <form action="forgot.php" method="post">
                <div>
                    <input class="form-control" type="email" placeholder="Ingresa tu correo" required autocomplete="off" name="email"/>
                </div>
                </br>
                <button class="button button-block"/>Enviar</button>
            </form>
        </div>
    </body>
</html>

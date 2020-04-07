<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require 'vendor/autoload.php';
    
    $_SESSION['nombre'] = $_POST['nombre'];
    $_SESSION['oficina'] = $_POST['oficina'];
    $_SESSION['email'] = $_POST['email'];
    
    $nombre = $mysqli -> escape_string($_POST['nombre']);
    $id = $mysqli -> escape_string($_POST['id']);
    $oficina = $mysqli -> escape_string($_POST['oficina']);
    $email = $mysqli -> escape_string($_POST['email']);
    //$password = $mysqli -> escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));
    $password = $mysqli -> escape_string($_POST['password']);
    $hash = $mysqli-> escape_string(md5(rand(0,1000)));
    
        
    $result= $mysqli-> query("select * from funcionarios where email= '$email'") or die($mysqli->error());
    
    if($result -> num_rows > 0){
        $_SESSION['message']="Usuario con este correo ya existe";
        header("Location: error.php");
        exit();
    } else {
        $sql="INSERT INTO funcionarios(nombre,identificacion,oficina,email,password,hash )"
                ."VALUES('$nombre','$id','$oficina','$email','$password','$hash')";
        if($mysqli->query($sql)){
            $_SESSION['logged_in']=true;
            
            $para_usuario = $email;
            $subject = 'Verifica tu cuenta';
            $message_body = 'hola '.$nombre. ', Gracias por Registrarse !
            Por favor confirma tu cuenta haciendo click en este link
            http://centralpointacceso.com/acceso/LOGIN/verificar.php?email='.$email.'&hash='.$hash;
            
            
                    
            //sendEmail($para_usuario, $subject, $message_body);
        
            //header('Location: perfil.php');
            //exit();
            
        }else{
            $_SESSION['message']="Ocurrio un Error";
            header("Location: error.php");
            exit();
        }
    }
    function sendEmail($para_usuario, $subject, $message_body){
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
    
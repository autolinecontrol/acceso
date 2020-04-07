<?php
ob_start();
session_start();
$dir = 'temp/';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
//Load Composer's autoloader
require 'vendor/autoload.php';
$nombrevisitante = "";
if(!file_exists($dir)){
    mkdir($dir);
}



if($_SESSION['logged_in']!== true){
    header("Location: index.php");
    exit();
}else{
    $usuario   = $_GET['iden'];
    $nombre  = $_SESSION['nombre'];
    $oficina = $_SESSION['oficina'];
    $email   = $_SESSION['email'];
    echo '<h2>'.'Anfitrion: '.$nombre.'</br>'.$oficina.'</h2>';
    require 'phpqrcode/qrlib.php';
    require 'conexion.php';
    require 'db.php';
    $result = $mysqli->query("SELECT * FROM funcionarios WHERE email = '$email'");

    if($result-> num_rows === 0){
        unset($_SESSION['logged_in']);
        $_SESSION['message']= 'Debes iniciar sesion antes de ver tu pagina de Perfil!';
        header("Location: error.php");
        exit();
    }else{
            
            $dir = 'temp/';
            $filename  = $dir.'test.png';
           
            $tamanio = 5;
            $level = 'M';
            $framesize = 3;
            $a = date("z");
            $contenido = $usuario*($a+1);
            QRcode::png($contenido, $filename, $level, $tamanio, $framesize);
            //echo '<img src="'.$filename.'" text/>';
            $resultado = mysqli_query($con, "select * from visitantes WHERE identificacion = $usuario");
            while($fila = mysqli_fetch_assoc($resultado))
            {
                $nombrevisitante= $fila['nombre'];
                $correovisitante = $fila['correo'];
                $codigovis = $fila['codigo'];
                $tipo = $fila['tipo'];
            }
            
            $_SESSION['message']= 'Por favor solicita a tu Invitado ingrese a su correo <strong>'.$correovisitante.'</strong>'
                .' Para recibir instrucciones para el uso del sistema e ingresar a tu evento!';
        
            $para_usuario = $correovisitante;
            $subject = 'Invitacion a Evento en Centro Empresarial Andino)';
            if($tipo == 'VISITANTE')
            {
                $message_body = '
                Estimado/a. ' .$nombrevisitante.',
                <BR>
                Ha sido Invitado a un Evento en Centro Empresarial Andino<br>
                1- Abra la imagen adjunta  <br>'.'
                2- Para el ingreso muestrela en el lector de codigo 2D Ubicado a la entrada de los pasillos.  <br>
                3- Aumente el brillo de su pantalla y coloque su celular a 15 centimetros del lector aproximadamente <br>
            
            NOTA: En caso de no contar con un celular, imprima la imagen adjunta, esta imagen solo sera valida para la fecha de la visita, este procedimiento se estara activo a partir del 2019-08-15 ';    
            }
            else
            {
            $message_body = '
                Estimado/a. ' .$nombrevisitante.',
                <BR>
                Ha sido Invitado a un Evento en Centro Empresarial Andino <br>
                1- Por Favor descargue la App  <br>'.
             "<a href='https://play.google.com/store/apps/details?id=com.autolinecontrol.inicio'> Google Play </a> <BR>".
             "<a href='https://itunes.apple.com/us/app/vip-access/id1451424415?l=es&ls=1&mt=8'> App Store </a><br>".
               '2- Ingrese y Escoja el Edificio <br> 
                3- Digita el usuario ( Correo ) <br> Su Clave es ('.$codigovis.') <br>'.'
                4- Genere su llave de acceso y Muestrela en el Lector de QR<br>'.

            'NOTA: En caso de no contar con un celular, imprima la imagen adjunta, esta imagen solo sera valida para la fecha de la visita, este procedimiento se estara activo a partir del 2019-08-15 <br>
               En caso de que no funcione la clave en su APP , desistale y vuelvala a instalar la Aplicacion';
            }
            sendEmail($para_usuario, $subject, $message_body);
            header('Location:success.php');
            exit();
        }
}
//echo '<img src="'.$filename.'" text/>';
function sendEmail($para_usuario, $subject, $message_body)
{
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
                $ruta = 'temp/test.png';
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
                $mail->addAttachment($ruta, 'QR.png');    // Optional name
                //$mail->AddEmbeddedImage($ruta, 'imagen'); //ruta de archivo de imagen
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
        <meta charset="UTF-8">
        <title>Success</title>
        <?php include 'css/css.html';?>
    </head>
    <body>
       <div class="form">
            <?php 
                echo '<img src="'.$filename.'" class="img-responsive";';
                echo '<h2>'.$nombrevisitante.'</br>Correo: '.$correovisitante.'</br>'.'Codigo: '.$codigovis.'</h2>';
                    
            ?> 
           
            <div class="h-30"></div>
        </div>
    </body>
</html>



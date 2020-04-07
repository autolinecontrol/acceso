<?php
$mysql_host    = 'localhost';
$mysql_usuario = 'mgeiqybt_autoline';
$mysql_clave   = 'acceso2018';
$mysql_BD      = 'mgeiqybt_CAP';

$con = mysqli_connect($mysql_host, $mysql_usuario,$mysql_clave,$mysql_BD);

$cnx =  new PDO("mysql:host=localhost;dbname=mgeiqybt_CAP","mgeiqybt_autoline","acceso2018");

$correo  = $_GET['correo'];
$cedula  = $_GET['cedula'];
$nombre  = $_GET['nombre'];
$oficina = $_GET['oficina'];

$tipo = "VISITANTE";

$resultado = mysqli_query($con, "select * from visitantes WHERE identificacion = $cedula");
            while($fila = mysqli_fetch_assoc($resultado))
            {
                $nombrevisitante= $fila['nombre'];
                $correovisitante = $fila['correo'];
                $codigo = $fila['codigo'];
                $tipo = $fila['tipo'];
            }

if($tipo=="VISITANTE")
{

$ingreso= date('Y-m-d').'T'.date('06:00');
$salida= date('Y-m-d').'T'.date('019:00');
  
$codigo = rand(1000, 9999);
$stat = 'M';
$cont='1';
$tipo='VISITANTE';
$carro='NO';

switch ($oficina) 
    {
    case "Administracion":
        $oficina = 1;
        break;
    case "MEDTRONIC":
        $oficina = 2;
        break;
    case "Davivienda":
        $oficina = 7;
        break;
    case "INVIAS":
        $oficina = 4;
        break;
    case "TCS":
        $oficina = 9;
        break;
    case "TINKKO":
        $oficina = 11;
        break;
    }
    

           
$res=$cnx->query("replace INTO visitantes (idvisitante,nombre,identificacion,codigo,Oficina,correo,Ingreso,Salida,estado,ncontroladora,tipo,vehiculo) VALUES ('', '$nombre', '$cedula', '$codigo', '$oficina','$correo','$ingreso','$salida','$stat','$cont','$tipo','$carro')");


}

require_once 'dbconfig.php';

 $query = "select * from visitantes where correo = '$correo'";
 
 $stmt = $DBcon->prepare($query);
 $stmt->execute();
 
 $userData = array();
 
 while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
  
  $userData['AllUsers'] = $row;
 }
 
 echo json_encode($userData);

?>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
//Load Composer's autoloader
require 'vendor/autoload.php';

$para_usuario = $correo;
$subject = 'Invitacion a Evento en Central Point)';
$message_body = 'Hola '.$nombre.',
                <br/> Para ingresar a la APP
                Ingresa el codigo '.$codigo;
            
sendEmail($para_usuario, $subject, $message_body);
header('Location:success.php');
exit();

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
                //$mail->addAttachment($ruta, 'QR.png');    // Optional name
                //$mail->AddEmbeddedImage($ruta, 'imagen'); //ruta de archivo de imagen
                //Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = $subject;
                $mail->Body    = $message_body;
    
                $mail->send();
                //echo 'El mensaje fue enviado';
                } 
                catch (Exception $e) 
                {
                echo 'El mensaje no pudo ser enviado. Error: ', $mail->ErrorInfo;
        }
}
           


?>

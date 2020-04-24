<?php
session_start();
$dir = 'temp/';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
//Load Composer's autoloader
require 'vendor/autoload.php';
require 'phpqrcode/qrlib.php';
require 'conexion.php';
require 'db.php';
$nombrevisitante = "";
if(!file_exists($dir)){
    mkdir($dir);
}
var_dump($_GET);

//_____________________________________________RECIBIMOS LAS VARIABLES Y ASIGNAMOS____________________________  

$nombreadmin    = $_SESSION['nombre'];
$documentoadmin = $_GET['documento'];   
$identificacion = $_GET['iden'];
$nombres        = $_GET['nombres'];
$correo         = $_GET['correo'];
$ingreso        = $_GET['ingreso'];
$salida         = $_GET['salida'];
$tipo           = $_GET['tipo'];
$carro          = $_GET['carro'];
$oficina        = $_GET['ofice'];
$grupoacceso    = $_GET['grupoacceso'];
$grupohorario   = $_GET['grupohorario'];
$grupodias      = $_GET['grupodias'];
$tipovehiculo   = $_GET['tipov'];
$nombre         = $_SESSION['nombre'];
$accion         = "REGISTRADO";
$cont           = 1;
$stat           = 'N';
if($carro=="NO")$tipovehiculo="NO";

//_______________________________________VALIDACION DE FECHA SALIDA VS FECHA INGRESO____________________

if($salida<$ingreso)
{     
    echo "<script type=\"text/javascript\">
    alert('La fecha final es menor a la fecha inicial');
    history.go(-1);
    </script>";
    exit;      
}

//_______________________________________ASIGNACION DE FECHAS MAXIMAS_____________________________________

if ($tipo == 'VISITANTE'){
    echo "ENTRO EN VISITANTES";
$fechamax= date("Y-m-d",strtotime($ingreso."+ 16 days"));
$grupohorario="1";
$grupodias="1";
$carro="NO";
$tipovehiculo="NO";
$looby=1;
}
if($tipo == 'CONTRATISTA')
$fechamax= date("Y-m-d",strtotime($ingreso."+ 91 days"));
if ($tipo == 'FUNCIONARIO')
$fechamax= date("Y-m-d",strtotime($ingreso."+ 367 days"));

//_______________________________________COMPARACION FECHA DE SALIDA CON FECHA MAXIMA_____________________

if ($salida>$fechamax) 
{
    echo "<script type=\"text/javascript\">
    alert('La fecha final no esta en el rango permitido');
    history.go(-1);
    </script>";
    exit;
}

//_____________________________________SE CREA LA FUNCION COMBROBAR NOMBRE_________________________________

function comprobarn($nombre)
{ 
    //compruebo que el tamaño del string sea válido. 
    if (strlen($nombre)<3 || strlen($nombre)>50)
    { 
        echo $nombre . " no es válido<br>"; 
        return false; 
    } 
    //compruebo que los caracteres sean los permitidos 
    $permitidos = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ "; 
    for ($i=0; $i<strlen($nombre); $i++)
    { 
        if (strpos($permitidos, substr($nombre,$i,1))===false)
        { 
            //  echo $nombre_usuario . " no es válido<br>"; 
            return false; 
        } 
    } 
    echo $nombre . " es válido<br>";  
    return true;
}
$validan = comprobarn($nombres);  
//________________________________________________SE VALIDA EL NOMBRE__________________________________
if(!$validan>0)
{   
    unset($_SESSION['logged_in']);
    $_SESSION['message']= 'El nombre registrado no pude contener tildes (´), ni (ñ), ni puntos Gracias, Vuelve a Inicar Sesión ';
    header("Location: error.php");
    exit();   
}

        //_______________________________________________INSERTAR EN LOG REGISTROS_________________________________

        $sqllog="INSERT INTO logregistros (idLog,Administrador,idVisitante,idAutoriza,Oficina,Fechainicio
        ,Fechafin,Tipo,Accion,Vehiculo,Tipovehiculo,Correo,grupohorario,grupoacceso,grupodias) VALUES (NULL,  '$nombreadmin', '$identificacion'
        ,'$documentoadmin','$oficina','$ingreso','$salida','$tipo','$accion','$carro','$tipovehiculo','$correo'
        ,'$grupohorario','$grupoacceso','$grupodias')";
        echo "<b>".$sqllog."</b>"."<br>";//exit;
        $resultadolog = mysqli_query($con,$sqllog);

        //____________________________________________INSERTAR EN VISITANTES______________________________________

        $sqlvisi="REPLACE INTO visitantes (idvisitante,nombre,identificacion,Oficina,correo,Ingreso
        ,Salida,estado,ncontroladora,tipo,vehiculo,Tipovehiculo,grupoacceso,grupohorario,grupodias) 
        VALUES (NULL,  '$nombres','$identificacion','$oficina','$correo','$ingreso','$salida','$stat',
        '$cont','$tipo','$carro','$tipovehiculo','$grupoacceso','$grupohorario','$grupodias')";
        $resultadovisi = mysqli_query($con,$sqlvisi);
        echo "<b>".$sqlvisi."</b>"."<br>"; 
     

//____________________________________________FUNCION INSERTAR USUARIOS______________________________________

function insertaru ($con,$identificacion, $ingreso,$salida,$id
,$stat,$carro,$oficina,$grupo,$grupohorario,$grupodias,$torre,
$tipovehiculo)
{
    $sqlinsertarusuarios="INSERT INTO usuarios 
    (idusuarios,identificacion,fechainicio,fechafin,ncontroladora
    ,estado,vehiculo,oficina,grupo,grupohorario,grupodias,torre,tipovehiculo) 
    VALUES (NULL, '$identificacion', '$ingreso','$salida','$id'
    ,'$stat','$carro','$oficina','$grupo','$grupodias','$grupohorario','$torre','$tipovehiculo')";
    //echo "<b>".$sqlinsertarusuarios."</b>"."<br>"; 
    $resultado1 = mysqli_query($con,$sqlinsertarusuarios);     
}

//____________________________________________TRAER DATOS DE GRUPO ACCESO________________________________________

$sqltraergrupo="SELECT * FROM grupo_acceso WHERE id='$grupoacceso'";
$resultadogrupoa = mysqli_query($con,$sqltraergrupo);
$torre="";
$p5=0;
$p6=0;
$p7=0;
$p8=0;
$p9=0;
$p10=0;
$p11=0;
$p12=0;
$p14=0;
$p15=0;
$sotanos=0;
$looby=0;
$pv=0;
$pf=0;
while($fila = mysqli_fetch_assoc($resultadogrupoa))
{
    $torre=$fila['torre'];
    if($fila['p5']==1)$p5=1;
    if($fila['p6']==1)$p6=1;
    if($fila['p7']==1)$p7=1;
    if($fila['p8']==1)$p8=1;
    if($fila['p9']==1)$p9=1;
    if($fila['p10']==1)$p10=1;
    if($fila['p11']==1)$p11=1;
    if($fila['p12']==1)$p12=1;
    if($fila['p14']==1)$p14=1;
    if($fila['p15']==1)$p15=1;
    if($fila['sotanos']==1)$sotanos=1;
    if($fila['looby']==1)$looby=1;
    if($fila['pv']==1)$pv=1;
    if($fila['pf']==1)$pf=1;
}

//_____________________________________BORRAMOS REGISTROS ANTERIORES____________________________________

$sqlborrar = "DELETE FROM usuarios WHERE identificacion='$identificacion'";
$resultadoborrar = mysqli_query($con,$sqlborrar);

//_____________________________________RECORRER CADA GRUPO DE CONTRALODARAS_______________________________
$contador=0;

if($p5==1)
{
    $sqlcontroladoras="SELECT idcontroladora,Torre FROM controladoras WHERE grupo =5";
    $grupo=5;
    $resultadocontroladoras = mysqli_query($con,$sqlcontroladoras);
    while($fila = mysqli_fetch_assoc($resultadocontroladoras))
    {
        if($torre==3)
        {
            $validainsert=insertaru($con,$identificacion, $ingreso,$salida,$fila['idcontroladora']
            ,$stat,$carro,$oficina,$grupo,$grupohorario,$grupodias,$fila['Torre'],
            $tipovehiculo);
            $contador++;           
            echo $validainsert;
        }
        if($torre==$fila['Torre'])
        {
            $validainsert=insertaru($con,$identificacion, $ingreso,$salida,$fila['idcontroladora']
            ,$stat,$carro,$oficina,$grupo,$grupohorario,$grupodias,$torre,
            $tipovehiculo);
            $contador++;           
            echo $validainsert;
        }
    }
}

if($p6==1)
{
    $sqlcontroladoras="SELECT idcontroladora,Torre FROM controladoras WHERE grupo= 6";
    $resultadocontroladoras = mysqli_query($con,$sqlcontroladoras);
    $grupo=6;
    while($fila = mysqli_fetch_assoc($resultadocontroladoras))
    {
        if($torre==3)
        {
            $validainsert=insertaru($con,$identificacion, $ingreso,$salida,$fila['idcontroladora']
            ,$stat,$carro,$oficina,$grupo,$grupohorario,$grupodias,$fila['Torre'],
            $tipovehiculo);
            $contador++;           
            echo $validainsert;
        }
        if($torre==$fila['Torre'])
        {
            $validainsert=insertaru($con,$identificacion, $ingreso,$salida,$fila['idcontroladora']
            ,$stat,$carro,$oficina,$grupo,$grupohorario,$grupodias,$torre,
            $tipovehiculo);
            $contador++;           
            echo $validainsert;
        }
    }
}

if($p7==1)
{
    $sqlcontroladoras="SELECT idcontroladora,Torre FROM controladoras WHERE grupo =7";
    $resultadocontroladoras = mysqli_query($con,$sqlcontroladoras);
    $grupo=7;
    while($fila = mysqli_fetch_assoc($resultadocontroladoras))
    {
        if($torre==3)
        {
            $validainsert=insertaru($con,$identificacion, $ingreso,$salida,$fila['idcontroladora']
            ,$stat,$carro,$oficina,$grupo,$grupohorario,$grupodias,$fila['Torre'],
            $tipovehiculo);
            $contador++;           
            echo $validainsert;
        }
        if($torre==$fila['Torre'])
        {
            $validainsert=insertaru($con,$identificacion, $ingreso,$salida,$fila['idcontroladora']
            ,$stat,$carro,$oficina,$grupo,$grupohorario,$grupodias,$torre,
            $tipovehiculo);
            $contador++;           
            echo $validainsert;
        }
    }
}

if($p8==1)
{
    $sqlcontroladoras="SELECT idcontroladora,Torre FROM controladoras WHERE grupo =8";
    $resultadocontroladoras = mysqli_query($con,$sqlcontroladoras);
    $grupo=8;
    while($fila = mysqli_fetch_assoc($resultadocontroladoras))
    {
        if($torre==3)
        {
            $validainsert=insertaru($con,$identificacion, $ingreso,$salida,$fila['idcontroladora']
            ,$stat,$carro,$oficina,$grupo,$grupohorario,$grupodias,$fila['Torre'],
            $tipovehiculo);
            $contador++;           
            echo $validainsert;
        }
        if($torre==$fila['Torre'])
        {
            $validainsert=insertaru($con,$identificacion, $ingreso,$salida,$fila['idcontroladora']
            ,$stat,$carro,$oficina,$grupo,$grupohorario,$grupodias,$torre,
            $tipovehiculo);
            $contador++;           
            echo $validainsert;
        }
    }
}

if($p9==1)
{
    $sqlcontroladoras="SELECT idcontroladora,Torre FROM controladoras WHERE grupo =9";
    $resultadocontroladoras = mysqli_query($con,$sqlcontroladoras);
    $grupo=9;
    while($fila = mysqli_fetch_assoc($resultadocontroladoras))
    {
        if($torre==3)
        {
            $validainsert=insertaru($con,$identificacion, $ingreso,$salida,$fila['idcontroladora']
            ,$stat,$carro,$oficina,$grupo,$grupohorario,$grupodias,$fila['Torre'],
            $tipovehiculo);
            $contador++;           
            echo $validainsert;
        }
        if($torre==$fila['Torre'])
        {
            $validainsert=insertaru($con,$identificacion, $ingreso,$salida,$fila['idcontroladora']
            ,$stat,$carro,$oficina,$grupo,$grupohorario,$grupodias,$torre,
            $tipovehiculo);
            $contador++;           
            echo $validainsert;
        }
    }
}

if($p10==1)
{
    $sqlcontroladoras="SELECT idcontroladora,Torre FROM controladoras WHERE grupo =10";
    $resultadocontroladoras = mysqli_query($con,$sqlcontroladoras);
    $grupo=10;
    while($fila = mysqli_fetch_assoc($resultadocontroladoras))
    {
        if($torre==3)
        {
            $validainsert=insertaru($con,$identificacion, $ingreso,$salida,$fila['idcontroladora']
            ,$stat,$carro,$oficina,$grupo,$grupohorario,$grupodias,$fila['Torre'],
            $tipovehiculo);
            $contador++;           
            echo $validainsert;
        }
        if($torre==$fila['Torre'])
        {
            $validainsert=insertaru($con,$identificacion, $ingreso,$salida,$fila['idcontroladora']
            ,$stat,$carro,$oficina,$grupo,$grupohorario,$grupodias,$torre,
            $tipovehiculo);
            $contador++;           
            echo $validainsert;
        }
    }
}

if($p11==1)
{
    $sqlcontroladoras="SELECT idcontroladora,Torre FROM controladoras WHERE grupo =11";
    $resultadocontroladoras = mysqli_query($con,$sqlcontroladoras);
    $grupo=11;
    while($fila = mysqli_fetch_assoc($resultadocontroladoras))
    {
        if($torre==3)
        {
            $validainsert=insertaru($con,$identificacion, $ingreso,$salida,$fila['idcontroladora']
            ,$stat,$carro,$oficina,$grupo,$grupohorario,$grupodias,$fila['Torre'],
            $tipovehiculo);
            $contador++;           
            echo $validainsert;
        }
        if($torre==$fila['Torre'])
        {
            $validainsert=insertaru($con,$identificacion, $ingreso,$salida,$fila['idcontroladora']
            ,$stat,$carro,$oficina,$grupo,$grupohorario,$grupodias,$torre,
            $tipovehiculo);
            $contador++;           
            echo $validainsert;
        }
    }
}

if($p12==1)
{
    $sqlcontroladoras="SELECT idcontroladora,Torre FROM controladoras WHERE grupo =12";
    $resultadocontroladoras = mysqli_query($con,$sqlcontroladoras);
    $grupo=12;
    while($fila = mysqli_fetch_assoc($resultadocontroladoras))
    {
        if($torre==3)
        {
            $validainsert=insertaru($con,$identificacion, $ingreso,$salida,$fila['idcontroladora']
            ,$stat,$carro,$oficina,$grupo,$grupohorario,$grupodias,$fila['Torre'],
            $tipovehiculo);
            $contador++;           
            echo $validainsert;
        }
        if($torre==$fila['Torre'])
        {
            $validainsert=insertaru($con,$identificacion, $ingreso,$salida,$fila['idcontroladora']
            ,$stat,$carro,$oficina,$grupo,$grupohorario,$grupodias,$torre,
            $tipovehiculo);
            $contador++;           
            echo $validainsert;
        }
    }
}

if($p14==1)
{
    $sqlcontroladoras="SELECT idcontroladora,Torre FROM controladoras WHERE grupo =14";
    $resultadocontroladoras = mysqli_query($con,$sqlcontroladoras);
    $grupo=14;
    while($fila = mysqli_fetch_assoc($resultadocontroladoras))
    {
        if($torre==3)
        {
            $validainsert=insertaru($con,$identificacion, $ingreso,$salida,$fila['idcontroladora']
            ,$stat,$carro,$oficina,$grupo,$grupohorario,$grupodias,$fila['Torre'],
            $tipovehiculo);
            $contador++;           
            echo $validainsert;
        }
        if($torre==$fila['Torre'])
        {
            $validainsert=insertaru($con,$identificacion, $ingreso,$salida,$fila['idcontroladora']
            ,$stat,$carro,$oficina,$grupo,$grupohorario,$grupodias,$torre,
            $tipovehiculo);
            $contador++;           
            echo $validainsert;
        }
    }
}

if($p15==1)
{
    $sqlcontroladoras="SELECT idcontroladora,Torre FROM controladoras WHERE grupo =15";
    $resultadocontroladoras = mysqli_query($con,$sqlcontroladoras);
    $grupo=15;
    while($fila = mysqli_fetch_assoc($resultadocontroladoras))
    {
        if($torre==3)
        {
            $validainsert=insertaru($con,$identificacion, $ingreso,$salida,$fila['idcontroladora']
            ,$stat,$carro,$oficina,$grupo,$grupohorario,$grupodias,$fila['Torre'],
            $tipovehiculo);
            $contador++;           
            echo $validainsert;
        }
        if($torre==$fila['Torre'])
        {
            $validainsert=insertaru($con,$identificacion, $ingreso,$salida,$fila['idcontroladora']
            ,$stat,$carro,$oficina,$grupo,$grupohorario,$grupodias,$torre,
            $tipovehiculo);
            $contador++;           
            echo $validainsert;
        }
    }
}
if($sotanos==1)
{
    $sqlcontroladoras="SELECT idcontroladora,Torre FROM controladoras WHERE grupo =1";
    $resultadocontroladoras = mysqli_query($con,$sqlcontroladoras);
    $grupo=1;
    while($fila = mysqli_fetch_assoc($resultadocontroladoras))
    {
        if($torre==3)
        {
            $validainsert=insertaru($con,$identificacion, $ingreso,$salida,$fila['idcontroladora']
            ,$stat,$carro,$oficina,$grupo,$grupohorario,$grupodias,$fila['Torre'],
            $tipovehiculo);
            $contador++;           
            echo $validainsert;
        }
        if($torre==$fila['Torre'])
        {
            $validainsert=insertaru($con,$identificacion, $ingreso,$salida,$fila['idcontroladora']
            ,$stat,$carro,$oficina,$grupo,$grupohorario,$grupodias,$torre,
            $tipovehiculo);
            $contador++;           
            echo $validainsert;
        }
    }
}
if($looby==1)
{
    $sqlcontroladoras="SELECT idcontroladora,Torre FROM controladoras WHERE grupo =4";
    echo "Esta es la torre $torre ";
    $resultadocontroladoras = mysqli_query($con,$sqlcontroladoras);
    $grupo=4;
    while($fila = mysqli_fetch_assoc($resultadocontroladoras))
    {
        if($torre==3)
        {
            $validainsert=insertaru($con,$identificacion, $ingreso,$salida,$fila['idcontroladora']
            ,$stat,$carro,$oficina,$grupo,$grupohorario,$grupodias,$fila['Torre'],
            $tipovehiculo);
            $contador++;           
            echo $validainsert;
        }
        if($torre==$fila['Torre'])
        {
            $validainsert=insertaru($con,$identificacion, $ingreso,$salida,$fila['idcontroladora']
            ,$stat,$carro,$oficina,$grupo,$grupohorario,$grupodias,$torre,
            $tipovehiculo);
            $contador++;           
            echo $validainsert;
        }
    }
}
if($pv==1)
{
    $sqlcontroladoras="SELECT idcontroladora,Torre FROM controladoras WHERE grupo =2";
    $resultadocontroladoras = mysqli_query($con,$sqlcontroladoras);
    $grupo=2;
    while($fila = mysqli_fetch_assoc($resultadocontroladoras))
    {
        if($torre==3)
        {
            $validainsert=insertaru($con,$identificacion, $ingreso,$salida,$fila['idcontroladora']
            ,$stat,$carro,$oficina,$grupo,$grupohorario,$grupodias,$fila['Torre'],
            $tipovehiculo);
            $contador++;           
            echo $validainsert;
        }
        if($torre==$fila['Torre'])
        {
            $validainsert=insertaru($con,$identificacion, $ingreso,$salida,$fila['idcontroladora']
            ,$stat,$carro,$oficina,$grupo,$grupohorario,$grupodias,$torre,
            $tipovehiculo);
            $contador++;           
            echo $validainsert;
        }
    }
}
if($pf==1)
{
    $sqlcontroladoras="SELECT idcontroladora,Torre FROM controladoras WHERE grupo =3";
    $resultadocontroladoras = mysqli_query($con,$sqlcontroladoras);
    $grupo=3;
    while($fila = mysqli_fetch_assoc($resultadocontroladoras))
    {
        if($torre==3)
        {
            $validainsert=insertaru($con,$identificacion, $ingreso,$salida,$fila['idcontroladora']
            ,$stat,$carro,$oficina,$grupo,$grupohorario,$grupodias,$fila['Torre'],
            $tipovehiculo);
            $contador++;           
            echo $validainsert;
        }
        if($torre==$fila['Torre'])
        {
            $validainsert=insertaru($con,$identificacion, $ingreso,$salida,$fila['idcontroladora']
            ,$stat,$carro,$oficina,$grupo,$grupohorario,$grupodias,$torre,
            $tipovehiculo);
            $contador++;           
            echo $validainsert;
        }
    }
}
exit;
//_______________________________________________ENVIAR CORREOS__________________________________
function enviarcorreos($correovisitante,$identificacion,$nombrevisitante,$con)
{       
   
    $dir = 'temp/';
    $filename  = $dir.'test.png';        
    $tamanio = 5;
    $level = 'M';
    $framesize = 3;
    $id = $identificacion;
    $contenido = $identificacion;
    QRcode::png($contenido, $filename, $level, $tamanio, $framesize);
    echo '<img src="'.$filename.'" text/>';          
    $_SESSION['message']= 'Ingreso al edificio Teleport <strong>'.$correovisitante.'</strong>'
    .' Instrucciones para el uso del sistema de Control de  Acceso! ';       
    $para_usuario = $correovisitante;$subject = 'Descubre la Nueva Forma de Ingresar al Edificio Teleport';
    $message_body = 'Estimado/a. ' .$nombrevisitante.',
    <BR>
    Bienvenido al Edificio Teleport.<br>
    A continuación encontrarás los pasos que te permitirán descargar tu código QR, 
    con el que podrás ingresar a las instalaciones del edificio.
    <br>
    Paso 1 Descarga la Imagen de Codigo QR<br>
    Paso 2 Aumenta el brillo de tu Celular<br>
    Paso 3 Presenta la Imagen en el lector QR 
    ';
    echo $para_usuario,$subject."<br>";
    sendEmail($para_usuario, $subject, $message_body, $con,$id);
    $_SESSION['message']= 'Por favor solicita a tu Invitado ingrese a su correo <strong>'.$correovisitante.'</strong>'
    .' Para recibir instrucciones para el uso del sistema e ingresar a tu evento!';
    header('Location:success.php');
    exit;
    echo '<img src="'.$filename.'" text/>';
    
}

function sendEmail($para_usuario, $subject, $message_body,$con,$id)
{
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
        $validar=0;
                $ruta = 'temp/test.png';
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication  
                $mail->Username = 'teleportacceso@gmail.com';                 // SMTP username
                $mail->Password = 'Acceso2020';                           // SMTP password
                $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587;                                    // TCP port to connect to
                //Recipients
                $mail->setFrom('teleportacceso@gmail.com', 'Control de Acceso Edificio Teleport');
                $mail->addAddress($para_usuario);     // Add a recipient

                //Attachments
                //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                $mail->addAttachment($ruta, 'QR.png');    // Optional name
                //$mail->AddEmbeddedImage($ruta, 'imagen'); //ruta de archivo de imagen
                //Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = $subject;
                $mail->Body    = $message_body;
                echo $id;
               
                $mail->send();
                echo 'El mensaje fue enviado a '.$para_usuario;
                } catch (Exception $e) {
                    $validar=1;
                echo 'El mensaje no pudo ser enviado. Error: ', $mail->ErrorInfo;
    }
}

enviarcorreos($correo,$identificacion,$nombres,$conn);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Success</title>
        <?php include '/css/style.css'; ?>
  <link rel= "stylesheet" type="text/css" href= "css/style.css"/>
 
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
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



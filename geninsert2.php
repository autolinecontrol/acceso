<?php
error_reporting(0);
ob_start();
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
if($_SESSION['logged_in']!== true){
    header("Location: index.php");
    exit();
}else
{  
    $nombreadmin  = $_SESSION['nombre'];
    $documentoadmin = $_GET['documento'];   
    $usuario   = $_GET['iden'];
    $nombres   = $_GET['nombres'];
    $correo    = $_GET['correo'];
    $ingreso   = $_GET['ingreso'];
    $salida    = $_GET['salida'];
    $tipo      = $_GET['tipo'];
    $carro     = $_GET['carro'];
    $ofice     = $_GET['ofice'];
    $grupo     = $_GET['grupo'];
    $tipovehiculo =$_GET['tipov'];
    $nombre  = $_SESSION['nombre'];
    $oficina = $_SESSION['oficina'];
    $email   = $_SESSION['email'];   
    $accion="REGISTRADO";
    echo "este es el tipo".$tipo;
    echo '<h2>'.'Anfitrion: '.$nombre.'</br>'.$oficina.'</h2>';  
    if($salida<$ingreso)
    {     
        echo "<script type=\"text/javascript\">
        alert('La fecha final es menor a la fecha inicial');
        history.go(-1);
        </script>";
        exit;      
    }
    else
    {
        //Aqui asignamos los grupos de acceso de acuerdo al tipo de usuario
        if ($tipo == 'VISITANTE')
        {
            if($grupo== '')$grupo = 1;
            $fechamax= date("Y-m-d",strtotime($ingreso."+ 16 days"));
        }
        if ($tipo == 'CONTRATISTA')
        {
	        if($grupo=='')$grupo = 3;
            $fechamax= date("Y-m-d",strtotime($ingreso."+ 91 days"));
        }
        if ($tipo == 'FUNCIONARIO')
        {
	        if($grupo=='')$grupo = 2;
            $fechamax= date("Y-m-d",strtotime($ingreso."+ 367 days"));
        } 
        echo "Tipo".$tipo;
        echo "Salida".$salida;
        echo "fecha maxima".$fechamax;
        if ($salida>$fechamax) {
            echo "<script type=\"text/javascript\">
            alert('La fecha final no esta en el rango permitido');
            history.go(-1);
            </script>";
            exit;
        }
        
    }
}
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
echo $validan;
if($validan>0)
{      
}
else
{
    unset($_SESSION['logged_in']);
    $_SESSION['message']= 'El nombre registrado no pude contener tildes (´), ni (ñ), ni puntos Gracias, Vuelve a Inicar Sesión ';
    header("Location: error.php");
    exit();
}
//Validamos que la variable caarro haya llegado y si no llego le damos un valor negativo
if(!isset($_GET['carro']))$carro="NO";
//Si carro tiene valor no entonces tipovehiculo tambien valdra no
if($carro=="NO")$tipovehiculo="NO";
//exit;
$cont=1;
//Insertar en el log
$sqllog="insert INTO logregistros(idLog,Administrador,idVisitante,idAutoriza,Oficina,Fechainicio,Fechafin,Tipo,Accion,Vehiculo,Tipovehiculo,Correo) VALUES (NULL,  '$nombreadmin', '$usuario','$documentoadmin','$ofice','$ingreso','$salida','$tipo','$accion','$carro','$tipovehiculo','$correo')";
echo "<b>".$sqllog."</b>"."<br>";//exit;
$resultado = mysqli_query($con,$sqllog);
$stat = 'N';
//------------Insertar en visitantes--------------
$sqlvisi="replace INTO visitantes(idvisitante,nombre,identificacion,Oficina,correo,Ingreso,Salida,estado,ncontroladora,tipo,vehiculo,Tipovehiculo,grupo) VALUES (NULL,  '$nombres', '$usuario','$ofice','$correo','$ingreso','$salida','$stat','$cont','$tipo','$carro','$tipovehiculo','$grupo')";
$resultado = mysqli_query($con,$sqlvisi);
echo "<b>".$sqlvisi."</b>"."<br>"; //exit;
//Contamos cuantas controladoras hay en el sistema
$numerocontroladoras=0;
$sqlcontarcontroladoras="SELECT COUNT(*) AS C FROM controladoras";
$resultcontarcontroladoras=mysqli_query($con,$sqlcontarcontroladoras); 
while($fila = mysqli_fetch_assoc($resultcontarcontroladoras))
{
    $numerocontroladoras=$fila['C'];
} 
$result = $mysqli->query("SELECT * FROM funcionarios WHERE email = '$email'");
$sqlmostraroficina="Select idcontroladora,Grupo from controladoras ";
$resultadooficina = mysqli_query($con,$sqlmostraroficina);                               
while($fila = mysqli_fetch_assoc($resultadooficina))
{
    $matriz[$fila['idcontroladora']]=$fila['Grupo'];
	//$grupocontroladora=$fila['Grupo'];
	//$idcontroladora=$fila['idcontroladora'];
	//echo $idcontroladora.'-'.$grupocontroladora.'<br>';
} 
//exit;
if($result-> num_rows === 0)
{
    unset($_SESSION['logged_in']);
    $_SESSION['message']= 'Debes iniciar sesion antes de ver tu pagina de Perfil!';
    header("Location: error.php");
    exit();
}
else
{         
    $codigo = rand(1000, 9999);         
    $cont='1';//Aqui voy
    echo 'usuario para registrar '.$usuario; 
    $consulta = "SELECT COUNT(*) FROM usuarios where identificacion = '$usuario' ";
    if ($resultado = $mysqli->query($consulta)) 
    {
        $fila = $resultado->fetch_row();     
        $numerous = $fila[0];
        printf(" us %d\n", $numerous);
        echo '<br>';  
        /* liberar el conjunto de resultados */
        $resultado->close();
    }
    if($numerous > 0)
    {
        echo 'ya existe';    
        $perfiltiempo = 1;
        $dias = 7;            
        //for($i=1;$i<=$numerocontroladoras;$i++)    
        //{   
         $sql = "delete from usuarios WHERE identificacion='$usuario'";
        if (mysqli_query($mysqli, $sql)) 
         {
             echo "Record updated successfully";
         } 
        else 
        {
            echo "Error updating record: " . mysqli_error($mysqli);
        }
    }
    //Insertar datos por grupo
    echo 'GRUPO '.$grupo;
    //exit;
    //Creamos la funcion insert de usuarios
    function insertaru ($con,$usuario, $ingreso,$salida,$i,$stat,$carro,$ofice,$grupo,	$perfiltiempo,$dias,$tipovehiculo)
    {
        $perfiltiempo=1;
        $dias=7;
        echo "la controladora es igual a ".$i." y el grupo es igual a ".$grupo."<br>"; 
        echo 'dato '.$g.'-'.$matriz[$k].'<br>';
        $sqlinsertarusuarios="insert INTO usuarios 
        (idusuarios,identificacion,fechainicio,fechafin,ncontroladora
        ,estado,vehiculo,oficina,grupo) 
        VALUES (NULL, '$usuario', '$ingreso','$salida','$i'
        ,'$stat','$carro','$ofice','$grupo')";
        echo "<b>".$sqlinsertarusuarios."</b>"."<br>"; 
        $resultado1 = mysqli_query($con,$sqlinsertarusuarios);     
    }
$validainsert=0;
echo "<b>".$grupo."</b>"."<br>";
switch ($grupo) 
{  
    case 1:
    {
        echo "<b>Numero Controladoras".$numerocontroladoras."</b>"."<br>";
        for($i=1;$i<=$numerocontroladoras;$i++)    
        {   
            echo 'dato'.$grupo.'-'.$matriz[$i].'<br>';
            if($matriz[$i]==1)
            {
                $grupo=1;
                $validainsert=insertaru($con,$usuario, $ingreso,$salida,$i
                ,$stat,$carro,$ofice,$grupo,$perfiltiempo,$dias,
                $tipovehiculo);           
                echo $validainsert;
            }
            if($matriz[$i]==10)
            {
                $grupo=10;
                $validainsert=insertaru($con,$usuario, $ingreso,$salida,$i
                ,$stat,$carro,$ofice,$grupo,$perfiltiempo,$dias,
                $tipovehiculo);           
                echo $validainsert;
            }
            if($matriz[$i]==11)
            {
                $grupo=11;
                $validainsert=insertaru($con,$usuario, $ingreso,$salida,$i
                ,$stat,$carro,$ofice,$grupo,$perfiltiempo,$dias,
                $tipovehiculo);           
                echo $validainsert;
            }
        }
    }
    break;
    case 2:
    {
        for($i=1;$i<=$numerocontroladoras;$i++)    
        {           
            if($matriz[$i]==1)
            {
                $grupo=1;
                $validainsert=insertaru($con,$usuario, $ingreso,$salida,$i
                ,$stat,$carro,$ofice,$grupo,$perfiltiempo,$dias,
                $tipovehiculo);           
                echo $validainsert;
            }
            if($matriz[$i]==2)
            {
                $grupo=2;
                $validainsert=insertaru($con,$usuario, $ingreso,$salida,$i
                ,$stat,$carro,$ofice,$grupo,$perfiltiempo,$dias,
                $tipovehiculo);           
                echo $validainsert;
            }
            
            if($matriz[$i]==10)
            {
                $grupo=10;
                $validainsert=insertaru($con,$usuario, $ingreso,$salida,$i
                ,$stat,$carro,$ofice,$grupo,$perfiltiempo,$dias,
                $tipovehiculo);           
                echo $validainsert;
            }
            if($matriz[$i]==11)
            {
                $grupo=11;
                $validainsert=insertaru($con,$usuario, $ingreso,$salida,$i
                ,$stat,$carro,$ofice,$grupo,$perfiltiempo,$dias,
                $tipovehiculo);           
                echo $validainsert;
            }
        }
    }
    break;
    case 3:
    {
        for($i=1;$i<=$numerocontroladoras;$i++)    
        {           
            if($matriz[$i]==1)
            {
                $grupo=1;
                $validainsert=insertaru($con,$usuario, $ingreso,$salida,$i
    		    ,$stat,$carro,$ofice,$grupo,$perfiltiempo,$dias,
    		    $tipovehiculo);           
                echo $validainsert;
            }
            if($matriz[$i]==2)
            {
                $grupo=2;
                $validainsert=insertaru($con,$usuario, $ingreso,$salida,$i
    		    ,$stat,$carro,$ofice,$grupo,$perfiltiempo,$dias,
    		    $tipovehiculo);           
                echo $validainsert;
            }
            if($matriz[$i]==3)
            {
                $grupo=3;
                $validainsert=insertaru($con,$usuario, $ingreso,$salida,$i
    		    ,$stat,$carro,$ofice,$grupo,$perfiltiempo,$dias,
    		    $tipovehiculo);           
                echo $validainsert;
            }
            if($matriz[$i]==10)
            {
                $grupo=10;
                $validainsert=insertaru($con,$usuario, $ingreso,$salida,$i
                ,$stat,$carro,$ofice,$grupo,$perfiltiempo,$dias,
                $tipovehiculo);           
                echo $validainsert;
            }
            if($matriz[$i]==11)
            {
                $grupo=11;
                $validainsert=insertaru($con,$usuario, $ingreso,$salida,$i
                ,$stat,$carro,$ofice,$grupo,$perfiltiempo,$dias,
                $tipovehiculo);           
                echo $validainsert;
            }
        }
    }
    break;
    case 4:
    {
        for($i=1;$i<=$numerocontroladoras;$i++)    
        {           
            if($matriz[$i]==3)
            {
                $grupo=3;
                $validainsert=insertaru($con,$usuario, $ingreso,$salida,$i
    		    ,$stat,$carro,$ofice,$grupo,$perfiltiempo,$dias,
    		    $tipovehiculo);           
                echo $validainsert;
            }
            if($matriz[$i]==4)
            {
                $grupo=4;
                $validainsert=insertaru($con,$usuario, $ingreso,$salida,$i
    		    ,$stat,$carro,$ofice,$grupo,$perfiltiempo,$dias,
    		    $tipovehiculo);           
                echo $validainsert;
            }
        }
    }
    break;
    mysqli_close($conn);             
}   

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
    $_SESSION['message']= 'Ingreso a la UGC <strong>'.$correovisitante.'</strong>'
    .' Instrucciones para el uso del sistema de Control de  Acceso! ';       
    $para_usuario = $correovisitante;$subject = 'Descubre la Nueva Forma de Ingresar a tu Universidad';
    $message_body = 'Estimado/a. ' .$nombrevisitante.',
    <BR>
    Bienvenido a la Universidad La Gran Colombia.<br>
    A continuación encontrarás los pasos que te permitirán descargar tu código QR, 
    con el que podrás ingresar a las instalaciones de la Universidad.
    <br><br>Disponible en la manzana central, Próximamente estará disponible en los demás edificios.<br>
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
                $mail->Username = 'carne.virtual@ugc.edu.co';                 // SMTP username
                $mail->Password = 'Acceso2020*';                           // SMTP password
                $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587;                                    // TCP port to connect to
                //Recipients
                $mail->setFrom('carne.virtual@ugc.edu.co', 'Control de Acceso Universidad Gran Colombia');
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

enviarcorreos($correo,$usuario,$nombres,$conn);
echo "Fuera de las funciones";
exit;    
 }

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



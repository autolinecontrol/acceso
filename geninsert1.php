<?php
error_reporting(0);
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
    $numerocontroladoras = 44;
    echo '<h2>'.'Anfitrion: '.$nombre.'</br>'.$oficina.'</h2>';
    require 'phpqrcode/qrlib.php';
    require 'conexion.php';
    require 'db.php';
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

        if ($tipo == 'VISITANTE')
        {
            if($grupo== '')$grupo = 1;
            $fechamax= date("Y-m-d",strtotime($ingreso."+ 16 days"));
        }
        if ($tipo == 'CONTRATISTA')
        {
	        if($grupo=='')$grupo = 2;
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


//Insertar en el log
$sqllog="insert INTO logregistros(idLog,Administrador,idVisitante,idAutoriza,Oficina,Fechainicio,Fechafin,Tipo,Accion,Vehiculo,Tipovehiculo,Correo) VALUES (NULL,  '$nombreadmin', '$usuario','$documentoadmin','$ofice','$ingreso','$salida','$tipo','$accion','$carro','$tipovehiculo','$correo')";
//echo $sqllog;exit;
$resultado = mysqli_query($con,$sqllog);
$stat = 'N';
//------------Insertar en visitantes--------------
$sqlvisi="replace INTO visitantes                 (idvisitante,nombre,identificacion,codigo,Oficina,correo,Ingreso,Salida,estado,ncontroladora,tipo,vehiculo,Tipovehiculo,grupo) VALUES (NULL,  '$nombres', '$usuario', '$codigo','$ofice','$correo','$ingreso','$salida','$stat','$cont','$tipo','$carro','$tipovehiculo','$grupo')";
$resultado = mysqli_query($con,$sqlvisi);
//echo $sqlvisi; exit;
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
        //Insertar datos por grupo
        echo 'GRUPO '.$grupo;
        //exit;
        switch ($grupo) 
        {  
            case 1:
            {
                for($i=1;$i<=$numerocontroladoras;$i++)    
                {   
                    echo 'dato'.$grupo.'-'.$matriz[$i].'<br>';
                    if($matriz[$i]==$grupo)
                    {				
                        $resultado1 = mysqli_query($con, "insert INTO usuarios (idusuarios,identificacion,fechainicio,fechafin,ncontroladora,estado,vehiculo,oficina,grupo,perfiltiempo,dias,tipov) VALUES (NULL, '$usuario', '$ingreso','$salida','$i','$stat','$carro','$ofice','$grupo','$perfiltiempo','$dias','$tipovehiculo')");        
                        echo 'datos'.$i.'<br>';
                    }
                }
            }
            break;
            case 2:
            {
                for($i=1;$i<=$numerocontroladoras;$i++)    
                {   
                    echo 'dato'.$grupo.'-'.$matriz[$i].'<br>';
                    if($matriz[$i]==1)
                    {
                        $grupo=1;
                        $resultado1 = mysqli_query($con, "insert INTO usuarios (idusuarios,identificacion,fechainicio,fechafin,ncontroladora,estado,vehiculo,oficina,grupo,perfiltiempo,dias,tipov) VALUES (NULL, '$usuario', '$ingreso','$salida','$i','$stat','$carro','$ofice','$grupo','$perfiltiempo','$dias','$tipovehiculo')");
                        echo 'datos'.$i.'<br>';
                    }
                }
                for($i=1;$i<=$numerocontroladoras;$i++)    
                {                    
                    echo 'dato'.$grupo.'-'.$matriz[$i].'<br>';
                    if($matriz[$i]==2)
                    {
                        $grupo=2;
                        $resultado1 = mysqli_query($con, "insert INTO usuarios (idusuarios,identificacion,fechainicio,fechafin,ncontroladora,estado,vehiculo,oficina,grupo,perfiltiempo,dias,tipov) VALUES (NULL, '$usuario', '$ingreso','$salida','$i','$stat','$carro','$ofice','$grupo','$perfiltiempo','$dias','$tipovehiculo')");            
                        echo 'datos'.$i.'<br>';
                    }
                }
            }
            break;
            case 3:
            {
                for($i=1;$i<=$numerocontroladoras;$i++)    
                {   
                    echo 'dato'.$grupo.'-'.$matriz[$i].'<br>';
                    if($matriz[$i]==1)
                    {
                        $grupo=1;				
                        $resultado1 = mysqli_query($con, "insert INTO usuarios (idusuarios,identificacion,fechainicio,fechafin,ncontroladora,estado,vehiculo,oficina,grupo,perfiltiempo,dias,tipov) VALUES (NULL, '$usuario', '$ingreso','$salida','$i','$stat','$carro','$ofice','$grupo','$perfiltiempo','$dias','$tipovehiculo')");                
                        echo 'datos'.$i.'<br>';
                    }
                }

                for($i=1;$i<=$numerocontroladoras;$i++)    
                {   
                    $grupo=2;
                    echo 'dato'.$grupo.'-'.$matriz[$i].'<br>';
                    if($matriz[$i]==2)
                    {
                        $resultado1 = mysqli_query($con, "insert INTO usuarios (idusuarios,identificacion,fechainicio,fechafin,ncontroladora,estado,vehiculo,oficina,grupo,perfiltiempo,dias,tipov) VALUES (NULL, '$usuario', '$ingreso','$salida','$i','$stat','$carro','$ofice','$grupo','$perfiltiempo','$dias','$tipovehiculo')");
                        echo 'datos'.$i.'<br>';
                    }
                }                        
                for($i=1;$i<=$numerocontroladoras;$i++)    
                {   
                    echo 'dato'.$grupo.'-'.$matriz[$i].'<br>';
                        if($matriz[$i]==3)
                        {
                            $grupo=3;
                            $resultado1 = mysqli_query($con, "insert INTO usuarios (idusuarios,identificacion,fechainicio,fechafin,ncontroladora,estado,vehiculo,oficina,grupo,perfiltiempo,dias,tipov) VALUES (NULL, '$usuario', '$ingreso','$salida','$i','$stat','$carro','$ofice','$grupo','$perfiltiempo','$dias','$tipovehiculo')");
                            echo 'datos'.$i.'<br>';
                        }
                }
            }
            break;
        mysqli_close($conn);             
        }
    }
    else
    {         
        $perfiltiempo = 1;
        $dias = 7;              
        //Restriccion de ingresos grupo		                
        switch ($grupo) 
        {
            case 1:
            {
                for($i=1;$i<=$numerocontroladoras;$i++)    
                {   
                    echo 'dato'.$grupo.'-'.$matriz[$i].'<br>';
                    if($matriz[$i]==$grupo)
                    {
                        $resultado1 = mysqli_query($con, "insert INTO usuarios (idusuarios,identificacion,fechainicio,fechafin,ncontroladora,estado,vehiculo,oficina,grupo,perfiltiempo,dias,tipov) VALUES (NULL, '$usuario', '$ingreso','$salida','$i','$stat','$carro','$ofice','$grupo','$perfiltiempo','$dias','$tipovehiculo')");
                        echo 'datos'.$i.'<br>';
                    }
                }
            }
            break;
            case 2:
            {
                for($i=1;$i<=$numerocontroladoras;$i++)    
                {   
                    echo 'dato'.$grupo.'-'.$matriz[$i].'<br>';
                    if($matriz[$i]==1)
                    {
                        $grupo=1;  $resultado1 = mysqli_query($con, "insert INTO usuarios (idusuarios,identificacion,fechainicio,fechafin,ncontroladora,estado,vehiculo,oficina,grupo,perfiltiempo,dias,tipov) VALUES (NULL, '$usuario', '$ingreso','$salida','$i','$stat','$carro','$ofice','$grupo','$perfiltiempo','$dias','$tipovehiculo')");
                        echo 'datos'.$i.'<br>';
                    }
                }
                for($i=1;$i<=$numerocontroladoras;$i++)    
                {   
                    echo 'dato'.$grupo.'-'.$matriz[$i].'<br>';
                    if($matriz[$i]==2)
                    {
                        $grupo=2;  
                        $resultado1 = mysqli_query($con, "insert INTO usuarios (idusuarios,identificacion,fechainicio,fechafin,ncontroladora,estado,vehiculo,oficina,grupo,perfiltiempo,dias,tipov) VALUES (NULL, '$usuario', '$ingreso','$salida','$i','$stat','$carro','$ofice','$grupo','$perfiltiempo','$dias','$tipovehiculo')");
                        echo 'datos'.$i.'<br>';
                    }
                }
            }
            break;
            case 3:
            {
                for($i=1;$i<=$numerocontroladoras;$i++)    
                {   
                    echo 'dato'.$grupo.'-'.$matriz[$i].'<br>';
                    if($matriz[$i]==1)
                    {
                        $grupo=1;  
                        $resultado1 = mysqli_query($con, "insert INTO usuarios (idusuarios,identificacion,fechainicio,fechafin,ncontroladora,estado,vehiculo,oficina,grupo,perfiltiempo,dias,tipov) VALUES (NULL, '$usuario', '$ingreso','$salida','$i','$stat','$carro','$ofice','$grupo','$perfiltiempo','$dias','$tipovehiculo')");
                        echo 'datos'.$i.'<br>';
                    }
                }
                for($i=1;$i<=$numerocontroladoras;$i++)    
                {   
                    echo 'dato'.$grupo.'-'.$matriz[$i].'<br>';
                    if($matriz[$i]==2)
                    {
                        $grupo=2;
                        $resultado1 = mysqli_query($con, "insert INTO usuarios (idusuarios,identificacion,fechainicio,fechafin,ncontroladora,estado,vehiculo,oficina,grupo,perfiltiempo,dias,tipov) VALUES (NULL, '$usuario', '$ingreso','$salida','$i','$stat','$carro','$ofice','$grupo','$perfiltiempo','$dias','$tipovehiculo')");
                        echo 'datos'.$i.'<br>';
                    }
                }
                for($i=1;$i<=$numerocontroladoras;$i++)    
                {   
                    echo 'dato'.$grupo.'-'.$matriz[$i].'<br>';
                    if($matriz[$i]==3)
                    {
                        $grupo=3;  
                        $resultado1 = mysqli_query($con, "insert INTO usuarios (idusuarios,identificacion,fechainicio,fechafin,ncontroladora,estado,vehiculo,oficina,grupo,perfiltiempo,dias,tipov) VALUES (NULL, '$usuario', '$ingreso','$salida','$i','$stat','$carro','$ofice','$grupo','$perfiltiempo','$dias','$tipovehiculo')");
                        echo 'datos'.$i.'<br>';
                    }
                }   
            }
            break;
        }                        
    }   
    $dir = 'temp/';
    $filename  = $dir.'test.png';        
    $tamanio = 5;
    $level = 'M';
    $framesize = 3;
    $contenido = $usuario;
    QRcode::png($contenido, $filename, $level, $tamanio, $framesize);
    echo '<img src="'.$filename.'" text/>';
    $resultado = mysqli_query($con, "select * from visitantes WHERE identificacion = $usuario");
    while($fila = mysqli_fetch_assoc($resultado))
    {
        $nombrevisitante= $fila['nombre'];
        $correovisitante = $fila['correo'];
        $codigovis = $fila['codigo'];
    }            
    $_SESSION['message']= 'Por favor solicita a tu Invitado ingrese a su correo <strong>'.$correovisitante.'</strong>'
    .' Para recibir instrucciones para el uso del sistema e ingresar a tu evento!';       
    $para_usuario = $correovisitante;$subject = 'Invitacion al Centro de Negocios Central Point';
    if($tipo == 'VISITANTE')
    {
        $message_body = '
        Estimado/a. ' .$nombrevisitante.',
        <BR>
        Ha sido Invitado a un Evento en Centro de Negocios Central Point<br>
        1- Abra la imagen adjunta  <br>'.'
        2- Para el ingreso muestrela en el lector de codigo 2D Ubicado a la entrada de los pasillos.  <br>
        3- Aumente el brillo de su pantalla y coloque su celular a 15 centimetros del lector aproximadamente <br>   
        NOTA: En caso de no contar con un celular, imprima la imagen adjunta, esta imagen solo sera valida para la fecha de la visita';    
    }
    else
    {
        $message_body = '
        Estimado/a. ' .$nombrevisitante.',
        <BR>
        Ha sido Invitado a un Evento en Centro de Negocios Central Point<br>
        1- Por Favor descargue la App  <br>'.
        "<a href='https://play.google.com/store/apps/details?id=com.autolinecontrol.inicio'> Google Play </a> <BR>".
        "<a href='https://itunes.apple.com/us/app/vip-access/id1451424415?l=es&ls=1&mt=8'> App Store </a><br>".
        '2- Ingrese y Escoja el Edificio <br> 
        3- Digita el usuario ( Correo ) <br> Su Clave es ('.$codigovis.') <br>'.'
        4- Genere su llave de acceso y Muestrela en el Lector de QR<br>'.
        'NOTA: En caso de no contar con un celular, imprima la imagen adjunta, esta imagen solo sera valida para la fecha de la visita, este procedimiento se estara activo a partir del 2019-09-15 <br>
        En caso de que no funcione la clave en su APP , desistale y vuelvala a instalar la Aplicacion';
    }
    //sendEmail($para_usuario, $subject, $message_body);
    header('Location:success.php');
    exit();       
}

echo '<img src="'.$filename.'" text/>';
function sendEmail($para_usuario, $subject, $message_body)
{
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
                $ruta = 'temp/test.png';
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'andinocentroempresarial@gmail.com';                 // SMTP username
                $mail->Password = 'Soport32019*';                           // SMTP password
                $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587;                                    // TCP port to connect to

                //Recipients
                $mail->setFrom('andinocentroempresarial@gmail.com', 'Control de Acceso');
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



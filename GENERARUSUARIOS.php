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
}else{
    
    $usuario   = $_GET['iden'];
    $nombres   = $_GET['nombres'];
    $correo    = $_GET['correo'];
    $ingreso   = $_GET['ingreso'];
    $salida    = $_GET['salida'];
    $tipo      = $_GET['tipo'];
    $carro     = $_GET['carro'];
    $ofice     = $_GET['ofice'];
    $grupo     = $_GET['grupo'];
    $nombre  = $_SESSION['nombre'];
    $oficina = $_SESSION['oficina'];
    $email   = $_SESSION['email'];
$sqlvisi="Select * from visitantes where Oficina='24'";
    $numerocontroladoras = 0;
    $grupo=1;
    echo '<h2>'.'Anfitrion: '.$nombre.'</br>'.$oficina.'</h2>';
    require 'phpqrcode/qrlib.php';
    require 'conexion.php';
    require 'db.php';
$stat = 'N';
    $result = $mysqli->query("SELECT * FROM funcionarios WHERE email = '$email'");
    
    $consulta = "SELECT COUNT(*) FROM controladoras where grupo = '$grupo'";
    if ($resultado = $mysqli->query($consulta)) 
    {
        $fila = $resultado->fetch_row();
        $numerocontroladoras = $fila[0];
        printf("La Consulta devolvió %d\n", $numerocontroladoras);
        echo '<br>';
        /* liberar el conjunto de resultados */
        $resultado->close();
    }
    if($result-> num_rows === 0){
        unset($_SESSION['logged_in']);
        $_SESSION['message']= 'Debes iniciar sesion antes de ver tu pagina de Perfil!';
        header("Location: error.php");
        exit();
    }else{            
            $recorrer=mysqli_query($con,$sqlvisi);
	while($filarecorrer = mysqli_fetch_assoc($recorrer)){
	//if($x==3){exit;}
		
	$usuario=$filarecorrer['identificacion'];
      
   
    $ingreso   = $filarecorrer['Ingreso'];
    $salida    = $filarecorrer['Salida'];
    
    $carro     = $filarecorrer['vehiculo'];
    $ofice     = $filarecorrer['Oficina'];
      
            $stat = 'N';
            $cont='21';//Aqui voy

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
                
                for($i=1;$i<=$numerocontroladoras;$i++)    
                {   
                    $sql = "UPDATE usuarios SET fechainicio = '$ingreso',fechafin = '$salida',estado = '$stat',vehiculo = '$carro',oficina='$ofice',grupo='$grupo',perfiltiempo = '$perfiltiempo',dias = '$dias' WHERE identificacion='$usuario'";

                    if (mysqli_query($mysqli, $sql)) {
                        echo "Record updated successfully";
                    } 
                    else {
                        echo "Error updating record: " . mysqli_error($mysqli);
                    }

                   mysqli_close($conn);
                
                    echo 'datos'.$i.'<br>';
                }
                
            }
            else
            {
                
                $perfiltiempo = 1;
                $dias = 7;
                
                
                
                
                //$i=1;

		if($tipo=='VISITANTE')
		$numerocontroladoras=16;
		if($tipo=='FUNCIONARIO')
		$numerocontroladoras=48;
                
                for($i=1;$i<=$numerocontroladoras;$i++)    
                {   

                    $resultado1 = mysqli_query($con, "insert INTO usuarios (idusuarios,identificacion,fechainicio,fechafin,ncontroladora,estado,vehiculo,oficina,grupo,perfiltiempo,dias) VALUES ('', '$usuario', '$ingreso','$salida','$i','$stat','$carro','$ofice','$grupo','$perfiltiempo','$dias')");
                
                    echo 'datos'.$i.'<br>';
                }
             } //$x=$x+1;  
               
            }
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



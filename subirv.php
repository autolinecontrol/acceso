<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    
	<link href="StyleSheet.css" rel="stylesheet" />
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	   <!-- Latest compiled JavaScript -->
	<script src="bootstrap/js/bootstrap.min.js"></script>
        
       <title>Subida de Masivos Visitantes</title>

	   <link rel="stylesheet" href="assets/demo.css">
	   <link rel="stylesheet" href="assets/header-second-bar.css">
	   <link href='http://fonts.googleapis.com/css?family=Cookie' rel='stylesheet' type='text/css'>
	   <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

</head>

<body>
    
<a href="perfil.php">Registro</a>
<br>
<?php
$contador=0;
error_reporting(E_ERROR | E_WARNING | E_PARSE);
date_default_timezone_set("America/Bogota");
echo "La hora en Colombia es: " . date ("H:i",time()) . "<br />";
session_start();

require 'conexion.php';
require 'db.php';
$ingreso   = $_POST['ingreso'];
$salida    = $_POST['salida'];
$oficina     = $_POST['ofice'];
$nombreadmin = $_POST['admin'];
$grupoacceso= $_POST['grupoacceso'];
$grupohorario= $_POST['grupohorario'];
$grupodias= $_POST['grupodias'];  
$documentoadmin=$_SESSION['Identificacion'];
$accion ="REGISTRADO";

?>
<?php
function comprobarn($nombre){ 
   //compruebo que el tamaño del string sea válido. 
   if (strlen($nombre)<3 || strlen($nombre)>50){ 
      //echo $nombre . " no es válido<br>"; 
      return false; 
   } 

   //compruebo que los caracteres sean los permitidos 
   $permitidos = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ "; 
   for ($i=0; $i<strlen($nombre); $i++){ 
      if (strpos($permitidos, substr($nombre,$i,1))===false){ 
       //  echo $nombre_usuario . " no es válido2<br>"; 
         return false; 
      } 
   } 
   //echo $nombre_usuario . " es válido3<br>"; 
   return true; 
} 
function comprobare($evento){ 
   //compruebo que el tamaño del string sea válido. 
   if (strlen($evento)<3 || strlen($evento)>40){ 
      //echo $evento. " no es válido4<br>"; 
      return false; 
   } 
   //compruebo que los caracteres sean los permitidos 
   $permitidos = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"; 
   for ($i=0; $i<strlen($evento); $i++){ 
      if (strpos($permitidos, substr($evento,$i,1))===false){ 
       //  echo $nombre_usuario . " no es válido5<br>"; 
         return false; 
      } 
   } 
   //echo $nombre_usuario . " es válido6<br>"; 
   return true; 
} 
function comprobarc($cedula){ 
   //compruebo que el tamaño del string sea válido. 
   if (strlen($cedula)<3 || strlen($cedula)>15){ 
     // echo $nombre_usuario . " no es válido7<br>"; 
      return false; 
   } 

   //compruebo que los caracteres sean los permitidos 
   $permitidos = "0123456789"; 
   for ($i=0; $i<strlen($cedula); $i++){ 
      if (strpos($permitidos, substr($cedula,$i,1))===false){ 
           // echo $nombre_usuario . " no es válido8<br>"; 
         return false; 
      } 
   } 
   //echo $nombre_usuario . " es válido9<br>"; 
   return true; 
} 

function comprobarf($ingreso,$salida){ 
   //compruebo que el tamaño del string sea válido. 
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
         $fechamax= date("Y-m-d",strtotime($ingreso."+ 367  days"));
         if ($salida>$fechamax) {
            
                
                echo "<script type=\"text/javascript\">
           alert('La fecha final no esta en el rango de 15 diasa la fecha inicial');
           history.go(-1);
       </script>";
                exit;
      
            }
    }
   }
    function insertaru ($con,$identificacion, $ingreso,$salida,$id
    ,$stat,$carro,$oficina,$grupohorario,$grupodias,$torre,
    $tipovehiculo)
    {
        $stat='N';
        $sqlinsertarusuarios="INSERT INTO usuarios 
        (idusuarios,identificacion,fechainicio,fechafin,ncontroladora
        ,estado,vehiculo,oficina,grupohorario,grupodias,torre,tipovehiculo) 
        VALUES (NULL, '$identificacion', '$ingreso','$salida','$id'
        ,'$stat','$carro','$oficina','$grupodias','$grupohorario','$torre','$tipovehiculo')";
        //echo "<b>".$sqlinsertarusuarios."</b>"."<br>"; 
        $resultado1 = mysqli_query($con,$sqlinsertarusuarios);     
    }
    $validaf = comprobarf($ingreso,$salida);
?>

<?php
/**
 *
 * @author   Horacio Romero Mendez (angelos)
 * @License   Copyleft 2011
 * @since   Sep 4, 2011 5:20:20 PM
 * @Internal  GNU/Linux Arch 2010.05 Notebook
 * 
 */


//OBTENER EL ARCHIVO QUE SE SUBIÓ
foreach($_FILES as $campo => $texto)
 eval("\$".$campo."='".$texto."';");


//COMO EL INPUT FILE FUE LLAMADO archivo ENTONCES ACCESAMOS A TRAVÉS DE $_FILES["archivo"]
?>
<table align="center">
 <tr>
  <td>
   <b>Nombre:</b>: <?php echo $_FILES["archivo"]["name"]?>
       
   <b>Tipo:</b>: <?php echo $_FILES["archivo"]["type"]?>
       
   <b>Subida:</b>: <?php echo ($_FILES["archivo"]["error"]) ? "Incorrecta" : "Correcta"?>
       
   <b>Tamaño:</b>: <?php echo $_FILES["archivo"]["size"]?> bytes
  </td>
 </tr>
</table>


<?php

//SI EL ARCHIVO SE ENVIÓ Y ADEMÁS SE SUBIO CORRECTAMENTE
if (isset($_FILES["archivo"]) && is_uploaded_file($_FILES['archivo']['tmp_name'])) {
 
 //SE ABRE EL ARCHIVO EN MODO LECTURA
 $fp = fopen($_FILES['archivo']['tmp_name'], "r");
 //SE RECORRE
  $cont = 0;
  echo "<div class = 'container'>
    <table class = 'table table-striped table-bordered'>
        <tr>
            <th>Cedula </th>
            <th>Nombre </th>
            <th>Correo</th>
            <th>Fecha Inicio</th>
            <th>Fecha Fin</th>
            <th>Oficina</th>
            <th>Estado</th>
            
            
        </tr>
          ";
          
        $nregistros=0;
        $nvalidos=0;
        $ninvalidos=0;
 while (!feof($fp)){ //LEE EL ARCHIVO A DATA, LO VECTORIZA A DATA
  
  //SI SE QUIERE LEER SEPARADO POR TABULADORES
  //$data  = explode(" ", fgets($fp));
  //SI SE LEE SEPARADO POR COMAS
  $data  = explode(";", fgets($fp));
  
  //AHORA DATA ES UN VECTOR Y EN CADA POSICIÓN CONTIENE UN VALOR QUE ESTA SEPARADO POR COMA.
  
  //SI QUEREMOS IMPRIMIR UN SOLO DATO
  //echo "<br/>Invitado: {$data[0]}.{$data[1]}.{$data[2]}.{$data[3]}<br/>";
 
  $cedula  = $data[0];
  $nombre  = $data[1];
  $nombre1 = $data[2];
  $correo  = $data[3];
  $carro= $data[4];
  $tipovehiculo= $data[5];
  $identificacion=$cedula;
  //$ingreso = $data[4];
  //$salida  = $data[5];
  //$oficina = $data[6];
 
 $nombre = $nombre." ".$nombre1;
  
  $validon = comprobarn($nombre);
  $validoc = comprobarc($cedula);
  // $validoe = comprobare($evento);
  
  $time = strtotime($fecha);
  $feven = date('Y-m-d',$time);
  $valido = $validon + $validoc;
  
  
  //echo $validoc."-".$cedula."-".$validon."-".$nombre."-".$correo."-".$oficina."<br>";
  
 
  $codigo = rand(1000, 9999);
  $stat = 'L';
  $cont='1';
  $tipo='FUNCIONARIO';
  $cedula1=$cedula;
  $nombres = $nombre;
  $ingreso1 = $ingreso;
  $salida1 = $salida;
  $oficina1 = $oficina;
  $correo1 = $correo;
  
  $usuario=$cedula;
  $ofice=$oficina1;
  
	// echo "fecha del evento ".$feven." CEDULA".$cedula;
	 
  
   
if($valido > 1 && $cedula != '') 
{
        
    if($nombre != '')
    {
        //_______________________________________________INSERTAR EN LOG REGISTROS_________________________________

        $sqllog="INSERT INTO logregistros (idLog,Administrador,idVisitante,idAutoriza,Oficina,Fechainicio
        ,Fechafin,Tipo,Accion,Vehiculo,Tipovehiculo,Correo,grupohorario,grupoacceso,grupodias) VALUES (NULL,  '$nombreadmin', '$identificacion'
        ,'$documentoadmin','$oficina','$ingreso','$salida','$tipo','$accion','$carro','$tipovehiculo','$correo'
        ,'$grupohorario','$grupoacceso','$grupodias')";
        //echo "<b>".$sqllog."</b>"."<br>";//exit;
        $resultadolog = mysqli_query($con,$sqllog);

        //____________________________________________INSERTAR EN VISITANTES______________________________________

        $sqlvisi="REPLACE INTO visitantes (idvisitante,nombre,identificacion,Oficina,correo,Ingreso
        ,Salida,estado,ncontroladora,tipo,vehiculo,Tipovehiculo,grupoacceso,grupohorario,grupodias) 
        VALUES (NULL,  '$nombres','$identificacion','$oficina','$correo','$ingreso','$salida','$stat',
        '$cont','$tipo','$carro','$tipovehiculo','$grupoacceso','$grupohorario','$grupodias')";
        $resultadovisi = mysqli_query($con,$sqlvisi);
        //echo "<b>".$sqlvisi."</b>"."<br>"; 
     
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
    $resultadocontroladoras = mysqli_query($con,$sqlcontroladoras);
    while($fila = mysqli_fetch_assoc($resultadocontroladoras))
    {
        if($torre==3)
        {
            $validainsert=insertaru($con,$identificacion, $ingreso,$salida,$fila['idcontroladora']
            ,$stat,$carro,$oficina,$grupohorario,$grupodias,$fila['Torre'],
            $tipovehiculo);
            $contador++;           
            echo $validainsert;
        }
        if($torre==$fila['Torre'])
        {
            $validainsert=insertaru($con,$identificacion, $ingreso,$salida,$fila['idcontroladora']
            ,$stat,$carro,$oficina,$grupohorario,$grupodias,$torre,
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
    while($fila = mysqli_fetch_assoc($resultadocontroladoras))
    {
        if($torre==3)
        {
            $validainsert=insertaru($con,$identificacion, $ingreso,$salida,$fila['idcontroladora']
            ,$stat,$carro,$oficina,$grupohorario,$grupodias,$fila['Torre'],
            $tipovehiculo);
            $contador++;           
            echo $validainsert;
        }
        if($torre==$fila['Torre'])
        {
            $validainsert=insertaru($con,$identificacion, $ingreso,$salida,$fila['idcontroladora']
            ,$stat,$carro,$oficina,$grupohorario,$grupodias,$torre,
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
    while($fila = mysqli_fetch_assoc($resultadocontroladoras))
    {
        if($torre==3)
        {
            $validainsert=insertaru($con,$identificacion, $ingreso,$salida,$fila['idcontroladora']
            ,$stat,$carro,$oficina,$grupohorario,$grupodias,$fila['Torre'],
            $tipovehiculo);
            $contador++;           
            echo $validainsert;
        }
        if($torre==$fila['Torre'])
        {
            $validainsert=insertaru($con,$identificacion, $ingreso,$salida,$fila['idcontroladora']
            ,$stat,$carro,$oficina,$grupohorario,$grupodias,$torre,
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
    while($fila = mysqli_fetch_assoc($resultadocontroladoras))
    {
        if($torre==3)
        {
            $validainsert=insertaru($con,$identificacion, $ingreso,$salida,$fila['idcontroladora']
            ,$stat,$carro,$oficina,$grupohorario,$grupodias,$fila['Torre'],
            $tipovehiculo);
            $contador++;           
            echo $validainsert;
        }
        if($torre==$fila['Torre'])
        {
            $validainsert=insertaru($con,$identificacion, $ingreso,$salida,$fila['idcontroladora']
            ,$stat,$carro,$oficina,$grupohorario,$grupodias,$torre,
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
    while($fila = mysqli_fetch_assoc($resultadocontroladoras))
    {
        if($torre==3)
        {
            $validainsert=insertaru($con,$identificacion, $ingreso,$salida,$fila['idcontroladora']
            ,$stat,$carro,$oficina,$grupohorario,$grupodias,$fila['Torre'],
            $tipovehiculo);
            $contador++;           
            echo $validainsert;
        }
        if($torre==$fila['Torre'])
        {
            $validainsert=insertaru($con,$identificacion, $ingreso,$salida,$fila['idcontroladora']
            ,$stat,$carro,$oficina,$grupohorario,$grupodias,$torre,
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
    while($fila = mysqli_fetch_assoc($resultadocontroladoras))
    {
        if($torre==3)
        {
            $validainsert=insertaru($con,$identificacion, $ingreso,$salida,$fila['idcontroladora']
            ,$stat,$carro,$oficina,$grupohorario,$grupodias,$fila['Torre'],
            $tipovehiculo);
            $contador++;           
            echo $validainsert;
        }
        if($torre==$fila['Torre'])
        {
            $validainsert=insertaru($con,$identificacion, $ingreso,$salida,$fila['idcontroladora']
            ,$stat,$carro,$oficina,$grupohorario,$grupodias,$torre,
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
    while($fila = mysqli_fetch_assoc($resultadocontroladoras))
    {
        if($torre==3)
        {
            $validainsert=insertaru($con,$identificacion, $ingreso,$salida,$fila['idcontroladora']
            ,$stat,$carro,$oficina,$grupohorario,$grupodias,$fila['Torre'],
            $tipovehiculo);
            $contador++;           
            echo $validainsert;
        }
        if($torre==$fila['Torre'])
        {
            $validainsert=insertaru($con,$identificacion, $ingreso,$salida,$fila['idcontroladora']
            ,$stat,$carro,$oficina,$grupohorario,$grupodias,$torre,
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
    while($fila = mysqli_fetch_assoc($resultadocontroladoras))
    {
        if($torre==3)
        {
            $validainsert=insertaru($con,$identificacion, $ingreso,$salida,$fila['idcontroladora']
            ,$stat,$carro,$oficina,$grupohorario,$grupodias,$fila['Torre'],
            $tipovehiculo);
            $contador++;           
            echo $validainsert;
        }
        if($torre==$fila['Torre'])
        {
            $validainsert=insertaru($con,$identificacion, $ingreso,$salida,$fila['idcontroladora']
            ,$stat,$carro,$oficina,$grupohorario,$grupodias,$torre,
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
    while($fila = mysqli_fetch_assoc($resultadocontroladoras))
    {
        if($torre==3)
        {
            $validainsert=insertaru($con,$identificacion, $ingreso,$salida,$fila['idcontroladora']
            ,$stat,$carro,$oficina,$grupohorario,$grupodias,$fila['Torre'],
            $tipovehiculo);
            $contador++;           
            echo $validainsert;
        }
        if($torre==$fila['Torre'])
        {
            $validainsert=insertaru($con,$identificacion, $ingreso,$salida,$fila['idcontroladora']
            ,$stat,$carro,$oficina,$grupohorario,$grupodias,$torre,
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
    while($fila = mysqli_fetch_assoc($resultadocontroladoras))
    {
        if($torre==3)
        {
            $validainsert=insertaru($con,$identificacion, $ingreso,$salida,$fila['idcontroladora']
            ,$stat,$carro,$oficina,$grupohorario,$grupodias,$fila['Torre'],
            $tipovehiculo);
            $contador++;           
            echo $validainsert;
        }
        if($torre==$fila['Torre'])
        {
            $validainsert=insertaru($con,$identificacion, $ingreso,$salida,$fila['idcontroladora']
            ,$stat,$carro,$oficina,$grupohorario,$grupodias,$torre,
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
    while($fila = mysqli_fetch_assoc($resultadocontroladoras))
    {
        if($torre==3)
        {
            $validainsert=insertaru($con,$identificacion, $ingreso,$salida,$fila['idcontroladora']
            ,$stat,$carro,$oficina,$grupohorario,$grupodias,$fila['Torre'],
            $tipovehiculo);
            $contador++;           
            echo $validainsert;
        }
        if($torre==$fila['Torre'])
        {
            $validainsert=insertaru($con,$identificacion, $ingreso,$salida,$fila['idcontroladora']
            ,$stat,$carro,$oficina,$grupohorario,$grupodias,$torre,
            $tipovehiculo);
            $contador++;           
            echo $validainsert;
        }
    }
}
if($looby==1)
{
    $sqlcontroladoras="SELECT idcontroladora,Torre FROM controladoras WHERE grupo =4";
    $resultadocontroladoras = mysqli_query($con,$sqlcontroladoras);
    while($fila = mysqli_fetch_assoc($resultadocontroladoras))
    {
        if($torre==3)
        {
            $validainsert=insertaru($con,$identificacion, $ingreso,$salida,$fila['idcontroladora']
            ,$stat,$carro,$oficina,$grupohorario,$grupodias,$fila['Torre'],
            $tipovehiculo);
            $contador++;           
            echo $validainsert;
        }
        if($torre==$fila['Torre'])
        {
            $validainsert=insertaru($con,$identificacion, $ingreso,$salida,$fila['idcontroladora']
            ,$stat,$carro,$oficina,$grupohorario,$grupodias,$torre,
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
    while($fila = mysqli_fetch_assoc($resultadocontroladoras))
    {
        if($torre==3)
        {
            $validainsert=insertaru($con,$identificacion, $ingreso,$salida,$fila['idcontroladora']
            ,$stat,$carro,$oficina,$grupohorario,$grupodias,$fila['Torre'],
            $tipovehiculo);
            $contador++;           
            echo $validainsert;
        }
        if($torre==$fila['Torre'])
        {
            $validainsert=insertaru($con,$identificacion, $ingreso,$salida,$fila['idcontroladora']
            ,$stat,$carro,$oficina,$grupohorario,$grupodias,$torre,
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
    while($fila = mysqli_fetch_assoc($resultadocontroladoras))
    {
        if($torre==3)
        {
            $validainsert=insertaru($con,$identificacion, $ingreso,$salida,$fila['idcontroladora']
            ,$stat,$carro,$oficina,$grupohorario,$grupodias,$fila['Torre'],
            $tipovehiculo);
            $contador++;           
            echo $validainsert;
        }
        if($torre==$fila['Torre'])
        {
            $validainsert=insertaru($con,$identificacion, $ingreso,$salida,$fila['idcontroladora']
            ,$stat,$carro,$oficina,$grupohorario,$grupodias,$torre,
            $tipovehiculo);
            $contador++;           
            echo $validainsert;
        }
    }
}
       
          echo "<td>".$cedula."</td><td>".$nombre."</td><td>".$correo."</td><td>".$ingreso1."</td><td> ".$salida1."</td><td> ".$oficina."</td><td>VALIDO</td>";
          $nvalidos=$nvalidos+1;
            echo "</tr>";
    }            		   
}
  else
  {
      if($cedula == '')
      {
         if( $nombre == '')
          {
              
              
          }
          
      }
      else{
          if( $nombre == '')
          {
           echo "<tr>";
           echo "<td><b>".$cedula."</b></td><td><b>".$nombre."</b></td><td><b>".$correo."</b></td><td><b>".$ingreso1."</b></td><td><b> ".$salida1."</b></td><td><b> ".$oficina."</b></td><td><b> NO VALIDO</b></td>";
           echo "</tr>";   
          }
         echo "<tr>";
         echo "<td><b>".$cedula."</b></td><td><b>".$nombre."</b></td><td><b>".$correo."</b></td><td><b>".$ingreso1."</b></td><td><b> ".$salida1."</b></td><td><b> ".$oficina."</b></td><td><b> NO VALIDO</b></td>";
         echo "</tr>";
         $ninvalidos=$ninvalidos+1;
      }
  }
   $nregistros=$nregistros+1;
   
 } 
 $nregistros=$nregistros-1;
 //echo "<b>Numero de Registros: $contador</b><br>";
 echo "<br><b>Numero de Registros: </b>".$nregistros." / <b>Registros Validos: </b>".$nvalidos." - <b>Registros Invalidos:</b> ".$ninvalidos."<br><br>";  
 
} 
 //echo "Error de subida";
?>
 </div>
 </table>


</body>
</html>

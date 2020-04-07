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
<?
$contador=0;
error_reporting(E_ERROR | E_WARNING | E_PARSE);
date_default_timezone_set("America/Bogota");
echo "La hora en Colombia es: " . date ("H:i",time()) . "<br />";

require 'conexion.php';
require 'db.php';
  $ingreso   = $_POST['ingreso'];
  $salida    = $_POST['salida'];
  $oficina     = $_POST['ofice'];
  $nombreadmin = $_POST['admin'];
  
?>
<?
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
   function insertaru ($con,$usuario, $ingreso,$salida,$i,$stat,$carro,$ofice,$grupo,	$perfiltiempo,$dias,$tipovehiculo)
{
    $perfiltiempo=1;
    $dias=7;
    //echo "la controladora es igual a ".$i." y el grupo es igual a ".$grupo."<br>"; 
    //echo 'dato '.$g.'-'.$matriz[$k].'<br>';
    $sqlinsertarusuarios="insert INTO usuarios 
    (idusuarios,identificacion,fechainicio,fechafin,ncontroladora
    ,estado,vehiculo,oficina,grupo) 
    VALUES (NULL, '$usuario', '$ingreso','$salida','$i'
    ,'$stat','$carro','$ofice','$grupo')";
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
  $stat = 'N';
  $cont='1';
  $tipo='FUNCIONARIO';
  $carro='NO';
  $cedula1=$cedula;
  $nombre1 = $nombre;
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
            $sqlvisitantes="replace INTO visitantes (idvisitante,nombre,identificacion,codigo,Oficina,correo,Ingreso,Salida,estado,ncontroladora,tipo,vehiculo) VALUES (NULL, '$nombre1', '$cedula1', '$codigo', '$oficina1','$correo1','$ingreso','$salida','$stat','$cont','$tipo','$carro')";
          //echo $sqlvisitantes; //exit;
            $resultado = mysqli_query($con,$sqlvisitantes);
          
          $admin = $nombreadmin;
          $anfitrion ="1";
          $accion = "REGISTRADO";
          

$sqlmostraroficina="Select idcontroladora,Grupo from controladoras ";
$resultadooficina = mysqli_query($con,$sqlmostraroficina);                               
 while($fila = mysqli_fetch_assoc($resultadooficina))
{
    $matriz[$fila['idcontroladora']]=$fila['Grupo'];
	//$grupocontroladora=$fila['Grupo'];
	//$idcontroladora=$fila['idcontroladora'];
	//echo $idcontroladora.'-'.$grupocontroladora.'<br>';
} 
$numerocontroladoras=0;
$sqlcontarcontroladoras="SELECT COUNT(*) AS C FROM controladoras";
$resultcontarcontroladoras=mysqli_query($con,$sqlcontarcontroladoras); 
while($fila = mysqli_fetch_assoc($resultcontarcontroladoras))
{
    $numerocontroladoras=$fila['C'];
} 

//exit;
    
    $codigo = rand(1000, 9999);         
    $cont='1';//Aqui voy
    //echo 'usuario para registrar '.$usuario; 
    $consulta = "SELECT COUNT(*) FROM usuarios where identificacion = '$usuario' ";
    if ($resultado = $mysqli->query($consulta)) 
    {
        $fila = $resultado->fetch_row();     
        $numerous = $fila[0];
        //printf(" us %d\n", $numerous);
        //echo '<br>';  
        /* liberar el conjunto de resultados */
        $resultado->close();
    }
    if($numerous > 0)
    {
        //echo 'ya existe';    
        $perfiltiempo = 1;
        $dias = 7;            
        for($i=1;$i<=$numerocontroladoras;$i++)    
        {   
          $sql = "delete from usuarios WHERE identificacion='$usuario'";
         if (mysqli_query($mysqli, $sql)) 
          {
              //echo "Record updated successfully";
          } 
        // else 
        // {
        //     echo "Error updating record: " . mysqli_error($mysqli);
        }
    }
    //Insertar datos por grupo
    //echo 'GRUPO '.$grupo;
    $grupo=2;
    //exit;
    //Creamos la funcion insert de usuarios
    
$validainsert=0;
//echo "<b>".$grupo."</b>"."<br>";
switch ($grupo) 
{  
    case 1:
    {
        //echo "<b>Numero Controladoras".$numerocontroladoras."</b>"."<br>";
        for($i=1;$i<=$numerocontroladoras;$i++)    
        {   
            //echo 'dato'.$grupo.'-'.$matriz[$i].'<br>';
            if($matriz[$i]==$grupo)
            {	
                $validainsert=insertaru($con,$usuario, $ingreso,$salida,$i
    		    ,$stat,$carro,$ofice,$grupo,$perfiltiempo,$dias,
    		    $tipovehiculo);           
                //echo $validainsert;     
            }
            if($matriz[$i]==10)
            {
                $grupo=10;
                $validainsert=insertaru($con,$usuario, $ingreso,$salida,$i
                ,$stat,$carro,$ofice,$grupo,$perfiltiempo,$dias,
                $tipovehiculo);           
                //echo $validainsert;
            }
            if($matriz[$i]==11)
            {
                $grupo=11;
                $validainsert=insertaru($con,$usuario, $ingreso,$salida,$i
                ,$stat,$carro,$ofice,$grupo,$perfiltiempo,$dias,
                $tipovehiculo);           
                //echo $validainsert;
            }
        }
    }
    break;
    case 2:
    {
        //echo "<b>Numero Controladoras".$numerocontroladoras."</b>"."<br>";
        for($i=1;$i<=$numerocontroladoras;$i++)    
        {        
            if($matriz[$i]==1)
            {
                $grupo=1;
                $validainsert=insertaru($con,$usuario, $ingreso,$salida,$i
                ,$stat,$carro,$ofice,$grupo,$perfiltiempo,$dias,
                $tipovehiculo);           
                //echo $validainsert;
            }
           
            if($matriz[$i]==2)
            {
                $grupo=2;
                $validainsert=insertaru($con,$usuario, $ingreso,$salida,$i
                ,$stat,$carro,$ofice,$grupo,$perfiltiempo,$dias,
                $tipovehiculo);           
                //echo $validainsert;
            }
            if($matriz[$i]==10)
            {
                $grupo=10;
                $validainsert=insertaru($con,$usuario, $ingreso,$salida,$i
                ,$stat,$carro,$ofice,$grupo,$perfiltiempo,$dias,
                $tipovehiculo);           
                //echo $validainsert;
            }
            if($matriz[$i]==11)
            {
                $grupo=11;
                $validainsert=insertaru($con,$usuario, $ingreso,$salida,$i
                ,$stat,$carro,$ofice,$grupo,$perfiltiempo,$dias,
                $tipovehiculo);           
                //echo $validainsert;
            }
        }
    }
    break;
               
    }   
          
          //$resultado = mysqli_query($con, "replace INTO Log(Administrador,idVisitante,idAutoriza,Oficina,Fechainicio,Fechafin,Tipo,Accion) VALUES ('$nombre', '$usuario', '$autoriza','$ofice','$ingreso','$salida','$tipo','$accion' )");
          $insertarlog="replace INTO logregistros(Administrador,idVisitante,idAutoriza,Oficina,Fechainicio,Fechafin,Tipo,Accion,Correo) VALUES ('$admin', '$cedula1', '$anfitrion','$oficina1','$ingreso','$salida','$tipo','$accion','$correo1')";
           //echo $insertarlog;
           //$mostrar="SELECT nombre,Oficina FROM visitantes WHERE identificacion='$cedula1'";
          $resultado = mysqli_query($con,$insertarlog); 
          //$resultadonombre = mysqli_query($con,$mostrar);
          echo "<tr>";
          /*$mostrar = mysqli_fetch_assoc($resultadonombre))
            {  $nombrev=$filamostrar['nombre'];
    $oficinav=$filamostrar['Oficina'];
    echo "<td>$cedula1</td><td>$nombrev</td><td>$oficinav</td><td>$contador</td>";
    $contador=$contador+1;
     //$grupocontroladora=$fila['Grupo'];
     //$idcontroladora=$fila['idcontroladora'];
     //echo $idcontroladora.'-'.$grupocontroladora.'<br>';
 } 
       */   
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

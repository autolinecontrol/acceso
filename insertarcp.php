<?php

require 'conexion.php';
 require 'db.php';

$usuario   = $_GET['identificacion'];
$nombres   = $_GET['nombre'];
$correo    = $_GET['correo'];
$ingreso   = $_GET['ingreso'];
$salida    = $_GET['salida'];
$tipo      = $_GET['tipo'];
$carro     = $_GET['vehiculo'];
$ofice     = $_GET['oficina'];
$grupo     = $_GET['grupo'];
$tipovehiculo =$_GET['tipovehiculo'];
//$grupo=1;

$documentoadmin=1;
$nombreadmin="SISTEMA";
$accion="REGISTRADO";
echo $tipo;

$codigo = rand(1000, 9999);
$stat = 'N';
$cont='1';//Aqui voy
if($carro=='SI')
{
$sqlinsertar="replace INTO visitantes (idvisitante,nombre,identificacion,codigo,Oficina,correo,Ingreso,Salida,estado,ncontroladora,tipo,vehiculo,Tipovehiculo,grupo) VALUES (NULL,  '$nombres', '$usuario', '$codigo','$ofice','$correo','$ingreso','$salida','$stat','$cont','$tipo','$carro','$tipovehiculo','$grupo')";
echo $sqlinsertar;
    $resultado = mysqli_query($con,$sqlinsertar);
$sqllog="insert INTO logregistros (idLog,Administrador,idVisitante,idAutoriza,Oficina,Fechainicio,Fechafin,Tipo,Accion,Vehiculo,Tipovehiculo,Correo) VALUES (NULL,  '$nombreadmin', '$usuario','$documentoadmin','$ofice','$ingreso','$salida','$tipo','$accion','$carro','$tipovehiculo','$correo')";
 $resultado = mysqli_query($con,$sqllog);
    
}
else{
    echo $sqlinsertar;
    $tipovehiculo="NO";
  $resultado = mysqli_query($con, "replace INTO visitantes (idvisitante,nombre,identificacion,codigo,Oficina,correo,Ingreso,Salida,estado,ncontroladora,tipo,vehiculo,Tipovehiculo,grupo,autorizo) VALUES (NULL,  '$nombres', '$usuario', '$codigo','$ofice','$correo','$ingreso','$salida','$stat','$cont','$tipo','$carro','$tipovehiculo','$grupo',NULL)");
$sqllog="insert INTO logregistros (idLog,Administrador,idVisitante,idAutoriza,Oficina,Fechainicio,Fechafin,Tipo,Accion,Vehiculo,Tipovehiculo,Correo) VALUES (NULL,  '$nombreadmin', '$usuario','$documentoadmin','$ofice','$ingreso','$salida','$tipo','$accion','$carro','$tipovehiculo','$correo')";
 $resultado = mysqli_query($con,$sqllog);
}

$consulta = "SELECT COUNT(*) FROM controladoras";

if ($resultado = $mysqli->query($consulta)) 
{
    $fila = $resultado->fetch_row();
    $numerocontroladoras = $fila[0];
    printf("La Consulta devolvió %d\n", $numerocontroladoras);
    echo '<br>';
    /* liberar el conjunto de resultados */
    $resultado->close();
}

 $sqlmostraroficina="Select idcontroladora,Grupo from controladoras ";
                    $resultadooficina = mysqli_query($con,$sqlmostraroficina);
                                
 while($fila = mysqli_fetch_assoc($resultadooficina))
{
			
        $matriz[$fila['idcontroladora']]=$fila['Grupo'];
	//$grupocontroladora=$fila['Grupo'];
	//$idcontroladora=$fila['idcontroladora'];

	//echo $idcontroladora.'-'.$grupocontroladora.'<br>';
}

echo 'usuario para registrar '.$usuario;

$consulta = "SELECT COUNT(*) FROM usuarios where identificacion = '$usuario'";
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

                    if (mysqli_query($mysqli, $sql)) {
                        echo "Record updated successfully";
                    } 
                    else {
                        echo "Error updating record: " . mysqli_error($mysqli);
                    }


//Insertar datos por grupo
if($tipo=='VISITANTE'){
	$grupo = 1;}
if($tipo=='FUNCIONARIO'){
	$grupo=2;}
    if($tipo=='CONTRATISTA'){
       $grupo=2;
    }

switch ($grupo) {
   
    case 1:{
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
    case 2:{
       for($i=1;$i<=$numerocontroladoras;$i++)    
                {   
			echo 'dato'.$grupo.'-'.$matriz[$i].'<br>';
			if($matriz[$i]==1)
			{
				$grupo=1;
                    $visi = mysqli_query($con, "insert INTO usuarios (idusuarios,identificacion,fechainicio,fechafin,ncontroladora,estado,vehiculo,oficina,grupo,perfiltiempo,dias,tipov) VALUES (NULL, '$usuario', '$ingreso','$salida','$i','$stat','$carro','$ofice','$grupo','$perfiltiempo','$dias','$tipovehiculo')");
                
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
    case 3:{
       for($i=1;$i<=$numerocontroladoras;$i++)    
                {   
			echo 'dato'.$grupo.'-'.$matriz[$i].'<br>';
			if($matriz[$i]==1)
			{
				$grupo=1;
                    $visi = mysqli_query($con, "insert INTO usuarios (idusuarios,identificacion,fechainicio,fechafin,ncontroladora,estado,vehiculo,oficina,grupo,perfiltiempo,dias,tipov) VALUES (NULL, '$usuario', '$ingreso','$salida','$i','$stat','$carro','$ofice','$grupo','$perfiltiempo','$dias','$tipovehiculo')");
                
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
   mysqli_close($conn);             
}
else
{
                
    $perfiltiempo = 1;
    $dias = 7;
                
  
    //$i=1;

//Restriccion de ingresos grupo
		if($tipo=='VISITANTE'){
	$grupo = 1;}
if($tipo=='FUNCIONARIO'){
	$grupo=2;}
    if($tipo=='CONTRATISTA'){
        $grupo=2;
    }
                

switch ($grupo) {
   
    case 1:{
       for($i=1;$i<=$numerocontroladoras;$i++)    
                {   
			echo 'dato'.$grupo.'-'.$matriz[$i].'<br>';
			if($matriz[$i]==$grupo)
			{
				
                    $resultado1 = mysqli_query($con, "insert INTO usuarios (idusuarios,identificacion,fechainicio,fechafin,ncontroladora,estado,vehiculo,oficina,grupo,perfiltiempo,dias) VALUES (NULL, '$usuario', '$ingreso','$salida','$i','$stat','$carro','$ofice','$grupo','$perfiltiempo','$dias')");
                
                    echo 'datos'.$i.'<br>';
			}
                }
        }
        break;
    case 2:{
       for($i=1;$i<=$numerocontroladoras;$i++)    
                {   
			echo 'dato'.$grupo.'-'.$matriz[$i].'<br>';
			if($matriz[$i]==1)
			{
				$grupo=1;
                    $resultado1 = mysqli_query($con, "insert INTO usuarios (idusuarios,identificacion,fechainicio,fechafin,ncontroladora,estado,vehiculo,oficina,grupo,perfiltiempo,dias) VALUES (NULL, '$usuario', '$ingreso','$salida','$i','$stat','$carro','$ofice','$grupo','$perfiltiempo','$dias')");
                
                    echo 'datos'.$i.'<br>';
			}
                }

 for($i=1;$i<=$numerocontroladoras;$i++)    
                {   
			echo 'dato'.$grupo.'-'.$matriz[$i].'<br>';
			if($matriz[$i]==2)
			{
				$grupo=2;
                    $resultado1 = mysqli_query($con, "insert INTO usuarios (idusuarios,identificacion,fechainicio,fechafin,ncontroladora,estado,vehiculo,oficina,grupo,perfiltiempo,dias) VALUES (NULL, '$usuario', '$ingreso','$salida','$i','$stat','$carro','$ofice','$grupo','$perfiltiempo','$dias')");
                
                    echo 'datos'.$i.'<br>';
			}
                }
        }
        break;
        
    case 3:{
       for($i=1;$i<=$numerocontroladoras;$i++)    
                {   
			echo 'dato'.$grupo.'-'.$matriz[$i].'<br>';
			if($matriz[$i]==1)
			{
				$grupo=1;
                    $visi = mysqli_query($con, "insert INTO usuarios (idusuarios,identificacion,fechainicio,fechafin,ncontroladora,estado,vehiculo,oficina,grupo,perfiltiempo,dias,tipov) VALUES (NULL, '$usuario', '$ingreso','$salida','$i','$stat','$carro','$ofice','$grupo','$perfiltiempo','$dias','$tipovehiculo')");
                
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

?>

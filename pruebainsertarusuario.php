<?php

require 'conexion.php';


$grupo=1;
$numerocontroladoras=20;

echo $tipo;

$codigo = rand(1000, 9999);
$stat = 'N';
$cont='1';//Aqui voy
  
$perfiltiempo = 1;
    $dias = 7;
echo 'usuario para registrar '.$usuario;
$sql="Select * from visitantes WHERE tipo='FUNCIONARIO' and salida >= '2019-09-21 00:00:00'";
$resultado=mysqli_query($con,$sql);
echo "<table>";
echo "<tr>";
echo "<th>Identificacion</th>";
echo "<th>Fechainicio</th>";
echo "<th>Nombre</th>";
echo "</tr>";
$x=0;
while($fila = mysqli_fetch_assoc($resultado))
{
	if($x==3){exit;}
	echo "<tr>";
	$identificacion=$fila['identificacion'];
	$ingreso=$fila['Ingreso'];
	$salida=$fila['Salida'];
	$carro=$fila['vehiculo'];
	$ofice=$fila['Oficina'];
	for($i=1;$i<=$numerocontroladoras;$i++)    
        {   
        $resultado1 = mysqli_query($con, "replace INTO usuarios (idusuarios,identificacion,fechainicio,fechafin,ncontroladora,estado,vehiculo,oficina,grupo,perfiltiempo,dias) VALUES ('', '$identificacion', '$ingreso','$salida','$i','$stat','$carro','$ofice','$grupo','$perfiltiempo','$dias')");
                
        echo 'datos'.$i.'<br>';
        }
	echo "<td>".$identificacion."</td>";	
	echo "<td>".$ingreso."</td>";
	echo "<td>".$salida."</td>";
	echo "<td>".$carro."</td>";
	echo "<td>".$ofice."</td>";
	echo "</tr>";
$x=$x+1;

}
    //$i=1;
                
    /*for($i=1;$i<=$numerocontroladoras;$i++)    
        {   
        $resultado1 = mysqli_query($con, "insert INTO usuarios (idusuarios,identificacion,fechainicio,fechafin,ncontroladora,estado,vehiculo,oficina,grupo,perfiltiempo,dias) VALUES ('', '$identificacion', '$ingreso','$salida','$i','$stat','$carro','$ofice','$grupo','$perfiltiempo','$dias')");
                
        echo 'datos'.$i.'<br>';
        }
               */ 
               


?>

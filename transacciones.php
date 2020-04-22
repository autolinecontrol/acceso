<?php
require 'conexion.php';

$Identificacion = $_GET['identificacion'];
$Ingreso        = $_GET['ingreso'];
$Estado         = $_GET['estado'];
$Controladora   = $_GET['controladora'];
$Oficina        = $_GET['oficina'];
$grupo        = $_GET['grupo'];

echo $Identificacion;
echo $Ingreso;
echo $Estado;
echo $Controladora; 
echo $Oficina;
echo $grupo;


$sql = "INSERT INTO transacciones(idtransaccion,identificacion,Ingreso,Estado,controladora,oficina,grupo) 
VALUES (NULL,'$Identificacion','$Ingreso','$Estado','$Controladora','$Oficina','$grupo')";
if (mysqli_query($con, $sql)) {
      echo "New record created successfully";
} else {
      echo "Error: " . $sql . "<br>" . mysqli_error($con);
}
mysqli_close($con);
?>

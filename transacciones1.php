<?php
require 'conexion.php';

$Identificacion = $_GET['identificacion'];
$oficina        = $_GET['oficina'];
$tipov          = $_GET['tipov'];

echo $Identificacion;
echo $Oficina;
echo $tipov;


$sql = "INSERT INTO transacciones1(identificacion,oficina,tipov) 
VALUES (NULL,'$Identificacion','$oficina','$tipov')";
if (mysqli_query($con, $sql)) {
      echo "New record created successfully";
} else {
      echo "Error: " . $sql . "<br>" . mysqli_error($con);
}
mysqli_close($con);
?>

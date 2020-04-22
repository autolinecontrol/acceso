<?php

require 'conexion.php';

$Identificacion = $_GET['identificacion'];
$Oficina        = $_GET['oficina'];

echo $Identificacion;
echo $Oficina;


$sql = "INSERT INTO transacciones2(identificacion,oficina) 
VALUES (NULL,'$Identificacion','$oficina')";
if (mysqli_query($con, $sql)) {
      echo "New record created successfully";
} else {
      echo "Error: " . $sql . "<br>" . mysqli_error($con);
}
mysqli_close($con);
?>
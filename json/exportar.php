<?php
include'../conexion.php';
$sql="SELECT * FROM visitantes ";
$mostrar = mysqli_query($con,$sql);
$datos = array();
foreach($mostrar as $row){
	array_push($datos, array(
    'nombre'=>$row['nombre'],
    'identificacion'=>$row['identificacion'],
    'oficina'=>$row['Oficina'],
    'correo'=>$row['correo'],
    'ingreso'=>$row['Ingreso'],
    'salida'=>$row['Salida'],
    'estado'=>$row['estado'],
    'tipo'=>$row['tipo']
	));
}
echo utf8_encode(json_encode($datos));
?>
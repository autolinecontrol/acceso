<?php
include'../conexion.php';
$contar=0;
$data = file_get_contents("http://172.16.26.138/conexion/acceso/json/exportar.php");
$array = json_decode($data);
foreach ($array as $value) {
    $nombre = $value->nombre;
    $identificacion = $value->identificacion;
    $oficina = $value->oficina;
    $correo = $value->correo;
    $tipo = $value->tipo;
    //echo $nombre."</br>"."$identificacion<br>$oficina<br>$correo<br>$tipo<hr></br>";
    $ingreso="2020-01-01";
    $salida="2020-06-01";
    $stat="N";
    $cont="1";
    $grupo="1";
    $sqlvisi="REPLACE INTO visitantes(idvisitante,nombre,identificacion,Oficina,correo,Ingreso,Salida,estado,ncontroladora,
    tipo,grupo) VALUES (NULL,  '$nombre','$identificacion','$oficina','$correo','$ingreso','$salida','$stat',
    '$cont','$tipo','$grupo')";
    //echo $sqlvisi."<hr></br>";
    $resultado = mysqli_query($con,$sqlvisi);
    $contar=$contar+1;
 }
echo "Se registraron: $contar";
?>
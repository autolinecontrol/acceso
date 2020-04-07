<?php
include'../conexion.php';
//en 11800 bota error
//en 11780 bota error
//en 11770 bota error
//en 11760 bota error
//en 11758 bota error aqui esta el error
//"\t1034282819":{"email":"johalopez79@hotmail.com","name":"JUAN DIEGO DE JESUS LOPEZ LOPEZ","uid":"\t1034282819"} este es el error
$sql="SELECT * FROM visitantes ";
$mostrar = mysqli_query($con,$sql);
$c=array();
foreach($mostrar as $row){
  $carrera="";
	$identificacion=$row['identificacion'];
	$c[$identificacion]=array(
    'Facultad'=>$row['Oficina'],
    'Perfil'=>$row['tipo'],
    'clave'=>'900',
    'email'=>$row['correo'],
    'foto'=>'no',
    'name'=>$row['nombre'],
    'uid'=>$row['identificacion']
	);
}
$data = '{"usuarios2":';
$a=$data;
$b=utf8_encode(json_encode($c));
$d='}';
$e=$b;
//echo $e;
//____________________________________________CREAR EL ARCHIVO _________________________________
$archivo = fopen("users.json","w");
if( $archivo == false ) {
  echo "Error al crear el archivo";
}
else
{
    // Escribir en el archivo:
     fwrite($archivo, $e);
    // Fuerza a que se escriban los datos pendientes en el buffer:
     fflush($archivo);
}
// Cerrar el archivo:
fclose($archivo);
?>
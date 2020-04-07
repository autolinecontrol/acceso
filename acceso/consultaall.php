<?php

require_once '../dbconfig.php';
//$fecha =  $_GET['fecha'];
$ncontroladora = $_GET['ncontroladora'];
$estado = $_GET['estado'];
$grupo = $_GET['grupo'];

//$estado='N';
$query = "select identificacion,fechainicio,fechafin,estado,oficina,vehiculo,grupo from usuarios  where  estado != '$estado' AND ncontroladora = '$ncontroladora' AND grupo = '$grupo'";
 //echo $query;
$stmt = $DBcon->prepare($query);
$stmt->execute();
 
$userData = array();
while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
  $userData['AllUsers'][]= $row;
}
 
echo json_encode($userData);



<?php
require_once '../dbconfig.php';
//$fecha =  $_GET['fecha'];
$ncontroladora = $_GET['ncontroladora'];
$oficina = $_GET['oficina'];

$query = "select * from oficinas";
$stmt = $DBcon->prepare($query);
$stmt->execute();
 
$userData = array();
 
while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
  
  $userData['AllUsers'][]= $row;
}
 
echo json_encode($userData);

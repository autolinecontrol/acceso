<?php
require_once 'dbconfig.php';
$identificacion =  $_GET['identificacion'];
$estado = $_GET['estado'];
$ncontroladora = $_GET['ncontroladora'];
$grupo = $_GET['grupo'];

 $query = "UPDATE usuarios SET estado ='$estado', grupo = '$grupo' where  identificacion = '$identificacion' and ncontroladora = '$ncontroladora'";
 
 $stmt = $DBcon->prepare($query);
 $stmt->execute();
 
 
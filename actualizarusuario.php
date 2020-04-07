<?php
require_once 'dbconfig.php';
$identificacion =  $_GET['identificacion'];
$estado = $_GET['estado'];
$ncontroladora = $_GET['ncontroladora'];

 $query = "UPDATE visitantes SET estado ='$estado', ncontroladora='$ncontroladora' where  identificacion = '$identificacion'";
 
 $stmt = $DBcon->prepare($query);
 $stmt->execute();
 


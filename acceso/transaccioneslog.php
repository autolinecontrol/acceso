<?php
$Identificacion = $_GET['identificacion'];
$Evento = $_GET['evento'];
$Motivo = $_GET['motivo'];
$Controladora = $_GET['ncontroladora'];
$Fecha = $_GET['fecha'];
$Grupo = $_GET['grupo'];


$cnx =  new PDO("mysql:host=localhost;dbname=mgeiqybt_cap","root","");
$res=$cnx->query("insert into log values (null,'$Fecha','$Identificacion','$Evento','$Motivo','$Controladora','$Grupo')");
?>

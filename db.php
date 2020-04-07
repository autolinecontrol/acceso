<?php

$mysql_host    = 'localhost';
$mysql_usuario = 'autoline2020_acceso';
$mysql_clave   = 'Acceso2020*';
$mysql_BD      = 'autoline2020_teleport';


$mysqli = new mysqli($mysql_host, $mysql_usuario,$mysql_clave,$mysql_BD) or die($mysqli->error);

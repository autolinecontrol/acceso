<?php

$mysql_host    = 'localhost';
$mysql_usuario = 'autoline2020_acceso';
$mysql_clave   = 'Acceso2020*';
$mysql_BD      = 'autoline2020_teleport';


$con = mysqli_connect($mysql_host, $mysql_usuario,$mysql_clave,$mysql_BD);

if(mysqli_connect_errno())
{
    echo "Error en la conexion: " . mysqli_connect_error();
}

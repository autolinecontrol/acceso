<?php

require 'conexion.php';
$personas = $_GET['personas'];
$nuevoIngreso  = $_GET['IngresoID'];
$nuevoSalida   = $_GET['SalidaID'];


$resultado = mysqli_query($con, "select visitantes.identificacion, visitantes.nombre, visitantes.Oficina, "
        . " transacciones.Ingreso, transacciones.Salida,transacciones.Estado,"
        . " controladoras.nombrecontroladora "
        . " from transacciones,visitantes,controladoras"
        . " where transacciones.identificacion = visitantes.identificacion "
        . " and transacciones.controladora = controladoras.idcontroladora"
        . " and transacciones.Ingreso > '$nuevoIngreso'"
        //. " and transacciones.Salida > '$nuevoSalida'"
        );

$table .= '<div class = "container">';
$table .= '<table class = "table table-striped table-bordered">';
$table .= '<tr>';
$table .= '<th>Identificacion</th>';
$table .= '<th>Nombre</th>';
$table .= '<th>Oficina</th>';
$table .= '<th>Ingreso</th>';
$table .= '<th>Salida</th>';
$table .= '<th>Estado</th>';
$table .= '<th>Dispositivo</th>';
$table .= '</tr>';

while($fila = mysqli_fetch_assoc($resultado))
{
    $table .= '<tr>';
    $table .= '<td>' . $fila['identificacion'] . '</td>';
    $table .= '<td>' . $fila['nombre'] . '</td>';
    $table .= '<td>' . $fila['Oficina'] . '</td>';
    $table .= '<td>' . $fila['Ingreso'] . '</td>';
    $table .= '<td>' . $fila['Salida'] . '</td>';
    $table .= '<td>' . $fila['Estado'] . '</td>';
    $table .= '<td>' . $fila['nombrecontroladora'] . '</td>';
    $table .= '</tr>';
}
$table .= '</table>';
$table .= '</div>';
echo $table;
mysqli_close($con);


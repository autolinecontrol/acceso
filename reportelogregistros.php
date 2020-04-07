<?php
require 'conexion.php';/*
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=Reportes.xls");*/
$sqlexportar = $_GET['sql'];
echo $_GET['sql']; exit;/*
$resultado = mysqli_query($con,$sqlexportar);?>

<div class = "container">
<table class = "table table-striped table-bordered">
<tr><th>Cedula Usuario</th>
            <th>Nombre Usuario</th>
            <th>Fecha Inicio </th>
            <th>Fecha Fin</th>
            <th>Oficina</th>
            <th>Administrador</th>
            <th>Transaccion</th>
            <th>Tipo</th>
            <th>Estado</th>
            
            <th>Vehiculo</th>
            <th>Correo</th>
            <th>Accion</th>
            <th>Anfitrion</th>
</tr>
<?php
while($fila = mysqli_fetch_assoc($resultado))
{
        $autoriza = '';
        if( $fila['idAutoriza']=='1')
        {
           $autoriza = 'Masivo';
        }
        else
        {
           $autoriza = $fila['idAutoriza'];
        }
            
        echo '<tr>';
        echo '<td>' . $fila['idVisitante'] . '</td>';
        echo '<td>' . $fila['nombre'] . '</td>';
        echo "<td> " .$fila['Fechainicio'] . '</td>';
        echo '<td>' . $fila['Fechafin'] . '</td>';
        echo '<td>' . $fila['Oficina'] . '</td>';
        echo '<td>'. $fila['Administrador']. '</td>';
        $horalocal=date('Y-m-d H:i:s', strtotime($fila['Fechahora']." + 2 hours "));
        echo '<td>'.$horalocal . '</td>';
        echo '<td>'. $fila['Tipo']. '</td>';
        echo '<td>'. $fila['estado']. '</td>';
        echo '<td>'. $fila['Vehiculo']. '</td>';
        echo '<td>'. $fila['Correo']. '</td>';
        echo '<td>'. $fila['Accion']. '</td>';
        echo '<td>'. $autoriza. '</td>';
        echo '</tr>';
}
mysqli_close($con);
*/
?>

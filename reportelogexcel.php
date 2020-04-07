<?php
require 'conexion.php';
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=Reportes.xls");
$sqlexportar = $_POST['sql'];
$resultado = mysqli_query($con,$sqlexportar);?>

<div class = "container">
<table class ="table table-triped table-bordered">
<tr>
<th>Fecha y Hora</th>
<th>Documento</th>
<th>Nombre</th>
<th>Oficina</th>
<th>Tipo</th>
<th>Veh.</th> 
<th>Evento</th>
<th>Motivo</th>
<th>Controladora</th>
</tr>
<?php
while($fila = mysqli_fetch_assoc($resultado))
{
  $evento=$fila['evento'];
    
if($evento=='antipassback')
{
    echo '<tr>';
    echo "<td><font color='red'>".$fila['fechaevento']."</font></td>";
	echo "<td><font color='red'>".$fila['identificacion']."</font></td>";
    echo "<td><font color='red'>".$fila['nombre']."</font></td>";                             echo "<td><font color='red'>".$fila['Nombre']."</font></td>";
    echo "<td><font color='red'>".$fila['tipo']."</font></td>";
    echo "<td><font color='red'>".$fila['vehiculo']."</font></td>";
	echo "<td><font color='red'>".$fila['evento']."</font></td>";
	echo "<td><font color='red'>".$fila['motivo']."</font></td>";
    echo "<td><font color='red'>".$fila['nombrecontroladora']."</font></td>"; 
    echo '</tr>';
    } 


if($evento=='expirado')
{
	echo '<tr>';
    echo "<td><font color='black'>".$fila['fechaevento']."</font></td>";
	echo "<td><font color='black'>".$fila['identificacion']."</font></td>";
    echo "<td><font color='black'>".$fila['nombre']."</font></td>";
    echo "<td><font color='black'>".$fila['Nombre']."</font></td>";
    echo "<td><font color='black'>".$fila['tipo']."</font></td>";
    echo "<td><font color='black'>".$fila['vehiculo']."</font></td>";        
	echo "<td><font color='black'>".$fila['evento']."</font></td>";
	echo "<td><font color='black'>".$fila['motivo']."</font></td>";
    echo "<td><font color='black'>".$fila['nombrecontroladora']."</font></td>";
	echo '</tr>';
}

if($evento=='No Registrado')
{
	echo '<tr>';
	echo "<td><font color='orange'>".$fila['fechaevento']."</font></td>";
	echo "<td><font color='orange'>".$fila['identificacion']."</font></td>";
    echo "<td><font color='orange'>NN</font></td>";
    echo "<td><font color='orange'>NN</font></td>";
    echo "<td><font color='orange'>NN</font></td>";
    echo "<td><font color='orange'>NN</font></td>";
	echo "<td><font color='orange'>".$fila['evento']."</font></td>";
	echo "<td><font color='orange'>".$fila['motivo']."</font></td>";
    echo "<td><font color='orange'>".$mostrarnombre['nombrecontroladora']."</font></td>"; 
    echo '</tr>';
}
    if($evento=='vehiculo')
{
	echo '<tr>';
    echo "<td><font color='blue'>".$fila['fechaevento']."</font></td>";
	echo "<td><font color='blue'>".$fila['identificacion']."</font></td>";
    echo "<td><font color='blue'>".$fila['nombre']."</font></td>";
    echo "<td><font color='blue'>".$fila.['Nombre']."</font></td>";
    echo "<td><font color='blue'>".$fila['tipo']."</font></td>";
    echo "<td><font color='blue'>".$fila['vehiculo']."</font></td>";
    echo "<td><font color='blue'>".$fila['evento']."</font></td>";
	echo "<td><font color='blue'>".$fila['motivo']."</font></td>";
    echo "<td><font color='blue'>".$fila['nombrecontroladora']."</font></td>"; 
	echo '</tr>';
}
}

?>

<?php
require 'conexion.php';
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=Reportes.xls");
$sqlexportar = $_POST['sql'];
$resultado = mysqli_query($con,$sqlexportar);?>

<div class = "container">
<table class = "table table-striped table-bordered">
<tr>
<th>Tipo</th>
<th>Identificacion</th>
<th>Nombre</th>
<th>Oficina</th>
<th>Ingreso</th>
<th>Salida</th>
<th>Estado</th>
<th>Dispositivo</th>
</tr>
<?php
while($fila = mysqli_fetch_assoc($resultado))
{
    echo '<tr>';
    echo '<td>' . $fila['tipo'] . '</td>';
    echo '<td>' . $fila['identificacion'] . '</td>';
    echo '<td>' . $fila['nombre'] . '</td>';
    $moficina=$fila['oficina'];
    $sqlmostraroficina="Select * from oficinas where Numero='$moficina'";
    $resultadooficina = mysqli_query($con,$sqlmostraroficina);
    while($recorrer2 = mysqli_fetch_assoc($resultadooficina))
                        {
                           $nombreoficina=$recorrer2['Nombre'];
			   break;
                        }
    echo '<td>' .$nombreoficina. '</td>';
    
    if($fila['Estado']== 'I')
    {
        echo '<td>' . $fila['Ingreso'] . '</td>';
        echo '<td>' . '-' . '</td>';
        echo '<td>' .'Ingreso'. '</td>';    
    }
    if($fila['Estado']== 'O')
    {
        echo '<td>' . '-' . '</td>';
        echo '<td>' . $fila['Ingreso'] . '</td>';
        echo '<td>' . 'Salida' . '</td>';
    }
    
    echo '<td>' . $fila['nombrecontroladora'] . '</td>';
    echo '</tr>';
}
mysqli_close($con);

?>

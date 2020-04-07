<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
require 'conexion.php';
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=Reportes.xls");
$nuevoIngreso = $_POST['ingreso'];
$nuevoSalida = $_POST['salida'];
$nuevooficina=$_POST['oficina'];
$nuevotipo=$_POST['tip'];
$nuevoid = $_POST['id'];
$tipo  = $_POST['perfil'];


$sql="select distinct t1.identificacion from transacciones as t1,visitantes as t2 where t1.Ingreso >= '$nuevoIngreso' and t1.Ingreso <= '$nuevoSalida' ";
        //. " and transacciones.oficina = '$nuevaofice'"
        //. "order by transacciones.Ingreso";
    if(isset($_POST['Documento']) && $_POST['Documento'] == '1')
    {        
        $sql=$sql.=" and t1.identificacion = '$nuevoid'  ";}
        if(isset($_POST['Oficina']) && $_POST['Oficina'] == '1')
        { 
 
            $sql=$sql." and t1.oficina = '$nuevooficina'";
	}
        
        if(isset($_POST['Perfil']) && $_POST['Perfil'] == '1')
        {
            $sql=$sql." and t2.tipo = '$nuevotipo' ";
	}

$resultado = mysqli_query($con,$sql);?>
<div class = "container">
<table class = "table table-striped table-bordered">
<tr>
<th>Tipo</th>
<th>Identificacion</th>
<th>Nombre</th>
<th>Fecha y Hora</th>
<th>Movimiento</th>
</tr>
<?php
while($fila = mysqli_fetch_assoc($resultado))
{
    echo '<tr>';
    $identificacion=$fila['identificacion'];
    //echo "<td>".$identificacion."</td>";/*
    $primeraentrada="(select t2.nombre,t2.tipo,t1.Ingreso,t1.Estado from transacciones as t1 inner JOIN visitantes AS t2 on t1.identificacion=t2.identificacion where t1.identificacion =$identificacion and t1.Ingreso >= '$nuevoIngreso' and t1.Ingreso <= '$nuevoSalida'  and t2.tipo = '$nuevotipo' limit 1) UNION (select t2.nombre,t2.tipo,t1.Ingreso,t1.Estado from transacciones as t1 inner JOIN visitantes AS t2 on t1.identificacion=t2.identificacion where t1.identificacion =$identificacion and t1.Ingreso >= '$nuevoIngreso' and t1.Ingreso <= '$nuevoSalida'  and t2.tipo = '$nuevotipo' order by t1.Ingreso desc limit 1)";
   //echo $primeraentrada; 
    $resultprimeraentrada= mysqli_query($con,$primeraentrada);
    if($resultprimeraentrada){
        while($recorrer2 =mysqli_fetch_assoc($resultprimeraentrada))
        {
            echo '<tr>';
            echo '<td>' . $recorrer2['tipo'] . '</td>';
            echo '<td>' .$identificacion. '</td>';
            echo '<td>' . $recorrer2['nombre'] . '</td>';
            echo '<td>' . $recorrer2['Ingreso'] . '</td>';
            if($recorrer2['Estado']== 'I')
            {
            echo '<td>' .'Ingreso'. '</td>';    
            }
            if($recorrer2['Estado']== 'O')
            {
            echo '<td>' . 'Salida' . '</td>';
            }
            echo '</tr>';
            
        }
    }
    else 
    {
        echo "No se encontraron registros entre las fechas $nuevoIngreso y $nuevoSalida";
    }
    echo '</tr>';
}
mysqli_close($con);
?>
</table>

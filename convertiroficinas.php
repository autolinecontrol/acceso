<?php
require 'conexion.php';
$contador=0;
function convertir ($con,$nombreoficina,$numerooficina)
{
    $sqlconvertir="UPDATE visitantes SET Oficina='$nombreoficina' WHERE Oficina='$numerooficina'";
    $resultadoconvertir=mysqli_query($con,$sqlconvertir);
    //echo"<br>";
    //echo $sqlconvertir;
}
$sqlusuarios="SELECT Oficina FROM visitantes";
$resultado=mysqli_query($con,$sqlusuarios);
$validainsert=0;
while($fila = mysqli_fetch_assoc($resultado))
{
	//Este es el numero que tiene
	$oficina=$fila['Oficina'];
    //echo "<td>".$oficina."</td>";	
    $sqloficinas="SELECT Nombre,Numero FROM oficinas";
$resultadooficinas=mysqli_query($con,$sqloficinas);
    while($filaoficinas = mysqli_fetch_assoc($resultadooficinas))
    {
        $nombreoficina=$filaoficinas['Nombre'];
        $numerooficina=$filaoficinas['Numero'];
        if($numerooficina==$oficina)
        {
            //echo "<td>".$numerooficina."</td>";
            //echo "<td>Entro en el igual</td>";
            $validainsert=convertir($con,$nombreoficina,$numerooficina);
            $contador=$contador+1;
        }
    }
    
	

}
echo "Se inserto $contador";
?>
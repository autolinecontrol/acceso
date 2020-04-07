<?php
 require 'conexion.php';
require 'db.php';
$sqlbuscar="SELECT t1.identificacion,t2.vehiculo,t2.idusuarios FROM visitantes t1 INNER JOIN usuarios t2 on t1.identificacion = t2.identificacion WHERE t1.vehiculo='SI'";
$recorrer=mysqli_query($con,$sqlbuscar);

$contador=0;
$control=0;
while($filarecorrer = mysqli_fetch_assoc($recorrer)){
    //if($control==150){exit;}
    $vehiculo=$filarecorrer['vehiculo'];
    if($vehiculo!='SI')
    {
        $id=$filarecorrer['identificacion'];
        $sqlactualizar="UPDATE usuarios SET vehiculo='SI', estado='N' WHERE identificacion=$id";
        
        $ejecutar=mysqli_query($con,$sqlactualizar);
        $contador=$contador+1;
        echo $contador;
        $control=$control+1;
        echo $filarecorrer['identificacion'];
        echo '<br>';
   
    }
    
}?>
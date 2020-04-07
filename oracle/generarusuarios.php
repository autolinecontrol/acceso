<?php
$contador=0;
include ("../conexion.php");
//Contar controladoras
$sqlcontarcontroladoras=mysqli_query($con,"SELECT COUNT(*) AS total FROM controladoras");
$data=mysqli_fetch_assoc($sqlcontarcontroladoras);
$numerocontroladoras=$data['total'];

//Armar Matriz de Controladoras
$sqlmostraroficina="SELECT idcontroladora,Grupo from controladoras ";
$resultadooficina = mysqli_query($con,$sqlmostraroficina);                               
while($fila = mysqli_fetch_assoc($resultadooficina))
{
    $matriz[$fila['idcontroladora']]=$fila['Grupo'];
	//$grupocontroladora=$fila['Grupo'];
	//$idcontroladora=$fila['idcontroladora'];
	//echo $idcontroladora.'-'.$grupocontroladora.'<br>';
}

//Crear la funcion que creara los usuarios 
function insertarusuarios($con,$identificacion,$ingreso,$salida,$i,$stat,$oficina,$grupo)
{
    
    //Contar si el usuario existe
    
    //Creamos el insert de los usuarios
    $sqlinsertarusuarios="REPLACE INTO usuarios 
    (idusuarios,identificacion,fechainicio,fechafin,ncontroladora
    ,estado,oficina,grupo) 
    VALUES (NULL, '$identificacion', '$ingreso','$salida','$i'
    ,'$stat','$oficina','$grupo');";
    //echo $sqlinsertarusuarios."<br>";   
    $resultadoinsertarusuarios = mysqli_query($con,$sqlinsertarusuarios);
    //mysqli_close($con);
}
$buscarn="SELECT * FROM visitantes ";
$resultadobuscar = mysqli_query($con,$buscarn);
//Recorremos la consulta

$validarr=0;
while($fila = mysqli_fetch_assoc($resultadobuscar))
{
    //Asignamos las variables
    $grupovisitante=$fila['grupo'];
    $ingreso=$fila['Ingreso'];
    $salida=$fila['Salida'];
    $stat='N';
    $oficina=$fila['Oficina'];
    $identificacion=$fila['identificacion'];
    $grupo=$fila['grupo'];
    //Si el visitante tiene grupo 2 creamos dos for uno para grupo 1 y el otro para grupo 2
    if($grupovisitante=="2")
    {
        for($i=1;$i<=$numerocontroladoras;$i++)    
        {           
            if($matriz[$i]==1)
            {
                $grupo=1;
                $validarr=insertarusuarios($con,$identificacion,$ingreso,$salida,$i
                ,$stat,$oficina,$grupo);           
                
            }
            if($matriz[$i]==10)
            {
                $grupo=10;
                $validarr=insertarusuarios($con,$identificacion,$ingreso,$salida,$i
                ,$stat,$oficina,$grupo);           
                
            }
            if($matriz[$i]==11)
            {
                $grupo=11;
                $validarr=insertarusuarios($con,$identificacion,$ingreso,$salida,$i
                ,$stat,$oficina,$grupo);           
                
            }
            if($matriz[$i]==2)
            {
                $grupo=2;
                $validarr=$validainsert=insertarusuarios($con,$identificacion, $ingreso,$salida,$i
                ,$stat,$oficina,$grupo);           
               
            }
        }
    }
    else
    {
        for($i=1;$i<=$numerocontroladoras;$i++)    
        {
        if($matriz[$i]==1)
        {
            $grupo=1;
            $validarr=insertarusuarios($con,$identificacion,$ingreso,$salida,$i
            ,$stat,$oficina,$grupo);           
            
        }
        if($matriz[$i]==10)
        {
            $grupo=10;
            $validarr=insertarusuarios($con,$identificacion,$ingreso,$salida,$i
            ,$stat,$oficina,$grupo);           
            
        }
        if($matriz[$i]==11)
        {
            $grupo=11;
            $validarr=insertarusuarios($con,$identificacion,$ingreso,$salida,$i
            ,$stat,$oficina,$grupo);           
            
        }
    }

    }
    
}
//echo "Inserto $contador";
?>
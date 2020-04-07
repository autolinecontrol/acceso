<?php
require '../conexion.php';
require '../db.php';
$usuario   = $_GET['identificacion'];
$nombres   = $_GET['nombre'];
$correo    = $_GET['correo'];
$ingreso   = $_GET['ingreso'];
$salida    = $_GET['salida'];
$tipo      = $_GET['tipo'];
$carro     = $_GET['vehiculo'];
$ofice     = $_GET['oficina'];
$grupo     = $_GET['grupo'];
$tipovehiculo =$_GET['tipovehiculo'];
//$grupo=1;
$documentoadmin=1;
$nombreadmin="SISTEMA";
$accion="REGISTRADO";
echo $tipo;
$codigo = rand(1000, 9999);
$stat = 'N';
$cont='1';
//Validacion de vehiculo
if($carro=='SI')
{
    $sqlinsertar="replace INTO visitantes (idvisitante,nombre,identificacion,codigo,Oficina,correo,Ingreso,Salida,estado,ncontroladora,tipo,vehiculo,Tipovehiculo,grupo) VALUES (NULL,  '$nombres', '$usuario', '$codigo','$ofice','$correo','$ingreso','$salida','$stat','$cont','$tipo','$carro','$tipovehiculo','$grupo')";
    $resultado = mysqli_query($con,$sqlinsertar);
    $sqllog="insert INTO logregistros (idLog,Administrador,idVisitante,idAutoriza,Oficina,Fechainicio,Fechafin,Tipo,Accion,Vehiculo,Tipovehiculo,Correo) VALUES (NULL,  '$nombreadmin', '$usuario','$documentoadmin','$ofice','$ingreso','$salida','$tipo','$accion','$carro','$tipovehiculo','$correo')";
    $resultado = mysqli_query($con,$sqllog);   
}
else
{
    $tipovehiculo="NO";
    $resultado = mysqli_query($con, "replace INTO visitantes (idvisitante,nombre,identificacion,codigo,Oficina,correo,Ingreso,Salida,estado,ncontroladora,tipo,vehiculo,Tipovehiculo,grupo,autorizo) VALUES (NULL,  '$nombres', '$usuario', '$codigo','$ofice','$correo','$ingreso','$salida','$stat','$cont','$tipo','$carro','$tipovehiculo','$grupo',NULL)");
    $sqllog="insert INTO logregistros (idLog,Administrador,idVisitante,idAutoriza,Oficina,Fechainicio,Fechafin,Tipo,Accion,Vehiculo,Tipovehiculo,Correo) VALUES (NULL,  '$nombreadmin', '$usuario','$documentoadmin','$ofice','$ingreso','$salida','$tipo','$accion','$carro','$tipovehiculo','$correo')";
    $resultado = mysqli_query($con,$sqllog);
}
// Saber cuantas controladoras hay
$consulta = "SELECT COUNT(*) FROM controladoras";
if ($resultado = $mysqli->query($consulta)) 
{
    $fila = $resultado->fetch_row();
    $numerocontroladoras = $fila[0];
    printf("La Consulta devolvió %d\n", $numerocontroladoras);
    echo '<br>';
    /* liberar el conjunto de resultados */
    $resultado->close();
}
// Creacion de arreglo con idcontroladora y grupo
$sqlmostraroficina="Select idcontroladora,Grupo from controladoras ";
$resultadooficina = mysqli_query($con,$sqlmostraroficina);                             
while($fila = mysqli_fetch_assoc($resultadooficina))
{		
    $matriz[$fila['idcontroladora']]=$fila['Grupo'];
}

echo 'usuario para registrar '.$usuario;

// Valida si el usuario a registrar existe
$consulta = "SELECT COUNT(*) FROM usuarios where identificacion = '$usuario'";
if ($resultado = $mysqli->query($consulta)) 
{
    $fila = $resultado->fetch_row();               
    $numerous = $fila[0];
    printf(" us %d\n", $numerous);
    echo '<br>';           
    /* liberar el conjunto de resultados */
    $resultado->close();
}

// Asiganacion de grupo por Perfil  si  no se trae (null)
if ($tipo == 'VISITANTE')
{
    if($grupo== '')$grupo = 1;
    $fechamax= date("Y-m-d",strtotime($ingreso."+ 16 days"));
}
if ($tipo == 'CONTRATISTA')
{
    if($grupo=='')$grupo = 2;
    $fechamax= date("Y-m-d",strtotime($ingreso."+ 91 days"));
}
if ($tipo == 'FUNCIONARIO')
{
    if($grupo=='')$grupo = 2;
    $fechamax= date("Y-m-d",strtotime($ingreso."+ 367 days"));
}
//Borra usuarios que ya esten registrados
if($numerous > 0)
{
    echo 'ya existe';    
    $perfiltiempo = 1;
    $dias = 7;            
    //for($i=1;$i<=$numerocontroladoras;$i++)    
    //{   
    $sql = "delete from usuarios WHERE identificacion='$usuario'";
    if (mysqli_query($mysqli, $sql)) 
    {
        echo "Record updated successfully";
    } 
    else 
    {
        echo "Error updating record: " . mysqli_error($mysqli);
    }
}
//Insertar datos por grupo
echo 'GRUPO '.$grupo;
//exit;
//Creamos la funcion insert de usuarios
function insertaru ($con,$usuario, $ingreso,$salida,$i,$stat,$carro,$ofice,$grupo,	$perfiltiempo,$dias,$tipovehiculo)
{
    $perfiltiempo=1;
    $dias=7;
    echo "la controladora es igual a ".$i." y el grupo es igual a ".$grupo."<br>"; 
   
    $sqlinsertarusuarios="insert INTO usuarios 
    (idusuarios,identificacion,fechainicio,fechafin,ncontroladora
    ,estado,vehiculo,oficina,grupo,perfiltiempo,dias,tipov) 
    VALUES (NULL, '$usuario', '$ingreso','$salida','$i'
    ,'$stat','$carro','$ofice','$grupo','$perfiltiempo','$dias',
    '$tipovehiculo')";
    //echo $sqlinsertarusuarios;
    $resultado1 = mysqli_query($con,$sqlinsertarusuarios); 
     
}
$validainsert=0;
switch ($grupo) 
{  
//Insertar visitantes grupos:
// 1 looby
    case 1:
    {
        for($i=1;$i<=$numerocontroladoras;$i++)    
        {   
            
            if($matriz[$i]==$grupo)
            {				
                $validainsert=insertaru($con,$usuario, $ingreso,$salida,$i
    		    ,$stat,$carro,$ofice,$grupo,$perfiltiempo,$dias,
    		    $tipovehiculo);           
                echo $validainsert;     
            }
        }
    }
    break;
//Insertar Funcionarios y Contratistas grupos:
// 1 Lobby
// 2 Parqueadero
// 4 TX
    
    case 2:
    {
        for($i=1;$i<=$numerocontroladoras;$i++)    
        {           
            if($matriz[$i]==1)
            {
                $grupo=1;
                $validainsert=insertaru($con,$usuario, $ingreso,$salida,$i
                ,$stat,$carro,$ofice,$grupo,$perfiltiempo,$dias,
                $tipovehiculo);           
                echo $validainsert;
            }
            if($matriz[$i]==2)
            {
                $grupo=2;
                $validainsert=insertaru($con,$usuario, $ingreso,$salida,$i
                ,$stat,$carro,$ofice,$grupo,$perfiltiempo,$dias,
                $tipovehiculo);           
                echo $validainsert;
            }
            if($matriz[$i]==4)
            {
                $grupo=4;
                $validainsert=insertaru($con,$usuario, $ingreso,$salida,$i
    		    ,$stat,$carro,$ofice,$grupo,$perfiltiempo,$dias,
    		    $tipovehiculo);           
                echo $validainsert;
            }
        }
    }
    break;
//Insertar Funcionarios VIP grupos:
// 1 Lobby
// 3 Parqueadero Visitantes
// 4 TX
    case 3:
    {
        for($i=1;$i<=$numerocontroladoras;$i++)    
        {     
            echo $i;      
            if($matriz[$i]==1)
            {
                $grupo=1;
                $validainsert=insertaru($con,$usuario, $ingreso,$salida,$i
    		    ,$stat,$carro,$ofice,$grupo,$perfiltiempo,$dias,
    		    $tipovehiculo);           
                echo $validainsert;
            }
            if($matriz[$i]==3)
            {
                $grupo=3;
                $validainsert=insertaru($con,$usuario, $ingreso,$salida,$i
    		    ,$stat,$carro,$ofice,$grupo,$perfiltiempo,$dias,
    		    $tipovehiculo);           
                echo $validainsert;
            }
            if($matriz[$i]==4)
            {
                $grupo=4;
                $validainsert=insertaru($con,$usuario, $ingreso,$salida,$i
    		    ,$stat,$carro,$ofice,$grupo,$perfiltiempo,$dias,
    		    $tipovehiculo);           
                echo $validainsert;
            }
        }
    }
    break;
//Insertar Funcionarios y Contratistas grupos:
// 3 Parqueadero
// 4 TX
    case 4:
    {
        for($i=1;$i<=$numerocontroladoras;$i++)    
        {           
            if($matriz[$i]==3)
            {
                $grupo=3;
                $validainsert=insertaru($con,$usuario, $ingreso,$salida,$i
    		    ,$stat,$carro,$ofice,$grupo,$perfiltiempo,$dias,
    		    $tipovehiculo);           
                echo $validainsert;
            }
            if($matriz[$i]==4)
            {
                $grupo=4;
                $validainsert=insertaru($con,$usuario, $ingreso,$salida,$i
    		    ,$stat,$carro,$ofice,$grupo,$perfiltiempo,$dias,
    		    $tipovehiculo);           
                echo $validainsert;
            }
        }
    }
    break;
    mysqli_close($conn);             
}   
?>

<?php
include ("../conexion.php");
$contador=0;
function insertar($nombres,$apellidos,$documento,$programa,$tipo,$email,$con)
{/*
    echo "Este es el Nombre ".$nombres."</br>";
    echo "Este es el Apellido ". $apellidos."</br>";
    echo "Este es el Documento ".$documento."</br>";
    echo "Este es el programa ".$programa."</br>";
    echo "Este es el tipo ".$tipo."</br>";
    echo "Este es el correo ".$email."</br>";
    echo "<hr></br>";*/
    $ingreso="2020-01-01";
    $salida="2020-06-01";
    
    $stat="N";
    $cont="1";
    $grupo="1";
    $sqlvisi="REPLACE INTO visitantes(idvisitante,nombre,apellidos,identificacion,Oficina,correo,Ingreso,Salida,estado,ncontroladora,
    tipo,grupo) VALUES (NULL,  '$nombres','$apellidos','$documento','$programa','$email','$ingreso','$salida','$stat',
    '$cont','$tipo','$grupo')";
    //echo $sqlvisi."<hr></br>";
    $resultado = mysqli_query($con,$sqlvisi);
}

require_once 'ConexionesBD.class.php';
include_once 'configuracion.php';
$bdIceberg= ConexionesBD::instancia($icebergHost, $icebergPort, $icebergUser, $icebergPassword, $icebergSID);
$connIceberg = $bdIceberg->conectar();
$sentencia='select * from ugc_control_acceso';                 
$resultado = $bdIceberg->ejecutaCompleto($connIceberg, $sentencia);
//print_r ($resultado);*/

foreach ($resultado as $row) {
    
    insertar($row['NOMBRES'],$row['APELLIDOS'],$row['DOCUMENTO'],$row['DEPENDENCIA_PROGRAMA'],$row['TIPOPERSONA'],$row['EMAIL'],$con);
    $contador++;
    /*
        echo "Este es el Nombre ".$row['NOMBRES']."</br>";
        echo "Este es el Apellido ". $row['APELLIDOS']."</br>";
        echo "Este es el Documento ".$row['DOCUMENTO']."</br>";
        echo "Este es el programa ".$row['DEPENDENCIA_PROGRAMA']."</br>";
        echo "Este es el tipo ".$row['TIPOPERSONA']."</br>";
        echo "Este es el correo ".$row['EMAIL']."</br>";
        echo "<hr></br>";
        */
    }
    echo "El numero de personas Insertadas Fue: ".$contador;
   
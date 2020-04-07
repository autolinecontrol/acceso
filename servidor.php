<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
require 'conexion.php';


$personas = $_GET['personas'];
$usuarioIDEliminado   = $_GET['usuarioIDEliminado'];

$usuarioIDActualizado = $_GET['usuarioIDActualizado'];
$nombreActualizado    = $_GET['nombreActualizado'];
$ingresoActualizado   = $_GET['ingresoActualizado'];
$salidaActualizado    = $_GET['salidaActualizado'];


//insertar
$nuevoUsuario        = $_GET['nuevoUsuario'];
$nuevoEmail          = $_GET['nuevoEmail'];
$nuevaOficina        = $_GET['nuevaOficina'];
$nuevaIdentificacion = $_GET['nuevaIdentificacion'];
$nuevoIngreso        = $_GET['nuevoIngreso'];
$nuevoSalida         = $_GET['nuevoSalida'];


//Actualizar
$nombreID    = "nombreID";
$emailID     = "emailID";
$ingresoID   = "ingresoID";
$salidaID    = "salidaID";
$actualizar  = "actualizar";
$borrar      = "borrar";
$tipo        = "VISITANTE";


if($personas === "personas")
{
    $hoy = date("Y-m-d");
    echo 'Fecha Actual '.$hoy;
    $resultado = mysqli_query($con, "select * from visitantes WHERE tipo='$tipo' and Salida >= '$hoy' ");
    $table .= '<div class="container">';
    $table .= '<div class="table-responsive">';
    //$table .= '<button onclick = "ejecutarNuevaVentana()" class = "btn btn-primary "> Agregar Usuarios </button>';
    $table .= '<table class = "table table-striped table-bordered">';
    $table .= '<tr>';
    $table .= '<th>Usuario</th>';
    $table .= '<th>Identificacion</th>';
    $table .= '<th>Nombre</th>';
    $table .= '<th>Oficina</th>';
    $table .= '<th>Fecha Hora Ingreso</th>';
    $table .= '<th>Fecha Hora Salida</th>';
    $table .= '<th>Estado </th>';
    $table .= '<th>NC </th>';
    $table .= '<th>Editar </th>';
    $table .= '<th>Borrar </th>';
    $table .= '<th>QR </th>';
    
    
    $table .= '</tr>';
    
    while($fila = mysqli_fetch_assoc($resultado))
    {
        $genera  = 'gen.php?iden=';
        $table .= '<tr>';
        $table .= '<td>' . $fila['idvisitante'] . '</td>';
        $table .= '<td>' . $fila['identificacion'] . '</td>';
        $table .= '<td id ="'.$nombreID.$fila['idvisitante'].'">' . $fila['nombre'] . '</td>';
        //$table .= '<td id ="'.$emailID.$fila['idvisitante'].'">' . $fila['correo'] . '</td>';
        $table .= '<td>' . $fila['Oficina'] . '</td>';
        $table .= '<td id ="'.$ingresoID.$fila['idvisitante'].'">' . $fila['Ingreso'] . '</td>';
        $table .= '<td id ="'.$salidaID.$fila['idvisitante'].'">' . $fila['Salida'] . '</td>';
        $table .= '<td>' . $fila['estado'] . '</td>';
	$table .= '<td>' . $fila['ncontroladora'] . '</td>';
        $table .= '<td> <input id = "'.$fila['idvisitante'].'" onclick = "editarUsuario(this.id)"'
                . ' type="button" value = "Editar" class = "btn btn-Info"</td>';
        $table .= '<td> <input id = "'.$borrar.$fila['idvisitante'].'" '
                . 'onclick = "borrarUsuario('.$fila['idvisitante'].')" type="button" value = "Borrar" class = "btn btn-danger"</td>';
        $table .= '<td> <input id = "'.$actualizar.$fila['idvisitante'].'" onclick = "actualizarUsuario('.$fila['idvisitante'].')" type="button" value = "Actualizar" class = "btn btn-primary" style="display:none"</td>';
        $table .= "<a href='$genera".$fila['identificacion']."'>Genera</a>";
	
        $table .= '</tr>';
    }
    $table .= '</table>';
    
    $table .= '</div>';
     echo $table;
    mysqli_close($con);
}

if(!empty($ingresoActualizado)){
    
    $ingresoactual = mysqli_real_escape_string($con, $ingresoActualizado);
    $salidaactual  = mysqli_real_escape_string($con, $salidaActualizado);
    $status = "N";
    $ncontroladora = "1";
    $resultado     = mysqli_query($con, "UPDATE visitantes SET Ingreso = '$ingresoactual', Salida = '$salidaactual', estado='$status', ncontroladora='$ncontroladora' WHERE idvisitante = $usuarioIDActualizado");
    mysqli_close();
}

if(!empty($usuarioIDEliminado)){
    $resultado = mysqli_query($con, "DELETE FROM visitantes WHERE idvisitante = $usuarioIDEliminado");
    mysqli_close();
}

if(!empty($nuevoUsuario) && !empty($nuevoEmail)){
    echo $nuevoUsuario;
    echo $nuevaIdentificacion;
    echo $nuevaOficina;
    echo $nuevoEmail;
    echo $nuevoIngreso;
    echo $nuevoSalida;
    $codigo = rand(10, 10000);
    $resultado = mysqli_query($con, "INSERT INTO visitantes (idvisitante,nombre,identificacion,codigo,Oficina,correo,Ingreso,Salida) VALUES ('', '$nuevoUsuario', '$nuevaIdentificacion', '$codigo', '$nuevaOficina','$nuevoEmail','$nuevoIngreso','$nuevoSalida')");
    //myqli_close();
    
    
    //$resultado = mysqli_query($con, "INSERT into visitantes values('','$nuevoUsuario','$nuevaIdentificacion','$codigo',$nuevaOficina',$nuevoEmail')");
    //myqli_close();
}



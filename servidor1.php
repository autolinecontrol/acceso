<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
require 'conexion.php';

$personas = $_GET['personas'];
$usuarioIDEliminado = $_GET['usuarioIDEliminado'];

$usuarioIDActualizado = $_GET['usuarioIDActualizado'];
$nombreActualizado = $_GET['nombreActualizado'];

//insertar
$nuevoUsuario        = $_GET['nuevoUsuario'];
$nuevoEmail          = $_GET['nuevoEmail'];
$nuevaOficina        = $_GET['nuevaOficina'];
$nuevaIdentificacion = $_GET['nuevaIdentificacion'];
$nuevoIngreso        = $_GET['nuevoIngreso'];
$nuevoSalida         = $_GET['nuevoSalida'];

$nombreID = "nombreID";
$emailID = "emailID";
$actualizar = "actualizar";
$borrar = "borrar";

if($personas === "personas")
{
    $resultado = mysqli_query($con, "select * from visitantes ORDER BY nombre ");
    
    $table .= '<div class = "container">';
    $table .= '<table class = "table table-striped table-bordered">';
    $table .= '<tr>';
    $table .= '<th>Usuario</th>';
    $table .= '<th>Nombre</th>';
    $table .= '<th>Email</th>';
    $table .= '<th>Borrar Usuario</th>';
    $table .= '</tr>';
    
    while($fila = mysqli_fetch_assoc($resultado))
    {
        $table .= '<tr>';
        $table .= '<td>' . $fila['idvisitante'] . '</td>';
        $table .= '<td id ="'.$nombreID.$fila['idvisitante'].'">' . $fila['nombre'] . '</td>';
        $table .= '<td id ="'.$emailID.$fila['idvisitante'].'">' . $fila['correo'] . '</td>';
        $table .= '<td> <input id = "'.$borrar.$fila['idvisitante'].'" onclick = "borrarUsuario('.$fila['idvisitante'].')" type="button" value = "Borrar" class = "btn btn-danger"</td>';
        
        $table .= '</tr>';
    }
    $table .= '</table>';
    $table .= '<button onclick = "ejecutarNuevaVentana()" class = "btn btn-primary "> Nuevo </button>';
    $table .= '</div>';
    echo $table;
    mysqli_close($con);
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
    $stat = 'N';
    $cont='1';
    $resultado = mysqli_query($con, "replace INTO visitantes (idvisitante,nombre,identificacion,codigo,Oficina,correo,Ingreso,Salida,estado,ncontroladora) VALUES ('', '$nuevoUsuario', '$nuevaIdentificacion', '$codigo', '$nuevaOficina','$nuevoEmail','$nuevoIngreso','$nuevoSalida','$stat','$cont')");
}


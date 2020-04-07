<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
require 'db.php';

ob_start();
session_start();

if($_SESSION['logged_in']!== true){
    header("Location: index.php");
    exit();
}else{
    $nombre  = $_SESSION['nombre'];
    $oficina = $_SESSION['oficina'];
    $email   = $_SESSION['email'];
    //echo $oficina;
    $result = $mysqli->query("SELECT * FROM funcionarios WHERE email = '$email'");

    if($result-> num_rows === 0){
        unset($_SESSION['logged_in']);
        $_SESSION['message']= 'Debes iniciar sesion antes de ver tu pagina de Perfil!';
        header("Location: error.php");
        exit();
    }else{
        $user = $result->fetch_assoc();
        $activo = $user['activo'];
        //echo $activo;
       
    }
}
?>
<?php

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
$tipo        = "FUNCIONARIO";

//echo $nuevaOficina;


if($personas === "personas")
{   
    $resultado = mysqli_query($con, "select * from visitantes WHERE`tipo` NOT IN ('VISITANTE','ESTUDIANTE') and Salida >= '$hoy' ");
    $table .= '<div class="container">';
    $table .= '<div class="table-responsive">';
    //$table .= '<button onclick = "ejecutarNuevaVentana()" class = "btn btn-primary "> Agregar Usuarios </button>';
    $table .= '<table class = "table table-striped table-bordered">';
    $table .= '<tr>';
    // $table .= '<th>Id</th>';
    $table .= '<th>Identificacion</th>';
    $table .= '<th>Nombres</th>';
    $table .= '<th>Correo</th>';
    $table .= '<th>Carro</th>';
    $table .= '<th>Oficina</th>';
    $table .= '<th>Tipo</th>';
    $table .= '<th>Ingreso</th>';
    $table .= '<th>Salida</th>';
    $table .= '<th>E</th>';
    $table .= '<th>Editar </th>';
    $table .= '<th>Borrar </th>';
    $table .= '<th>QR </th>';
    
    
    $table .= '</tr>';
    
    while($fila = mysqli_fetch_assoc($resultado))
    {
        $genera  = 'gen.php?iden=';
        $table .= '<tr>';
        // $table .= '<td>' . $fila['idvisitante'] . '</td>';
        $table .= '<td>' . $fila['identificacion'] . '</td>';
        $table .= '<td id ="'.$nombreID.$fila['idvisitante'].'">' . $fila['nombre'] . '</td>';
        $table .= '<td id ="'.$emailID.$fila['idvisitante'].'">' . $fila['correo'] . '</td>';
        $table .= '<td>' . $fila['vehiculo'] . '</td>';
        $table .= '<td>' . $fila['Oficina'] . '</td>';
        $table .= '<td>' . $fila['tipo'] . '</td>';
        $table .= '<td id ="'.$ingresoID.$fila['idvisitante'].'">' . $fila['Ingreso'] . '</td>';
        $table .= '<td id ="'.$salidaID.$fila['idvisitante'].'">' . $fila['Salida'] . '</td>';
        $table .= '<td>' . $fila['estado'] . '</td>';
        $table .= '<td> <input id = "'.$fila['idvisitante'].'" onclick = "editarUsuario(this.id)"'
                . ' type="button" value = "Editar" class = "btn btn-Info"</td>';
        $table .= '<td> <input id = "'.$borrar.$fila['idvisitante'].'" '
                . 'onclick = "borrarUsuario('.$fila['idvisitante'].')" type="button" value = "Borrar" class = "btn btn-danger"</td>';
        $table .= '<td> <input id = "'.$actualizar.$fila['idvisitante'].'" onclick = "actualizarUsuario('.$fila['idvisitante'].')" type="button" value = "Actualizar" class = "btn btn-primary" style="display:none"</td>';
        $table .= "<a href='$genera".$fila['identificacion']."'>Enviar</a>";   
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
    $codigo = rand(10, 1000);
    $resultado = mysqli_query($con, "INSERT INTO visitantes (idvisitante,nombre,identificacion,codigo,Oficina,correo,Ingreso,Salida) VALUES ('', '$nuevoUsuario', '$nuevaIdentificacion', '$codigo', '$nuevaOficina','$nuevoEmail','$nuevoIngreso','$nuevoSalida')");
    //myqli_close();
    
    
    //$resultado = mysqli_query($con, "INSERT into visitantes values('','$nuevoUsuario','$nuevaIdentificacion','$codigo',$nuevaOficina',$nuevoEmail')");
    //myqli_close();
}



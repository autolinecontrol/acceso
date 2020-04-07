<?php
$validar=0;
error_reporting(E_ERROR | E_WARNING | E_PARSE);
require 'db.php';
ob_start();
session_start();
if($_SESSION['logged_in']!== true)
{
    header("Location: index.php");
    exit();
}
else
{
    $nombre  = $_SESSION['nombre'];
    $oficina = $_SESSION['oficina'];
    $email   = $_SESSION['email'];
    $result = $mysqli->query("SELECT * FROM funcionarios WHERE email = '$email'");
    if($result-> num_rows === 0)
    {
        unset($_SESSION['logged_in']);
        $_SESSION['message']= 'Debes iniciar sesion antes de ver tu pagina de Perfil!';
        header("Location: error.php");
        exit();
    }
    else
    {
        $user = $result->fetch_assoc();
        $activo = $user['activo'];   
    }
}
?>
<head>
	<link href="StyleSheet.css" rel="stylesheet" />
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
	<script src="bootstrap/js/bootstrap.min.js"></script>
    <title>Buscar Registros</title>
    <link rel="stylesheet" href="assets/demo.css">
    <link rel="stylesheet" href="assets/header-second-bar.css">
	<link href='http://fonts.googleapis.com/css?family=Cookie' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
	<style type="text/css">
    input[type="checkbox"]  {
    display:inline-block;
    width:19px;
    height:19px;
    margin:-2px 10px 0 0;
    vertical-align:middle;
    cursor:pointer;
    }
    </style>    
</head>
<body>
<?php
if($activo<2)
{
    session_start();
    session_unset();
    session_destroy();
    $_SESSION['message']="Ocurrio un Error";
    header("Location: error.php");
    exit();
}
if($activo>1)
{
    include 'banner.php';
}
?>     
<header class="header-two-bars">
<div class="header-second-bar">
<br>
<form class="contact_form" id="buscador" name="buscador" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>"> 
    <ul>
        <li></li><br>
        1- Escoja una Fecha: <br><br>
        Fecha y Hora de Inicio <br><Input id="busca" name="ingreso" type="datetime-local" placeholder="Entrada"  value="<?php echo date('Y-m-d').'T'.date('06:00'); ?>" autofocus ><br><br>
        Fecha y Hora de Inicio Fin : <br><input id="busca" name="salida" type="datetime-local" placeholder="Salida"  value="<?php echo date('Y-m-d').'T'.date('23:59'); ?>" autofocus ><br><br>
        2- Parametros: <br><br>
        <input id="busca" name="id" type="search" placeholder="Cedula" autofocus ><br><br>
        <input id="busca" name="oficina" type="search" placeholder="Oficina" autofocus ><br><br>
        <select name="tip" form="buscador">
            <option value="FUNCIONARIO">FUNCIONARIO</option>
            <option value="VISITANTE">VISITANTE</option>
            <option value="CONTRATISTA">CONTRATISTA</option>
        </select>
        <br><br>
        3- Seleccione una Opcion adicional: <br> 
        <li>
        <input type="checkbox" name="Documento" id="documento" value="documento">Cedula<br></li>
        <li>
        <input type="checkbox"  name="Oficina" id="oficina" value="oficina">Oficina </li>
        <li>
        <input type="checkbox"  name="Perfil" id="perfil" value="perfil"> Perfil</li><br>
    </ul>
    <input type="submit" name="buscador" class="btn btn-success" value="buscar">
</form>
</div>
</header>
<?php
require 'conexion.php';
$nuevoIngreso = $_POST['ingreso'];
$nuevoSalida=$_POST['salida'];
$nuevoid=$_POST['id'];
$nuevooficina=$_POST['oficina'];
$nuevotipo=$_POST['tip'];
if(isset($_POST['buscador']))
{
    $sql="select 
    logregistros.idVisitante,
    visitantes.nombre,
    logregistros.Fechainicio,
    logregistros.Fechafin,
    logregistros.Oficina,
    logregistros.Administrador,
    logregistros.Fechahora,
    logregistros.Tipo,
    visitantes.estado,
    logregistros.Accion,
    logregistros.idAutoriza,
    logregistros.Vehiculo,
    logregistros.Correo
    from
    logregistros,visitantes 
    where
    logregistros.idVisitante=visitantes.identificacion and
    Fechainicio  >= '$nuevoIngreso'and
    Fechainicio <='$nuevoSalida'"
    ;
    $validar=1;
}
else
{
}
$vacio=0;
if(isset($_POST['Documento']))
{
    $sql=$sql.=" and logregistros.idVisitante = ".$nuevoid;
}
if(isset($_POST['Oficina']))
{
    $sql=$sql." and logregistros.Oficina = ".$nuevooficina;
}
if(isset($_POST['Perfil']))
{
    $sql=$sql." and logregistros.Tipo LIKE '".$nuevotipo."'";
}
$sql=$sql." ORDER BY logregistros.Fechahora  ASC";
//echo $sql;
$resultado = mysqli_query($con,$sql);
?>
<!--<div class = "container">!-->
<table class = "table table-striped table-bordered">
    <tr>
        <th>Cedula Usuario</th>
        <th>Nombre Usuario</th>
        <th>Fecha Inicio </th>
        <th>Fecha Fin</th>
        <th>Oficina</th>
        <th>Administrador</th>
        <th>Transaccion</th>
        <th>Tipo</th>
        <th>Estado</th>
        <th>Vehiculo</th>
        <th>Correo</th>
        <th>Accion</th>
        <th>Anfitrion</th>
    </tr>
<?php
while($fila = mysqli_fetch_assoc($resultado))
{
    if($validar==1){
    $autoriza = '';
    if( $fila['idAutoriza']=='1')
        {
           $autoriza = 'Masivo';
        }
        else
        {
           $autoriza = $fila['idAutoriza'];
        }
        echo '<tr>';
        echo '<td>' . $fila['idVisitante'] . '</td>';
        echo '<td>' . $fila['nombre'] . '</td>';
        echo "<td> " .$fila['Fechainicio'] . '</td>';
        echo '<td>' . $fila['Fechafin'] . '</td>';
        echo '<td>' . $fila['Oficina'] . '</td>';
        echo '<td>'. $fila['Administrador']. '</td>';
        $horalocal=date('Y-m-d H:i:s', strtotime($fila['Fechahora']." + 2 hours "));
        echo '<td>'.$horalocal . '</td>';
        echo '<td>'. $fila['Tipo']. '</td>';
        echo '<td>'. $fila['estado']. '</td>';
        echo '<td>'. $fila['Vehiculo']. '</td>';
        echo '<td>'. $fila['Correo']. '</td>';
        echo '<td>'. $fila['Accion']. '</td>';
        echo '<td>'. $autoriza. '</td>';
        echo '</tr>';
    }
}

mysqli_close($con);
?>
</table>
</div>

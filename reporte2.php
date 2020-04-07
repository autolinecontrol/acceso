<?php
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
    
    $result = $mysqli->query("SELECT * FROM funcionarios WHERE email = '$email'");

    if($result-> num_rows === 0){
        unset($_SESSION['logged_in']);
        $_SESSION['message']= 'Debes iniciar sesion antes de ver tu pagina de Perfil!';
        header("Location: error.php");
        exit();
    }else{
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
        
       <title>Reporte Salidas</title>

	   <link rel="stylesheet" href="assets/demo.css">
	   <link rel="stylesheet" href="assets/header-second-bar.css">
	   <link href='http://fonts.googleapis.com/css?family=Cookie' rel='stylesheet' type='text/css'>
	   <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
        
</head>
 <body>
            
            <div class="form">
            <?php
            if(!$activo){
                echo "<div class = 'alert alert-info'>
                    Tu cuenta fue creada! Te acabamos de enviar un correo, 
                    por favor confirma tu cuenta haciendo click en el link enviado, gracias.
                    </div>";
            }?>
           
            <header class="header-two-bars">

            <div class="header-first-bar">

                <div class="header-limiter">

                    <h1><a href="#">Central<span>Point</span></a></h1>
                    

                    <nav>
                        <a href="perfil.php">Registro</a>
                        <a href="reporte1.php">Visitantes</a>
                        <a href="reporte2.php">Funcionarios</a>
                        
                    </nav>

                    <a href="logout.php" class="logout-button">Logout</a>
                </div>

            </div>

            <div class="header-second-bar">

                
                    <nav>
                        <a href="#"><i class="fa fa-comments-o"></i> Questions</a>
                        <a href="#"><i class="fa fa-file-text"></i> Results</a>
                        <a href="#"><i class="fa fa-group"></i> Participants</a>
                        <a href="#"><i class="fa fa-cogs"></i> Settings</a>
                    </nav>
                    <br>
                    <form class="contact_form" id="buscador" name="buscador" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>"> 
                        <input id="busca" name="ingreso" type="datetime-local" value="<?php echo date('Y-m-d').'T'.date('07:00'); ?>"  placeholder="Entrada" autofocus >
                        <input id="busca" name="salida" type="datetime-local" value="<?php echo date('Y-m-d').'T'.date('19:00'); ?>"  placeholder="Salida" autofocus >
                        
                        <input type="submit" name="buscador" class="btn btn-success" aceptar" value="buscar">
                    </form>
                   
                

            </div>

        </header>
<?php
if($_POST){
require 'conexion.php';
$nuevoIngreso = $_POST['ingreso'];
$nuevoSalida = $_POST['salida'];
$tipo = "FUNCIONARIO";

$resultado = mysqli_query($con, "select visitantes.identificacion, visitantes.nombre, transacciones.oficina, "
        . " transacciones.Ingreso, transacciones.Salida,transacciones.Estado,"
        . " controladoras.nombrecontroladora "
        . " from transacciones,visitantes,controladoras"
        . " where transacciones.identificacion = visitantes.identificacion "
        . " and transacciones.controladora = controladoras.idcontroladora"
	. " and visitantes.tipo = '$tipo' "
        . " and transacciones.Ingreso > '$nuevoIngreso'"
        . " and transacciones.Ingreso < '$nuevoSalida'"
        
        . "order by transacciones.Ingreso"
        );
}

?>

<div class = "container">
<table class = "table table-striped table-bordered">
<tr>
<th>Identificacion</th>
<th>Nombre</th>
<th>Oficina</th>
<th>Ingreso</th>
<th>Salida</th>
<th>Estado</th>
<th>Dispositivo</th>
</tr>
<?
while($fila = mysqli_fetch_assoc($resultado))
{
    echo '<tr>';
    echo '<td>' . $fila['identificacion'] . '</td>';
    echo '<td>' . $fila['nombre'] . '</td>';
    echo '<td>' . $fila['oficina'] . '</td>';
    if($fila['Estado']== 'I')
    {
        echo '<td>' . $fila['Ingreso'] . '</td>';
        echo '<td>' . '-' . '</td>';
        echo '<td>' .'Ingreso'. '</td>';    
    }
    if($fila['Estado']== 'O')
    {
        echo '<td>' . '-' . '</td>';
        echo '<td>' . $fila['Ingreso'] . '</td>';
        echo '<td>' . 'Salida' . '</td>';
    }
    
    echo '<td>' . $fila['nombrecontroladora'] . '</td>';
    echo '</tr>';
}
mysqli_close($con);
?>
</table>
</div>


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
                        <a href="funcionariosoficina.php">Funcionarios con Vehiculo</a>
                        <a href="report.php">Reportes</a>
                        
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
                    
        

            </div>

        </header>
<?php
//if($_POST){
require 'conexion.php';

//$nuevoIngreso = $_POST['ingreso'];
//$nuevoSalida = $_POST['salida'];

$resultado = mysqli_query($con, "select * from oficinas order by Nombre");
//}

?>

<div class = "container">
<table class = "table table-striped table-bordered">
<tr>
<th>Oficina</th>
<th>Nombre</th>
<th>Carros</th>
<th>Cupo</th>
<th>Disp</th>
<th>Motos</th>
<th>Cupo</th>
<th>Disp</th>

</tr>
<?
while($fila = mysqli_fetch_assoc($resultado))
{
    echo '<tr>';
    echo '<td>' . $fila['Numero'] . '</td>';
    echo '<td>' . $fila['Nombre'] . '</td>';
    echo '<td>' . $fila['Cupoactual'] . '</td>';
    echo '<td>' . $fila['Cupo'] . '</td>';
    $falta = (int)$fila['Cupo']-(int)$fila['Cupoactual'];
    echo '<td>' . $falta . '</td>'; 
    echo '<td>' . $fila['CupoActualMotos'] . '</td>';
    echo '<td>' . $fila['CupoMotos'] . '</td>';
    $falta1 = (int)$fila['CupoMotos']-(int)$fila['CupoActualMotos'];
    echo '<td>' . $falta1 . '</td>';
    echo '</tr>';
}
mysqli_close($con);
?>
</table>
</div>


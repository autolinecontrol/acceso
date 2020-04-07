<?php
require 'db.php';


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
            $activo = 3;
            if(!$activo){
                echo "<div class = 'alert alert-info'>
                    Tu cuenta fue creada! Te acabamos de enviar un correo, 
                    por favor confirma tu cuenta haciendo click en el link enviado, gracias.
                    </div>";
            }?>
           
            <header class="header-two-bars">

            <div class="header-first-bar">

                <div class="header-limiter">

                    <h1><a href="perfil.php">Central<span>Point</span></a></h1>
                    

                    
                </div>

            </div>

            <div class="header-second-bar">

                
                    <nav>
                       
                        <a href="#"><i class="fa fa-cogs"></i> Exportar</a>
                    </nav>
                    <br>
                    <form class="contact_form" id="buscador" name="buscador" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>"> 
                        <input id="busca" name="ingreso" type="datetime-local" placeholder="Entrada"  value="<?php echo date('Y-m-d').'T'.date('06:00'); ?>" autofocus >
                        <input id="busca" name="salida" type="datetime-local" placeholder="Salida"  value="<?php echo date('Y-m-d').'T'.date('23:59'); ?>" autofocus >
                        <input id="busca" name="id" type="search" placeholder="Cedula" autofocus >
                        <input id="busca" name="oficina" type="search" placeholder="Oficina" autofocus >
                        <select name="tip" id="sel1">
                            <option>VISITANTE</option>
                            <option>FUNCIONARIO</option>
                        </select>
                        <select name="estado" id="sel1">
			    <option>A</option>
                            <option>I</option>
                            <option>O</option>
                        </select>
                        <select name="conteo" id="sel1">
                            <option>Repetidos</option>
                            <option>Unicos</option>
                        </select>
                        
                        <input type="submit" name="buscador" class="btn btn-success" aceptar" value="buscar">
                    </form>
                   
                

            </div>

        </header>
<?php
if($_POST)
{
require 'conexion.php';
$nuevoIngreso = $_POST['ingreso'];
$nuevoSalida = $_POST['salida'];
$nuevoid = $_POST['id'];
$nuevaofice = $_POST['oficina'];
$tipo  = $_POST['tip'];
$estado = $_POST['estado'];
$conteo = $_POST['conteo'];

if($nuevoid=="")
{
$resultado = mysqli_query($con, "select visitantes.identificacion, visitantes.nombre, transacciones.oficina, "
        . " transacciones.Ingreso, transacciones.Salida,transacciones.Estado,"
        . " controladoras.nombrecontroladora "
        . " from transacciones,visitantes,controladoras"
        . " where transacciones.identificacion = visitantes.identificacion "
        . " and visitantes.tipo = '$tipo' "
        //. " where transacciones.identificacion = '$nuevoid' "
        . " and transacciones.controladora = controladoras.idcontroladora"
        . " and transacciones.Ingreso > '$nuevoIngreso'"
        . " and transacciones.Ingreso < '$nuevoSalida'"
        . " and transacciones.oficina = '$nuevaofice'"
        . " and transacciones.Estado = '$estado'"
        . "order by transacciones.Ingreso desc"
        );
}
else
{
$resultado = mysqli_query($con, "select visitantes.identificacion, visitantes.nombre, transacciones.oficina, "
        . " transacciones.Ingreso, transacciones.Salida,transacciones.Estado,"
        . " controladoras.nombrecontroladora "
        . " from transacciones,visitantes,controladoras"
        . " where transacciones.identificacion = visitantes.identificacion "
        . " and visitantes.identificacion = '$nuevoid' "
        . " and visitantes.tipo = '$tipo' "
        . " and transacciones.controladora = controladoras.idcontroladora"
        . " and transacciones.Ingreso > '$nuevoIngreso'"
        . " and transacciones.Ingreso < '$nuevoSalida'"
        . " and transacciones.oficina = '$nuevaofice'"
        ." and transacciones.Estado = '$estado'"                 
        . "order by transacciones.Ingreso desc"
        
       
        );
}
if($nuevaofice=="")
{
     if($estado=="A")
    {
        $resultado = mysqli_query($con, "select visitantes.identificacion, visitantes.nombre, transacciones.oficina, "
        . " transacciones.Ingreso, transacciones.Salida,transacciones.Estado,"
        . " controladoras.nombrecontroladora "
        . " from transacciones,visitantes,controladoras"
        . " where transacciones.identificacion = visitantes.identificacion "
        . " and visitantes.tipo = '$tipo' "
        . " and transacciones.controladora = controladoras.idcontroladora"
        . " and transacciones.Ingreso > '$nuevoIngreso'"
        . " and transacciones.Ingreso < '$nuevoSalida'"
        //. " and transacciones.Estado = '$estado'"
        //. " GROUP BY visitantes.identificacion"
        . " order by transacciones.Ingreso desc"
        
        );
    }
    else
    {
        $resultado = mysqli_query($con, "select visitantes.identificacion, visitantes.nombre, transacciones.oficina, "
        . " transacciones.Ingreso, transacciones.Salida,transacciones.Estado,"
        . " controladoras.nombrecontroladora "
        . " from transacciones,visitantes,controladoras"
        . " where transacciones.identificacion = visitantes.identificacion "
        . " and visitantes.tipo = '$tipo' "
        . " and transacciones.controladora = controladoras.idcontroladora"
        . " and transacciones.Ingreso > '$nuevoIngreso'"
        . " and transacciones.Ingreso < '$nuevoSalida'"
        . " and transacciones.Estado = '$estado'"
        //. " GROUP BY visitantes.identificacion"
        . " order by transacciones.Ingreso"
        
        );
        
    }
}
if($conteo=="Unicos")
{
    $resultado = mysqli_query($con, "select visitantes.identificacion, visitantes.nombre, transacciones.oficina, "
        . " transacciones.Ingreso, transacciones.Salida,transacciones.Estado,"
        . " controladoras.nombrecontroladora "
        . " from transacciones,visitantes,controladoras"
        . " where transacciones.identificacion = visitantes.identificacion "
        . " and visitantes.tipo = '$tipo' "
        . " and transacciones.controladora = controladoras.idcontroladora"
        . " and transacciones.Ingreso > '$nuevoIngreso'"
        . " and transacciones.Ingreso < '$nuevoSalida'"
        . " and transacciones.Estado = '$estado'"
        . " GROUP BY visitantes.identificacion"
        . " order by transacciones.Ingreso desc"
        
        );
}
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
<?php
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
    $num = $num+1;
    echo '</tr>';
   
}
echo "Numero de Registros " . $num;
mysqli_close($con);
?>
</table>
</div>


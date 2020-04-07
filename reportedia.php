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

                    <h1><a href="#">Autoline<span>Control</span></a></h1>
                    

                    <nav>
                        <a href="perfil.php">Registro</a>
                        <a href="mostrar.php">Visitantes</a>
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
                    <form class="contact_form" id="buscador" name="buscador" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>"> 
                        <input id="busca" name="ingreso" type="datetime-local" placeholder="Entrada"  value="<?php echo date('Y-m-d').'T'.date('06:00'); ?>" autofocus >
                        <input id="busca" name="salida" type="datetime-local" placeholder="Salida"  value="<?php echo date('Y-m-d').'T'.date('23:59'); ?>" autofocus >
                        <input id="busca" name="id" type="search" placeholder="Cedula" autofocus >
                        <input id="busca" name="oficina" type="search" placeholder="Oficina" autofocus >
                        <select name="tip" id="sel1">
                            <option>FUNCIONARIO</option>
                            <option>VISITANTE</option>
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
$inicio = strtotime($nuevoIngreso);
$fin = strtotime($nuevoSalida);
$dif = $fin - $inicio;
$diasFalt = (( ( $dif / 60 ) / 60 ) / 24);
//echo $diasFalt;
$ndias =  round($diasFalt,0);
echo $ndias.'<br>';
$diaactual=1;//
$menor=0;
for ($i = 0; $i < $ndias; $i++)
{

 $days ="+".$i."day";

 $nuevafecha = strtotime ( $days , strtotime ( $nuevoIngreso ) ) ;
 $nuevafecha = date ( 'Y-m-d' , $nuevafecha ); 
 $nuevofin =  date('Y-m-d', strtotime ( '+1 day' , strtotime ( $nuevafecha)));
 //echo $nuevafecha.' / '.$nuevofin.'<br>';
}   
?>
                                                                                                            <div class = "container">
<table class = "table table-striped table-bordered">
<tr>
<th>Identificacion</th>
<th>Ingreso</th>
<th>Salida</th>
</tr>
                                                   
<?php
   
    $resultado = mysqli_query($con, "select visitantes.identificacion "
        . " from transacciones,visitantes"
        . " where transacciones.identificacion = visitantes.identificacion "
        . " and visitantes.tipo = '$tipo' "
        . " and transacciones.Ingreso > '$nuevoIngreso'"
        . " and transacciones.Ingreso < '$nuevoSalida'"
        . "group by visitantes.identificacion"
        );

                              
 $x=0;//apuntador        

while($fila = mysqli_fetch_assoc($resultado))
{
    //$cc[$y] =  $fila['identificacion'] . '</br>';
    //$y++; 
    $resultado1 = mysqli_query($con, "select * "
        . " from transacciones"
        . " where identificacion = '".$fila["identificacion"]."' "
        . " and transacciones.Ingreso > '$nuevoIngreso'"
        . " and transacciones.Ingreso < '$nuevoSalida'"
        . " order by transacciones.Ingreso"       
                       
        );
    
    
    while($fila = mysqli_fetch_assoc($resultado1))
    {
        /*algoritmo de fecha menor y mayor
        $Cedula  
        $Cedula[$x]   -> $fila['identificacion']
        $Fechainicial
        $Fecha[$x]    -> $fila['Ingreso']
        $Fechamayor
        $Fechamenor
        */
       
        if($x==0)
        { 
            $Fechamenor = $fila['Ingreso'];
            $Cedula     = $fila['identificacion'];
        }
       /* echo $x.'</br>'; 
        echo 'Cedula    '.$Cedula.'</br>'; 
        echo 'Cedula[$x]'.$fila['identificacion'].'</br>';
        */
        if($Cedula==$fila['identificacion'])
        {
             $Fechainicial= $fila['Ingreso'];
        }
        
        //echo 'Fechainicial'.$Fechainicial.'</br>';
        
        if($Cedula != $fila['identificacion'] )
        {
            $Fechamayor = $Fechainicial;
            echo '<tr>';
            echo '<td>' . $Cedula . '</td>';
            echo '<td>' . $Fechamenor . '</td>';
            echo '<td>' . $Fechamayor . '</td>';
            echo '</tr>';
            
            $Fechamenor = $fila['Ingreso'];
            $Cedula     = $fila['identificacion'];
        }
      
        $x=$x+1;
        
           
    }
}



mysqli_close($con);

}
?>







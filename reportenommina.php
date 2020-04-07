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
  
    $resultado = mysqli_query($con, "select visitantes.identificacion "
        . " from transacciones,visitantes"
        . " where transacciones.identificacion = visitantes.identificacion "
        . " and visitantes.tipo = '$tipo' "
        . " and transacciones.Ingreso > '$nuevoIngreso'"
        . " and transacciones.Ingreso < '$nuevoSalida'"
        . "group by visitantes.identificacion "
         
                             
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
        . " order by transacciones.Ingreso ASC"       
                       
        );
    
    
    while($fila = mysqli_fetch_assoc($resultado1))
    {
	echo $fila['identificacion'];
        /*
        $t = strtotime($fila['Ingreso']);
        
        if($x==0)
        { 
            $Fechamenor = $fila['Ingreso'];
            $Fecha1 = date("Y-m-d", $t);
            $Cedula1 = $fila['identificacion'];
            $h1 = date("H:i:s", $t); 
        }
        
        $Cedula2 = $fila['identificacion'];
        $Fecha2 = date("Y-m-d", $t);
        $Fechaactual = $fila['Ingreso'];
        $h2 = date("H:i:s", $t);
        
        //echo 'F1-'.$Fecha1.'H1-'.$h1.' fyh '.$fila['Ingreso'].'Cedula1-'.$Cedula1.'<br>';
        //echo 'F2-'.$Fecha2.'H2-'.$h2.' fyh '.$fila['Ingreso'].'Cedula2-'.$Cedula2.'<br>'.'<br>';
        
        if($Fecha1==$Fecha2)
        {
            
            if($h1<$h2)
            {
                //echo 'Fecha menor'.$Fechamenor,'</br>';
                $Fecha1=$Fecha2;
                $Fechamayor = $Fechaactual;
            }
        }
        
        if($Fecha1 < $Fecha2)
        {
            echo 'Cedula Ingreso '.$Cedula2.' Fecha ingreso '. $Fechamenor.' Fecha Salida '. $Fechamayor.'<br>'.'<br>';
            $Fecha1=$Fecha2;
            $h1=$h2;
            $Fechamenor=$fila['Ingreso'];
        }
        if($Cedula1!=$Cedula2)
        {
            //$Fechamayor = $Fechaactual;
            //echo 'Cedula Ingreso cc '.$Cedula2.' Fecha ingreso '. $Fechamenor.' Fecha Salida '. $Fechamayor.'<br>';
            //$Fechamenor = $fila['Ingreso'];
            $Fecha1=date("Y-m-d", $t);
            $Cedula1=$Cedula2;
            
        }
        
        //echo 'Fecha de Ingreso '.$fila['Ingreso'].'</br>';
       
        $x=$x+1;
        */
           
    }
}



mysqli_close($con);

}
?>


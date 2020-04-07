<?php
$validar=0;
error_reporting(E_ERROR | E_WARNING | E_PARSE);
require 'db.php';
require 'conexion.php';

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
        
       <title>Buscar Movimientos</title>

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

                     <h1><a href="perfil.php">Central<span>Point &nbsp;&nbsp;&nbsp;</span></a></h1>
                    <ul class="nav">
                                
                                  <li class="dropdown">
                                    <a href="perfil.php" class="dropbtn"> Registro</a>
                                  </li>
                                  <li class="dropdown">
                                    <a href="adminoficinas.php" class="dropbtn">Administradores</a>
                                  </li>
                              
                    <a href="logout.php" class="logout-button">Logout</a>
                    </ul>
                </div>

            </div>

            <div class="header-second-bar">
<?php $sqloficina="Select * from oficinas ORDER BY Numero";
                    $resultadooficina = mysqli_query($con,$sqloficina);?>
                
                   
                    <br>
                    <form class="contact_form" id="buscador" name="buscador" method="post" action="reporteexceldia.php"> 
                    <ul>
                        <li></li><br>
                        1- Escoja una Fecha: <br><br>
                        Fecha y Hora de Inicio <br><Input id="busca" name="ingreso" type="datetime-local" placeholder="Entrada"  value="<?php echo date('Y-m-d').'T'.date('06:00'); ?>" autofocus ><br><br>
                        Fecha y Hora de Inicio Fin : <br><input id="busca" name="salida" type="datetime-local" placeholder="Salida"  value="<?php echo date('Y-m-d').'T'.date('23:59'); ?>" autofocus ><br><br>
                        2- Parametros: <br><br>
                        
                        <input id="busca" name="id" type="search" placeholder="Cedula" autofocus ><br><br>
                        Oficina:<br><br>
                        <select id="busca" name="oficina" >
                    <?php
                     while($fila = mysqli_fetch_assoc($resultadooficina))
                        {
                             echo '<option value="'.$fila['Numero'].'">'.$fila['Nombre'].'</option>';
                        }?>
                    </select>
                        <br><br>
                        Tipo:<br><br>
                        <select name="tip" form="buscador">
                            <option value="FUNCIONARIO">FUNCIONARIO</option>
                            <option value="VISITANTE">VISITANTE</option>
                            <option value="CONTRATISTA">CONTRATISTA</option>
                        </select>
                        <br><br>
                        
                        3- Seleccione una Opcion adicional: <br> 
                    
                        
                         <li>
                         <input type="checkbox" name="Documento" id="Documento" value="1">Cedula<br></li>
                         <li>
                         <input type="checkbox"  name="Oficina" id="Oficina" value="1">Oficina </li>
                         <li>
                         <input type="checkbox"  name="Perfil" id="Perfil" value="1"> Perfil</li><br>
                         
                    </ul>
                        <input type="submit" name="buscador" class="btn btn-success" aceptar" value="Exportar">
                       
</form>
                                 

            </div>

        </header>
                    </form>


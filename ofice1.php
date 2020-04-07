<?php require 'db.php'; ob_start(); session_start(); if($_SESSION['logged_in']!== true){
    header("Location: index.php");
    exit();
}else{
    $nombre = $_SESSION['nombre'];
    $oficina = $_SESSION['oficina'];
    $email = $_SESSION['email'];
    
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
?> <head>
	<link href="StyleSheet.css" rel="stylesheet" />
       <!-- Latest compiled and minified CSS -->
	   <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	   <!-- jQuery library -->
	   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	   <!-- Latest compiled JavaScript -->
	   <script src="bootstrap/js/bootstrap.min.js"></script>
        
       <title>Registro</title>
	   <link rel="stylesheet" href="assets/demo.css">
	   <link rel="stylesheet" href="assets/header-second-bar.css">
	   <link href='http://fonts.googleapis.com/css?family=Cookie' rel='stylesheet' type='text/css'>
	   <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
        
</head>
 <body>
        <form method="get" name="ingresodep" id="contFrm" action="">
            <div class="form">
            <?php
            if($activo<2)
            {
                session_start();
                session_unset();
                session_destroy();
                
            echo '<h1>No tinenes el Perfil para Activar Funcionarios </h1>';
            echo '<a href="index.php">Inicio</a>';
            }
            if($activo>1){
                
            ?>
           
            <header class="header-two-bars">
            <div class="header-first-bar">
                <div class="header-limiter">
                    <h1><a href="#">Central<span>Point</span></a></h1>
                    
                    <nav>
                        <a href="perfil.php">Registro</a>
                        <a href="mostrar.php">Visitantes</a>
                        <a href="report.php">Reportes</a>
                        <a href="activarfuncionarios.php">Funcionarios</a>
                        <a href="ofice.php">Oficinas</a>
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
                        <input id="busca" name="ingreso" type="search" placeholder="Oficina Numero" autofocus >
                        
                        <input type="submit" name="consulta" class="btn btn-success" aceptar" value="buscar">
                        
                    </form>
                    
            </div>
        </header> <?php require 'conexion.php'; if(isset($_GET['nuevo'])) { $id = $_GET['id']; //echo $id; $nactivo="2"; $Consulta = mysqli_query($con,"UPDATE funcionarios SET activo='2' 
        $resultado = mysqli_query($con, "SELECT identificacion,nombre,activo 
          from funcionarios
          where identificacion = '$id'
         order by nombre"
        );
}
if(isset($_GET['guarda'])) { $nombre = $_GET['nombreoficina']; $ubicacion = $_GET['ubicacion']; $numero = $_GET['numero']; $cupos = $_GET['cupos']; $resultado = mysqli_query($con, "INSERT 
INTO oficinas (Nombre,Ubicacion,Numero,Cupos) VALUES ('$nombre', '$ubicacion', '$numero', '$cupos')");
 myqli_close();
}
if(isset($_GET['consulta'])) { $numero = $_GET['ingreso']; $resultado = mysqli_query($con, "select Nombre,Ubicacion,Numero,Cupos"
        . " from oficinas"
        . " where Numero = '$numero'"
        );
        
    $Datoss = mysqli_fetch_array($resultado);
    $numero = $Datoss["Numero"];
    $nombreoficina = $Datoss["Nombre"];
    $ubicacion = $Datoss["Ubicacion"];
    $cupos = $Datoss["Cupos"];
}
?> <div class = "container">
            <form method="get" class="contact_form">
                <ul>
                <li>
                    <h2>Usuarios</h2>
                    <span class="required_notification">* Datos requeridos</span>
                </li>
                <li>
                    <label for="name">*Oficina No:</label>
                    <input type="text" name="numero" placeholder="Numero" id ="nuevaIdentificacionID" value="<?php echo $numero; ?>" required />
                </li>
                <li>
                    <label for="name">*Nombre:</label>
                    <input type="text" name="nombreoficina" placeholder="Nombre Oficina" id ="nuevoUsuarioID" value="<?php echo $nombreoficina; ?>" required />
                </li>
                
                <li>
                    <label for="ubica">*Ubicacion:</label>
                    <input type="text" name="ubicacion" placeholder="ubicacion" id ="nuevoUbicacion" value="<?php echo $ubicacion; ?>" required />
                </li>
                <li>
                    <label for="cupos">*Cupos:</label>
                    
                    <input type="text" name="cupos" placeholder="50" id ="nuevoUbicacion" value="<?php echo $cupos; ?>" required />
                </li>
                
                <li>
                    <label for="Fecha"> </label>
                    <input type="submit" name="guarda" class="btn btn-success" value= "Guardar">
                </li>
                </ul> <?
}
?> </div>

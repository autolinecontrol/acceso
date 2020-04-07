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
<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
	<link href="StyleSheet.css" rel="stylesheet" />
       <!-- Latest compiled and minified CSS -->
	   <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

	   <!-- jQuery library -->
	   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

	   <!-- Latest compiled JavaScript -->
	   <script src="bootstrap/js/bootstrap.min.js"></script>
       <title>Second Bar Header</title>

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
                        <a href="mostrar.php">Visitantes</a>
                        <a href="reporte1.php">Reportes</a>
                        <a href="#">Roles</a>
                    </nav>

                    <a href="logout.php" class="logout-button">Logout</a>
                </div>

            </div>

            <div class="header-second-bar">

                <div class="header-limiter">
                    <h2><a href="#">Survey name</a></h2>

                    <nav>
                        <a href="#"><i class="fa fa-comments-o"></i> Questions</a>
                        <a href="#"><i class="fa fa-file-text"></i> Results</a>
                        <a href="#"><i class="fa fa-group"></i> Participants</a>
                        <a href="#"><i class="fa fa-cogs"></i> Settings</a>
                    </nav>

                </div>

            </div>

        </header>
		
			
            <script>
                function showUser(str) {
                    if (str=="") {
                        document.getElementById("txtHint").innerHTML="";
                        return;
                  } 
                  if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp=new XMLHttpRequest();
                  } else { // code for IE6, IE5
                    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                  }
                  xmlhttp.onreadystatechange=function() {
                    if (this.readyState==4 && this.status==200) {
                      document.getElementById("txtingreso").innerHTML=this.responseText;
                    }
                  }
                  xmlhttp.open("GET","servidor3.php?IngresoID=" + str, true)
                  xmlhttp.send();
                }
                </script>

                        <link href="css/StyleSheet.css" rel="stylesheet" />
                        <title>Reportes</title>


                        <form class="contact_form">
                <label for="Fecha">*Ingreso:</label>
                <input type="datetime-local" name="users" value="<?php echo date('Y-m-d').'T'.date('H:i'); ?>" onchange="showUser(this.value)" placeholder="yyyy-MM-hh HH:mm:ss"  required  />
                <span class="form_hint">Formato correcto: "yyyy-MM-hh HH:mm"</span>

                <br>

                <div id="txtingreso"><b>Escoja Hora y Fecha Ingreso </b></div>
                </form>
  
         
        </body>    
</html>
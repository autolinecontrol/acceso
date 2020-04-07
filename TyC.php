<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
require 'db.php';

ob_start();
ini_set("session.cookie_lifetime","7200");
ini_set("session.gc_maxlifetime","7200");
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
        //echo $activo;
       
    }
    if($_POST["rechazar"])
    {
        unset($_SESSION['logged_in']);
        $_SESSION['message']= 'Debes aceptar los terminos y condiciones ';
        header("Location: error.php");
        exit();
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
        
       <title>Terminos y Condiciones</title>

	   <link rel="stylesheet" href="assets/demo.css">
	   <link rel="stylesheet" href="assets/header-second-bar.css">
	   <link href='http://fonts.googleapis.com/css?family=Cookie' rel='stylesheet' type='text/css'>
	   <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
	   
        
</head>
 <body>
        <form  method="post" name="ingresodep" id="contFrm" action="">    
            <div class="form">
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
                        
                        ?>
                    
                    
                    
                </div>

            </div>

            
                <center>
                    <div class="row">
  <div class="col-sm-2"></div>
  <div class="col-sm-8"><br><br><br><br><br><br><br><br>
      <h1>Términos y Condiciones</h1>
     


<p>Estoy de acuerdo con la <a href="Politica.html">Política de Tratamiento de Datos</a>
y los <a href="Politica.html">Términos y Condiciones</a> para el uso de la plataforma</p><center>
<a href="perfil.php" class="btn btn-success" role="button">Aceptar</a>

 <input type="submit" name="rechazar" class="btn btn-success"  value="Rechazar">

</center>
</div>
  <div class="col-sm-2"></div>
</div>
             
                    </center>
            

        </header>
<?php




?>
</div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</body>



<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
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
        //echo $activo;
       
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
        
       <title>Subir Masivos</title>

	   <link rel="stylesheet" href="assets/demo.css">
	   <link rel="stylesheet" href="assets/header-second-bar.css">
	   <link href='http://fonts.googleapis.com/css?family=Cookie' rel='stylesheet' type='text/css'>
	   <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
        
</head>
 <body>
<form method="post" action="subir.php" enctype="multipart/form-data" id="testform">

            <div class="form">
            <?php
            if($activo<2)
            {
                session_start();
                session_unset();
                session_destroy();
                
            echo '<h1>No tienes el Perfil para Activar Funcionarios </h1>';
            echo '<a href="index.php">Inicio</a>';
            }
            if($activo>=2){
                
            ?>
           
            <header class="header-two-bars">

            <div class="header-first-bar">

                <div class="header-limiter">

 <h1><a href="perfil.php">Central<span>Point &nbsp;&nbsp;&nbsp;</span></a></h1>

                           <ul class="nav">
                                
                                  <li class="dropdown">
                                    <a href="perfil.php" class="dropbtn"> Registro</a>
                                  </li>
                                 
                        
                           
                   

                    <a href="logout.php" class="logout-button">Logout</a>
                    </ul>
                </div>

            </div>

           

        </header>
            <ol>
            <li>
                    <label for="name">Administrador:</label><br>
                    <input type="text" name="admin" placeholder="Nombres Apellidos" id ="nuevoUsuarioID" value="<?php echo $nombre; ?>"  readonly />
            </li>
            
            
                
             <br><label for="Fecha">Oficina:</label>
             <? if($oficina<2){?>
                    
                    <select name="ofice" class="form-control" id="sel1">
                        <option value=1>Administracion</option>
                        <option value=2>Acosta Consultores</option>
                        <option value=3>Assist card</option>
                        <option value=4>Avia Marketing</option>
                        <option value=5>Aviatur</option>
                        <option value=6>Bbva Premium</option>
                        <option value=7>Canales Desarrolladores</option>
                        <option value=8>Colempresas</option>
                        <option value=9>HBI</option>
                        <option value=10>Helm Bank USA</option>
                        <option value=11>Itau Banca Privada</option>
                        <option value=12>Isolucion</option>
                        <option value=13>Inversiones Lopez</option>
                        <option value=14>Naciones Unidas</option>
                        <option value=15>Octopus Travel</option>
                        <option value=16>Palacios Lleras</option>
                        <option value=17>Racafe</option>
                        <option value=18>Trafigura</option>
                    </select>
                    <?}?>
             <? if($oficina>1){?>
             <br><input type="text" placeholder="Oficina" name="ofice" id ="oficina" value="<?php echo $oficina; ?>" readonly />
              <?}?>
                
                     <?php $fecha_actual = date("Y-m-d");
                    //sumo 1 día
                    $fechamax= date("Y-m-d",strtotime($fecha_actual."+ 366 days"));
                    $fechamin =$fecha_actual;
                    echo $ingreso; ?> 
                    <br><label for="Fecha">Inicia :</label><br>
                    <input type="datetime-local" name="ingreso" value="<?php echo date('Y-m-d').'T'.date('06:00'); ?>"  min="<?php echo $fechamin.'T'.date('06:00'); ?>" max = "<?php echo $fechamax.'T'.date('06:00'); ?>" placeholder="yyyy-MM-hh HH:mm:ss" id="IngresoID" required  />
                    <span class="form_hint">Formato correcto: "yyyy-MM-hh HH:mm"</span>
                
                     <?php $fecha_actual = date("Y-m-d");
                    //sumo 1 día
                    $fechamax= date("Y-m-d",strtotime($fecha_actual."+ 366 days"));
                    $fechamin =$fecha_actual;
                     echo $salida;?> 
                    <br><br> 
                    <label for="Fecha">Expira (Fecha no puede ser mayor a 1 año) </label><br>
                    <input type="datetime-local" name="salida" value="<?php echo date('Y-m-d').'T'.date('23:00'); ?>"  min="<?php echo $fechamin.'T'.date('06:00'); ?>" max = "<?php echo $fechamax.'T'.date('23:00'); ?>" placeholder="yyyy-MM-hh HH:mm:ss" id="SalidaID" required  />
                    <span class="form_hint">Formato correcto: "yyyy-MM-hh HH:mm"</span>
                    
               
    <br><br>
    <input name="archivo" type="file" id="archivo">
    <br>
    <input name="boton" type="submit" id="boton" value="Subir" />
    </ol>
  </p>
</form>

</body>
<?
}
?>
</table>
</div>

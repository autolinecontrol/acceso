<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE); 
require 'db.php';
require 'conexion.php';
ob_start();
session_start();

if($_SESSION['logged_in'] == true){
    header("Location: perfil.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
  <title>Inicio </title>
  <?php include 'css/css.html'; ?>
</head>

<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login'])) {
        require 'login.php';
    }
    else if (isset($_POST['registrar'])) {
        require 'registrar.php';
    }
}
?>
<body>

<div class="container">
        <div class="panel-body">
          <div class="row">
            <div class="form">
              <div class="panel-heading">
                <div class="row">
                  <ul class="botones-principales">
                      <li class="tab active"><a href="#login">Login</a></li>
                      <li class="tab"><a href="#signup">Crear cuenta</a></li>
                  </ul>
                </div>
               </div>
        
          <form  action="index.php" method="post" class="form-login" style="display: block;">
              <input type="email" class="form-control" placeholder="&#xf0e0; Correo"  name= "email" required autofocus><br/>
              <input type="password" class="form-control" placeholder="&#xf023; Contraseña" name = "password" required><br/>
              <button class="button button-block" name="login" />INGRESAR</button><br/>
              <div class="form-group">
                <div class="row">
                    <div class="text-center">
                      <a href="forgot.php" tabindex="5" class="forgot-password">¿Olvidaste tu contraseña?</a>
                    </div>
                </div>
              </div>
          </form>
          <form  action="index.php" method="post" class="form-create" style="display: none;">
            <input type="text" placeholder = "Nombre"   class="form-control" required autocomplete="off" name='nombre' /><br/>
            <input type="text" placeholder = "Cedula" class="form-control" required autocomplete="off" name='id' /><br/>
            
            <select name="oficina" class="form-control" placeholder="&#xf0e0; id="sel1">
                    
                     
                    <?php
                    $sqloficina="Select * from oficinas ORDER BY Numero";
                    $resultadooficina = mysqli_query($con,$sqloficina); 
                         while($fila = mysqli_fetch_assoc($resultadooficina))
                        {
                             echo '<option value="'.$fila['Numero'].'">'.$fila['Nombre'].'</option>';
                        }?>
                    </select>
                      
            <br/><br/>
            
            <input type="email" placeholder= "Correo"    class="form-control" required autocomplete="off" name='email' /><br/>
            <input type="password" placeholder= "Contraseña" class="form-control" required autocomplete="off" name='password'/><br/>
            <button type="submit" class="button button-block" name="registrar" />REGISTRARSE</button>
          </form>
        </div>
      </div>
    </div>
</div>
<script src="js/index.js"></script>
</body>
</html>
